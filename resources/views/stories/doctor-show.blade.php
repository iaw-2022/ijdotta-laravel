@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">{{ $patient->lastname }}, {{ $patient->name }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <x-success-message/>
                            <x-errors-alert/>

                            <div class="card p-3 rounded bg-light">
                                <div class="row">
                                    <div class="col-9">
                                        @php
                                            $doctor = $story->doctor()->get()->first();
                                        @endphp
                                        <h1>{{ $story->date }}</h1>
                                            <i class="fas fa-user-md mx-3"></i><span>{{$doctor->lastname}}, {{$doctor->name}}</span>
                                        <p>{{ $story->description }}</p>
                                    </div>
                                    <div class="col-3 d-flex justify-content-end align-items-start">
                                        <a class="btn btn-warning"
                                            href="{{ route('patients.stories.edit', [$patient->id, $story->id]) }}">
                                            <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                        </a>
                                        {!! Form::open(['method' => 'delete', 'route' => ['patients.stories.destroy', [$patient->id, $story->id]], 'style' => 'display:inline']) !!}
                                        {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger mx-2']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row mx-3">
                                <div class="col-9">
                                    <h1>Treatments</h1>
                                </div>
                                <div class="col-3 d-flex align-items-center">
                                    <a class="btn btn-primary" href="{{ route('patients.stories.treatments.create', [$patient->id, $story->id]) }}">
                                        <i class="fas fa-plus-circle mx-1"></i><span>Add treatment</span>
                                    </a>
                                </div>
                            </div>
                            <div class="row mx-3 d-flex justify-content-start">
                            </div>
                            @foreach ($treatments as $treatment)
                                <div class="row m-3">
                                    <div class="col-9">
                                        <h3>{{ $treatment->title }} </h3>
                                        {{ $treatment->description }}
                                    </div>
                                    <div class="col-3 d-flex align-items-center">
                                        <a class="btn btn-warning"
                                            href="{{ route('patients.stories.treatments.edit', [$patient->id, $story->id, $treatment->id]) }}">
                                            <i class="fas fa-pen mx-1"></i><span>Edit</span>
                                        </a>
                                        {!! Form::open(['method' => 'delete', 'route' => ['patients.stories.treatments.destroy', [$patient->id, $story->id, $treatment->id]], 'style' => 'display:inline']) !!}
                                        {!! Form::button('<i class="fa fa-trash mx-1"></i>Delete', ['type' => 'submit', 'class' => 'btn btn-danger mx-2']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
