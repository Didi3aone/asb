@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
       Laporan Transaksi
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
                        <option value="1">{{ trans('cruds.transaction-stock.fields.in') }}</option>
                        <option value="2">{{ trans('cruds.transaction-stock.fields.out') }}</option>
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
            <a class="btn btn-warning" href="{{ route("admin.transaksi-in") }}">
                <i class="fa fa-plus"></i> {{ trans('cruds.transaction-stock.title_transaction_in') }}
            </a>
            <a class="btn btn-primary" href="{{ route("admin.transaksi-out") }}">
                <i class="fa fa-plus"></i> {{ trans('cruds.transaction-stock.title_transaction_out') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.transaction-stock.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.nomor_transaksi') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.gudang_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.rak_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.tanggal_transaksi') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.in_out') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $key => $transactions)
                        <tr data-entry-id="{{ $transactions->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $transactions->nomor_ijin ?? '' }}
                            </td>
                            <td>
                                {{ $transactions->getGudang['nama_gudang'] ?? '' }}
                            </td>
                            <td>
                                @php
                                    $name = \App\RakGudang::getName($transactions->rak_id);
                                @endphp
                                {{ $name->name ?? '' }}
                            </td>
                            <td>
                                {{ $transactions->tanggal_transaksi ?? '' }}
                            </td>
                            <td>
                                {{ \App\TransaksiStok::TypeTransaction[$transactions->tipe] ?? '' }}
                            </td>
                            <td>
                                @can('transaction_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.transaksi.show', $transactions->id) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('transaction_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.transaksi.edit', $transactions->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                {{-- @can('transaction_delete')
                                    
                                    <form action="{{ route('admin.transaksi.destroy', $transactions->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> 
                                            {{ trans('global.delete') }}
                                        </button>
                                    </form>
                                @endcan --}}
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
        window.open("{{ route('admin.report-transaksi') }}?start="+ start +"&end="+ end +"&type="+ type);
    });

</script>
@endsection
@endsection