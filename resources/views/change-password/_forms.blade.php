<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('current_password', 'Senha Atual') }}
            {{ Form::password('current_password', [
                'class' => 'form-control' . ($errors->has('current_password') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'current_password'])
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('password', 'Nova Senha') }}
            {{ Form::password('password', [
                'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'password'])
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirmar Senha') }}
            {{ Form::password('password_confirmation', [
                'class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'password_confirmation'])
        </div>
    </div>
</div>
