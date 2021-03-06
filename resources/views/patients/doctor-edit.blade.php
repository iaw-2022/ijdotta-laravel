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

                                {{ Form::model($patient, ['method' => 'PUT', 'route' => ['patients.update', $patient->id]]) }}

                                <div class="form-group">
                                    {{ Form::label('name') }}
                                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('lastname') }}
                                    {{ Form::text('lastname', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('email') }}
                                    {{ Form::text('email', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('health insurance company') }}
                                    {{ Form::text('health_insurance_company', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::label('health insurance id') }}
                                    {{ Form::text('health_insurance_id', null, ['class' => 'form-control']) }}
                                </div>

                                <div class="form-group">
                                    {{ Form::button('<i class="fas fa-check-circle mx-1"></i><span>Confirm changes</span>', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
                                    <a class="btn btn-danger" href="{{redirect()->back()->getTargetUrl()}}">
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
