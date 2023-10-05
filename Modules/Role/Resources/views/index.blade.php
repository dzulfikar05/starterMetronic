<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Form Role</div>
            </div>
            <div class="card-body">
                <form action="javascript:onSave(this)" method="post" id="form_role" name="form_role" autocomplete="off">
                    <input type="hidden" name="role_id" id="role_id">
                    <div class="form-label">
                        <label class="mb-2 required" for="role_kode">Kode</label>
                        <input id="role_kode" required name="role_kode" class="form-control form-control mb-3" type="text"
                            placeholder="Kode">
                    </div>
                    <div class="form-label">
                        <label class="mb-2 required" for="role_nama">Nama</label>
                        <input id="role_nama" required name="role_nama" class="form-control form-control mb-3" type="text"
                            placeholder="Nama">
                    </div>
                    <div class="form-group mt-5 d-flex justify-content-end">
                        <button type="button" onclick="onReset()" class="btn btn-light me-3"><i class="align-middle"
                                data-feather="rotate-ccw"> </i> Reset</button>
                        <button type="submit" class="btn btn-success"><i class="align-middle" data-feather="save"> </i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Tabel Role</div>
            </div>
            <div class="card-body">
                <div class="form-group d-flex justify-content-end mb-3">
                    <button type="button" onclick="initTable()" class="btn btn-light "><i class="align-middle fa fa-sync"></i> Refresh</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-row-bordered border align-middle rounded w-100"
                        id="table_role">
                        <thead class="text-center">
                            <tr class="fw-bolder">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal viewRole" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Role Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:onSaveRole(this)" method="post" id="form_list_role" name="form_list_role"
                    autocomplete="off">
                    <div class="check-role">
                       
                    </div>
                    <div id="test_tree"></div>
                    <div class="form-group mt-5 d-flex justify-content-end">
                        <button type="button" onclick="onResetCheck()" class="btn btn-light me-3"><i class="align-middle"
                                data-feather="rotate-ccw"> </i> Reset</button>
                        <button type="submit" class="btn btn-success"><i class="align-middle" data-feather="save"> </i>
                            Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('role::javascript')
