<?php
$GLOBALS['title'] = 'Form Jabatan';
$GLOBALS['active_jabatan'] = 'active';
include '../fetch_data/index.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../template/navbar.php';
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
                            <h3 class="card-title">Form Input Jabatan</h3>
                        </div>
                        <div class="card-body">
                            <form action="store.php" method="post" enctype="multipart/form-data">
                                <div class="form-group col-md-5">
                                    <label>Nama Jabatan</label>
                                    <input class="form-control" type="text" name="jabatan" id="jabatan">
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-primary px-3">Simpan</button>
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