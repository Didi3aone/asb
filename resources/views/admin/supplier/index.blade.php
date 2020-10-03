@extends('layouts.admin')
@section('content')
@can('supplier_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary float-right" href="{{ route("admin.supplier.create") }}">
                <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.suppliers.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.suppliers.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.suppliers.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.suppliers.fields.no_telp') }}
                        </th>
                        <th>
                            {{ trans('cruds.suppliers.fields.no_hp') }}
                        </th>
                        <th>
                            {{ trans('cruds.suppliers.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.suppliers.fields.pic') }}
                        </th>
                        <th>
                            {{ trans('cruds.suppliers.fields.alamat') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($supplier as $key => $suppliers)
                        <tr data-entry-id="{{ $suppliers->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $suppliers->nama ?? '' }}
                            </td>
                            <td>
                                {{ $suppliers->no_telp ?? '' }}
                            </td>
                            <td>
                                {{ $suppliers->no_hp ?? '' }}
                            </td>
                            <td>
                                {{ $suppliers->email ?? '' }}
                            </td>
                            <td>
                                {{ $suppliers->pic ?? '' }}
                            </td>
                            <td>
                                {{ $suppliers->alamat ?? '' }}
                            </td>
                            <td>
                                @can('supplier_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.supplier.show', $suppliers->id) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('supplier_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.supplier.edit', $suppliers->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('supplier_delete')
                                    
                                    <form action="{{ route('admin.supplier.destroy', $suppliers->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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