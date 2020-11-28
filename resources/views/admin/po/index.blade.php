@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        Laporan Purchase Order
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                    <label for="start">{{ trans('cruds.member.fields.start') }}*</label>
                    <input type="text" id="start" name="start" class="form-control date" value="{{ old('start') }}">
                    @if($errors->has('start'))
                        <em class="invalid-feedback">
                            {{ $errors->first('start') }}
                        </em>
                    @endif
                    <p class="helper-block">
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
                    <label for="end">{{ trans('cruds.member.fields.end') }}*</label>
                    <input type="text" id="end" name="end" class="form-control date" value="{{ old('end') }}">
                    @if($errors->has('end'))
                        <em class="invalid-feedback">
                            {{ $errors->first('end') }}
                        </em>
                    @endif
                    <p class="helper-block">
                    </p>
                </div>
            </div>
            <div class="col">
                <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }}">
                    <label for="type">{{ trans('cruds.request-order.fields.type') }}*</label>
                    <select name="type" id="type" class="form-control select2" required style="width: 100%; height:36px;">
                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                        <option value="1">{{ trans('cruds.purchase-order.fields.paid') }}</option>
                        <option value="2">{{ trans('cruds.purchase-order.fields.unpaid') }}</option>
                    </select>
                    @if($errors->has('type'))
                        <em class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </em>
                    @endif
                    <p class="helper-block">
                    </p>
                </div>
            </div>
        </div>
        <div class="text-xs-right">
			<button type="submit" id="report" name="report" class="btn btn-info">Show Report</button>
		</div>
    </div>
</div>
@can('transaction_create')
    <div style="margin-bottom: 10px;padding:10 10 10 10px" class="row">
        <div class="col-lg float-right" style="margin-bottom: 10px;padding:10 10 10 10 px;">
            <a class="btn btn-warning" href="{{ route("admin.po.create") }}">
                <i class="fa fa-plus"></i> {{ trans('cruds.purchase-order.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.purchase-order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.purchase-order.fields.no_req') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase-order.fields.date') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase-order.fields.supplier_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase-order.fields.qty') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase-order.fields.total') }}
                        </th>
                        <th>
                            {{ trans('cruds.purchase-order.fields.payment_status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($po as $key => $transactions)
                        <tr data-entry-id="{{ $transactions->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transactions->no_po ?? '' }}
                            </td>
                            <td>
                                {{ $transactions->transaction_date ?? '' }}
                            </td>
                            <td>
                                @php
                                    $name = \App\User::getName($transactions->supplier_id);
                                @endphp
                                {{ $name->name ?? '' }}
                            </td>
                            <td>
                                @php
                                    $count = \App\DetailPurchase::countPO($transactions->id); 
                                @endphp
                                {{ $count ?? 0 }}
                            </td>
                            <td>
                                @php
                                    $sum = \App\DetailPurchase::sumPO($transactions->id);
                                    $rp = \App\PurchaseOrder::rupiah($sum);
                                @endphp
                                {{ $rp ?? 0 }}
                            </td>
                            <td>
                                @if ($transactions->status_payment == 0)
                                    {{ trans('cruds.purchase-order.fields.unpaid') }}
                                @elseif ($transactions->status_payment == 1)
                                    {{ trans('cruds.purchase-order.fields.paid') }}
                                @endif
                            </td>
                            <td>
                                @can('transaction_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.po.show', $transactions->id) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @if ($transactions->status_payment == 0)
                                    <form action="{{ route('admin.update-payment', $transactions->id) }}" method="POST" onsubmit="return confirm('{{ trans('cruds.purchase-order.fields.set_payment_paid') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="status" value="1">
                                        @method('put')
                                        <button type="submit" class="btn btn-xs btn-info">
                                            <i class="fa fa-edit"></i>
                                            {{ trans('cruds.purchase-order.fields.pay') }}
                                        </button>
                                    </form>
                                @elseif ($transactions->status_payment == 1)
                                    <form action="{{ route('admin.update-payment', $transactions->id) }}" method="POST" onsubmit="return confirm('{{ trans('cruds.purchase-order.fields.set_payment_unpaid') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="status" value="0">
                                        @method('put')
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-edit"></i>
                                            {{ trans('cruds.purchase-order.fields.cancel') }}
                                        </button>
                                    </form>
                                @endif
                                @can('transaction_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.po.edit', $transactions->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('transaction_delete')
                                    
                                    <form action="{{ route('admin.po.destroy', $transactions->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> 
                                            {{ trans('global.delete') }}
                                        </button>
                                    </form>
                                @endcan
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
        let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('admin.permissions.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });
                if (ids.length === 0) {
                    alert('{{ trans('global.datatables.zero_selected') }}')
                    return
                }
                if (confirm('{{ trans('global.areYouSure') }}')) {
                    $.ajax({
                    headers: {'x-csrf-token': _token},
                    method: 'POST',
                    url: config.url,
                    data: { ids: ids, _method: 'DELETE' }})
                    .done(function () { location.reload() })
                }
            }
        }
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
        @can('gudang_delete')
        dtButtons.push(deleteButton)
        @endcan
        $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    });

    $('#report').on('click', function () {
        var start   = $("#start").val();
        var end     = $("#end").val();
        var type    = $("#type").val();
        // if(type == '') {
		// 	swal("Error","{{ trans('cruds.program.fields.reporttype') }}");
		// 	return false;
		// }
        window.open("{{ route('admin.report-po') }}?start="+ start +"&end="+ end +"&type="+ type);
    });

</script>
@endsection
@endsection