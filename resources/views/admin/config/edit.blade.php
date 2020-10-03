@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.configuration.title') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.configuration.update", $config->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- @method('put') --}}
            <input type="hidden" name="is_file" value="{{$config->is_file}}">
            <div class="form-group">
                <label for="name">{{ trans('cruds.configuration.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" readonly value="{{ old('name', $config->name) }}">
            </div>

            @if($config->is_file == \App\Configuration::Text)
            <div class="form-group">
                <label for="value">{{ trans('cruds.configuration.fields.value') }}*</label>
                <input type="text" id="value" name="value" class="form-control" value="{{ old('value', $config->value) }}">
            </div>
            @else
            <div class="form-group">
                <label for="name">{{ trans('cruds.configuration.fields.value') }}*</label>
                <input type="file" id="files" name="files" class="form-control" value="{{ old('files', '') }}">
            </div>
            @endif
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