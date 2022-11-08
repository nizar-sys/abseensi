<x-app-layout>
    <x-slot name="header">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            Data rayon
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="modals">
        <div class="modal modal-blur fade" id="modal-add-class-groups" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah rayon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form-new-class-groups">
                            <div class="mb-3">
                                <label class="form-label mb-3" for="nama_rayon">Nama rayon</label>
                                <input type="text" class="form-control input-nama_rayon" name="nama_rayon"
                                    placeholder="Ketik nama rayon... cth: Ciawi 4">
                                <div class="invalid-feedback d-block invalid-nama_rayon"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Batal
                        </a>
                        <button class="btn btn-primary ms-auto" id="save-class-groups">
                            <x-icon type="plus" classicon="" />
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-remove-class-groups" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <x-icon type="alert-triangle" classicon="mb-2 text-danger icon-lg" />
                        <h3>Apakah Anda yakin?</h3>
                        <div class="text-muted">Anda akan menghapus data rayon, dan data terkaitnya seperti data rombel dan siswa.</div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Batal
                                    </a></div>
                                <div class="col"><a href="#" class="btn btn-danger w-100" id="delete-class-groups">
                                        Hapus
                                    </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-edit-class-groups" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah rayon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" id="form-edit-class-groups">
                            <div class="mb-3">
                                <label class="form-label mb-3" for="nama_rayon">Nama rayon</label>
                                <input type="text" class="form-control input-nama_rayon" name="nama_rayon"
                                    placeholder="Ketik nama rayon... cth: Ciawi 4">
                                <div class="invalid-feedback d-block invalid-nama_rayon"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Batal
                        </a>
                        <button class="btn btn-primary ms-auto" id="edit-class-groups">
                            <x-icon type="edit" classicon="" />
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title h4">Data rayon</div>
                        <div class="card-actions">
                            <a href="#" class="btn btn-secondary" id="refresh-class-groups">
                                <x-icon type="reload" classicon="icon text-white" />
                                Segarkan
                            </a>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal-add-class-groups">
                                <x-icon type="plus" classicon="" />
                                Tambah
                            </a>
                        </div>
                    </div>
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-muted">
                                Menampilkan
                                <div class="mx-2 d-inline-block">
                                    <input type="text" class="form-control form-control-sm" value=""
                                        size="3" aria-label="Total rayon" id="input-length-class-groups">
                                </div>
                                data
                            </div>
                            <div class="ms-auto text-muted">
                                Cari rayon:
                                <div class="ms-2 d-inline-block">
                                    <input type="search" class="form-control form-control-sm"
                                        aria-label="Cari rayon" placeholder="Cari rayon" id="search-class-groups">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>nama rayon</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="class-groups-data">
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-muted">Menampilkan <span id="count-from-class-groups">0</span> sampai <span
                                id="count-to-class-groups">0</span> dari <span id="count-total-class-groups">0</span>
                            data
                        </p>
                        <ul class="pagination m-0 ms-auto" id="paginate-class-groups"></ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            let iconEdit = `<x-icon type="edit" classicon="icon-tabler icon-tabler-edit" />`
            let iconHapus = `<x-icon type="trash" classicon="icon-tabler icon-tabler-trash" />`
        </script>
        @vite('resources/js/admin/master_data/rayons/script.js')
    @endsection
</x-app-layout>
