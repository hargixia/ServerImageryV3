<div class="container-fluid py-3">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-12 col-md-2 mb-3">
            <aside class="sticky-top">
                @include('components.navbar')
            </aside>
        </div>

        <!-- Main Content -->
        <main class="col-12 col-md-10">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">

                    <form wire:submit.prevent="updateFoto" class="text-center mb-4">
                        <div class="position-relative d-inline-block">

                            <img
                                src="{{ asset('images/profile.png') }}"
                                id="previewFoto"
                                class="rounded-circle shadow"
                                width="150" height="150">

                            <label
                                class="btn btn-sm rounded-circle position-absolute bottom-0 end-0 d-flex align-items-center justify-content-center"
                                style="width: 40px; height: 40px; background:white; border:1px solid #ddd;">

                                <i class="bi bi-camera fs-6 text-dark"></i>
                                <input type="file" class="foto-edit" id="fotoInput" wire:model="new_foto" accept="image/*" hidden>
                            </label>
                        </div>

                        <div class="mt-3 d-none" id="btnSaveFotoWrapper">
                            <button type="submit" class="btn btn-success btn-sm">
                                Simpan Foto
                            </button>
                        </div>
                    </form>


                    <form wire:submit.prevent="updateProfil">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control input-info" wire:model.defer="nama" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Tanggal Lahir</label>
                                <input type="date" class="form-control input-info" wire:model.defer="tanggal_lahir" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                <select class="form-select input-info" wire:model.defer="jenis_kelamin" disabled>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-4 text-end">
                            <button type="button" class="btn btn-primary me-2" id="btnEditInfo">Edit Profil</button>
                            <button type="button" class="btn btn-secondary me-2 d-none" id="btnCancelInfo">Batal</button>
                            <button type="submit" class="btn btn-success d-none" id="btnSaveInfo" >Simpan Perubahan</button>
                        </div>
                    </form>

                    <form wire:submit.prevent="updatePassword" class="mt-4">
                        <h5 class="fw-semibold">Ganti Password</h5>

                        <label>Password Lama</label>
                        <input type="password" class="form-control mb-2 password-field" wire:model.defer="password_lama" disabled>

                        <label>Password Baru</label>
                        <input type="password" class="form-control mb-2 password-field" wire:model.defer="password_baru" disabled>

                        <label>Konfirmasi Password</label>
                        <input type="password" class="form-control mb-2 password-field" wire:model.defer="password_konfirmasi" disabled>

                        <button type="button" id="btnEditPassword" class="btn btn-warning btn-sm mt-2">Edit Password</button>
                        <button type="button" id="btnCancelPassword" class="btn btn-secondary btn-sm mt-2 d-none">Batal</button>
                        <button type="submit" id="btnSavePassword" class="btn btn-success btn-sm mt-2 d-none">Simpan Password</button>
                    </form>

                    <script>
                        document.addEventListener("DOMContentLoaded", () => {

                            // ========== FUNGSI GLOBAL =============
                            const toggleState = (inputs, editBtn, cancelBtn, saveBtn, enable) => {
                                inputs.forEach(i => i.disabled = !enable);
                                editBtn.classList.toggle("d-none", enable);
                                cancelBtn.classList.toggle("d-none", !enable);
                                saveBtn.classList.toggle("d-none", !enable);
                            };


                            // ========== 1. INFORMASI PROFIL ==========
                            const infoInputs = document.querySelectorAll(".input-info");
                            toggleState(infoInputs, btnEditInfo, btnCancelInfo, btnSaveInfo, false);

                            btnEditInfo.onclick = () => toggleState(infoInputs, btnEditInfo, btnCancelInfo, btnSaveInfo, true);
                            btnCancelInfo.onclick = () => toggleState(infoInputs, btnEditInfo, btnCancelInfo, btnSaveInfo, false);


                            // ========== 2. PASSWORD ==========
                            const passInputs = document.querySelectorAll(".password-field");
                            toggleState(passInputs, btnEditPassword, btnCancelPassword, btnSavePassword, false);

                            btnEditPassword.onclick = () => toggleState(passInputs, btnEditPassword, btnCancelPassword, btnSavePassword, true);
                            btnCancelPassword.onclick = () => toggleState(passInputs, btnEditPassword, btnCancelPassword, btnSavePassword, false);


                            // ========== 3. FOTO PROFIL ==========
                            const fotoInput = document.querySelector(".foto-edit");

                            toggleState([fotoInput], btnEditFoto, btnCancelFoto, btnSaveFoto, false);

                            btnEditFoto.onclick = () => toggleState([fotoInput], btnEditFoto, btnCancelFoto, btnSaveFoto, true);
                            btnCancelFoto.onclick = () => toggleState([fotoInput], btnEditFoto, btnCancelFoto, btnSaveFoto, false);


                            // ------- Preview Foto -------
                            fotoInput.addEventListener("change", function() {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById("previewFoto").src = e.target.result;
                                }
                                reader.readAsDataURL(this.files[0]);
                            });

                        });
                    </script>

                </div>
            </div>
        </main>

    </div>
</div>
