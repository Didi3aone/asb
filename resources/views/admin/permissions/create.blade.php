@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.permission.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.permissions.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('access_name') ? 'has-error' : '' }}">
                <label for="access_name">{{ trans('cruds.permission.fields.access_name') }}*</label>
                <input type="text" id="name" name="access_name" class="form-control" value="{{ old('access_name', isset($permission) ? $permission->name : '') }}" required>
                @if($errors->has('access_name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('access_name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.permission.fields.title') }}*</label>
                <input type="text" id="name" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->name : '') }}" required>
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.permission.fields.title_helper') }}
                </p>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
            </div>
        </form>


    </div>
</div>
@endsection