<div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12">
                        <?= $this->session->flashdata('pesan');?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12 mb-3">    
                    <a href="<?= base_url()?>pengaturan/profil" class="btn btn-md btn-success btn-block"><i class="fa fa-user-cog mr-1"></i>Pengaturan Profil</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="<?= base_url()?>pengaturan/foto" class="btn btn-md btn-success btn-block"><i class="fa fa-image mr-1"></i>Upload Foto</a>
                </div>
                <div class="col-12 mb-3">
                    <a href="<?= base_url()?>pengaturan/password" class="btn btn-md btn-success btn-block"><i class="fa fa-key mr-1"></i>Pengaturan Password</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#profil").addClass("active");

    setInputFilter(document.getElementById("no_hp"), function(value) {
        return /^[0-9]*$/i.test(value);
    });
</script>

