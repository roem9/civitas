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
<!-- modal -->

<!-- modal -->
    <div class="modal fade" id="modalDetailProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetailProfilLabel">Detail Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="alert alert-info"><i class="fa fa-info-circle mr-1 text-info"></i> ubah data profil Anda <a href="<?= base_url('pengaturan/profil')?>" class="text-primary">di sini</a></div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control form-control-sm" value="<?= $kpq['nama_kpq']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nip">NIK</label>
                    <input type="text" name="nik" id="nik" class="form-control form-control-sm" value="<?= $kpq['nip']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="t4_lahir">Tempat Lahir</label>
                    <input type="text" name="t4_lahir" id="t4_lahir" class="form-control form-control-sm" value="<?= $kpq['t4_lahir']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tgl_lahir">Tgl Lahir</label>
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control form-control-sm" value="<?= $kpq['tgl_lahir']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="no_hp">No. Handphone</label>
                    <input type="text" maxlength="13" name="no_hp" id="no_hp" class="form-control form-control-sm" value="<?= $kpq['no_hp']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control form-control-sm" rows="5" readonly><?= $kpq['alamat']?></textarea>
                </div>
                <div class="form-group">
                    <label for="pendidikan">Pendidikan</label>
                    <select name="pendidikan" id="pendidikan" class="form-control form-control-sm" readonly>
                        <option value="">Pilih Pendidikan</option>
                        <option <?php if($kpq['pendidikan'] == "SMA/Sederajat"){echo "selected";}?> value="SMA/Sederajat">SMA/Sederajat</option>
                        <option <?php if($kpq['pendidikan'] == "DI"){echo "selected";}?> value="DI">DI</option>
                        <option <?php if($kpq['pendidikan'] == "DII"){echo "selected";}?> value="DII">DII</option>
                        <option <?php if($kpq['pendidikan'] == "DIII"){echo "selected";}?> value="DIII">DIII</option>
                        <option <?php if($kpq['pendidikan'] == "S1"){echo "selected";}?> value="S1">S1</option>
                        <option <?php if($kpq['pendidikan'] == "S2"){echo "selected";}?> value="S2">S2</option>
                        <option <?php if($kpq['pendidikan'] == "S3"){echo "selected";}?> value="S3">S3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="jurusna">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" class="form-control form-control-sm" value="<?= $kpq['jurusan']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="no_ktp">No. KTP</label>
                    <input type="text" name="no_ktp" id="no_ktp" class="form-control form-control-sm" value="<?= $kpq['no_ktp']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tgl_masuk">Tgl Bergabung</label>
                    <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control form-control-sm" value="<?= $kpq['tgl_masuk']?>" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
            </div>
        </div>
    </div>
<!-- modal -->

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
                        <li class="list-group-item list-group-item-info d-flex justify-content-between"><span><i class="fa fa-user mr-2 text-dark"></i> Profil</span><span><a href="#modalDetailProfil" data-toggle="modal" class="btn btn-outline-success btn-sm">detail</a></span></li>
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
                   <div class="alert alert-warning"><i class="fa fa-exclamation-circle text-warning mr-1"></i>Selama Pandemi Covid, tidak ada Infaq OT Peserta, sehingga honor OT ditiadakan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#beranda").addClass("active");
</script>