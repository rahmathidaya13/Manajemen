<?php
$GLOBALS['title'] = 'Data Absensi';
$GLOBALS['active_jabatan'] = 'active';
// fetch data dari tabel user
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/koneksi.php';
include '../config/function.php';
?>
<?php if ($data['level'] == 'admin') : ?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Jabatan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Jabatan</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">

                    <?php if (!empty($_SESSION["alert"])) : ?>
                        <div class="alert alert-<?php echo $_SESSION["type"] ?> alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION["alert"] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION["alert"]); ?>
                    <?php endif; ?>

                    <div class="card">
                        <?php if ($data['level'] == 'admin') : ?>
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm" href="../data-jabatan/add-form.php">Tambah</a>
                            </div>
                        <?php endif ?>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive-md table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Jabatan</th>
                                        <?php if ($data['level'] == 'admin') : ?>
                                            <th class="text-center">Aksi</th>
                                        <?php endif ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data_jabatan = select_all($conn, 'jabatan');
                                    foreach ($data_jabatan as $rows) :
                                    ?>
                                        <tr>
                                            <td class="align-middle"><?php echo $rows['nama_jabatan'] ?></td>
                                            <td class="align-middle d-flex justify-content-center">
                                                <a class="btn btn-warning btn-sm mr-2" href="edit-form.php?modify=<?php echo $rows['id_jabatan'] ?>"><i class="fas fa-edit"></i> Edit</a>
                                                <a class="btn btn-danger btn-sm mr-2" onclick="return confirm('Apakah yakin data ini dihapus?')" href="delete.php?delete=<?php echo $rows['id_jabatan'] ?>"> <i class="fas fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php elseif ($data['level'] == 'user') : ?>
    <!-- <?php include 'user-only/index.php' ?> -->
<?php endif; ?>
<?php include '../template/footer.php' ?>