<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-user-edit"></i> Edit Pegawai</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="/pegawai/update/<?= $pegawai['id'] ?>">

            <div class="row">

                <!-- NAMA -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" value="<?= $pegawai['nama'] ?>" class="form-control">
                </div>

                <!-- EMAIL -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="<?= $pegawai['email'] ?>" class="form-control">
                </div>

                <!-- PHONE -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">No HP</label>
                    <input type="text" name="phone" value="<?= $pegawai['phone'] ?>" class="form-control">
                </div>

                <!-- JABATAN -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jabatan</label>
                    <select name="jabatan" class="form-select">
                        <option value="">-- Pilih Jabatan --</option>
                        <option value="Manager" <?= $pegawai['jabatan'] == 'Manager' ? 'selected' : '' ?>>Manager</option>
                        <option value="Staff" <?= $pegawai['jabatan'] == 'Staff' ? 'selected' : '' ?>>Staff</option>
                        <option value="Magang" <?= $pegawai['jabatan'] == 'Magang' ? 'selected' : '' ?>>Magang</option>
                    </select>
                </div>

                <!-- DEPARTEMEN -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Departemen</label>
                    <select name="departemen" class="form-select">
                        <option value="">-- Pilih Departemen --</option>
                        <option value="HRD" <?= $pegawai['departemen'] == 'HRD' ? 'selected' : '' ?>>HRD</option>
                        <option value="Marketing" <?= $pegawai['departemen'] == 'Marketing' ? 'selected' : '' ?>>Marketing</option>
                    </select>
                </div>

                <!-- STATUS -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Karyawan</label>
                    <select name="status_karyawan" class="form-select">
                        <option value="tetap" <?= $pegawai['status_karyawan'] == 'tetap' ? 'selected' : '' ?>>Tetap</option>
                        <option value="kontrak" <?= $pegawai['status_karyawan'] == 'kontrak' ? 'selected' : '' ?>>Kontrak</option>
                        <option value="magang" <?= $pegawai['status_karyawan'] == 'magang' ? 'selected' : '' ?>>Magang</option>
                    </select>
                </div>

                <!-- TANGGAL LAHIR -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="<?= $pegawai['tanggal_lahir'] ?>" class="form-control">
                </div>

                <!-- TANGGAL MASUK -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" value="<?= $pegawai['tanggal_masuk'] ?>" class="form-control">
                </div>

                <!-- ALAMAT -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"><?= $pegawai['alamat'] ?></textarea>
                </div>

            </div>

            <!-- BUTTON -->
            <div class="d-flex justify-content-between">
                <a href="/pegawai" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update
                </button>
            </div>

        </form>

    </div>
</div>

<!-- ERROR -->
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