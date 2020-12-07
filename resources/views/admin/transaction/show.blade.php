@extends('layouts.admin')
@section('content')
@php
	$color = \App\User::getColor(\Auth::user()->id);
@endphp
<div class="card">
    @if($transaksi->tipe == 1)
        <div class="card-header bg-warning">
            {{ trans('global.show') }} {{ trans('cruds.transaction-stock.title_transaction_in') }}
        </div>
    @else
        <div class="card-header {{ $color->code }}">
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
            @if(count($show) > 0)
            <h2>Detail Penerima</h2>
            <div class="table table-responsive">
                <table class="table table-bordered table-striped table-sm" class="table table-striped table-bordered ">
                    <thead>
                        <tr>
                            <th>
                                No
                            </th>
                            <th>
                                NIK
                            </th>
                            <th>
                                No. KK 
                            </th>
                            <th>
                                Nama Penerima 
                            </th>
                            <th>
                                No. Telp 
                            </th>
                            <th>
                                No. Handphone 
                            </th>
                            <th>
                                Email 
                            </th>
                            <th>
                                Pekerjaan
                            </th>
                            <th>
                                Provinsi
                            </th>
                            <th>
                                Kabupaten
                            </th>
                            <th>
                                Kecamatan
                            </th>
                            <th>
                                Kelurahan
                            </th>
                            <th>
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($show as $key => $rows)
                            @if($rows->nik == null)
                                <tr>
                                    <td colspan="13">
                                        <center>{{ trans('cruds.request-order.fields.member') }} {{ trans('cruds.request-order.fields.notfound') }}</center>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        {{ $key +1 }}
                                    </td>
                                    <td>
                                        {{ $rows->nik }}
                                    </td>
                                    <td>
                                        {{ $rows->no_kk }}
                                    </td>
                                    <td>
                                        {{ $rows->nickname }}
                                    </td>
                                    <td>
                                        {{ $rows->no_telp }}
                                    </td>
                                    <td>
                                        {{ $rows->no_hp }}
                                    </td>
                                    <td>
                                        {{ $rows->email ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($rows->pekerjaan != null)
                                            
                                        @endif
                                        @php
                                            $name = \App\Job::getName($rows->pekerjaan);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Provinsi::getProv($rows->provinsi);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Kabupaten::getKab($rows->kabupaten);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Kecamatan::getKec($rows->kecamatan);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Kelurahan::getKel($rows->kelurahan);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($rows->status_penerima == 1)
                                            Belum Menerima
                                        @else
                                            Sudah Menerima
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
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