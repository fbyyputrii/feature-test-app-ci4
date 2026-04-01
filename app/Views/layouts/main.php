<!DOCTYPE html>
<html>

<head>
    <title>HR System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f5f6fa;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #1e272e;
        }

        .sidebar a {
            color: #d2dae2;
            padding: 10px;
            display: block;
            border-radius: 6px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #485460;
            color: white;
        }

        .active-menu {
            background: #0d6efd;
            color: white !important;
        }

        .topbar {
            background: white;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        .card {
            border-radius: 12px;
        }
    </style>
</head>

<body>

    <div class="d-flex">
        <!-- SIDEBAR -->
        <div class="sidebar p-3">

            <h4 class="text-white"><i class="fa fa-building"></i> HR System</h4>
            <hr class="text-secondary">

            <a href="/dashboard"><i class="fa fa-chart-line"></i> Dashboard</a>

            <a href="/pegawai"><i class="fa fa-users"></i> Pegawai</a>

            <a href="/tunjangan"><i class="fa fa-money-bill"></i> Tunjangan</a>

            <a href="/setting" class="text-white d-block mb-2"><i class="fa fa-cogs"></i> Setting Tunjangan</a>

            <a href="/logs"><i class="fa fa-file-alt"></i> Logs</a>

            <hr class="text-secondary">
            <small class="text-secondary">Management</small>

            <a href="/users"><i class="fa fa-user"></i> User</a>
            <a href="/roles"><i class="fa fa-user-shield"></i> Role</a>

            <hr class="text-secondary">

            <a href="/logout" class="text-danger">
                <i class="fa fa-sign-out-alt"></i> Logout
            </a>

        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-grow-1">

            <div class="topbar d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Dashboard</h5>

                <div>
                    <strong><?= session()->get('username') ?></strong><br>
                    <small><?= session()->get('role') ?></small>
                </div>
            </div>


            <div class="p-4">

                <?php if (session()->getFlashdata('success')): ?>
                    <script>
                        Swal.fire('Success', '<?= session()->getFlashdata('success') ?>', 'success');
                    </script>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <script>
                        Swal.fire('Error', '<?= session()->getFlashdata('error') ?>', 'error');
                    </script>
                <?php endif; ?>

                <div class="card p-3 shadow-sm">
                    <?= $this->renderSection('content') ?>
                </div>

            </div>

        </div>

    </div>

</body>

</html>