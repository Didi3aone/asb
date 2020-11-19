@extends('layouts.admin')
@section('content')

<div class="card">
    @if($transaksi->tipe == 1)
        <div class="card-header bg-warning">
            {{ trans('global.show') }} {{ trans('cruds.transaction-stock.title_transaction_in') }}
        </div>
    @else
        <div class="card-header bg-primary">
            {{ trans('global.show') }} {{ trans('cruds.transaction-stock.title_transaction_out') }}
        </div>
    @endif

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.nomor_transaksi') }}
                        </th>
                        <td>
                            {{ $transaksi->nomor_ijin }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $nama = \App\MstGudang::getWarehouse($transaksi->gudang_id);
                        @endphp
                        <th>
                            {{ trans('cruds.transaction-stock.fields.gudang_id') }}
                        </th>
                        <td>
                            {{ $nama->nama_gudang ?? '-'}}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $nama = \App\RakGudang::getName($transaksi->rak_id);
                        @endphp
                        <th>
                            {{ trans('cruds.transaction-stock.fields.rak_id') }}
                        </th>
                        <td>
                            {{ $nama->name ?? '-'}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.tanggal_transaksi') }}
                        </th>
                        <td>
                            {{ $transaksi->tanggal_transaksi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By
                        </th>
                        <td>
                            @php
                                $name = \App\User::getName($transaksi->created_by);
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
                                $name = \App\User::getName($transaksi->updated_by);
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
                        <th>
                            {{ trans('cruds.transaction-stock.fields.barang_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.qty') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($detail) > 0)
                        @foreach($detail as $key => $rows)
                            <tr>
                                <td>
                                    {{ $key +1 }}
                                </td>
                                <td>
                                    @php
                                        $name = \App\Item::getItem($rows->barang_id);
                                    @endphp
                                    {{ $name->nama }}
                                </td>
                                <td>
                                    {{ $rows->qty }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
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