@extends('layouts.admin')
@section('content')
@php
	$color = \App\User::getColor(\Auth::user()->id);
@endphp
<div class="card">
    @if($transaksi->tipe == 1)
        <div class="card-header bg-warning">
            {{ trans('global.edit') }} {{ trans('cruds.transaction-stock.title_transaction_in') }}
        </div>
    @else
        <div class="card-header {{ $color->code }}">
            {{ trans('global.edit') }} {{ trans('cruds.transaction-stock.title_transaction_out') }}
        </div>
    @endif

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.transaksi.update", $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="tipe" value="{{ $transaksi->tipe }}">
            <div class="form-group {{ $errors->has('nomor_ijin') ? 'has-error' : '' }}">
                <label for="nomor_ijin">{{ trans('cruds.transaction-stock.fields.nomor_transaksi') }}*</label>
                <input type="text" id="nomor_ijin" name="nomor_ijin" class="form-control" value="{{ $transaksi->nomor_ijin }}">
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
                    <div class="form-group {{ $errors->has('gudang_id') ? 'has-error' : '' }}">
                        <label for="roles">{{ trans('cruds.transaction-stock.fields.gudang_id') }}*</label>
                        <select name="gudang_id" id="gudang_id" class="form-control select2" required style="width: 100%; height:36px;">
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($gudang as $id => $gd)
                                <option value="{{ $id }}" @if ($transaksi->gudang_id == $id) selected @endif>{{ $gd }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('gudang_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('gudang_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                        </p>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group {{ $errors->has('rak_id') ? 'has-error' : '' }}">
                        <label for="roles">{{ trans('cruds.transaction-stock.fields.rak_id') }}*</label>
                        <select name="rak_id" id="rak_id" class="form-control select2" style="width: 100%; height:36px;" @if ($transaksi->rak_id == 0) disabled @endif>
                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                            @foreach($rak as $id => $rak)
                                <option value="{{ $id }}" @if ($transaksi->rak_id == $id) selected @endif>{{ $rak }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('rak_id'))
                            <em class="invalid-feedback">
                                {{ $errors->first('rak_id') }}
                            </em>
                        @endif
                        <p class="helper-block">
                        </p>
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->has('tanggal_transaksi') ? 'has-error' : '' }}">
                <label for="tanggal_transaksi">{{ trans('cruds.transaction-stock.fields.tanggal_transaksi') }}*</label>
                <input type="text" id="tanggal_transaksi" name="tanggal_transaksi" class="form-control date" value="{{ $transaksi->tanggal_transaksi }}">
                @if($errors->has('tanggal_transaksi'))
                    <em class="invalid-feedback">
                        {{ $errors->first('tanggal_transaksi') }}
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
                        {{-- <th>{{ trans('cruds.transaction-stock.fields.nomor_sparepart') }}</th> --}}
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody id="items">
                        @if(count($detail) > 0)
                            @foreach ($detail as $key => $rows)
                                <tr>
                                    <td>
                                        @php
                                            $name = \App\Item::getItem($rows->barang_id);   
                                        @endphp
                                        <input type="text" id="val_{{ $rows->id }}" name="val[]" class="form-control" value="{{ $name->nama }}" readonly>
                                        <input type="hidden" id="barang_id_{{ $rows->id }}" name="barang_id[]" class="form-control" value="{{ $rows->barang_id }}" readonly>
                                        <input type="hidden" id="detail_id_{{ $rows->id }}" name="detail_id[]" class="form-control" value="{{ $rows->id }}" readonly>
                                        {{-- <select name="barang_id[]" id="barang_id_{{ $rows->id }}" class="form-control select2" style="width: 100%; height:36px;" readonly>
                                            <option value="">{{ trans('global.pleaseSelect') }}</option>
                                            @foreach($item as $id => $it)
                                                <option value="{{ $id }}" @if ($rows->barang_id == $id) selected @endif>{{ $it }}</option>
                                            @endforeach
                                        </select> --}}
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
                                    {{-- <td>
                                        <input type="text" id="nomor_sparepart_0" name="nomor_sparepart" class="form-control" value="{{ old('nomor_sparepart', '') }}">
                                        @if($errors->has('nomor_sparepart'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('nomor_sparepart') }}
                                            </em>
                                        @endif
                                    </td> --}}
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
                                {{-- <td>
                                    <input type="text" id="nomor_sparepart_0" name="nomor_sparepart" class="form-control" value="{{ old('nomor_sparepart', '') }}">
                                    @if($errors->has('nomor_sparepart'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('nomor_sparepart') }}
                                        </em>
                                    @endif
                                </td> --}}
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
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-default"> 
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

    $("#gudang_id").change(function() {
        let val = $(this).val();
        $.ajax({
            url: '{{ route('admin.get-rak') }}',
            data: {
                val: val
            },
            dataType: 'json',
            type: 'GET',
            success: function(response) {
                var len = response.length;
                if(len > 1) {
					for( var i = 0; i<len; i++){
						console.log(response);
                        $('#rak_id').prop('disabled', false);
                        var code = response[i]['id'];
                        var name = response[i]['name'];
                        $("#rak_id").append("<option value='"+code+"' name='"+name+"'>"+name+"</option>");
					}
				} else {
                    $('#rak_id').prop('disabled', true);
                }
            }
        })
    });
</script>
@endsection