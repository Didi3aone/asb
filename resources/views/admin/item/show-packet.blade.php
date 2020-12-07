@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.item.title_singular') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Kode
                        </th>
                        <td>
                            {{ $barang->kode }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nama Paket
                        </th>
                        <td>
                            {{ $barang->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kategori
                        </th>
                        <td>
                            @php
                                $name = \App\ItemCategory::getName($barang->kategori_id);
                            @endphp
                            {{ $name->nama }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Unit
                        </th>
                        <td>
                            @php
                                $name = \App\ItemUnit::getName($barang->unit_id);
                            @endphp
                            {{ $name->nama }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card-header">
                {{ trans('cruds.item.fields.detail') }}
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            No.
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.qty') }}
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
                                        $name = \App\Item::getItem($rows->id_barang);
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