@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-warning">
        {{ trans('global.edit') }} {{ trans('cruds.transaction-stock.title_transaction_in') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.po.update", $po->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="tipe" value="1">
            <div class="form-group {{ $errors->has('nomor_ijin') ? 'has-error' : '' }}">
                <label for="nomor_ijin">{{ trans('cruds.transaction-stock.fields.nomor_transaksi') }}*</label>
                <input type="text" id="nomor_ijin" name="nomor_ijin" class="form-control" value="{{ $po->no_po }}">
                @if($errors->has('nomor_ijin'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nomor_ijin') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                        <label for="roles">{{ trans('cruds.transaction-stock.fields.supplier') }}*</label>
                        <select name="supplier_id" id="supplier_id" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($supplier as $id => $gd)
                                <option value="{{ $id }}" @if ($po->supplier_id == $id) selected @endif>{{ $gd }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('supplier_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('supplier_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('transaction_date') ? 'has-error' : '' }}">
                <label for="transaction_date">{{ trans('cruds.transaction-stock.fields.tanggal_transaksi') }}*</label>
                <input type="text" id="transaction_date" name="transaction_date" class="form-control date" value="{{ $po->transaction_date }}">
                @if($errors->has('transaction_date'))
                    <em class="invalid-feedback">
                        {{ $errors->first('transaction_date') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <br>
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.transaction-stock.fields.barang_id') }}</th>
                        <th>{{ trans('cruds.transaction-stock.fields.qty') }}</th>
                        <th>PPN </th>
                        <th>{{ trans('global.price') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                    @if(count($detail) > 0)
                        @foreach ($detail as $key => $rows)
                            <tr>
                                <td>
                                    <select name="barang_id[]" id="barang_id_{{ $rows->id }}" class="form-control select2" required style="width: 100%; height:36px;">
                                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                                        @foreach($item as $id => $it)
                                            <option value="{{ $id }}" @if ($rows->id_barang == $id) selected @endif>{{ $it }}</option>
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
                                    <input type="text" id="qty_{{ $rows->id }}" name="qty[]" onkeypress="return isNumber(event)" class="form-control" value="{{ $rows->qty }}">
                                    @if($errors->has('qty'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('qty') }}
                                        </em>
                                    @endif
                                </td>
                                <td>
                                    <select name="ppn[]" id="ppn_{{ $rows->id }}" class="form-control select2" required style="width: 100%; height:36px;">
                                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                                        <option value="0" @if ($rows->ppn == 0) selected @endif>{{ trans('global.no') }}</option>
                                        <option value="1" @if ($rows->ppn == 1) selected @endif>{{ trans('global.yes') }}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="price_{{ $rows->id }}" name="price[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control" value="{{ $rows->price }}">
                                    @if($errors->has('price'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('price') }}
                                        </em>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" id="add_item" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
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
                                <input type="text" id="qty_0" name="qty[]" onkeypress="return isNumber(event)" class="form-control" value="{{ old('qty', '') }}">
                                @if($errors->has('qty'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('qty') }}
                                    </em>
                                @endif
                            </td>
                            <td>
                                <select name="ppn[]" id="ppn_0" class="form-control select2" required style="width: 100%; height:36px;">
                                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                                    <option value="0">{{ trans('global.no') }}</option>
                                    <option value="1">{{ trans('global.yes') }}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" id="price_0" name="price[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control" value="{{ old('price', '') }}">
                                @if($errors->has('price'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('price') }}
                                    </em>
                                @endif
                            </td>
                            <td>
                                <button type="button" id="add_item" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> </button>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.po.index') }}" class="btn btn-default"> 
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
                            <input type="text" id="qty_${index}" name="qty[]" onkeypress="return isNumber(event)" class="form-control" value="{{ old('qty', '') }}">
                            @if($errors->has('qty'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <select name="ppn[]" id="ppn_${index}" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                <option value="0">{{ trans('global.no') }}</option>
                                <option value="1">{{ trans('global.yes') }}</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" id="price_${index}" name="price[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control" value="{{ old('price', '') }}">
                            @if($errors->has('price'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </em>
                            @endif
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

    window.leadingZero = function(value, element, decimal = false) {
        var convert_number = removeChar(value);
        if(decimal) {
            if(value != '') {
                element.val(keyupFormatUangWithDecimal(value));
            } else {
                element.val(0);
            }
        } else {
            if(value != '') {
            element.val(keyupFormatUang(parseInt(convert_number)));
            } else {
            element.val(0);
            }
        }
    }

    function removeChar(value) {
        return value.toString().replace(/[.*+?^${}()|[\]\\]/g, '');
    }

    window.keyupFormatUang = function(value) {
        var number = '';    
        var value_rev = value.toString().split('').reverse().join('');
            
        for(var i = 0; i < value_rev.length; i++) {
            if(i % 3 == 0) number += value_rev.substr(i, 3) + '.';
        }
            
        return number.split('', number.length - 1).reverse().join('');
    }

    window.keyupFormatUangWithDecimal = function(value) {
        return value.replace(/^0+/, '').replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    } 
</script>
@endsection