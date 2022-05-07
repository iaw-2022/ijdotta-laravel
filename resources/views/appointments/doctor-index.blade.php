@extends('layouts.app')

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Appointments</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body overflow-auto">


                            <table id="appointments" class="table table-hover">
                                <thead>
                                    <th scope="col">Id</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Initial time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Patient</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        @php
                                            $patient = $appointment->patient()->get()->first();
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $appointment->id }}</th>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->initial_time }}</td>
                                            <td>{{ $appointment->end_time }}</td>
                                            <td>
                                                @if ($patient)
                                                    {{$patient->lastname, $patient->name}}
                                                @else
                                                    Free
                                                @endif
                                            </td>
                                            <td class="action-buttons-td">
                                                {!! Form::open(['method' => 'delete', 'route' => ['appointments.destroy', $appointment->id], 'style' => 'display:inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach()
                                </tbody>
                            </table>

                            <div class="pagination d-flex justify-content-start">
                                {{$appointments->links()}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#appointments').DataTable();
        });
    </script>
@endsection