<?php
$GLOBALS['title'] = 'Home';
$GLOBALS['active_home'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/koneksi.php';
include '../config/function.php';
$count = count_all($conn, 'jumlah', 'pegawai');
$row = mysqli_fetch_assoc($count);
?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
        <div class="row py-2">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $row['jumlah'] ?></h3>
                <p>Employee</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <div class="row">
                <div class="col">
                    <div class="p-5 mb-4 bg-dark rounded-5">
                        <div class="container-fluid py-5">
                            <h1 class="display-5 fw-bold">Hai, <?php echo ucwords($data['username']) ?></h1>
                            <h1 class="display-5 fw-bold">Selamat Datang Di Aplikasi Manajemen Pegawai</h1>
                            <p class="fs-4">
                                ini adalah aplikasi manajemen pegawai yang dibuat dengan PHP dan MYSQL sebagai databasenya
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include '../template/footer.php' ?>