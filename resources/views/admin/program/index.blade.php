@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('cruds.program.title_singular') }} {{ trans('global.report') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                    <label for="start">{{ trans('cruds.member.fields.start') }}*</label>
                    <input type="text" id="start" name="start" class="form-control date" value="{{ old('start' ) }}">
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
                    <input type="text" id="end" name="end" class="form-control date" value="{{ old('end' ) }}">
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
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label for="type">Program*</label>
                    <select name="type" id="type" class="form-control select2" required style="width: 100%; height:36px;">
                        <option value="">{{ trans('global.pleaseSelect') }}</option>
                        @foreach($prog as $id => $un)
                            <option value="{{ $id }}">{{ $un }}</option>
                        @endforeach
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
@can('customer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary float-right" href="{{ route("admin.program.create") }}">
                <i class="fa fa-plus"></i> {{ trans('global.add') }} {{ trans('cruds.program.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.program.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.program.fields.nama') }}
                        </th>
                        <th>
                            {{ trans('cruds.program.fields.start_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.program.fields.end_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.program.fields.desc') }}
                        </th>
                        <th>
                            {{ trans('cruds.program.fields.created_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.program.fields.updated_by') }}
                        </th>
                        <th>
                            {{ trans('cruds.program.fields.count') }}s
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($program as $key => $rows)
                        <tr data-entry-id="{{ $rows->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $rows->name ?? '' }}
                            </td>
                            <td>
                                {{ $rows->start_date ?? '' }}
                            </td>
                            <td>
                                {{ $rows->end_date ?? '' }}
                            </td>
                            <td>
                                {{ $rows->description ?? '' }}
                            </td>
                            <td>
                                @php
                                    $name = \App\User::getName($rows->created_by);
                                @endphp
                                {{ $name->name ?? '' }}
                            </td>
                            <td>
                                @php
                                    $name = \App\User::getName($rows->updated_by);
                                @endphp
                                {{ $name->name ?? '' }}
                            </td>
                            <td>
                                @php
                                    $count = \App\DetailPeriodeProgram::countPrograms($rows->id)
                                @endphp
                                {{ $count ?? '' }}
                            </td>
                            <td>
                                @can('program_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.program.show', $rows->id) }}">
                                        <i class="fa fa-eye"></i> {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('program_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.program.edit', $rows->id) }}">
                                        <i class="fa fa-edit"></i> {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('program_delete')
                                    
                                    <form action="{{ route('admin.program.destroy', $rows->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
        if(type == '') {
			swal("Error","{{ trans('cruds.program.fields.reporttype') }}");
			return false;
		}
        window.open("{{ route('admin.report-program') }}?start="+ start +"&end="+ end +"&type="+ type);
    });

</script>
@endsection
@endsection