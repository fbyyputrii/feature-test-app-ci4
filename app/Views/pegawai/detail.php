<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-user"></i> Detail Pegawai</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">
                <strong>Nama:</strong><br>
                <?= $pegawai['nama'] ?>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Email:</strong><br>
                <?= $pegawai['email'] ?>
            </div>

            <div class="col-md-6 mb-3">
                <strong>No HP:</strong><br>
                <?= $pegawai['phone'] ?>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Jabatan:</strong><br>
                <?= $pegawai['jabatan'] ?>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Departemen:</strong><br>
                <?= $pegawai['departemen'] ?>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Status:</strong><br>
                <span class="badge bg-primary">
                    <?= ucfirst($pegawai['status_karyawan']) ?>
                </span>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Tanggal Lahir:</strong><br>
                <?= date('d M Y', strtotime($pegawai['tanggal_lahir'])) ?>
            </div>

            <div class="col-md-6 mb-3">
                <strong>Tanggal Masuk:</strong><br>
                <?= date('d M Y', strtotime($pegawai['tanggal_masuk'])) ?>
            </div>

            <div class="col-md-12 mb-3">
                <strong>Alamat:</strong><br>
                <?= $pegawai['alamat'] ?>
            </div>

        </div>

        <a href="/pegawai" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Kembali
        </a>

    </div>
</div>

<?= $this->endSection() ?>