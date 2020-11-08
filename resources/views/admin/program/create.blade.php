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
            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                <label for="start_date">{{ trans('cruds.program.fields.start_date') }}*</label>
                <input type="text" id="start_date" name="start_date" class="form-control date" value="{{ old('start_date', date('Y-m-d')) }}">
                @if($errors->has('start_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                <label for="end_date">{{ trans('cruds.program.fields.end_date') }}*</label>
                <input type="text" id="end_date" name="end_date" class="form-control date" value="{{ old('end_date', date('Y-m-d')) }}">
                @if($errors->has('end_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                <label for="desc">{{ trans('cruds.program.fields.desc') }}*</label>
                <textarea class ="form-control" name="desc" value="{{ old('alamat', isset($user) ? $member->alamat : '') }}" id="desc"> </textarea>
                @if($errors->has('desc'))
                    <em class="invalid-feedback">
                        {{ $errors->first('desc') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.transaction-stock.fields.barang_id') }}</th>
                        {{-- <th>{{ trans('cruds.transaction-stock.fields.qty') }}</th>
                        <th>{{ trans('cruds.transaction-stock.fields.nomor_sparepart') }}</th> --}}
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    <tr>
                        <td>
                            <select name="barang_id[]" id="barang_id_0" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                @foreach($item as $id => $it)
                                    <option value="{{ $id }}">{{ $it }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('gudang_id'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('gudang_id') }}
                                </em>
                            @endif
                            <p class="helper-block">
                            </p>
                        </td>
                        <td>
                            <button type="button" id="add_item" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
@section('scripts')
@parent
<script>
    $("body").on("click",".btn-remove",function(){
        $(this).parents(".control-group").remove();
    });
    let index = 1
    $(document).ready(function () {
        $('#add_item').on('click', function (e) {
            e.preventDefault()

            let html = `
                    <tr data-id="${index}">
                        <td>
                            <select name="barang_id[]" id="barang_id_${index}" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                @foreach($item as $id => $it)
                                    <option value="{{ $id }}">{{ $it }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('barang_id'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('barang_id') }}
                                </em>
                            @endif
                            <p class="helper-block">
                            </p>
                        </td>
                        <td>
                            <a href="javascript:;" class="remove-item btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
            `

            $('#items').append(html)
            $('.select2').select2();
            index++
        })
    })
</script>
@endsection