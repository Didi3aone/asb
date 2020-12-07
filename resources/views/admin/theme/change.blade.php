@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.theme.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.change-template") }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group {{ $errors->has('theme') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.transaction-stock.fields.supplier') }}*</label>
                <select name="theme" id="theme" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($theme as $id => $gd)
                        <option value="{{ $id }}">{{ $gd }}</option>
                    @endforeach
                </select>
                @if($errors->has('theme'))
                    <em class="invalid-feedback">
                        {{ $errors->first('theme') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.transaction-stock.fields.supplier') }}*</label>
                <select name="color" id="color" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($color as $id => $gd)
                        <option value="{{ $id }}">{{ $gd }}</option>
                    @endforeach
                </select>
                @if($errors->has('color'))
                    <em class="invalid-feedback">
                        {{ $errors->first('color') }}
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