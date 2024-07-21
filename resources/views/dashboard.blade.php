@extends('layouts.layout')


@section('title','Queueing System')

@section('content')
<!-- <h1>Hello {{ auth()->user()->username }}</h1>
<a href="{{route('logout')}}">logout</a> -->
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

                <div class="d-flex justify-content-center gap-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Add Patient
                    </button>
                    <a href="{{route('logout')}}" class="btn btn-secondary"> Logout </a>

                    <x-modals.form-addPatient />
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/0">Laboratory</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/1">Radiology</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/2">Pharmacy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/3">Admission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/4">Cashier</a>
                    </li>
                </ul>

                <h4 class="text-center mt-3" id="date"></h4>
                <h4 class="text-center text-light-emphasis" id="time"></h4>
            </div>
        </div>

        <div class="col-md-9">
            <div id="content" class="container d-flex flex-column  mt-4 gap-3">
                <div class="grd gap-2">
                    @foreach ($patients as $patient)
                    <div class="col bg p-3 rounded-3">
                        <h2>{{ $patient->department_name }}</h2>
                        <div class="text-center d-flex flex-column">
                            <h3>Queue No.</h3>
                            <h1 class="display-1">{{$patient->queue_no}}</h1>


                        </div>
                        <div class="d-flex justify-content-start gap-3">
                            <h4>Name:</h4>
                            <h4>{{$patient->patient_name}}</h4>

                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <form action="{{route('served')}}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="served" value="{{$patient->id}}">
                                <input type="submit" class="btn btn-success" value="Served">
                            </form>

                            <form action="{{route('not_served')}}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="not_served" value="{{$patient->id}}">
                                <input type="submit" class="btn btn-danger" value="Not Served">
                            </form>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

        </div>
    </div>
    @endsection
