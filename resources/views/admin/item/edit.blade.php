@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.update') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.item.update",$item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
                <label for="kode">{{ trans('cruds.item.fields.kode') }}*</label>
                <input type="text" id="kode" name="kode" class="form-control" value="{{ old('kode', $item->kode) }}">
                @if($errors->has('kode'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kode') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                <label for="nama">{{ trans('cruds.item.fields.nama') }}*</label>
                <input type="text" id="name" name="nama" class="form-control" value="{{ old('nama', $item->nama) }}">
                @if($errors->has('nama'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div class="form-group {{ $errors->has('kategori_id') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.item.fields.kategori_id') }}*</label>
                <select name="kategori_id" id="kategori_id" class="form-control select2" required style="width: 100%; height:36px;">
                    @foreach($kategori as $id => $ka)
                        <option value="{{ $id }}" @if($item->kategori_id == $id) selected @endif>{{ $ka }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategori_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('kategori_id') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div class="form-group {{ $errors->has('unit_id') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.item.fields.unit_id') }}*</label>
                <select name="unit_id" id="unit_id" class="form-control select2" required style="width: 100%; height:36px;">
                    @foreach($unit as $id => $un)
                        <option value="{{ $id }}" @if($item->unit_id == $id) selected @endif>{{ $un }}</option>
                    @endforeach
                </select>
                @if($errors->has('unit_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('unit_id') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
             <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                <label for="kode">{{ trans('cruds.item.fields.foto') }}*</label>
                <input type="file" id="foto" name="fotos" class="form-control" value="{{ old('foto', '') }}">
                @if($errors->has('foto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
                <a class="" href="{{ asset('images/'.@unserialize($item->foto)) }}" target="_blank">{{ @unserialize($item->foto) }}</a>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.item.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>


    </div>
</div>
@endsection