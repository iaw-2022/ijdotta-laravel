@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">{{ $doctor->lastname }}, {{ $doctor->name }} profile</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row my-3">
                                <div class="col-6 d-flex justify-content-start">
                                    <a class="btn btn-primary mx-2" href="{{ route('appointments.index', ['doctor_id' => $doctor->id]) }}">
                                        <i class="fas fa-calendar mx-3"></i><span>Appointments</span>
                                    </a>
                                    <a class="btn btn-info mx-2"
                                        href="{{ route('doctors.appointmentspatterns.index', $doctor->id) }}">
                                        <i class="fas fa-tools mx-3"></i><span>Appointments Patterns</span>
                                    </a>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <a class="btn btn-warning mx-2" href="{{ route('doctors.edit', $doctor->id) }}">
                                        <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                    </a>
                                    {!! Form::open(['method' => 'delete', 'route' => ['doctors.destroy', $doctor->id], 'style' => 'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger mx-2']) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>

                            <table class="table table-bordered table-hover">
                                <thead>
                                    <th scope="row">Id</th>
                                    <th>{{ $doctor->id }}</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            Name
                                        </th>
                                        <td>
                                            {{ $doctor->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Lastname
                                        </th>
                                        <td>
                                            {{ $doctor->lastname }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Email
                                        </th>
                                        <td>
                                            {{ $doctor->email }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
