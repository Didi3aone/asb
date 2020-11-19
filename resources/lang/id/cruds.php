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
    'information'           => [
        'title'          => 'Informasi',
        'title_singular' => 'Informasi',
        'fields'         => [
            'nama'              => 'Nama',
            'categories'        => 'Kategori',
            'content'           => 'Isi',
            'pict'              => 'Gambar',
            'created_by'        => 'Pembuat',
            'updated_by'        => 'Di Update oleh',
            'status'            => 'Status',
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
    'category'        => [
        'title'          => 'Artikel Kategori',
        'title_singular' => 'Artikel Kategori',
        'fields'         => [
            'nama'              => 'Nama',
            'content'           => 'Konten',
            'pict'              => 'Gambar',
            'created_by'        => 'Pembuat',
            'updated_by'        => 'Di Update Oleh',
            'status'            => 'Status',
            'id_helper'         => '',
            'title'             => 'Key',
            'access_name'             => 'Access Name',
            'title_helper'      => '',
            'created_at'        => 'Tanggal di buat',
            'created_at_helper' => '',
            'updated_at'        => 'Tanggal di update',
            'updated_at_helper' => '',
            'deleted_at'        => 'Dihapus Pada',
            'deleted_at_helper' => '',
        ],
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
            'id'                => 'ID',
            'name'              => 'Nama Gudang',
            'status'            => 'Status',
            'rak'               => 'Rak',
            'created_at'        => 'Dibuat Pada',
            'updated_at'        => 'Dirubah Pada',
            'deleted_at'        => 'Dihapus Pada',
            'hapus_confirm'     => 'Hapus Rak ini ?',
            'rak_val'           => 'Nama Rak Tidak Boleh Kosong !'
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
            'reporttype'        => 'Tipe tidak boleh kosong',
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
            'no'                => 'No Anggota',
            'nama'              => 'Nama',
            'nickname'          => 'Nama Panggilan',
            'nik'               => 'No. KTP',
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
            'level'             => 'Level Anggota',
            'inactive'          => 'Tidak Aktif',
            'foto_ktp'          => 'KTP',
            'foto_kk'           => 'KK',
            'email'             => 'Email',
            'created_by'        => 'Pembuat',
            'updated_by'        => 'Update',
            'count'             => 'Total',
            'alamat'            => 'Alamat',
            'created_at'        => 'Dibuat pada',
            'updated_at'        => 'Dirubah pada',
            'deleted_at'        => 'Dihapus pada',
            'level_member'      => 'Level Anggota',
            'oldpassword'       => 'Password Lama',
            'newpassword'       => 'Password Baru',
            'pob'               => 'Tempat Lahir',
            'dob'               => 'Hari Lahir'
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
            'nama'              => 'Nama',
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
            'report'            => 'Laporan Anggota Berdasarkan Provinsi',
            'jumlah'            => 'Jumlah',
            'total'             => 'Total',
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
            'report'            => 'Laporan Anggota Berdasarkan Kabupaten',
            'jumlah'            => 'Jumlah',
            'total'             => 'Total',
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
            'report'            => 'Laporan Anggota Berdasarkan Kecamatan',
            'jumlah'            => 'Jumlah',
            'total'             => 'Total',
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
            'report'            => 'Laporan Anggota Berdasarkan Kelurahan',
            'jumlah'            => 'Jumlah',
            'total'             => 'Total',
        ],
    ],
    'item-category'          => [
        'title'          => 'Kategori Barang',
        'title_singular' => 'Kategori Barang',
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
            'packet'        => 'Paket',
            'nama'          => 'Nama',
            'status'        => 'Status',
            'kategori_id'   => 'Kategori',
            'unit_id'       => 'Satuan',
            'kode'          => 'Kode',
            'qty'           => 'Jumlah',
            'detail'        => 'Detail Paket',
            'foto'          => 'Poto',
            'stock'         => 'Stok',
            'created_at'    => 'Dibuat Pada',
            'updated_at'    => 'Dirubah Pada',
            'deleted_at'    => 'Dihapus Pada',
        ],
    ],

    'transaction-stock'          => [
        'title'          => 'Keluar Masuk Stok',
        'title_transaction_in'   => 'Pemasukan',
        'title_transaction_out'  => 'Pengeluaran',
        'title_singular' => 'Transaksi',
        'fields'         => [
            'id'                => 'ID',
            'nomor_transaksi'   => 'Nomor Transaksi',
            'nomor_ijin'        => 'Nomor Ijin',
            'tanggal_transaksi' => 'Tanggal Transaksi',
            'gudang_id'         => 'Gudang',
            'rak_id'            => 'Rak',
            'tipe'              => 'Tipe',
            'barang_id'         => 'Barang',
            'qty'               => 'Kuantitas',
            'nomor_sparepart'   => 'Nomor Sparepart',
            'in_out'            => 'Masuk / Keluar',
            'in'                => 'Pemasukan',
            'out'               => 'Pengeluaran',
            'Supplier'          => 'Penyuplai',
            'saldo'             => 'Stok Terakhir',
            'created_at'        => 'Dibuat Pada',
            'updated_at'        => 'Dirubah Pada',
            'deleted_at'        => 'Dihapus Pada',
            'payment_status'    => 'Status Pembayaran',
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
            'type'               => 'Jenis Report',
            'request'            => 'Diajukan',
            'send'               => 'Dikirim',
            'receive'            => 'Diterima',
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
            'paid'              => 'Dibayar',
            'unpaid'            => 'Belum Dibayar',
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
