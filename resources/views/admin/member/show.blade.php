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