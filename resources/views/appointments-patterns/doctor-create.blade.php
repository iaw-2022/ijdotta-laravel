@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Create</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="container">
                        <div class="card">
                            <div class="card-body">

                                <x-errors-alert/>

                                {{ Form::open(['route' => ['appointmentspatterns.store']]) }}
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            {{ Form::label('initial_date') }}
                                            {{ Form::date('initial_date', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            {{ Form::label('end_date') }}
                                            {{ Form::date('end_date', null, ['class' => 'form-control']) }}
                                        </div>
                                    </div>
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
                                    <div class="col">
                                        <div class="form-group">
                                            {{ Form::label('appointment_duration') }}
                                            {{ Form::text('appointment_duration', null, ['class' => 'form-control', 'aria-describedby' => 'durationHelp']) }}
                                            <small id="durationHelp" class="form-text text-muted">Enter a number of
                                                minutes (up to 99)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[0]', 'Mon') }}
                                                        {{ Form::label('monday') }}
                                                    </div>
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[1]', 'Tue') }}
                                                        {{ Form::label('tuesday') }}
                                                    </div>
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[2]', 'Wed') }}
                                                        {{ Form::label('wednesday') }}
                                                    </div>
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[3]', 'Thu') }}
                                                        {{ Form::label('thursday') }}
                                                    </div>
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[4]', 'Fri') }}
                                                        {{ Form::label('friday') }}
                                                    </div>
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[5]', 'Sat') }}
                                                        {{ Form::label('saturday') }}
                                                    </div>
                                                    <div class="form-check">
                                                        {{ Form::checkbox('days[6]', 'Sun') }}
                                                        {{ Form::label('sunday') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::button('<i class="fas fa-check-circle mx-1"></i><span>Confirm changes</span>', ['type' => 'submit', 'class' => 'btn btn-primary']) }}
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
