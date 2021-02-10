<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('name', 'Nome') }}
            {{ Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'name'])
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::email('email', null, [
                'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'email'])
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('phone', 'Telefone') }}
            {{ Form::text('phone', null, [
                'class' => 'form-control' . ($errors->has('phone') ? ' is-invalid' : ''),
                'required',
                'data-mask' => 'phone'
            ]) }}
            @include('errors.input', ['field' => 'phone'])
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('roles', 'Atribuição') }}
            {{ Form::select('roles', ['' => 'Selecione...'] + $roles->pluck('description', 'id')->all(), null, [
                'class' => 'form-control' . ($errors->has('roles') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'roles'])
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('is_enabled', 'Ativo') }}
            {{ Form::select('is_enabled', ['' => 'Selecione...', 1 => 'Sim', 0 => 'Não'], null, [
                'class' => 'form-control' . ($errors->has('is_enabled') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'is_enabled'])
        </div>
    </div>
    @if(!isset($user))
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('password', 'Senha') }}
            {{ Form::password('password', [
                'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'password'])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirmar Senha') }}
            {{ Form::password('password_confirmation', [
                'class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'password_confirmation'])
        </div>
    </div>
    @endif
</div>
