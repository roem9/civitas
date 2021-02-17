        <div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12">
                        <?= $this->session->flashdata('pesan');?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php if($kpq['foto'] != "") :?>
                    <div class="col-12 mb-3">
                        <img src="<?= base_url()?>assets/img/foto/<?= $kpq['foto']?>" class='img-rounded img-fluid'>
                    </div>
                <?php endif;?>
                <div class="col-12 col-md-6">
                <form action ="<?= base_url()?>pengaturan/edit_foto" method="post" enctype="multipart/form-data">
                    <label for="file"> Upload atau ganti foto Anda disini </label>
                    <div class="form-group">
                        <input type="file" name="gambar" id="gambar" required>
                    </div>
                    <div class="form-group d-flex justify-content-end">
                        <input type="submit" value="Upload" class="btn btn-md btn-primary">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#foto").addClass("active");
</script>

