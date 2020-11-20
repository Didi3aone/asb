@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('cruds.category.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.category.update",$category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.member.fields.nama') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('thumbnail') ? 'has-error' : '' }}">
                <label for="kode">{{ trans('cruds.information.fields.pict') }}*</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-control" value="{{ old('thumbnail', '') }}">
                @if($errors->has('thumbnail'))
                    <em class="invalid-feedback">
                        {{ $errors->first('thumbnail') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.update') }}
                </button>
                <a href="{{ route('admin.category.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>


    </div>
</div>
@endsection