@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Show Member
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.no') }}
                        </th>
                        <td>
                            {{ $detail->no_member }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.nama') }}
                        </th>
                        <td>
                            {{ $member->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.nickname') }}
                        </th>
                        <td>
                            {{ $detail->nickname }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.nik') }}
                        </th>
                        <td>
                            {{ $detail->nik }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nomor KK
                        </th>
                        <td>
                            {{ $detail->no_kk }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.hp') }}
                        </th>
                        <td>
                            {{ $detail->no_hp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.email') }}
                        </th>
                        <td>
                            {{ $member->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.gender') }}
                        </th>
                        @if ($detail->gender == 0)
                            <td>
                                {{ trans('cruds.member.fields.wanita') }}
                            </td>
                        @elseif ($detail->gender == 1)
                            <td>
                                {{ trans('cruds.member.fields.pria') }}
                            </td>
                        @endif
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.member.fields.address') }}
                        </th>
                        <td>
                            {{ $detail->alamat ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Provinsi
                        </th>
                        <td>
                            @php
                                $name = \App\Provinsi::getProv($detail->provinsi);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kabupaten/Kota
                        </th>
                        <td>
                            @php
                                $name = \App\Kabupaten::getKab($detail->kabupaten);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kecamatan
                        </th>
                        <td>
                            @php
                                $name = \App\Kecamatan::getKec($detail->kecamatan);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kelurahan
                        </th>
                        <td>
                            @php
                                $name = \App\Kelurahan::getKel($detail->kelurahan);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Provinsi Domisili
                        </th>
                        <td>
                            @php
                                $name = \App\Provinsi::getProv($detail->provinsi_domisili);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kabupaten/Kota Domisili
                        </th>
                        <td>
                            @php
                                $name = \App\Kabupaten::getKab($detail->kabupaten_domisili);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kecamatan Domisili
                        </th>
                        <td>
                            @php
                                $name = \App\Kecamatan::getKec($detail->kecamatan_domisili);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kelurahan Domisili
                        </th>
                        <td>
                            @php
                                $name = \App\Kelurahan::getKel($detail->kelurahan_domisili);
                            @endphp
                            {{ $name->name ?? '' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <h2>Member</h2>
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
                            Nama 
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
                    </tr>
                </thead>
                <tbody>
                    @if(count($show) > 0)
                        @foreach($show as $key => $rows)
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