<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Absensi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
            <li class="breadcrumb-item active">Data Absensi</li>
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
          <?php if ($data['level'] == 'admin') : ?>
            <div class="card-header">
              <a class="btn btn-primary btn-sm" href="../data-absensi/add-form.php">Tambah</a>
            </div>
          <?php endif ?>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Pegawai</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <th>Keterangan</th>
                  <?php if ($data['level'] == 'admin') : ?>
                    <th>Aksi</th>
                  <?php endif ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $data_absen = mysqli_query($conn, "SELECT absensi.*, pegawai.* FROM absensi INNER JOIN pegawai ON absensi.id_pegawai = pegawai.id_pegawai");
                foreach ($data_absen as $rows) :
                ?>
                  <tr>
                    <td class="align-middle"><?php echo $no++ ?></td>
                    <td class="align-middle"><?php echo $rows['nama'] ?></td>
                    <td class="align-middle"><?php echo $rows['tanggal'] ?></td>
                    <td class="align-middle"><?php echo $rows['jam_masuk'] ?></td>
                    <td class="align-middle"><?php echo $rows['jam_keluar'] ?></td>
                    <td class="align-middle"><?php echo $rows['keterangan'] ?></td>
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