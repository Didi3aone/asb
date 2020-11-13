@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit', ) }} {{ trans('cruds.information.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.info.update", $info->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                <label for="nama">{{ trans('cruds.information.fields.nama') }}*</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ $info->name }}">
                @if($errors->has('nama'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('kategori_id') ? 'has-error' : '' }}">
                <label for="kategori_id">{{ trans('cruds.information.fields.categories') }}*</label>
                <select name="kategori_id" id="kategori_id" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($category as $data => $row)
                        <option value="{{ $data }}" @if ($info->kategori_id == $data) selected @endif>{{ $row }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategori_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kategori_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                <label for="kode">{{ trans('cruds.information.fields.pict') }}*</label>
                <input type="file" id="foto" name="foto" class="form-control" value="{{ old('foto', '') }}">
                @if($errors->has('foto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.information.fields.content') }}*</label>
                <textarea class ="form-control my-editor" name="content" value="" id="content"> {{ $info->content }}</textarea>
                @if($errors->has('content'))
                    <em class="invalid-feedback">
                        {{ $errors->first('content') }}
                    </em>
                @endif
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.info.index') }}" class="btn btn-default"> 
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
        tinymce.init({
            selector:'textarea.my-editor',
            width: 900,
            height: 300
        });
    </script>
@endsection