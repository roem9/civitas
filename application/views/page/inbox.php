        <div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $this->session->flashdata('pesan');?>
                        </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php if(COUNT($inbox) != 0):?>
                    <?php foreach ($inbox as $inbox) :?>
                        <div class="col-12 mb-2">
                            <ul class="list-group">
                                <li class="list-group-item active d-flex justify-content-between"><?= $inbox['judul']?> <span><a href="<?= base_url()?>inbox/delete_inbox/<?= $inbox['id_inbox']?>" onclick="return confirm('Anda yakin akan menghapus pesan ini?')" class="text-light"><i class="fa fa-trash-alt"></i></a></span></li>
                                <li class="list-group-item"><?= $inbox['inbox']?></li>
                            </ul>
                        </div>
                    <?php endforeach;?>
                <?php else :?>
                    <div class="col-12 col-md-6">
                        <div class="alert alert-warning" role="alert">
                        <i class="fa fa-info-circle mr-1 text-warning"></i> Inbox kosong
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#inbox").addClass("active");
</script>

