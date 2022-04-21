@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Patient profile</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill"
                                        href="#pills-profile" role="tab" aria-controls="pills-profile"
                                        aria-selected="false">Profile</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-stories-tab" data-toggle="pill"
                                        href="#pills-stories" role="tab" aria-controls="pills-stories"
                                        aria-selected="true">Stories</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-appointments-tab" data-toggle="pill"
                                        href="#pills-appointments" role="tab" aria-controls="pills-appointments"
                                        aria-selected="false">Appointments</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">

                                {{-- Profile tab --}}
                                <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab">...</div>
                                {{-- Stories tab --}}
                                <div class="tab-pane fade" id="pills-stories" role="tabpanel"
                                    aria-labelledby="pills-stories-tab">
                                    <div class="row">
                                        <div class="col-2">
                                            <h2>Info</h2>
                                        </div>
                                        <div class="col-7">
                                            <h2>Description</h2>
                                        </div>
                                        <div class="col-3">
                                            <h2>Actions</h2>
                                        </div>
                                    </div>
                                    @foreach ($stories as $story)
                                        @php
                                            $patient = $story
                                                ->patient()
                                                ->get()
                                                ->first(); //todo: get id from url
                                        @endphp
                                        <div class="row my-3">
                                            <div class="col-2 d-flex flex-column align-items-end">
                                                <h5 class="font-weight-bold">{{ $story->date }}</h5>
                                                <h6 class="font-italic">{{ $story->doctor_id }}</h6>
                                            </div>
                                            <div class="col-7">
                                                {{ $story->description }}
                                            </div>
                                            <div class="col-3">
                                                <a class="btn btn-primary"
                                                    href="{{ route('patients.stories.show', [$patient->id, $story->id]) }}">
                                                    <i class="fas fa-eye mx-1"></i><span>Show</span>
                                                </a>
                                                <a class="btn btn-warning"
                                                    href="{{ route('patients.stories.edit', [$patient->id, $story->id]) }}">
                                                    <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                                </a>
                                                {!! Form::open(['method' => 'delete', 'route' => ['patients.stories.destroy', [$patient->id, $story->id]], 'style' => 'display:inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                {{-- Appointments tab --}}
                                <div class="tab-pane fade overflow-auto" id="pills-appointments" role="tabpanel"
                                    aria-labelledby="pills-appointments-tab">
                                    <table class="table">
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
                                                            {{ $doctor->lastname, $doctor->name }}
                                                        @else
                                                            Unknown doctor
                                                        @endif
                                                    </td>
                                                    <td class="action-buttons-td">
                                                        <a class="btn btn-primary"
                                                            href="{{ route('patients.stories.create',$appointment->patient()->get()->first()->id) }}">
                                                            <i class="fas fa-comment-alt mx-1"></i></i></i><span>Write
                                                                story</span>
                                                        </a>
                                                        <a class="btn btn-warning"
                                                            href="{{ route('appointments.edit', $appointment->id) }}">
                                                            <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                                        </a>
                                                        {!! Form::open(['method' => 'delete', 'route' => ['appointments.destroy', $appointment->id], 'style' => 'display:inline']) !!}
                                                        {!! Form::button('<i class="fas fa-ban mx-1"></i>Cancel', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
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
