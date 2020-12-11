@extends('layouts.admin')
@section('content')
@php
	$color = \App\User::getColor(\Auth::user()->id);
@endphp
<div class="card">
    <div class="navbar card-header {{ $color->code }}">
        <a href="#" class="btn btn-primary">
            {{ trans('global.show') }} {{ trans('cruds.do.title') }}
        </a>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.do.fields.nomor_transaksi') }}
                        </th>
                        <td>
                            {{ $do->sk }}
                        </td>
                    </tr>
                    <tr>
                        @php
                            $nama = \App\MstSupplier::getName($do->custid);
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
                            {{ trans('cruds.do.fields.send_date') }}
                        </th>
                        <td>
                            {{ $do->send_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.do.fields.receive_date') }}
                        </th>
                        <td>
                            {{ $do->receive_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By
                        </th>
                        <td>
                            @php
                                $name = \App\User::getName($do->created_by);
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
                                $name = \App\User::getName($do->updated_by);
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
                        <th>{{ trans('cruds.do.fields.product') }}</th>
                        <th>{{ trans('cruds.do.fields.qty') }}</th>
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