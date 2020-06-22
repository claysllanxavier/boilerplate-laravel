<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('description', 'Descrição') }}
            {{ Form::text('description', null, [
                'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'description'])
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('name', 'Alias') }}
            {{ Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'name'])
        </div>
    </div>
    <div class="col-md-12">
        {{ Form::label('name', 'Permissões') }}
        {{Form::select('permissions[]', $permissions->pluck('description', 'id')->all(), null, [
        'class' => 'form-control multi-select' . ($errors->has('permissions') ? ' is-invalid' : ''),
        'required',
        'multiple'
        ]) }}
        @include('errors.input', ['field' => 'permissions'])
    </div>

</div>
