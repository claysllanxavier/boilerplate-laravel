<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('name', 'Nome') }}
            {{ Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'required',
                'maxlength' => 100
            ]) }}
            @include('errors.input', ['field' => 'name'])
        </div>
    </div>
</div>
