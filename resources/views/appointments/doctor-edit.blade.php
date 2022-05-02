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

                                {{ Form::model($appointment, ['method' => 'PUT', 'route' => ['appointments.update', $appointment->id]]) }}

                                <div class="form-group">
                                    {{ Form::label('date') }}
                                    {{ Form::date('date', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            {{ Form::label('initial_time') }}
                                            {{ Form::time('initial_time', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            {{ Form::label('end_time') }}
                                            {{ Form::time('end_time', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    {{ Form::label('doctor') }}
                                    {{ Form::select('doctor', $doctors, null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('patient') }}
                                    {{ Form::select('patient', $patients, null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::button('<i class="fas fa-check-circle mx-1"></i><span>Confirm changes</span>', ['type' => 'submit','class' => 'btn btn-primary']) }}
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
