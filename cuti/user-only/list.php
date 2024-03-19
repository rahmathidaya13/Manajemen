<?php
$GLOBALS['title'] = 'Data Cuti';
$GLOBALS['active_cuti'] = 'active';
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Cuti</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
                            <li class="breadcrumb-item active">Data Cuti</li>
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
                            <strong><?php echo $_SESSION["alert"] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION["alert"]); ?>
                    <?php endif; ?>

                    <div class="card">
                            <div class="card-header">
                                <a class="btn btn-primary btn-sm" href="../cuti/add-form.php">Buat Pengajuan Cuti</a>
                            </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped table-responsive-md">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pegawai</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Jenis Cuti</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data_absen = joinTb_not_where($conn, 'cuti','*', 'pegawai','nama', 'INNER JOIN', 'id_pegawai','id_pegawai');
                                    foreach ($data_absen as $rows) :
                                    ?>
                                        <tr>
                                            <td class="align-middle"><?php echo $no++ ?></td>
                                            <td class="align-middle"><?php echo $rows['nama'] ?></td>
                                            <td class="align-middle"><?php echo $rows['tgl_pengajuan'] ?></td>
                                            <td class="align-middle"><?php echo $rows['tgl_mulai'] ?></td>
                                            <td class="align-middle"><?php echo $rows['tgl_selesai'] ?></td>
                                            <td class="align-middle"><?php echo $rows['jenis_cuti'] ?></td>
                                            <td class="align-middle"><?php echo $rows['keterangan'] ?></td>
                                            <td class="align-middle">
                                                <?php if($rows['status'] == 'diproses') : ?>
                                                <span class="badge badge-primary py-2">Diproses</span>
                                                <?php elseif($rows['status'] == 'disetujui') : ?>
                                                <span class="badge badge-success py-2">Disetujui</span>
                                                <?php elseif($rows['status'] == 'ditolak') : ?>
                                                <span class="badge badge-danger py-2">Ditolak</span>
                                                <?php else: ?>
                                                <span class="badge badge-secondary py-2">not found</span>
                                                <?php endif ?>
                                            </td>
                                            <td class="align-middle d-flex justify-content-center">
                                                <a class="btn btn-warning btn-sm mr-2" href="edit-form.php?modify=<?php echo $rows['id_cuti'] ?>"><i class="fas fa-edit"></i> </a>
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
