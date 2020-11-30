@extends('layouts.admin')
@section('content')


{{-- @can('customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary float-right" href="{{ route("admin.master-member.create") }}">
                <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.member.title_singular') }}
            </a>
        </div>
    </div>
@endcan --}}
<div class="card">
    <div class="card-header">
        {{ trans('cruds.unverified-member.title') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.member.fields.no') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.nik') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.telp') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.hp') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.updated_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.created_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.member.fields.is_active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($member as $key => $rows)
                        <tr data-entry-id="{{ $rows->userid }}">
                            <td>

                            </td>
                            <td>
                                @php
                                    $kec = str_pad($rows->kecid,4,"0",STR_PAD_LEFT);   
                                @endphp
                                {{ $rows->provid ?? '-' }}.{{ $kec ?? '-' }}.{{ $rows->no_member ?? '-' }}
                            </td>
                            <td>
                                {{ $rows->name ?? '-' }}
                            </td>
                            <td>
                                {{ $rows->nik ?? '-' }}
                            </td>
                            <td>
                                {{ $rows->no_telp ?? '-' }}
                            </td>
                            <td>
                                {{ $rows->no_hp ?? '-' }}
                            </td>
                            <td>
                                {{ $rows->email ?? '-' }}
                            </td>
                            <td>
                                @php
                                    $name = \App\User::getName($rows->created_by);
                                @endphp
                                {{ $name->name ?? '-' }}
                            </td>
                            <td>
                                @php
                                    $name = \App\User::getName($rows->updated_by);
                                @endphp
                                {{ $name->name ?? '-' }}
                            </td>
                            <td>
                                {{ $rows->created_at ?? '-' }}
                            </td>
                            <td>
                                @if($rows->is_active == 1)
                                    {{ trans('cruds.member.fields.active') }}
                                @elseif($rows->is_active == 0)
                                    {{ trans('cruds.member.fields.inactive') }}
                                @endif
                            </td>
                            <td>
                                @can('member_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.master-member.show', $rows->userid) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('member_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.master-member.edit', $rows->userid) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                {{-- @can('member_delete')
                                    
                                    <form action="{{ route('admin.master-member.destroy', $rows->userid) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        if(type == '') {
			swal("Error","{{ trans('cruds.program.fields.reporttype') }}");
			return false;
		}
        window.open("{{ route('admin.report-member') }}?start="+ start +"&end="+ end +"&type="+ type);
    });
</script>
@endsection
@endsection