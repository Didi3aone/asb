@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.item.fields.packet') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.post-packet") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="is_paket" id="is_paket" value="1">
            <div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
                <label for="kode">{{ trans('cruds.item.fields.kode') }}*</label>
                <input type="text" id="kode" name="kode" class="form-control" value="{{ old('kode', '') }}">
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
                <input type="text" id="name" name="nama" class="form-control" value="{{ old('nama', '') }}">
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
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($kategori as $id => $ka)
                        <option value="{{ $id }}">{{ $ka }}</option>
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
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($unit as $id => $un)
                        <option value="{{ $id }}">{{ $un }}</option>
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
            {{-- <div class="form-group {{ $errors->has('foto') ? 'has-error' : '' }}">
                <label for="kode">{{ trans('cruds.item.fields.foto') }}*</label>
                <input type="file" id="foto" name="fotos" class="form-control" value="{{ old('foto', '') }}">
                @if($errors->has('foto'))
                    <em class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div> --}}
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.transaction-stock.fields.barang_id') }}</th>
                        <th>{{ trans('cruds.transaction-stock.fields.qty') }}</th>
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
                            <input type="text" id="qty_0" name="qty[]" class="form-control" onKeyUp="numericFilter(this);" value="{{ old('qty', '') }}">
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
                <a href="{{ route('admin.item.index') }}" class="btn btn-default"> 
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
                            <input type="text" id="qty_${index}" name="qty[]" class="form-control" onKeyUp="numericFilter(this);" value="{{ old('qty', '') }}">
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
    });

    function numericFilter(txb) {
		txb.value = txb.value.replace(/[^\0-9]/ig, "");
    }
</script>
@endsection