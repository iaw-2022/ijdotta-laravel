<div>
    {{Form::open(['method' => 'PUT', 'route' => ['user.password', Auth::user()->id]])}}

    <div class="form-group">
        {{ Form::label('current_password') }}
        {{ Form::password('current_password', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('new_password') }}
        {{ Form::password('new_password', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('repeat_password') }}
        {{ Form::password('repeat_password', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::button('<i class="fas fa-check-circle mx-1"></i><span>Update password</span>', ['type' => 'submit', 'class' => 'btn btn-success']) }}
    </div>

    {{Form::close()}}
</div>