<template>
    <div class="container" style="padding-top: 30px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">VueJS Datatables</h5>
                    </div>
                    <div class="card-body">
                      	<!-- COMPONENT YANG SUDAH KITA BUAT, MENGHARAPKAN 3 BUAH PROPS, YAKNI ITEMS, FIELDS DAN META. KETIGA DATA YANG DIMINTA OLEH PROPS INI AKAN KITA KIRIMKAN -->
                        <!-- ADAPUN CARA MENGAMBIL VALUE DARI EMIT YANG SUDAH KITA BUAT ADALAH DENGAN MENAMBAHKAN @ DAN DIIKUTI DENGAN NAMA EMITNYA -->
                        <!-- DAN PARAMETER SETELAH SAMA DENGAN DARI EMIT ADALAH FUNGSI UNTUK MENERIMA VALUENYA -->
                        <app-datatable 
                            :items="items" 
                            :fields="fields" 
                            :meta="meta" 
                            @per_page="handlePerPage" 
                            @pagination="handlePagination" 
                            @search="handleSearch" 
                            @sort="handleSort"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
