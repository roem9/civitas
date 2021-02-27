        <div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12">
                        <?= $this->session->flashdata('pesan');?>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12 col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info"><i class="fa fa-key mr-1"></i>Ganti Password</li>
                        <form action="<?= base_url()?>pengaturan/edit_password" method="post">
                            <li class="list-group-item">
                                <div class="form-group">
                                    <label for="pass1">Password</label>
                                    <input type="password" name="pass1" id="pass1" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="pass2">Konfirm Password</label>
                                    <input type="password" name="pass2" id="pass2" class="form-control form-control-sm" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <input type="submit" value="Ubah Password" id="btn-submit-pass" class="btn btn-sm btn-success">
                                </div>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#profil").addClass("active");
    $("#btn-simpan-profil").click(function(){
        var c = confirm('Yakin akan menyimpan data profil Anda?')
        return c;
    })

    $("#btn-submit-pass").click(function(){
        var c = confirm('Yakin akan mengubah password Anda?')
        return c;
    })
</script>

