<x-app-layout>
    <x-slot name="header_content">
        <h1>Produk</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Produk</div>
        </div>
    </x-slot>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Produk</h4>
                    <div class="card-header-action">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#add-product"><i class="fas fa-plus"></i> Tambah Produk</button>
                    </div>
                </div>
                <div class="card-body">
                    @if (session()->get('product'))
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>×</span>
                                </button>
                                {{ session('product') }}
                            </div>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="product" class="table table-striped table-md">
                            <thead>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Harga Reseller</th>
                                <th>Harga Toko</th>
                                <th>Aksi</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="modal">
        @component('components.modal', ['id' => 'add-product'])
            @slot('action', route('products.store'))

            @slot('title', 'Tambah Produk')

            @slot('body')
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="code" id="code" autocomplete="off">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Nama">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6" id="category-add">
                        <label for="Jenis Kategori">Jenis Kategori</label>
                        <div class="input-group">
                            <select class="custom-select select2-modal" name="category" style="width:100%" data-parent="#category-add">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Stok">Stok</label>
                    <input type="number" class="form-control" name="stock" id="stock" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="Harga">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp
                            </div>
                        </div>
                        <input type="text" class="form-control price" name="price" id="price" autocomplete="off">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Harga Reseller">Harga Reseller</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control price" name="reseller_price" id="reseller_price" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Harga Toko">Harga Toko</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control price" name="store_price" id="store_price" autocomplete="off">
                        </div>
                    </div>
                </div>
            @endslot

            @slot('footer')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary btn-save">Simpan</button>
            @endslot
        @endcomponent

        @component('components.modal', ['id' => 'edit-product'])
            @slot('action', ''))

            @slot('method')
                @method('patch')
            @endslot

            @slot('title', 'Edit Kategori Produk')

            @slot('body')
                <div class="form-group">
                    <label for="Kode">Kode</label>
                    <input type="text" class="form-control" name="code" id="code" autocomplete="off">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Nama">Nama</label>
                        <input type="text" class="form-control" name="name" id="name" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6" id="category-edit">
                        <label for="Jenis Kategori">Jenis Kategori</label>
                        <div class="input-group">
                            <select class="custom-select select2-ajax select2-modal" name="category" style="width:100%" data-parent="#category-edit">
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Stok">Stok</label>
                    <input type="number" class="form-control" name="stock" id="stock" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="Harga">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Rp
                            </div>
                        </div>
                        <input type="text" class="form-control price" name="price" id="price" autocomplete="off">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Harga Reseller">Harga Reseller</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control price" name="reseller_price" id="reseller_price" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Harga Toko">Harga Toko</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Rp
                                </div>
                            </div>
                            <input type="text" class="form-control price" name="store_price" id="store_price" autocomplete="off">
                        </div>
                    </div>
                </div>
            @endslot

            @slot('footer')
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button class="btn btn-primary btn-save">Simpan</button>
            @endslot
        @endcomponent

        @component('components.modal', ['id' => 'delete-confirmation'])
            @slot('action', ''))

            @slot('method')
                @method('delete')
            @endslot

            @slot('title', 'Hapus Kategori Produk?')

            @slot('body')
                <p>Apakah anda yakin?</p>
            @endslot

            @slot('footer')
                <button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</button>
                <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
            @endslot
        @endcomponent
    </x-slot>

    <x-slot name="script">
        <script type="text/javascript">
            $(function () {
                $('#product').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('products.index') }}",
                    columns: [
                        {data: 'code', name: 'code'},
                        {data: 'name', name: 'name'},
                        {data: 'product_category.name', name: 'category'},
                        {data: 'stock', name: 'stock'},
                        {data: 'price', name: 'price'},
                        {data: 'reseller_price', name: 'name'},
                        {data: 'store_price', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                    columnDefs: [
                        { width: '40px', targets: 0 },
                    ],
                    "order": [[ 1, "asc" ]],
                    fnDrawCallback: function(){
                        $('[data-toggle="tooltip"]').tooltip()
                    }
                });

                $('.select2-modal').each(function(){
                    $(this).select2({
                        dropdownParent: $(this).data('parent'),
                        placeholder: 'Pilih Jenis Kategori',
                        tags: true,
                        ajax: {
                            url: "{{ route('get-categories') }}",
                            dataType: 'json',
                            delay: 250,
                            data: function (params) {
                                return {
                                    search: params.term,
                                };
                            },
                            processResults: function (data) {
                                return {
                                    results: data.data
                                };
                            },
                            cache: true
                        }
                    })
                })
            });
        </script>
    </x-slot>
</x-app-layout>
