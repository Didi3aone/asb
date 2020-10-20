<?php

return [
    'userManagement'       => [
        'title'          => 'Manajemen Pengguna',
        'title_singular' => 'Manajemen Pengguna',
    ],
    'itemManagement'      => [
        'title'          => 'Barang',
        'title_singular' => 'Barang',
    ],
    'memberManagement'      => [
        'title'          => 'Anggota',
        'title_singular' => 'Anggota',
    ],
    'masterManagement'      => [
        'title'          => 'Master',
        'title_singular' => 'Master',
    ],
    'transactionManagement'      => [
        'title'          => 'Transaksi',
        'title_singular' => 'Transaksi',
    ],
    'permission'           => [
        'title'          => 'Izin',
        'title_singular' => 'Izin',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Kunci',
            'access_name'             => 'Nama Akses',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'                 => [
        'title'          => 'Peranan',
        'title_singular' => 'Peran',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Nama',
            'title_helper'       => '',
            'permissions'        => 'Perizinan',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '', 
        ],
    ],
    'user'                 => [
        'title'          => 'Daftar Pengguna',
        'title_singular' => 'Pengguna',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'Nama',
            'name_helper'              => '',
            'gudang'                   => 'Gudang', 
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email Konfirmasi pada',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Peranan',
            'roles_helper'             => '',
            'remember_token'           => 'Pengingat Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'old_password'             => 'Password Lama',
            'new_password'             => 'Password Baru',
            'confirm_password'         => 'Konfirmasi Password',
            'change_password'          => 'Ubah Password',
            'last_login'               => 'Login Terakhir',
            'from'                     => 'Dari',
        ],
    ],
    'warehouse'          => [
        'title'          => 'Gudang',
        'title_singular' => 'Gudang',
        'fields'         => [
            'id'                 => 'ID',
            'name'               => 'Nama Gudang',
            'status'             => 'Status',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],
    'suppliers'          => [
        'title'          => 'Pemasok',
        'title_singular' => 'Pemasok',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Nama',
            'email'             => 'Email',
            'no_telp'           => 'Telepon',
            'no_hp'             => 'HP',
            'pic'               => 'Perwakilan',
            'no_rekening'       => 'Nomor Rekening',
            'ppn'               => 'PPN',
            'password'          => 'Kata sandi',
            'alamat'            => 'Alamat',
            'created_at'        => 'Dibuat pada',
            'updated_at'        => 'Dirubah pada',
            'deleted_at'        => 'Dihapus pada',
        ],
    ],
    'customer'          => [
        'title'          => 'Pelanggan',
        'title_singular' => 'Pelanggan',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Nama',
            'email'             => 'Email',
            'no_telp'           => 'Telepon',
            'no_hp'             => 'HP',
            'pic'               => 'Perwakilan',
            'no_rekening'       => 'Nomor Rekening',
            'ppn'               => 'PPN',
            'password'          => 'Kata sandi',
            'alamat'            => 'Alamat',
            'created_at'        => 'Dibuat pada',
            'updated_at'        => 'Dirubah pada',
            'deleted_at'        => 'Dihapus pada',
        ],
    ],
    'program'          => [
        'title'          => 'Program',
        'title_singular' => 'Program',
        'item'           => 'Detail Barang',
        'fields'         => [
            'id'        => 'ID',
            'nama'      => 'Nama',
            'desc'      => 'Deskripsi',
            'start_date'=> 'Tanggal Mulai',
            'end_date'  => 'Tanggal Berakhir',
            'desc'      => 'Deskripsi',
            'created_by'=> 'Pembuat',
            'updated_by'=> 'Update',
            'count'     => 'Total',
            'alamat'    => 'Alamat',
            'created_at'=> 'Dibuat pada',
            'updated_at'=> 'Dirubah pada',
            'deleted_at'=> 'Dihapus pada',
        ],
    ],
    'member'          => [
        'title'          => 'Anggota',
        'title_singular' => 'Anggota',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Nama',
            'nik'               => 'NIK',
            'telp'              => 'No. Telp',
            'hp'                => 'No. HP',
            'start'             => 'Tanggal Mulai',
            'end'               => 'Tanggal Berakhir',
            'email'             => 'Email',
            'is_active'         => 'Status',
            'active'            => 'Aktif',
            'address'           => 'Alamat',
            'address'           => 'Address',
            'kelurahan'         => 'Kelurahan',
            'kecamatan'         => 'Kecamatan',
            'kabupaten'         => 'Kabupaten',
            'provinsi'          => 'Province',
            'gender'            => 'Gender',
            'marital_status'    => 'Marital Status',
            'job'               => 'Job',
            'level'             => 'Level Member',
            'inactive'          => 'Tidak Aktif',
            'foto_ktp'          => 'KTP',
            'foto_kk'          => 'KK',
            'email'             => 'Email',
            'created_by'        => 'Pembuat',
            'updated_by'        => 'Update',
            'count'             => 'Total',
            'alamat'            => 'Alamat',
            'created_at'        => 'Dibuat pada',
            'updated_at'        => 'Dirubah pada',
            'deleted_at'        => 'Dihapus pada',
        ],
    ],
    'wilayah'          => [
        'title'          => 'Wilayah',
        'title_singular' => 'Wilayah',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Deskripsi',
            'start'             => 'Tanggal Mulai',
            'end'               => 'Tanggal Berakhir',
            'created_by'        => 'Dibuat Oleh',
            'updated_by'        => 'Di Update Oleh',
            'count'             => 'Total',
            'statusactive'      => 'Aktif',
            'statusinactive'    => 'Tidak Aktif',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'provinsi'          => [
        'title'          => 'Provinsi',
        'title_singular' => 'Provinsi',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Deskripsi',
            'start'             => 'Tanggal Mulai',
            'end'               => 'Tanggal Berakhir',
            'created_by'        => 'Dibuat Oleh',
            'updated_by'        => 'Di Update Oleh',
            'count'             => 'Total',
            'statusactive'      => 'Aktif',
            'statusinactive'    => 'Tidak Aktif',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'kabupaten'          => [
        'title'          => 'Kabupaten',
        'title_singular' => 'Kabupaten',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Deskripsi',
            'start'             => 'Tanggal Mulai',
            'end'               => 'Tanggal Berakhir',
            'created_by'        => 'Dibuat Oleh',
            'updated_by'        => 'Di Update Oleh',
            'count'             => 'Total',
            'statusactive'      => 'Aktif',
            'statusinactive'    => 'Tidak Aktif',
            'statusactive'      => 'Aktif',
            'statusinactive'    => 'Tidak Aktif',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'kecamatan'          => [
        'title'          => 'Kecamatan',
        'title_singular' => 'Kecamatan',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Deskripsi',
            'start'             => 'Tanggal Mulai',
            'end'               => 'Tanggal Berakhir',
            'created_by'        => 'Dibuat Oleh',
            'updated_by'        => 'Di Update Oleh',
            'count'             => 'Total',
            'kabupaten'         => 'District',
            'statusactive'      => 'Aktif',
            'statusinactive'    => 'Tidak Aktif',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'kelurahan'          => [
        'title'          => 'Kelurahan',
        'title_singular' => 'Kelurahan',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Deskripsi',
            'start'             => 'Tanggal Mulai',
            'end'               => 'Tanggal Berakhir',
            'created_by'        => 'Dibuat Oleh',
            'updated_by'        => 'Di Update Oleh',
            'count'             => 'Total',
            'statusactive'      => 'Aktif',
            'statusinactive'    => 'Tidak Aktif',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'item-category'          => [
        'title'          => 'Kategori',
        'title_singular' => 'Kategori',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Nama',
            'status'             => 'Status',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],
    'verified-member'          => [
        'title'          => 'Anggota Terverifikasi',
        'title_singular' => 'Anggota Terverifikasi',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Nama',
            'status'             => 'Status',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],
    'unverified-member'          => [
        'title'          => 'Anggota Belum Terverifikasi',
        'title_singular' => 'Anggota Belum Terverifikasi',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Nama',
            'status'             => 'Status',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],
    'item-unit'          => [
        'title'          => 'Satuan',
        'title_singular' => 'Satuan',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Nama',
            'status'             => 'Status',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],

    'item'          => [
        'title'          => 'Barang',
        'title_singular' => 'Barang',
        'fields'         => [
            'id'            => 'ID',
            'nama'          => 'Nama',
            'status'        => 'Status',
            'kategori_id'   => 'Kategori',
            'unit_id'       => 'Satuan',
            'kode'          => 'Kode',
            'foto'          => 'Poto',
            'stock'         => 'Stok',
            'created_at'    => 'Dibuat Pada',
            'updated_at'    => 'Dirubah Pada',
            'deleted_at'    => 'Dihapus Pada',
        ],
    ],

    'transaction-stock'          => [
        'title'          => 'Keluar Masuk Stok',
        'title_transaction_in'   => 'Masuk',
        'title_transaction_out'  => 'Keluar',
        'title_singular' => 'Transaksi',
        'fields'         => [
            'id'                 => 'ID',
            'nomor_transaksi'    => 'Transaksi Number',
            'nomor_ijin'         => 'Nomor Ijin',
            'tanggal_transaksi'  => 'Tanggal Transaksi',
            'gudang_id'          => 'Gudang',
            'tipe'               => 'Tipe',
            'barang_id'          => 'Barang',
            'qty'                => 'Kuantitas',
            'nomor_sparepart'    => 'Nomor Sparepart',
            'in_out'             => 'Masuk / Keluar',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],

    'request-order'          => [
        'title'          => 'Pesanan Permintaan',
        'title_singular' => 'Pesanan Permintaan',
        'fields'         => [
            'id'                 => 'ID',
            'nomor_transaksi'    => 'Transaksi Number',
            'nomor_ijin'         => 'Nomor Ijin',
            'tanggal_transaksi'  => 'Tanggal Transaksi',
            'gudang_id'          => 'Gudang',
            'tipe'               => 'Tipe',
            'member'             => 'Anggota',
            'receive'            => 'Status Penerima',
            'receive_date'       => 'Tanggal Diterima',
            'barang_id'          => 'Barang',
            'qty'                => 'Kuantitas',
            'nomor_sparepart'    => 'Nomor Sparepart',
            'in_out'             => 'Masuk / Keluar',
            'created_at'         => 'Dibuat Pada',
            'updated_at'         => 'Dirubah Pada',
            'deleted_at'         => 'Dihapus Pada',
        ],
    ],

    'purchase-order'          => [
        'title'          => 'Pesanan Pembelian',
        'title_singular' => 'Pesanan Pembelian',
        'fields'         => [    
            'no_req'            => 'ID',
            'date'              => 'Transaksi Number',
            'supplier_by'       => 'Pemasok',
            'program'           => 'Program',
            'total'             => 'Total',
            'tipe'              => 'Tipe',
            'barang_id'         => 'Barang',
            'qty'               => 'Kuantitas',
            'nomor_sparepart'   => 'Nomor Sparepart',
            'in_out'            => 'Masuk / Keluar',
            'created_at'        => 'Dibuat Pada',
            'updated_at'        => 'Dirubah Pada',
            'deleted_at'        => 'Dihapus Pada',
        ],
    ],

    'configuration'          => [
        'title'          => 'Konfigurasi',
        'title_singular' => 'Konfigurasi',
        'fields'         => [
            'id'          => 'ID',
            'name'        => 'Kata Kunci',
            'value'       => 'Nilai',
            'is_file'     => 'File ?',
            'yes_file'    => 'Ya',
            'no_file'     => 'Tidak',
            'created_at'  => 'Dibuat Pada',
            'updated_at'  => 'Dirubah Pada',
            'deleted_at'  => 'Dihapus Pada',
        ],
    ],
];
