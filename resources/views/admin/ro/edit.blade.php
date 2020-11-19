@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header bg-warning">
        {{ trans('global.edit') }} {{ trans('cruds.request-order.title_singular') }}
    </div>

    <div class="card-body">
        <form class="form-material mt-4" action="{{ route("admin.ro.update", $ro->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group {{ $errors->has('no_request') ? 'has-error' : '' }}">
                {{-- <label for="no_request">{{ trans('cruds.request-order.fields.no_request') }}*</label> --}}
                <label for="no_request">No Request*</label>
                <input type="text" id="no_request" name="no_request" class="form-control" value="{{ $ro->no_request }}">
                @if($errors->has('no_request'))
                    <em class="invalid-feedback">
                        {{ $errors->first('no_request') }}
                    </em>
                @endif
                <p class="helper-block">

                </p>
            </div>
            <div class="form-group {{ $errors->has('program_id') ? 'has-error' : '' }}">
                <label for="roles">Program ID *</label>
                <select name="program_id" id="program_id" class="form-control select2" required style="width: 100%; height:36px;">
                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                    @foreach($program as $id => $gd)
                        <option value="{{ $id }}" @if ($ro->program_id == $id) selected @endif>{{ $gd }}</option>
                    @endforeach
                </select>
                @if($errors->has('program_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('program_id') }}
                    </em>
                @endif
                <p class="helper-block">
                </p>
            </div>
            <br>
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" name="chk" ></th>
                            <th>{{ trans('cruds.request-order.fields.member') }}</th>
                            {{-- <th>{{ trans('cruds.request-order.fields.receive_date') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody id="items">
                        @foreach($member as $key => $rows)
                        <tr data-entry-id="{{ $rows->id }}">
                            <td>
                                <input type="checkbox" id="receive_{{ $rows->id }}" name="chkbox[]" value="{{ $rows->id }}" >
                            </td>
                            <td>
                                <input type="text" id="name" name="name" value="{{ $rows->name }}" readonly>
                            </td>
                            {{-- <td>
                                <input type="text" id="receive_date" name="receive_date" class="form-control date" value="{{ old('receive_date', date('Y-m-d')) }}">
                                @if($errors->has('receive_date'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('receive_date') }}
                                    </em>
                                @endif
                            </td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <button class="btn btn-primary" id="save" type="submit">
                    <span class="spinner-border spin-save spinner-border-sm" role="status" aria-hidden="true"></span>
                    <i class="fa fa-save"></i> {{ trans('global.save') }}
                </button>
                <a href="{{ route('admin.ro.index') }}" class="btn btn-default"> 
                    <i class="fa fa-arrow-left"> {{ trans('global.back_to_list') }}</i>
                </a>
            </div>
        </form>


    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $("body").on("click",".btn-remove",function(){
        $(this).parents(".control-group").remove();
    });
    let index = 1
    $(document).ready(function () {
        $('#add_item').on('click', function (e) {
            e.preventDefault()

            let html = `
                    <tr data-id="${index}">
                        <td>
                            <select name="member[]" id="member_${index}" class="form-control select2" required style="width: 100%; height:36px;">
                                <option value="">{{ trans('global.pleaseSelect') }}</option>
                                @foreach($member as $id => $it)
                                    <option value="{{ $id }}">{{ $it }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('member'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('member') }}
                                </em>
                            @endif
                            <p class="helper-block">
                            </p>
                        </td>
                        <td>
                            <input type="checkbox" id="receive_${index}" name="receive[]">
                        </td>
                        <td>
                            <input type="text" id="receive_date_${index}" name="receive_date" class="form-control" value="{{ old('receive_date', '') }}">
                            @if($errors->has('receive_date'))
                                <em class="invalid-feedback">
                                    {{ $errors->first('receive_date') }}
                                </em>
                            @endif
                        </td>
                        <td>
                            <a href="javascript:;" class="remove-item btn btn-danger btn-sm" onclick="this.parentNode.parentNode.remove()">
                                <i class="fa fa-times"></i>
                            </a>
                        </td>
                    </tr>
            `
            listStartDate(index)
            $('#items').append(html)
            $('.select2').select2();
            index++
        })
    })
    
    $("#checkAll").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    function listStartDate (i) {
        const $start = $('#receive_date_'+ i);
        var dateNow = new Date();
        
        $start.datetimepicker({
            defaultDate:dateNow
        });
    }
</script>
@endsection