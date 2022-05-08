@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Welcome</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">
                                <x-errors-alert/>

                                {{ Form::model($treatment, ['method' => 'PUT', 'route' => ['patients.stories.treatments.update', [$patient->id, $story->id, $treatment->id]]]) }}

                                <div class="form-group">
                                    {{ Form::label('title') }}
                                    {{ Form::text('title', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('description') }}
                                    {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '50']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::button('<i class="fas fa-check-circle mx-1"></i><span>Update treatment</span>', ['type' => 'submit','class' => 'btn btn-primary']) }}
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
