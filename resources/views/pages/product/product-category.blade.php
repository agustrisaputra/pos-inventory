<x-app-layout>
    <x-slot name="header_content">
        <h1>Kategori Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Kategori Produk</div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Kategori Produk</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#product-category"><i class="fas fa-plus"></i> Tambah Kategori</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-md" id="productCategory">
                            <thead>
                                <th class="text-center">No</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="modal">
        @component('components.modal', ['id' => 'product-category'])
            @slot('action', route('product-categories.store'))

            @slot('title', 'Tambah Kategori Produk')

            @slot('body')
                <div class="form-group">
                    <label for="Nama">Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            @endslot

            @slot('footer')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary btn-save">Simpan</button>
            @endslot
        @endcomponent
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(function () {
                var table = $('#productCategory').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('product-categories.index') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    columnDefs: [
                        { width: '90px', targets: 0 },
                    ],
                    fnDrawCallback: function(){
                        $('[data-toggle="tooltip"]').tooltip()
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
