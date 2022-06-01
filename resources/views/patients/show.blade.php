@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">{{ $patient->lastname }}, {{ $patient->name }} profile</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <x-success-message/>
                            <x-errors-alert/>

                            <ul class="nav nav-pills mb-3 d-flex justify-content-start" id="pills-tab" role="tablist">
                                <li class="nav-item mx-2" role="presentation">
                                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill"
                                        href="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item mx-2" role="presentation">
                                    <a class="nav-link" id="pills-stories-tab" data-toggle="pill"
                                        href="#pills-stories" role="tab" aria-controls="pills-stories"
                                        aria-selected="true">Stories</a>
                                </li>
                                <li class="nav-item mx-2" role="presentation">
                                    <a class="nav-link" id="pills-appointments-tab" data-toggle="pill"
                                        href="#pills-appointments" role="tab" aria-controls="pills-appointments"
                                        aria-selected="false">Appointments</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">

                                {{-- Profile tab --}}
                                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">

                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <th scope="row">Id</th>
                                            <th>{{ $patient->id }}</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    Name
                                                </th>
                                                <td>
                                                    {{ $patient->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Lastname
                                                </th>
                                                <td>
                                                    {{ $patient->lastname }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Email
                                                </th>
                                                <td>
                                                    {{ $patient->email }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Health Insurance Company
                                                </th>
                                                <td>
                                                    <em>Hidden</em>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Health Insurance Id
                                                </th>
                                                <td>
                                                    <em>Hidden</em>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    Validation code
                                                </th>
                                                <td>
                                                    <em>{{ $patient->verification_code }}</em>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                {{-- Stories tab --}}
                                <div class="tab-pane fade" id="pills-stories" role="tabpanel"
                                    aria-labelledby="pills-stories-tab">

                                    <table class="table table-hover">
                                        <thead>
                                            <th scope="col">Date</th>
                                            <th scope="col" style="width:70%">Description</th>
                                            <th scope="col">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($stories as $story)
                                                @php
                                                    $patient = $story
                                                        ->patient()
                                                        ->get()
                                                        ->first(); //todo: get id from url
                                                @endphp
                                                <tr>
                                                    <td>{{ $story->date }}</td>
                                                    <td style="width:70%">
                                                        <em>Hidden story with id {{ $story->id }}</em>
                                                    </td>
                                                    <td>
                                                        {!! Form::open(['method' => 'delete', 'route' => ['admin.patients.stories.destroy', [$patient->id, $story->id]], 'style' => 'display:inline']) !!}
                                                        {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                {{-- Appointments tab --}}
                                <div class="tab-pane fade overflow-auto" id="pills-appointments" role="tabpanel"
                                    aria-labelledby="pills-appointments-tab">
                                    <table class="table table-hover">
                                        <thead>
                                            <th scope="col" class="d-none">Id</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Initial time</th>
                                            <th scope="col">End time</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Actions</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($appointments as $appointment)
                                                @php
                                                    $doctor = $appointment
                                                        ->doctor()
                                                        ->get()
                                                        ->first();
                                                @endphp
                                                <tr>
                                                    <th scope="row" class="d-none">{{ $appointment->id }}</th>
                                                    <td>{{ $appointment->date }}</td>
                                                    <td>{{ $appointment->initial_time }}</td>
                                                    <td>{{ $appointment->end_time }}</td>
                                                    <td>
                                                        @if ($doctor)
                                                            <i class="fas fa-user-md mx-3"></i><span>{{ $doctor->lastname }},
                                                                {{ $doctor->name }}</span>
                                                        @else
                                                            Unknown doctor
                                                        @endif
                                                    </td>
                                                    <td class="action-buttons-td">
                                                        {!! Form::open(['method' => 'delete', 'route' => ['admin.appointments.destroy', $appointment->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                            @endforeach()
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
