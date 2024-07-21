<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'department_id',
        'status'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
