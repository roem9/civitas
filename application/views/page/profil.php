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
                    <form action="<?= base_url()?>pengaturan/edit_kpq" method="post">
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
                            <input type="text" name="t4_lahir" id="t4_lahir" class="form-control form-control-sm" value="<?= $kpq['t4_lahir']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">Tgl Lahir</label>
                            <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control form-control-sm" value="<?= $kpq['tgl_lahir']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No. Handphone</label>
                            <input type="text" maxlength="13" name="no_hp" id="no_hp" class="form-control form-control-sm" value="<?= $kpq['no_hp']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control form-control-sm" rows="5" required><?= $kpq['alamat']?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="pendidikan">Pendidikan</label>
                            <select name="pendidikan" id="pendidikan" class="form-control form-control-sm" required>
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
                            <input type="text" name="jurusan" id="jurusan" class="form-control form-control-sm" value="<?= $kpq['jurusan']?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_ktp">No. KTP</label>
                            <input type="text" name="no_ktp" id="no_ktp" class="form-control form-control-sm" value="<?= $kpq['no_ktp']?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="tgl_masuk">Tgl Bergabung</label>
                            <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control form-control-sm" value="<?= $kpq['tgl_masuk']?>" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Edit Data" id="btn-simpan-profil" class="btn btn-sm btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#profil").addClass("active");

    $("#btn-simpan-profil").click(function(){
        var c = confirm('Yakin akan mengubah data profil Anda?')
        return c;
    })

    setInputFilter(document.getElementById("no_hp"), function(value) {
        return /^[0-9]*$/i.test(value);
    });
</script>

