@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.configuration.title') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.configuration.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('is_file') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.configuration.fields.is_file') }} *</label>
                <select name="is_file" id="is_file" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    <option value="1">{{ trans('cruds.configuration.fields.yes_file') }}</option>
                    <option value="0">{{ trans('cruds.configuration.fields.no_file') }}</option>
                </select>
                @if($errors->has('is_file'))
                    <em class="invalid-feedback">
                        {{ $errors->first('is_file') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.configuration.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', '') }}">
            </div>

            <div class="form-group" id="free" style="display:none;">
                <label for="value">{{ trans('cruds.configuration.fields.value') }}*</label>
                <input type="text" id="value" name="value" class="form-control" value="{{ old('value', '') }}">
            </div>

            <div class="form-group" id="file" style="display:none;">
                <label for="name">{{ trans('cruds.configuration.fields.value') }}*</label>
                <input type="file" id="files" name="files" class="form-control" value="{{ old('files', '') }}">
            </div>

            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
@parent
    <script>
        const Yes = 1;
        const No  = 0; 
        
        $('#is_file').change(function() {
            let id = $(this).val()

            if( id == Yes ) {
                $("#free").hide()
                $("#file").show()
            } else if( id == No) {
                $("#free").show()
                $("#file").hide()
            } else {
                $("#free").hide()
                $("#file").hide()
            }
        })
    </script>
@endsection