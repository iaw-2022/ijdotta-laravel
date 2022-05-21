@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Patterns</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        
                        <div class="card-body overflow-auto">


                            <table class="table table-hover">
                                <thead>
                                    <th scope="col">Id</th>
                                    <th scope="col">Initial date</th>
                                    <th scope="col">End date</th>
                                    <th scope="col">Initial time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Appointment duration</th>
                                    <th scope="col">Days</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($patterns as $pattern)
                                        <tr>
                                            @php
                                                $doctor = $pattern->doctor()->get()->first(); // todo get from url or somewhere else
                                            @endphp
                                            <th scope="row">{{ $pattern->id }}</th>
                                            <td>{{ $pattern->initial_date }}</td>
                                            <td>{{ $pattern->end_date }}</td>
                                            <td>{{ $pattern->initial_time }}</td>
                                            <td>{{ $pattern->end_time }}</td>
                                            <td>{{ $pattern->appointment_duration }}</td>
                                            <td>{{ implode(" ", ($pattern->days))  }}</td>
                                            <td class="action-buttons-td">
                                                {!! Form::open(['method' => 'delete', 'route' => ['admin.doctors.appointmentspatterns.destroy', [$doctor->id, $pattern->id]], 'style' => 'display:inline']) !!}
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
