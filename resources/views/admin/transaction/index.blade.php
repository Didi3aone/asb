@extends('layouts.admin')
@section('content')
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
                            {{ trans('cruds.transaction-stock.fields.nomor_ijin') }}
                        </th>
                        <th>
                            {{ trans('cruds.transaction-stock.fields.gudang_id') }}
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
                                {{ $transactions->nomor_transaksi ?? '' }}
                            </td>
                            <td>
                                {{ $transactions->nomor_ijin ?? '' }}
                            </td>
                            <td>
                                {{ $transactions->getGudang['nama_gudang'] ?? '' }}
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
                                @can('transaction_delete')
                                    
                                    <form action="{{ route('admin.transaksi.destroy', $transactions->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    })

</script>
@endsection
@endsection