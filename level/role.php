<?php
$GLOBALS['title'] = 'Level';
$GLOBALS['active_role'] = 'active';
// fetch data dari tabel user
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
if(isset($_GET['level'])){
    $get_level = htmlspecialchars($_GET['level']);
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$get_level'");
    $result = mysqli_fetch_assoc($query);
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex justify-content-center">
                <div class="col-md-5">

                <!-- alert -->
                <?php if (!empty($_SESSION["alert"])) : ?>
                        <div class="alert alert-<?php echo $_SESSION["type"] ?> alert-dismissible fade show" role="alert">
                            <strong><?php echo $_SESSION["alert"] ?> <?php echo ucwords($result['level']) ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION["alert"]) ?>
                    <?php endif; ?>

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Status Level</h3>
                        </div>
                        <div class="card-body">
                            <form action="update_level.php?level=<?php echo $result['username'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo $result['id'] ?>" >
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" readonly value="<?php echo $result['username'] ?>" name="username" id="username" class="form-control  my-colorpicker1">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" readonly value="<?php echo $result['email'] ?>" name="email" id="email" class="form-control  my-colorpicker1">
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <select class="form-control" name="level" id="level">
                                    <option style="font-weight: bold;" value="<?php echo $result['level'] ?>"><?php echo ucwords($result['level']) ?></option>
                                    <option value="admin">Admin</option>
                                    <option value="hrd">HRD</option>
                                    <option value="pegawai">Pegawai</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                   <button type="submit" class="btn w-100 btn-primary" >Ubah</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include '../template/footer.php' ?>
