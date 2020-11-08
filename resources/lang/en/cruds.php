<?php

return [
    'userManagement'    => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'itemManagement'      => [
        'title'          => 'Item',
        'title_singular' => 'Item',
    ],
    'memberManagement'      => [
        'title'          => 'Member',
        'title_singular' => 'Member',
    ],
    'masterManagement'      => [
        'title'          => 'Master',
        'title_singular' => 'Master',
    ],
    'transactionManagement'      => [
        'title'          => 'Transaction',
        'title_singular' => 'Transaction',
    ],
    'information'        => [
        'title'          => 'Informations',
        'title_singular' => 'Informations',
        'fields'         => [
            'nama'              => 'Name',
            'categories'        => 'Category Type',
            'content'           => 'Content',
            'pict'              => 'Picture',
            'created_by'        => 'Author',
            'updated_by'        => 'Updated By',
            'status'            => 'Status',
            'id_helper'         => '',
            'title'             => 'Key',
            'access_name'             => 'Access Name',
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
        'title'          => 'Article Categories',
        'title_singular' => 'Article Categories',
        'fields'         => [
            'nama'              => 'Name',
            'content'           => 'Content',
            'pict'              => 'Picture',
            'created_by'        => 'Author',
            'updated_by'        => 'Updated By',
            'status'            => 'Status',
            'id_helper'         => '',
            'title'             => 'Key',
            'access_name'             => 'Access Name',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'permission'        => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Key',
            'access_name'             => 'Access Name',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'              => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'              => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'nik'                      => 'Nik',
            'gudang'                   => 'Warehouse', 
            'nik_helper'               => '',
            'departmentId'             => 'Department',
            'departmentId_helper'      => '',
            'name'                     => 'Name',
            'name_helper'              => '',
            'email'                    => 'Email',
            'email_helper'             => '',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'roles'                    => 'Roles',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'old_password'             => 'Old Password',
            'new_password'             => 'New Password',
            'confirm_password'         => 'Confirm Password',
            'change_password'          => 'Change Password',
            'last_login'               => 'Last Login',
            'from'                     => 'From',
        ],
    ],
    'warehouse'          => [
        'title'          => 'Warehouse',
        'title_singular' => 'Warehouse',
        'fields'         => [
            'id'                 => 'ID',
            'name'               => 'Warehouse Name',
            'status'             => 'Status',
            'rak'                => 'Shelf',
            'created_at'         => 'Created at',
            'updated_at'         => 'Updated at',
            'deleted_at'         => 'Deleted at',
        ],
    ],
    'suppliers'          => [
        'title'          => 'Suppliers',
        'title_singular' => 'Supplier',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'email'             => 'Email',
            'no_telp'           => 'Phone Number',
            'no_hp'             => 'Handphone',
            'pic'               => 'Pic',
            'no_rekening'       => 'Account Number',
            'ppn'               => 'PPN',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'customer'          => [
        'title'          => 'Customers',
        'title_singular' => 'Customers',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'email'             => 'Email',
            'no_telp'           => 'Phone Number',
            'no_hp'             => 'Handphone',
            'pic'               => 'Pic',
            'no_rekening'       => 'Account Number',
            'ppn'               => 'PPN',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'program'          => [
        'title'          => 'Programs',
        'title_singular' => 'Programs',
        'item'           => 'Items Detail',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Description',
            'start_date'        => 'Start Date',
            'end_date'          => 'End Date',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'password'          => 'Password',
            'reporttype'        => 'Type Cannot be Empty',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'member'          => [
        'title'          => 'Members',
        'title_singular' => 'Members',
        'fields'         => [
            'id'                => 'ID',
            'no'                => 'No Member',
            'nama'              => 'Name',
            'nickname'          => 'Nickname',
            'nik'               => 'No. KTP',
            'telp'              => 'No. Telp',
            'hp'                => 'No. HP',
            'email'             => 'Email',
            'is_active'         => 'Status',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'active'            => 'Active',
            'inactive'          => 'InActive',
            'email'             => 'Email',
            'address'           => 'Address',
            'kelurahan'         => 'Kelurahan',
            'kecamatan'         => 'Kecamatan',
            'kabupaten'         => 'Kabupaten',
            'provinsi'          => 'Province',
            'gender'            => 'Gender',
            'marital_status'    => 'Marital Status',
            'job'               => 'Job',
            'level'             => 'Level Member',
            'foto_ktp'          => 'KTP',
            'foto_kk'           => 'KK',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'wilayah'          => [
        'title'          => 'Territory',
        'title_singular' => 'Territory',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Description',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'active'            => 'status',
            'statusactive'      => 'Active',
            'statusinactive'    => 'InActive',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'provinsi'          => [
        'title'          => 'Province',
        'title_singular' => 'Province',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Description',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'active'            => 'status',
            'statusactive'      => 'Active',
            'statusinactive'    => 'InActive',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'kabupaten'          => [
        'title'          => 'District',
        'title_singular' => 'District',
        'fields'         => [
            'id'                => 'ID',
            'nama'              => 'Name',
            'desc'              => 'Description',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'active'            => 'status',
            'statusactive'      => 'Active',
            'statusinactive'    => 'InActive',
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
            'desc'              => 'Description',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'kabupaten'         => 'District',
            'active'            => 'status',
            'statusactive'      => 'Active',
            'statusinactive'    => 'InActive',
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
            'desc'              => 'Description',
            'start'             => 'Start Date',
            'end'               => 'End Date',
            'created_by'        => 'Created By',
            'updated_by'        => 'Updated By',
            'count'             => 'Count',
            'active'            => 'status',
            'statusactive'      => 'Active',
            'statusinactive'    => 'InActive',
            'password'          => 'Password',
            'alamat'            => 'Address',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    'item-category'          => [
        'title'          => 'Item Categories',
        'title_singular' => 'Item Categories',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Name',
            'status'             => 'Status',
            'created_at'         => 'Created at',
            'updated_at'         => 'Updated at',
            'deleted_at'         => 'Deleted at',
        ],
    ],
    'verified-member'          => [
        'title'          => 'Verified Member',
        'title_singular' => 'Verified Member',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Name',
            'status'             => 'Status',
            'created_at'         => 'Created At',
            'updated_at'         => 'Updated At',
            'deleted_at'         => 'Deleted At',
        ],
    ],
    'unverified-member'          => [
        'title'          => 'Unverified Member',
        'title_singular' => 'Unverified Member',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Name',
            'status'             => 'Status',
            'created_at'         => 'Created At',
            'updated_at'         => 'Updated At',
            'deleted_at'         => 'Deleted At',
        ],
    ],
    'item-unit'          => [
        'title'          => 'Unit',
        'title_singular' => 'Unit',
        'fields'         => [
            'id'                 => 'ID',
            'nama'               => 'Name',
            'status'             => 'Status',
            'created_at'         => 'Created at',
            'updated_at'         => 'Updated at',
            'deleted_at'         => 'Deleted at',
        ],
    ],

    'item'          => [
        'title'          => 'Item',
        'title_singular' => 'Item',
        'fields'         => [
            'id'            => 'ID',
            'nama'          => 'Name',
            'status'        => 'Status',
            'kategori_id'   => 'Category',
            'unit_id'       => 'Unit',
            'kode'          => 'Code',
            'foto'          => 'Foto',
            'stock'         => 'Stock',
            'created_at'    => 'Created at',
            'updated_at'    => 'Updated at',
            'deleted_at'    => 'Deleted at',
        ],
    ],

    'transaction-stock'          => [
        'title'                  => 'In Out Stock',
        'title_transaction_in'   => 'In',
        'title_transaction_out'  => 'Out',
        'title_singular'         => 'Transaction',
        'fields'         => [
            'id'                 => 'ID',
            'nomor_transaksi'    => 'Transaction Number',
            'nomor_ijin'         => 'Permit Number',
            'tanggal_transaksi'  => 'Transaction Date',
            'gudang_id'          => 'Warehouse',
            'tipe'               => 'Type',
            'barang_id'          => 'Item',
            'qty'                => 'Qty',
            'nomor_sparepart'    => 'Sparepart Number',
            'in_out'             => 'In / Out',
            'created_at'         => 'Created at',
            'updated_at'         => 'Updated at',
            'deleted_at'         => 'Deleted at',
        ],
    ],

    'request-order' => [
        'title'                  => 'Request Order',
        'title_singular'         => 'Request Order',
        'fields'         => [
            'no_req'            => 'No Request',
            'date'              => 'Date',
            'created_by'        => 'Created By',
            'program'           => 'Program',
            'member'            => 'Member',
            'receive'           => 'Receive Status',
            'receive_date'      => 'Receive Date',
            'total'             => 'Total',
            'tipe'              => 'Type',
            'type'              => 'Report Type',
            'request'           => 'Requested',
            'send'              => 'Sent',
            'receive'           => 'Received',
            'barang_id'         => 'Item',
            'total'             => 'Total',
            'nomor_sparepart'   => 'Sparepart Number',
            'in_out'            => 'In / Out',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    
    'purchase-order' => [
        'title'                  => 'Purchase Order',
        'title_singular'         => 'Purchase Order',
        'fields'         => [
            'no_req'            => 'No Request',
            'date'              => 'Date',
            'supplier_by'       => 'Supplier By',
            'program'           => 'Program',
            'total'             => 'Total',
            'tipe'              => 'Type',
            'barang_id'         => 'Item',
            'paid'              => 'Paid',
            'unpaid'            => 'Unpaid',
            'qty'               => 'Qty',
            'nomor_sparepart'   => 'Sparepart Number',
            'in_out'            => 'In / Out',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ],
    ],
    
    'configuration'          => [
        'title'          => 'Configuration',
        'title_singular' => 'Configuration',
        'fields'         => [
            'id'          => 'ID',
            'name'        => 'Key Name',
            'value'       => 'Value',
            'is_file'     => 'Is File ?',
            'yes_file'    => 'Yes',
            'no_file'     => 'No',
            'created_at'  => 'Created at',
            'updated_at'  => 'Updated at',
            'deleted_at'  => 'Deleted at',
        ],
    ],
];
