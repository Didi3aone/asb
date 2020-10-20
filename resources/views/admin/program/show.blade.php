@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.program.title_singular') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $program->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date
                        </th>
                        <td>
                            {{ $program->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>
                        <td>
                            {{ $program->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{ $program->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By
                        </th>
                        <td>
                            @php
                                $name = \App\User::getName($program->created_by);
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
                        <th>
                            {{ trans('cruds.program.fields.nama') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($detail) > 0)
                        @foreach($detail as $key => $rows)
                            <tr>
                                <td>
                                    {{ $key +1 }}
                                </td>
                                <td>
                                    @php
                                        $name = \App\Item::getItem($rows->id_barang);
                                    @endphp
                                    {{ $name->nama }}
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