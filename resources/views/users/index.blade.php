@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Users</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body pb-0">
                            <a class="btn btn-success my-3" href="{{ route('admin.users.create') }}">
                                <i class="fas fa-plus-circle mx-1"></i><span>Create</span>
                            </a>
                        </div>

                        <div class="card-body overflow-auto">

                            <table class="table table-hover">
                                <thead>
                                    <th scope="col">Id</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Related doctor</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->role->role }}</td>
                                            <td>{{ $user->name }}</td>
                                            @php
                                                $rel_doctor = $user->doctor()->get()->first();
                                            @endphp
                                            <td>
                                                @if ($rel_doctor)
                                                    <a class="btn" href="{{route('admin.doctors.show', $rel_doctor->id)}}">
                                                        <i class="fas fa-user-md mx-3"></i><span>{{$rel_doctor->lastname}}, {{$rel_doctor->name}}</span>
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="action-buttons-td">
                                                <a
                                                    class="btn btn-warning" href="{{ route('admin.users.edit', $user->id) }}">
                                                    <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                                </a>
                                                {!! Form::open(['method' => 'delete', 'route' => ['admin.users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach()
                                </tbody>
                            </table>
                            <div class="pagination d-flex justify-content-start">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
