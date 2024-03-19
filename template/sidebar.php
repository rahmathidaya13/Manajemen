<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if (isset($data['foto'])) : ?>
                    <a title="Profile" href="../data-pegawai/profile.php?custom=<?php echo str_replace(' ', '+',$data['username']) ?>"><img style="border: 1px solid #fff;" src="<?php echo '../profile/' . $data['foto'] ?>" class="img-circle elevation-2" alt="User Image"></a>
                <?php else : ?>
                    <a title="Profile" href="../data-pegawai/profile.php?custom=<?php echo str_replace(' ', '+',$data['username']) ?>"><img src="../profile/noimage.jpg" class="img-circle elevation-2" alt="User Image"></a>
                <?php endif ?>
            </div>
            <div class="info">
                <a href="../data-pegawai/profile.php?custom=<?php echo str_replace(' ', '+',$data['username']) ?>" class="d-block"><?php echo ucwords($data['username']) ?></a>
                <?php if($data['level'] == 'admin'): ?>
                <span class="badge bg-success px-2"><?php echo ucwords($data['level']) ?></span>
                <?php else: ?>
                <span class="badge bg-primary px-2"><?php echo ucwords($data['level']) ?></span>
                <?php endif ?>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="../dashboard/home.php" class="nav-link <?php echo $active_home ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../data-pegawai/list_pegawai.php" class="nav-link <?php echo $active_pegawai ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Data Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <?php if($data['level'] == 'admin'): ?>
                    <a href="../data-absensi/list_absensi.php" class="nav-link <?php echo $active_absen ?>">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Data Absensi
                        </p>
                    </a>
                    <?php endif ?>
                </li>
                <li class="nav-item">
                    <a href="../data-jabatan/list.php" class="nav-link <?php echo $active_jabatan ?>">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            Data Jabatan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../cuti/list.php" class="nav-link <?php echo $active_cuti ?>">
                        <i class="nav-icon fas fa-pencil-alt"></i>
                        <p>
                            Data Cuti
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../level/role.php?level=<?php echo str_replace(' ', '+',$data['username']) ?>" class="nav-link <?php echo $active_role ?>">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Status Level
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a onclick="return confirm('Apakah yakin mau keluar ?')" href="../Auth/logout.php" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>