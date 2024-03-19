<?php
$GLOBALS['title'] = 'Profile';
include '../config/koneksi.php';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
if (isset($_GET['custom'])) {
    $get_profile = htmlspecialchars($_GET['custom']);
    $query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$get_profile'");
    $rows = mysqli_fetch_assoc($query);
}
?>
<div class="content-wrapper py-3">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">

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
                            <h3 class="card-title">Update Photo</h3>
                        </div>
                        <div class="card-body">
                            <form action="update_profile.php?custom=<?php echo $rows['username'] ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $rows['id'] ?>">
                                <div class="form-group">
                                    <?php if (isset($rows['foto'])) : ?>
                                        <img class="py-2" src="<?php echo '../profile/' . $rows['foto'] ?>" alt="<?php echo $rows['foto'] ?>" width="80">
                                    <?php else : ?>
                                        <img class="py-2" src="../profile/noimage.jpg" alt="no image" width="80">
                                    <?php endif ?>
                                    <input type="file" name="foto" id="foto" accept="image/*" class="form-control my-colorpicker1">
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="submit" disabled name="submit" class="btn btn-secondary px-3">Update</button>
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
    let inputfile =document.getElementById("foto");
    let buttonupdate =document.getElementById("submit");
    inputfile.addEventListener("change", ()=>{
        buttonupdate.classList.remove("btn-secondary");
        buttonupdate.classList.add("btn-primary");
        buttonupdate.disabled = !inputfile.files.length > 0;
    });
</script>
<?php include '../template/footer.php' ?>