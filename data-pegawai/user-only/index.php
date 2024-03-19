<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Pegawai</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard/home.php">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <?php if ($data['level'] == 'admin') : ?>
            <div class="card-header">
              <a class="btn btn-primary btn-sm" href="../data-pegawai/add_form.php">Tambah</a>
            </div>
          <?php endif ?>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>foto</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Tanggal Lahir</th>
                  <th>Alamat</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $data_pegawai = mysqli_query($conn, "SELECT * FROM pegawai");
                foreach ($data_pegawai as $rows) :
                ?>
                  <tr>
                    <td class="align-middle"><?php echo $no++ ?></td>
                    <td class="align-middle"><img src="<?php echo '../gambar/' . $rows['foto'] ?>" width="50" alt="<?php echo $rows['foto'] ?>"></td>
                    <td class="align-middle"><?php echo $rows['nama'] ?></td>
                    <td class="align-middle"><?php echo $rows['jenis_kelamin'] ?></td>
                    <td class="align-middle"><?php echo $rows['tgl_lahir'] ?></td>
                    <td class="align-middle"><?php echo $rows['alamat'] ?></td>
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