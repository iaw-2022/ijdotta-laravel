@extends('layouts.app')

@section('css')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"/> --}}
    {{-- <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" /> --}}
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Patients</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body pb-0">
                            <a class="btn btn-success my-3" href="{{ route('patients.create') }}">
                                <i class="fas fa-plus-circle mx-1"></i><span>Create</span>
                            </a>
                        </div>

                        <div class="card-body overflow-auto">


                            <table id="patients" class="table table-hover">
                                <thead>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Health Insurance Company</th>
                                    <th scope="col">Health Insurance ID</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <th scope="row">{{ $patient->id }}</th>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->lastname }}</td>
                                            <td>{{ $patient->email }}</td>
                                            <td>{{ $patient->health_insurance_company }}</td>
                                            <td>{{ $patient->health_insurance_id }}</td>
                                            <td class="action-buttons-td">
                                                <a
                                                    class="btn btn-primary" href="{{ route('patients.show', $patient->id) }}">
                                                    <i class="fas fa-eye mx-1"></i><span>Show</span>
                                                </a>
                                                <a
                                                    class="btn btn-warning" href="{{ route('patients.edit', $patient->id) }}">
                                                    <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                                </a>
                                                {!! Form::open(['method' => 'delete', 'route' => ['patients.destroy', $patient->id], 'style' => 'display:inline']) !!}
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

@section('page_js')
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $('#patients').DataTable();
        });
    </script>
@endsection
