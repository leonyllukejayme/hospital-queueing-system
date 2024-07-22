@extends('layouts.layout')
@section('title','Queueing System')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 bg-light">
            <div class="d-flex flex-column gap-2">
                <a href="{{route('dashboard')}}">
                    <h4 class="text-center mt-3">Hospital Queueing System</h4>
                </a>
                <!-- <hr /> -->
                <h5 class="text-center text-light-emphasis">Hello {{ auth()->user()->username }}</h5>

                @if ($errors->any())
                <p class="alert alert-danger">Fill up all the fields</p>
                @endif

                <x-sidebar/>

                <h4 class="text-center mt-3" id="date"></h4>
                <h4 class="text-center text-light-emphasis" id="time"></h4>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Waiting Table -->
            <div class="mt-4">
                <h3>{{ $title }}</h3>
                <div class="col-12 scroll">
                    <table class="table table-bordered ">
                        <thead class="table-dark sticky">
                            <tr>
                                <th scope="col" width="13%">Queue No.</th>
                                <th scope="col" width="30%">Name</th>
                                <th scope="col" width="5%">Age</th>
                                <th scope="col" width="12%">Gender</th>
                                <th scope="col" width="12%">Date of Birth</th>
                                <th scope="col" width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                            <tr>
                                <th scope="row">{{$result->queue_no}}</th>
                                <td>{{$result->name}}</td>
                                <td>{{$result->age}}</td>
                                <td>{{$result->gender}}</td>
                                <td>{{$result->birthdate}}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    @php
                                    $isFirstRow = $result->queue_no == $firstQueueNo;
                                    $isLastRow = $result->queue_no == $lastQueueNo;
                                    @endphp
                                    <form action="{{route('reorderQueueUp',['department' => $result->department_id - 1])}}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="dept_id" value="{{$result->department_id}}">
                                        <input type="hidden" name="queue_no" value="{{$result->queue_no}}">

                                        <button type="submit" class="btn btn-primary" @if ($isFirstRow) disabled @endif><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5" />
                                            </svg></button>

                                    </form>


                                    <form action="{{route('reorderQueueDown',['department'=> $result->department_id - 1])}}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="dept_id" value="{{$result->department_id}}">
                                        <input type="hidden" name="queue_no" value="{{$result->queue_no}}">
                                        <button type="submit" class="btn btn-primary" @if ($isLastRow) disabled @endif> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4" />
                                            </svg></button>

                                    </form>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>
    @endsection
