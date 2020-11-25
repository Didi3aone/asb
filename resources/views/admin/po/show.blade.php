@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Purchase Order
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            No. Purchase Order
                        </th>
                        <td>
                            {{ $po->no_po }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Supplier
                        </th>
                        <td>
                            @php
                                $nama = \App\MstSupplier::getName($po->supplier_id);
                            @endphp
                            {{ $nama->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Transaction Date
                        </th>
                        <td>
                            {{ $po->transaction_date }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <h2>Detail</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ trans('cruds.transaction-stock.fields.barang_id') }}</th>
                        <th>{{ trans('cruds.transaction-stock.fields.qty') }}</th>
                        <th>{{ trans('global.price') }}</th>
                        <th>PPN </th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($detail) > 0)
                        @foreach ($detail as $key => $rows)
                            <tr>
                                <td>
                                    @php
                                        $name = \App\Item::getItem($rows->id_barang);
                                    @endphp
                                    {{ $name->nama }}
                                </td>
                                <td>
                                    {{ $rows->qty }}
                                </td>
                                <td>
                                    @php
                                        $rp = \App\PurchaseOrder::rupiah($rows->price);
                                    @endphp
                                    {{ $rp }}
                                </td>
                                <td>
                                    @if ($rows->ppn == 0) 
                                        No
                                    @else
                                        Yes 
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </thead>
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