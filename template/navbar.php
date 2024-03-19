 <?php 
//  ambil nama pegawai berdasarkan pengajuan cuti
$user = mysqli_query($conn, "SELECT cuti.*, pegawai.nama FROM cuti INNER JOIN pegawai ON cuti.id_pegawai = pegawai.id_pegawai WHERE status = 'diproses' ORDER BY id_cuti DESC LIMIT 5");
// hitung pegawai yang mengajukan cuti
$count = mysqli_query($conn, "SELECT COUNT('status') AS jumlah FROM cuti WHERE status = 'diproses'");
if(mysqli_num_rows($count) > 0){
  $row = mysqli_fetch_assoc($count);
  $jumlah = $row['jumlah'];
  // $alert = 'Pengajuan cuti belum diproses';
}
 ?>
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
   <!-- Left navbar links -->
   <ul class="navbar-nav">
     <li class="nav-item">
       <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
     </li>
   </ul>

   <!-- Right navbar links -->
   <ul class="navbar-nav ml-auto">
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge " <?php echo ( $jumlah == 0 ) ? 'hidden' : $jumlah ?>><?php echo $jumlah ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <?php foreach($user as $list) :  ?>
          <a href="../cuti/permintaan.php?req=<?php echo $list['id_pegawai'] ?>" class="dropdown-item">
            <i class="fab fa-wpforms mr-2"></i> 
            <?php echo $list['nama']. ' Mengajukan Cuti' ?>
            <span class="float-right text-muted text-sm"><?php echo date('d-m-Y H:s', strtotime($list['created_at'])) ?></span>
          </a>
          <?php endforeach ?>
          <?php if(isset($list) == true) : ?>
            <span class="dropdown-item text-center"><a href="../cuti/implicit.php">Lihat Semua</a></span>
            <?php else: ?>
            <span class="dropdown-item text-center">Tidak ada notifikasi</span>
          <?php endif ?>
        </div>
      </li>
      
     <div class="dropdown">
       <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
       <?php echo ucwords($data['username']) ?>
        </a>
       <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
         <a class="dropdown-item" href="#">Profile</a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" onclick="return confirm('Apakah yakin mau keluar ?')" href="../Auth/logout.php">Logout</a>
       </div>
     </div>
   </ul>
 </nav>

 <!-- /.navbar -->