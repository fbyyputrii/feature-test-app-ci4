<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h4 class="mb-4"><i class="fa fa-money-bill-wave"></i> Hitung Tunjangan Transport</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="/tunjangan/store">

            <div class="row">

                <!-- PEGAWAI -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Pilih Pegawai</label>
                    <select name="pegawai_id" class="form-select">
                        <option value="">-- Pilih Pegawai --</option>
                        <?php foreach($pegawai as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= old('pegawai_id') == $p['id'] ? 'selected' : '' ?>>
                                <?= $p['nama'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- KM -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jarak per Hari (KM)</label>
                    <input type="number" name="km" value="<?= old('km') ?>" 
                           class="form-control" placeholder="Contoh: 10">
                </div>

                <!-- HARI KERJA -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Jumlah Hari Kerja</label>
                    <input type="number" name="hari_kerja" value="<?= old('hari_kerja') ?>" 
                           class="form-control" placeholder="Contoh: 22">
                </div>

            </div>

        
            <div class="d-flex justify-content-between">
                <a href="/tunjangan" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="fa fa-calculator"></i> Hitung
                </button>
            </div>

        </form>

    </div>
</div>

<?php if(session()->getFlashdata('errors')): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Validasi Gagal',
        html: `<?php foreach(session()->getFlashdata('errors') as $error): ?>
                    <div><?= $error ?></div>
               <?php endforeach; ?>`
    });
</script>
<?php endif; ?>

<?= $this->endSection() ?>