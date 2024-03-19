<?php
$GLOBALS['title'] = 'Form Jabatan';
$GLOBALS['active_jabatan'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
include '../config/koneksi.php';
include '../config/function.php';
if(isset($_GET['modify'])){
    $get = safeInput($conn, $_GET['modify']);
    $data_jabatan = select_where($conn, ['*'], 'jabatan', 'id_jabatan', $get);
    $data = mysqli_fetch_array($data_jabatan);
}
// function update
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $id = safeInput($conn, $_POST['id']);
    $jabatan = safeInput($conn, $_POST['jabatan']);
    $data = ['nama_jabatan'=>$jabatan];
    $update = update_db($conn, 'jabatan', $data, 'id_jabatan', $id);
    if($update > 0){
        $_SESSION['type'] = 'success';
        $_SESSION['alert'] = 'Data berhasil diupdate';
        header("Location:list.php");
        exit();
    }else{
        $_SESSION['type'] = 'danger';
        $_SESSION['alert'] = 'Data gagal diupdate';
        header("Location:edit-form.php");
        exit();
    }
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col">
                <?php if (!empty($_SESSION["alert"])) : ?>
                        <div class="alert alert-<?php echo $_SESSION["type"] ?> alert-dismissible fade show" role="alert">
                            <strong><?php echo $_SESSION["alert"] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION["alert"]); ?>
                    <?php endif; ?>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Jabatan</h3>
                        </div>
                        <div class="card-body">
                            <form action="edit-form.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $data['id_jabatan'] ?>">
                                <div class="form-group col-md-5">
                                    <label>Nama Jabatan</label>
                                    <input class="form-control" value="<?php echo $data['nama_jabatan'] ?>" type="text" name="jabatan" id="jabatan">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary px-3">Ubah</button>
                                    <button type="reset" class="btn btn-danger px-3">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include '../template/footer.php' ?>