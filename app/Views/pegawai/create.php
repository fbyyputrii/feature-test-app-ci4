<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-user-plus"></i> Tambah Pegawai</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="/pegawai/store">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="<?= old('nama') ?>" class="form-control" placeholder="Masukkan nama">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= old('email') ?>" class="form-control" placeholder="Masukkan email">
                </div>

              
                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="phone" value="<?= old('phone') ?>" class="form-control" placeholder="Masukkan nomor HP">
                </div>

               
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jabatan</label>
                    <select name="jabatan" class="form-select">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="Manager" <?= old('jabatan') == 'Manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="Staff" <?= old('jabatan') == 'Staff' ? 'selected' : '' ?>>Staff</option>
                        <option value="Magang" <?= old('jabatan') == 'Magang' ? 'selected' : '' ?>>Magang</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="departemen" class="form-select">
                        <option value="">-- Pilih Departemen --</option>
                        <option value="HRD" <?= old('departemen') == 'HRD' ? 'selected' : '' ?>>HRD</option>
                        <option value="Marketing" <?= old('departemen') == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                        <option value="Executive" <?= old('departemen') == 'Executive' ? 'selected' : '' ?>>Executive</option>
                        <option value="Production" <?= old('departemen') == 'Production' ? 'selected' : '' ?>>Production</option>
                        <option value="Commissioner" <?= old('departemen') == 'Commissioner' ? 'selected' : '' ?>>Commissioner</option>
                    </select>
                </div>

    
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Karyawan</label>
                    <select name="status_karyawan" class="form-select">
                        <option value="">-- Pilih Status --</option>
                        <option value="tetap" <?= old('status_karyawan') == 'tetap' ? 'selected' : '' ?>> Tetap</option>
                        <option value="kontrak" <?= old('status_karyawan') == 'kontrak' ? 'selected' : '' ?>> Kontrak</option>
                        <option value="magang" <?= old('status_karyawan') == 'magang' ? 'selected' : '' ?>> Magang</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="<?= old('tanggal_lahir') ?>" class="form-control">
                </div>

               
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="<?= old('tanggal_masuk') ?>" class="form-control">
                </div>

             
                <div class="col-md-12 mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat"><?= old('alamat') ?></textarea>
                </div>

            </div>

            <div class="d-flex justify-content-between">
                <a href="/pegawai" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `<?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <div><?= $error ?></div>
               <?php endforeach; ?>`
        });
    </script>
<?php endif; ?>

<?= $this->endSection() ?>