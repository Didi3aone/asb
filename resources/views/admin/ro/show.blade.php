@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Request Order
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
                            {{ $ro->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Start Date
                        </th>
                        <td>
                            {{ $ro->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            End Date
                        </th>
                        <td>
                            {{ $ro->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Description
                        </th>
                        <td>
                            {{ $ro->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created By
                        </th>
                        <td>
                            @php
                                $name = \App\User::getName($ro->created_by);
                            @endphp
                            {{ $name->name }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <h2>Detail Penerima</h2>
            <div class="table table-responsive">
                <table class="table table-bordered table-striped table-sm" class="table table-striped table-bordered ">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            NIK
                        </th>
                        <th>
                            No. KK 
                        </th>
                        <th>
                            Nama Penerima 
                        </th>
                        <th>
                            No. Telp 
                        </th>
                        <th>
                            No. Handphone 
                        </th>
                        <th>
                            Email 
                        </th>
                        <th>
                            Pekerjaan
                        </th>
                        <th>
                            Provinsi
                        </th>
                        <th>
                            Kabupaten
                        </th>
                        <th>
                            Kecamatan
                        </th>
                        <th>
                            Kelurahan
                        </th>
                        <th>
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($detail) > 0)
                        @foreach($detail as $key => $rows)
                            @if($rows->nik == null)
                                <tr>
                                    <td colspan="13">
                                        <center>{{ trans('cruds.request-order.fields.member') }} {{ trans('cruds.request-order.fields.notfound') }}</center>
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        {{ $key +1 }}
                                    </td>
                                    <td>
                                        {{ $rows->nik }}
                                    </td>
                                    <td>
                                        {{ $rows->no_kk }}
                                    </td>
                                    <td>
                                        {{ $rows->nickname }}
                                    </td>
                                    <td>
                                        {{ $rows->no_telp }}
                                    </td>
                                    <td>
                                        {{ $rows->no_hp }}
                                    </td>
                                    <td>
                                        {{ $rows->email ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($rows->pekerjaan != null)
                                            
                                        @endif
                                        @php
                                            $name = \App\Job::getName($rows->pekerjaan);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Provinsi::getProv($rows->provinsi);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Kabupaten::getKab($rows->kabupaten);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Kecamatan::getKec($rows->kecamatan);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @php
                                            $name = \App\Kelurahan::getKel($rows->kelurahan);
                                        @endphp
                                        {{ $name->name ?? '-' }}
                                    </td>
                                    <td>
                                        @if ($rows->status_penerima == 1)
                                            Belum Menerima
                                        @else
                                            Sudah Menerima
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                </thead>
            </table>
            </div>
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