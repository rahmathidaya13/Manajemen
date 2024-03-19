<?php
$GLOBALS['title'] = 'Data Pegawai';
$GLOBALS['active_pegawai'] = 'active';
// fetch data dari tabel user
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/function.php';
?>

<?php if ($data['level'] == 'admin') : ?>
  <style>
    .chk{
    position: relative;
    margin-top: 0rem;
    margin-left: 1.5rem;
    }
</style>
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
              <a class="btn btn-primary btn-sm" href="../data-pegawai/add_form.php">Tambah</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-responsive-sm">
                <thead>
                  <tr>
                    <th>Tandai</th>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Tanggal Bergabung</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $user_id = $data['id'];
                  $no = 1;
                  //  mysqli_query($conn, "SELECT pegawai.*, user.level FROM pegawai INNER JOIN user ON pegawai.user_id = user.id WHERE pegawai.user_id = '$user_id'");
                  $data_pegawai = join_table($conn, 'pegawai', '*', 'user', 'level', 'INNER JOIN', 'user_id', 'id', 'user_id', $user_id);
                  foreach ($data_pegawai as $rows) :
                  ?>
                    <tr>
                      <td class="align-middle">
                        <input class="form-check-input chk" type="checkbox" name="tandai">
                      </td>
                      <td class="align-middle"><?php echo $no++ ?></td>
                      <td class="align-middle"><img src="<?php echo '../gambar/' . $rows['foto'] ?>" width="50" height="50" alt="<?php echo $rows['foto'] ?>"></td>
                      <td class="align-middle"><?php echo $rows['nama'] ?></td>
                      <td class="align-middle"><?php echo $rows['jenis_kelamin'] ?></td>
                      <td class="align-middle"><?php echo $rows['tgl_lahir'] ?></td>
                      <td class="align-middle"><?php echo $rows['jabatan'] ?></td>
                      <td class="align-middle"><?php echo $rows['alamat'] ?></td>
                      <td class="align-middle"><?php echo date('d-m-Y', strtotime($rows['tgl_gabung'])) ?></td>
                      <td class="align-middle d-flex justify-content-center" >
                        <a class="btn btn-warning btn-sm mr-1" href="edit-form.php?modify=<?php echo $rows['id_pegawai'] ?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm mr-1" onclick="return confirm('Apakah yakin data ini dihapus?')" href="delete.php?delete=<?php echo $rows['id_pegawai'] ?>"> <i class="fas fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
                <!-- <tfoot>
                <th colspan="13"><a class="btn btn-sm btn-danger disabled" href="">Delete</a></th>
                </tfoot> -->
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
<?php elseif ($data['level'] == 'user') : ?>
  <!-- ketika level adalah user, user hanya bisa melihat data saja tidak bisa untuk tambah,ubah, dan hapus -->
  <?php include 'user-only/index.php' ?>
<?php endif; ?>
<?php include '../template/footer.php' ?>