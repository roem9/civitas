<!-- Modal -->
        <div class="modal fade" id="modalDetailGolongan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailGolonganLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="tipe_kelas"></div>
                <div id="honor-ot"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
        </div>

        <div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <?= $this->session->flashdata('pesan');?>
                        </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info"><i class="fa fa-user mr-2 text-dark"></i> Profil</li>
                        <li class="list-group-item"><?= $kpq['nama_kpq']?></li>
                        <li class="list-group-item"><?= $kpq['nip']?></li>
                        <li class="list-group-item d-flex justify-content-between">Gol. <?= $kpq['golongan']?></li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info d-flex justify-content-between"><span><i class="fa fa-clock mr-2 text-dark"></i> KBM <?= $bulan[date("n")] . " " . date("Y")?></span></li>
                        <li class="list-group-item d-flex justify-content-between">Kelas <span><?= $kelas?></span></li>
                        <li class="list-group-item d-flex justify-content-between">
                            KBM <span><?= COUNT($kbm)?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            Badal <span><?= COUNT($badal)?></span>
                        </li>
                        <li class="list-group-item list-group-item-danger d-flex justify-content-between">
                            Dibadal <span><?= COUNT($dibadal)?></span>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success"><i class="fa fa-money-bill mr-2 text-dark"></i> Honor</li>
                        <li class="list-group-item"><?= rupiah($honor_kbm+$honor_badal)?></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-3">
                   <div class="alert alert-info"><i class="fa fa-info-circle text-info mr-1"></i>selama masa pandemi honor overtime ditiadakan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#beranda").addClass("active");
</script>