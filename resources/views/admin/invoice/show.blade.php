@extends('layouts.admin')
@section('content')
@php
	$color = \App\User::getColor(\Auth::user()->id);
@endphp
<div class="card">
    <div class="navbar card-header {{ $color->code }}">
        <a href="#" class="btn btn-primary">
            {{ trans('global.show') }} {{ trans('cruds.invoice.title') }}
        </a>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.nomor_transaksi') }}
                        </th>
                        <td>
                            {{ $inv->no_transaksi }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $nama = \App\MstSupplier::getName($inv->custid);
                        @endphp
                        <th>
                            {{ trans('cruds.transaction-stock.fields.supplier') }}
                        </th>
                        <td>
                            {{ $nama->nama ?? '-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.invoice.fields.tanggal_transaksi') }}
                        </th>
                        <td>
                            {{ $inv->transaction_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By
                        </th>
                        <td>
                            @php
                                $name = \App\User::getName($inv->created_by);
                            @endphp
                            {{ $name->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Updated By
                        </th>
                        <td>
                            @php
                                $name = \App\User::getName($inv->updated_by);
                            @endphp
                            {{ $name->name ?? '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-header">
                {{ trans('cruds.program.item') }}
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th style="width:15%;">{{ trans('cruds.invoice.fields.product') }}</th>
                        <th style="width:15%;">{{ trans('cruds.invoice.fields.price') }}</th>
                        <th style="width:8%;">{{ trans('cruds.invoice.fields.qty') }}</th>
                        <th>{{ trans('cruds.invoice.fields.amount') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($dt) > 0)
                        @foreach($dt as $key => $rows)
                            <tr>
                                <td>
                                    {{ $key +1 }}
                                </td>
                                <td>
                                    @php
                                        $name = \App\Item::getItem($rows->product_id);
                                    @endphp
                                    {{ $name->nama }}
                                </td>
                                <td>
                                    Rp. {{ number_format($rows->price, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ $rows->qty }}
                                </td>
                                <td>
                                    Rp. {{ number_format($rows->amount, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"></td>
                        <td>{{ trans('global.total') }}</td>
                        <td>
                            Rp. {{ number_format($inv->subtotal, 0, ',', '.') }}
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
                        <td colspan="3"></td>
                        <td>{{ trans('cruds.invoice.fields.disc') }}</td>
                        <td>Rp. {{ number_format($inv->disc, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>PPN</td>
                        @if($inv->ppn == 1)
                            <td>{{ trans('global.yes') }}</td>
                        @else
                            <td>{{ trans('global.no') }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                        <td>{{ trans('global.grandtotal') }}</td>
                        <td>Rp. {{ number_format($inv->grandtotal, 0, ',', '.') }}</td>
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
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        

        <nav class="mb-3">
            <div class="nav nav-tabs">

            </div>
        </nav>
        <div class="tab-content">

        </div>
    </div>
</div>
@endsection