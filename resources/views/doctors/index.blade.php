@extends('layouts.app')

@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
@endsection

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Doctors</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body pb-0">
                            <a class="btn btn-success my-3" href="{{ route('admin.doctors.create') }}">
                                <i class="fas fa-plus-circle mx-1"></i><span>Create</span>
                            </a>
                        </div>

                        <div class="card-body overflow-auto">


                            <table id="doctors" class="table table-hover">
                                <thead>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Lastname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <th scope="row">{{ $doctor->id }}</th>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->lastname }}</td>
                                            <td>{{ $doctor->email }}</td>
                                            <td class="action-buttons-td">
                                                <a
                                                    class="btn btn-warning" href="{{ route('admin.doctors.edit', $doctor->id) }}">
                                                    <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                                </a>
                                                {!! Form::open(['method' => 'delete', 'route' => ['admin.doctors.destroy', $doctor->id], 'style' => 'display:inline']) !!}
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
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#doctors').DataTable();
        });
    </script>
@endsection