<div class="modal viewForm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Tenaga Ahli</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:onSave(this)" method="post" id="form_user" name="form_user"
                    autocomplete="off">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group col-12 row mb-2">
                        <label class="form-label col-12" for="user_photo">Photo</label>
                        <div class="row">

                            <div class="picture-container  col-2">
                                <div class="picture">
                                    <img src="" class="picture-src" id="user_photoPreview" title="">
                                    <input type="file" id="user_photo" name="user_photo">
                                </div>

                            </div>
                            <i class="col-10 remove-img d-flex justify-content-start fa fa-times text-danger fa-2x"
                                onclick="removePP(this)"></i>
                        </div>
                    </div>
                    <div class="form-label">
                        <label class="mb-2 required" for="user_nama">Nama</label>
                        <input id="user_nama" required name="user_nama" class="form-control mb-3" type="text"
                            placeholder="Nama">
                    </div>
                    <div class="form-label">
                        <label class="mb-2 required" for="user_username">Username</label>
                        <input id="user_username" required name="user_username" class="form-control mb-3" type="text"
                            placeholder="Username">
                    </div>
                    <div class="form-label">
                        <label class="mb-2 required" for="user_email">Email</label>
                        <input id="user_email" required name="user_email" class="form-control mb-3" type="email"
                            placeholder="Email">
                    </div>
                    <div class="form-label">
                        <label class="mb-2 required" for="user_password">Password</label>
                        <input id="user_password" name="user_password" class="form-control mb-3" type="password"
                            placeholder="Password">
                    </div>
                    <div class="form-label ">
                        <label class="mb-2 col-12" for="user_role">Role</label>
                        <select id="user_role" name="user_role" class="w-100" style="width: 100%">
                            <option value="">- Pilih -</option>
                        </select>
                    </div>
                    <label class="form-check mt-2">
                        <input id="user_active" name="user_active" class="form-check-input" type="checkbox"
                            value="1">
                        <span class="form-check-label">
                            Active
                        </span>
                    </label>
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
</div>
