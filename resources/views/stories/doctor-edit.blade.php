@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Edit</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <x-errors-alert/>

                                {{ Form::model($story, ['method' => 'PUT', 'route' => ['patients.stories.update', [$patient->id, $story->id]]]) }}

                                <div class="form-group">
                                    {{ Form::label('date') }}
                                    {{ Form::date('date', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('description') }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '50']) }}
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            {{ Form::label('doctor') }}
                                            {{ Form::text('doctor', $doctor->lastname . ', ' . $doctor->name, ['class' => 'form-control', 'readonly']) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::button('<i class="fas fa-check-circle mx-1"></i><span>Update story</span>', ['type' => 'submit','class' => 'btn btn-primary']) }}
                                    <a class="btn btn-danger" href="{{ redirect()->back()->getTargetUrl() }}">
                                        <i class="fas fa-ban mx-1"></i><span>Cancel</span>
                                    </a>
                                </div>

                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
