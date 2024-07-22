<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{

    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect(route('login'));
        }

        $subquery = DB::table('queues as q')
            ->select(
                'p.id',
                'p.name as patient_name',
                'd.name as department_name',
                'q.queue_no',
                DB::raw('ROW_NUMBER() OVER (PARTITION BY d.id ORDER BY q.queue_no) as rn')
            )
            ->join('patients as p', 'q.patient_id', '=', 'p.id')
            ->join('departments as d', 'q.department_id', '=', 'd.id')
            ->where('p.status', 'waiting');

        $patients = DB::table(DB::raw("({$subquery->toSql()}) as subquery"))
            ->mergeBindings($subquery)
            ->where('rn', 1)
            ->get();

        // Log::info($patients);


        return view('dashboard', ['patients' => $patients]);
    }



    public function department($department)
    {
        $dpt = Department::pluck('name');

        $results = DB::table('queues as q')
            ->join('patients as p', 'q.patient_id', '=', 'p.id')
            ->join('departments as d', 'q.department_id', '=', 'd.id')
            ->select('q.queue_no', 'p.name', 'p.age', 'p.gender', 'p.birthdate', 'q.department_id')
            ->where('p.status', 'waiting')
            ->where('d.name', $dpt[$department])
            ->orderBy('q.queue_no')
            ->get();

        // $firstQueueNo = $results->first()->queue_no;
        // $lastQueueNo = $results->last()->queue_no;



        $title = $dpt[$department];
        return view('dept_table', ['title' => $title, 'results' => $results]);
    }


    public function addPatient(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'birthdate' => 'required|date',
            'gender' => 'required|string',
            'department' => 'required|integer|exists:departments,id',
        ]);

        $patientId = DB::table('patients')->insertGetId([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'birthdate' => $request->input('birthdate'),
            'gender' => $request->input('gender'),
            'department_id' => $request->input('department'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $nextPosition = DB::table('queues')->where('department_id', request('department'))->max('queue_no');
        $nextPosition = is_null($nextPosition) ? 1 : $nextPosition + 1;

        DB::table('queues')->insert([
            'patient_id' => $patientId,
            'department_id' => request('department'),
            'queue_no' => $nextPosition,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect(route('dashboard'));
    }

    public function reorderQueueUp(Request $request)
    {

        $department_id = $request->input('dept_id');
        $queue_no = $request->input('queue_no');


        DB::table('queues')
            ->where('department_id', $department_id)
            ->update([
                'queue_no' => DB::raw('CASE
            WHEN queue_no = ' . $queue_no . ' THEN ' . $queue_no - 1 . '
            WHEN queue_no = ' . $queue_no - 1 . ' THEN ' . $queue_no . '
            ELSE queue_no
            END')
            ]);


        return redirect(route('dashboard'));
    }

    public function reorderQueueDown(Request $request)
    {


        $department_id = $request->input('dept_id');
        $queue_no = $request->input('queue_no');

        DB::table('queues')
            ->where('department_id', $department_id)
            ->update([
                'queue_no' => DB::raw('CASE
            WHEN queue_no = ' . $queue_no . ' THEN ' . $queue_no + 1 . '
            WHEN queue_no = ' . $queue_no + 1 . ' THEN ' . $queue_no . '
            ELSE queue_no
            END')
            ]);


        return redirect(route('dashboard'));
    }

    public function served()
    {
        Patient::where('id', request('served'))->update(['status' => 'served']);

        return redirect(route('dashboard'));
    }
    public function not_served()
    {
        Patient::where('id', request('not_served'))->update(['status' => 'not-served']);

        return redirect(route('dashboard'));
    }
}
