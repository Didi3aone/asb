@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('cruds.warehouse.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.gudang.update", $gudang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group {{ $errors->has('nama_gudang') ? 'has-error' : '' }}">
                <label for="nama_gudang">{{ trans('cruds.warehouse.fields.name') }}*</label>
                <input type="text" id="name" name="nama_gudang" class="form-control" value="{{ old('nama_gudang', $gudang->nama_gudang) }}">
                @if($errors->has('nama_gudang'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nama_gudang') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.update') }}
                </button>
                <a href="{{ route('admin.gudang.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>


    </div>
</div>
@endsection