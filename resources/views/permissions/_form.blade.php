<div class="row">
    <div class="col-md-9">
        <div class="form-group">
            {{ Form::label('description', 'Descrição') }}
            {{ Form::text('description', null, [
                'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'description'])
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('name', 'Alias') }}
            {{ Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required'
            ]) }}
            @include('errors.input', ['field' => 'name'])
        </div>
    </div>
</div>
