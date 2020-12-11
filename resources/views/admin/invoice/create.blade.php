@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-warning">
        {{ trans('global.create') }} {{ trans('cruds.invoice.title') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.invoice.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="tipe" value="1">
            <div class="form-group {{ $errors->has('no_trx') ? 'has-error' : '' }}">
                <label for="no_trx">{{ trans('cruds.invoice.fields.nomor_transaksi') }}*</label>
                <input type="text" id="no_trx" name="no_trx" class="form-control" value="{{ $no_trx }}">
                @if($errors->has('no_trx'))
                    <em class="invalid-feedback">
                        {{ $errors->first('no_trx') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            
            <div class="form-group {{ $errors->has('gudang_id') ? 'has-error' : '' }}">
                <label for="roles">{{ trans('cruds.transaction-stock.fields.supplier') }}*</label>
                <select name="supplier_id" id="supplier_id" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($supplier as $id => $gd)
                        <option value="{{ $id }}">{{ $gd }}</option>
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
                
            <div class="form-group {{ $errors->has('tanggal_transaksi') ? 'has-error' : '' }}">
                <label for="tanggal_transaksi">{{ trans('cruds.invoice.fields.tanggal_transaksi') }}*</label>
                <input type="text" id="tanggal_transaksi" name="tanggal_transaksi" class="form-control date" value="{{ old('tanggal_transaksi', date('Y-m-d')) }}">
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
                        <th style="width:15%;">{{ trans('cruds.invoice.fields.product') }}</th>
                        <th style="width:15%;">{{ trans('cruds.invoice.fields.price') }}</th>
                        <th style="width:8%;">{{ trans('cruds.invoice.fields.qty') }}</th>
                        <th>{{ trans('cruds.invoice.fields.amount') }}</th>
                        {{-- <th>{{ trans('cruds.invoice.fields.nomor_sparepart') }}</th> --}}
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
                            <input type="text" id="price_0" name="price[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control price" value="0">
                            @if($errors->has('price'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <input type="text" id="qty_0" name="qty[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control qty" value="0">
                            @if($errors->has('qty'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <input type="text" id="amount_0" name="amount[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control amount" value="0">
                            @if($errors->has('amount'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('amount') }}
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
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td>{{ trans('global.total') }}</td>
                            <td>
                                <input type="text" id="subtotal" name="subtotal" class="subtotal numbersonly form-control"
                                    onkeyup="leadingZero(this.value, $(this), true)" value="{{ old('subtotal','') }}">
                            </td>
                        </tr>
                        {{-- <tr>
                            <td colspan="3"></td>
                            <td>{{ trans('cruds.invoice.fields.ongkir') }}</td>
                            <td>
                                <input type="text" id="ongkir" name="ongkir" class="ongkir form-control"
                                    onKeyUp="numericFilter(this);" value="" readonly>
                            </td>
                        </tr> --}}
                        <tr>
                            <td colspan="2"></td>
                            <td>{{ trans('cruds.invoice.fields.disc') }}</td>
                            <td>
                                <input type="text" id="disc" name="disc" class="disc form-control"
                                    onKeyUp="leadingZero(this.value, $(this), true)" value="0">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>PPN</td>
                            <td>
                                <select name="ppn" id="ppn" class="ppn select2 form-control" style="width:100%;">
                                    <option value="0">{{ trans('global.no') }}</option>
                                    <option value="1">{{ trans('global.yes') }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td>{{ trans('global.grandtotal') }}</td>
                            <td>
                                <input type="text" id="total_amount" name="total_amount" class="total_amount numbersonly form-control"
                                    onkeyup="leadingZero(this.value, $(this), true)" value="{{ old('total_amount','') }}">
                            </td>
                        </tr>
                        {{-- <tr>
                            <td colspan="3"></td>
                            <td>{{ trans('cruds.invoice.fields.paid')}}</td>
                            <td>
                                <input type="text" id="paid" name="paid" class="paid form-control" onKeyUp="numericFilter(this);"
                                    value="{{ old('paid',0,'') }}">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td>{{ trans('cruds.invoice.fields.unpaid')}}</td>
                            <td>
                                <input type="text" id="unpaid" name="unpaid" class="unpaid form-control"
                                    onkeyup="leadingZero(this.value, $(this), true)" value="{{ old('unpaid',0,'') }}" readonly>
                            </td>
                        </tr> --}}
                    </tfoot>
                </table>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.invoice.index') }}" class="btn btn-default"> 
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
                            <input type="text" id="price_${index}" name="price[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control price" value="0">
                            @if($errors->has('price'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('price') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <input type="text" id="qty_${index}" name="qty[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control qty" value="0">
                            @if($errors->has('qty'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('qty') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <input type="text" id="amount_${index}" name="amount[]" onkeyup="leadingZero(this.value, $(this), true)" class="form-control amount" value="0">
                            @if($errors->has('amount'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('amount') }}
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

    $(document).on('keyup', '.qty', function(event) {
        countSubtotal(this);
    });

    $(document).on('keyup', '.price', function(event) {
        countSubtotal(this);
    });
    $(document).on('keyup', '.disc', function(event) {
        countDisc(this);
        // countTotalAfterDisc(this);
    });
    $(document).on('change', '.ppn', function(event) {
        countppn(this);
    })

    function countSubtotal(el) {
        let price = $(el).closest('tr').find('.price').val().replace(/,/g, '')
        let qtyInput = $(el).closest('tr').find('.qty').val();

        let priceInt = removeChar(price);
        if (isNaN(priceInt)) price = 0
        let sumPrice = parseInt(priceInt) * parseInt(qtyInput);
        let totalPrice = keyupFormatUang(parseInt(sumPrice));

        if (isNaN(sumPrice)) totalPrice = 0;
        $(el).closest('tr').find('.amount').val(totalPrice);

        countTotal();
    }

    function countDisc(el) {
        let tot = $("#subtotal").val();
        let ds = $("#disc").val();
        let ppn = $("#ppn").val();

        var tint = removeChar(tot);
        var dint = removeChar(ds);
        
        if(ppn == 1) {
            var calc = parseFloat(tint)-parseFloat(dint);
            let count = (parseInt(calc) * 10)/100;
            console.log("count = "+count);
            var ps = parseInt(calc)+parseInt(count);
            console.log("ps = "+ps);
        } else {
            var ps = parseFloat(tint)-parseFloat(dint);
        }
        
        var afterDisc = keyupFormatUang(parseInt(ps));
        console.log("calc = "+calc);
        if (isNaN(afterDisc)) afterDisc = 0;
        $("#total_amount").val(afterDisc);
        // countTotal();
    }

    function countppn(el) {
        let tot = $("#subtotal").val();
        let ds = $("#disc").val();
        let ppn = $("#ppn").val();

        var tint = removeChar(tot);
        var dint = removeChar(ds);
        
        if (dint == "") dint = 0;
        if(ppn == 1) {
            var calc = parseFloat(tint)-parseFloat(dint);
            let count = (parseInt(calc) * 10)/100;
            console.log("count = "+count);
            var ps = parseInt(calc)+parseInt(count);
            
        } else {
            var ps = parseFloat(tint)-parseFloat(dint);
        }
        console.log("ps = "+ps);
        let ppnInt = keyupFormatUang(ps);

        if (isNaN(ppnInt)) ppnInt = 0;
        $("#total_amount").val(ppnInt);

        // countTotal();
    }

    function countTotal() {
        var total = 0;
        let ds = $("#disc").val();
        let pn = $("#ppn").val();
        let dsInt = removeChar(ds);

        $.each($('.amount'), function(key, obj) {
            var amount = $(obj).val();
            var a = removeChar(amount);
            var subtotal = parseFloat(a);
            if (isNaN(subtotal)) subtotal = 0;
            total += subtotal;
            total
        });
        if(dsInt == '') dsInt = 0;
        
        if(pn == 1) {
            var calcDiskon = parseInt(total) - parseInt(dsInt);
            let count = (parseInt(calcDiskon) * 10)/100;
            var ps = parseInt(calcDiskon)+parseInt(count);
        } else {
            var ps = parseInt(total) - parseInt(dsInt);
        }
         let subtot = keyupFormatUang(parseInt(total));

        var grandTotal = keyupFormatUang(parseInt(ps));
        $('.subtotal').val(subtot)
        $('.total_amount').val(grandTotal)
        $el = $('table.table').find('.ongkir')
        if ($el.val()) {
            countTotalAfterOngkir($el)
        }
    }

    window.leadingZero = function(value, element, decimal = false) {
        var convert_number = removeChar(value);
        if (convert_number) {
            element.val(parseInt(convert_number).toLocaleString('id-ID'))
            return
        }
        if (decimal) {
            if (value != '') {
                element.val(keyupFormatUangWithDecimal(value));
            } else {
                element.val(0);
            }
        } else {
            if (value != '') {
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

        for (var i = 0; i < value_rev.length; i++) {
            if (i % 3 == 0) number += value_rev.substr(i, 3) + '.';
        }

        return number.split('', number.length - 1).reverse().join('');
    }



    window.keyupFormatUangWithDecimal = function(value) {
        return value.replace(/^0+/, '').replace(/(?!\.)\D/g, "").replace(/(?<=\..*)\./g, "").replace(/(?<=\.\d\d).*/g,
            "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

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
				}
            }
        })
    });
</script>
@endsection