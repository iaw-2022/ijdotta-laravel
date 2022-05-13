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

                                <x-success-message />
                                <x-errors-alert />
                                <x-change-password-form />

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
