@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="col-lg-12">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-blue order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">Item</h6>
                            <h2 class="text-right"><i class="fa fa-cubes f-left"></i><span>{{ $item }}</span></h2>
                            <p class="m-b-0"><a style="color:white;" href="{{ route('admin.item.index') }}">{{ trans('global.more_info') }}</a><span class="f-right"><i class="fa fa-arrow-right f-left"></i></span></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-green order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">{{ trans('cruds.warehouse.title') }}</h6>
                            <h2 class="text-right"><i class="fa fa-building f-left"></i><span>{{ $warehouse }}</span></h2>
                            <p class="m-b-0"><a style="color:white;" href="{{ route('admin.gudang.index') }}">{{ trans('global.more_info') }}</a><span class="f-right"><i class="fa fa-arrow-right f-left"></i></span></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-yellow order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">{{ trans('cruds.customer.title') }}</h6>
                            <h2 class="text-right"><i class="fa fa-users f-left"></i><span>{{ $customer }}</span></h2>
                            <p class="m-b-0"><a style="color:white;" href="{{ route('admin.customer.index') }}">{{ trans('global.more_info') }}</a><span class="f-right"><i class="fa fa-arrow-right f-left"></i></span></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-xl-3">
                    <div class="card bg-c-pink order-card">
                        <div class="card-block">
                            <h6 class="m-b-20">{{ trans('cruds.suppliers.title') }}</h6>
                            <h2 class="text-right"><i class="fa fa-truck f-left"></i><span>{{ $supplier }}</span></h2>
                            <p class="m-b-0"><a style="color:white;" href="{{ route('admin.supplier.index') }}">{{ trans('global.more_info') }}</a><span class="f-right"><i class="fa fa-arrow-right f-left"></i></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            @php
                $color = \App\User::getColor(\Auth::user()->id);
            @endphp
            <div class="card-header {{ $color->code }}">
                <a href="#" class="btn btn-primary">
                    {{ trans('global.data_stock_item') }}
                </a>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ trans('cruds.item.fields.nama') }}</th>
                        <th>{{ trans('cruds.item.fields.kategori_id') }}</th>
                        <th>{{ trans('cruds.item.fields.unit_id') }}</th>
                        <th>{{ trans('cruds.item.fields.stock') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stock as $key => $value)
                    <tr>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->kategori }}</td>
                        <td>{{ $value->unit }}</td>
                        <td>{{ $value->stock }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection