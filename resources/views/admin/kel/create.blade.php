@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.program.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.program.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('nama') ? 'has-error' : '' }}">
                <label for="nama">{{ trans('cruds.program.fields.nama') }}*</label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', '') }}">
                @if($errors->has('nama'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('no_telp') ? 'has-error' : '' }}">
                <label for="no_telp">{{ trans('cruds.program.fields.start') }}*</label>
                <input type="text" onkeypress="return isNumber(event)" id="no_telp" name="no_telp" class="form-control" value="{{ old('no_telp', '') }}">
                @if($errors->has('no_telp'))
                    <em class="invalid-feedback">
                        {{ $errors->first('no_telp') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('no_hp') ? 'has-error' : '' }}">
                <label for="no_hp">{{ trans('cruds.program.fields.end') }}*</label>
                <input type="text" onkeypress="return isNumber(event)" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp', '') }}">
                @if($errors->has('no_hp'))
                    <em class="invalid-feedback">
                        {{ $errors->first('no_hp') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.program.fields.description') }}*</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            
            <div class="form-group {{ $errors->has('ppn') ? 'has-error' : '' }}">
                {{ trans('cruds.program.fields.ppn') }}
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ppn" id="inlineRadio1" value="{{ \App\MstSupplier::YesPpn }}">
                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ppn" checked id="inlineRadio2" value="{{ \App\MstSupplier::NoPpn }}">
                    <label class="form-check-label" for="inlineRadio2">No</label>
                </div>
                 @if($errors->has('ppn'))
                    <em class="invalid-feedback">
                        {{ $errors->first('ppn') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('alamat') ? 'has-error' : '' }}">
                <label for="alamat">{{ trans('cruds.program.fields.alamat') }}*</label>
                <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat', '') }}">
                @if($errors->has('alamat'))
                    <em class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">{{ trans('cruds.program.fields.password') }}*</label>
                <input type="password" id="password" name="password" class="form-control" value="{{ old('password', '') }}">
                @if($errors->has('password'))
                    <em class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.program.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>


    </div>
</div>
@endsection