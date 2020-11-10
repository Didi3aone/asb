@extends('layouts.admin')
@section('content')
@can('item_create')
    <div style="margin-bottom: 10px;padding:10 10 10 10px" class="row">
        <div class="col-lg float-right" style="margin-bottom: 10px;padding:10 10 10 10 px;">
            <a class="btn btn-warning" href="{{ route("admin.item.create") }}">
                <i class="fa fa-plus"></i> {{ trans('cruds.item.title') }}
            </a>
            <a class="btn btn-primary" href="{{ route("admin.create-packet") }}">
                <i class="fa fa-plus"></i> {{ trans('cruds.item.fields.packet') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.item.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.item.fields.nama') }}
                        </th>

                        <th>
                            {{ trans('cruds.item.fields.kode') }}
                        </th>

                        <th>
                            {{ trans('cruds.item.fields.kategori_id') }}
                        </th>

                        <th>
                            {{ trans('cruds.item.fields.unit_id') }}
                        </th>

                        <th>
                            {{ trans('cruds.item.fields.foto') }}
                        </th>
                        <th>
                            {{ trans('cruds.item.fields.stock') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($item as $key => $items)
                        <tr data-entry-id="{{ $items->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $items->nama ?? '' }}
                            </td>
                            <td>
                                {{ $items->kode ?? '' }}
                            </td>
                            <td>
                                {{ $items->getKategori['nama'] ?? '' }}
                            </td>
                            <td>
                                {{ $items->getUnit['nama'] ?? '' }}
                            </td>
                            <td>
                                <a class="" href="{{ asset('images/item/'.@unserialize($items->foto)) }}" target="_blank">
                                    <img src="{{ asset('images/item/'.@unserialize($items->foto)) }}" width=130 height=100>
                                </a>
                            </td>
                            <td>
                                {{ $items->stok_akhir ?? '' }}
                            </td>
                            <td>
                                @if($items->is_paket == 1)
                                    @can('item_unit_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.show-packet', $items->id) }}">
                                            <i class="fa fa-eye"></i> {{ trans('global.view') }} Detail
                                        </a>
                                    @endcan
                                @endif
                                @can('item_unit_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.item.edit', $items->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('item_unit_delete')
                                    
                                    <form action="{{ route('admin.item.destroy', $items->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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