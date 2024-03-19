<?php
$GLOBALS['title'] = 'Form Pegawai';
$GLOBALS['active_pegawai'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/function.php';
$jabatan = select_all($conn, 'jabatan');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Pegawai</h3>
                        </div>
                        <div class="card-body">
                            <form action="store.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $data['id'] ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" name="nama" id="nama" class="form-control  my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Kelamin</label>
                                            <select class="form-control" name="jk" id="jk">
                                                <option style="font-weight: bold;" value="0" selected="selected">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" name="tgl" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No Handphone</label>
                                            <input type="number" name="nohp" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jabatan</label>
                                            <select class="form-control" name="jabatan" id="jabatan">
                                                <option style="font-weight: bold;" value="0">Pilih Jabatan</option>
                                                <?php foreach($jabatan as $row): ?>
                                                <option value="<?php echo $row['nama_jabatan'] ?>"><?php echo $row['nama_jabatan'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Gaji</label>
                                            <input type="number" name="gaji" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Bergabung</label>
                                            <input type="date" name="tgl_gabung" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <img style="border: 1px solid #000;" id="show_img" src="../gambar/noimage/noimage.jpg" class="img-fluid mb-2" width="70" height="70" alt="">
                                            <input type="file" name="photo" id="photo" accept="image/*" class="form-control my-colorpicker1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="submit" name="submit" onclick="validasi()" class="btn btn-primary px-3">Simpan</button>
                                            <button type="reset" class="btn btn-danger px-3">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    let img =document.getElementById('show_img');
    let input =document.getElementById('photo');
    input.addEventListener('change', (event)=>{
        let previewImg = event.target.files[0];
        img.src =URL.createObjectURL(previewImg);
    });
</script>
<?php include '../template/footer.php' ?>