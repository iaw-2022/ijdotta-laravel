@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Appointments</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body pb-0">
                            <a class="btn btn-success my-3" href="{{ route('admin.appointments.create') }}">
                                <i class="fas fa-plus-circle mx-1"></i><span>Create</span>
                            </a>
                        </div>

                        <div class="card-body overflow-auto">


                            <table class="table table-hover">
                                <thead>
                                    <th scope="col">Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Initial time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Doctor</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        @php
                                            $doctor = $appointment
                                                ->doctor()
                                                ->get()
                                                ->first();
                                            $patient = $appointment
                                                ->patient()
                                                ->get()
                                                ->first();
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $appointment->id }}</th>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->initial_time }}</td>
                                            <td>{{ $appointment->end_time }}</td>
                                            <td>
                                                @if ($doctor)
                                                    <a class="btn"
                                                        href="{{ route('admin.doctors.show', $doctor->id) }}">
                                                        <i
                                                            class="fas fa-link mx-3"></i><span>{{ $doctor->lastname}}, {{$doctor->name }}</span>
                                                    </a>
                                                @else
                                                    Unknown doctor
                                                @endif
                                            </td>
                                            <td>
                                                @if ($patient)
                                                    <a class="btn"
                                                        href="{{ route('admin.patients.show', $patient->id) }}">
                                                        <i
                                                            class="fas fa-link mx-3"></i><span>{{ $patient->lastname}}, {{$patient->name }}</span>
                                                    </a>
                                                @else
                                                    Free
                                                @endif
                                            </td>
                                            <td class="action-buttons-td">
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.appointments.edit', $appointment->id) }}">
                                                    <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                                </a>
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
    </section>
@endsection
