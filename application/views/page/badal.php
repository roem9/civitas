<!-- Modal presensi -->
<div class="modal fade" id="modalPresensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPresensiLabel">Presensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>kelas/rekap_badal" method="post" id="form-1">
            <input type="hidden" name="id_kbm" id="id-kbm">
            <input type="hidden" name="id_kelas" id="id-kelas">
            <input type="hidden" name="tipe" id="tipe">
            <div class="list-peserta-sesuai"></div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary mt-2 mr-2" data-dismiss="modal">Tutup</button>
                <input type="submit" value="Simpan" id="btn-badal" class="btn btn-sm btn-primary mt-2">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal presensi -->
<div class="modal fade" id="modalPresensiPembinaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPresensiLabel">Presensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url()?>kelas/rekap_badal_pembinaan" method="post" id="form-1">
            <input type="hidden" name="id_kbm" id="id_kbm_pembinaan">
            <input type="hidden" name="id_kelas" id="id_kelas_pembinaan">
            <!-- <div class="form-group">
                <label for="keterangan_badal">Keterangan</label>
                <select name="keterangan_badal" id="keterangan_badal" class="form-control form-control-sm">
                    <option value="">Pilih Keterangan</option>
                    <option value="badal">Badal</option>
                    <option value="gabungan">Gabungan</option>
                </select>
            </div> -->
            <div class="form-group">
                <label for="materi">Materi</label>
                <textarea name="materi" id="materi" class="form-control form-control-sm" required></textarea>
            </div>
            <div class="form-group">
                <label for="tugas">Tugas</label>
                <textarea name="tugas" id="tugas" class="form-control form-control-sm" required></textarea>
            </div>
            <label for=""><strong>List Peserta</strong></label>
            <div class="list-peserta-pembinaan"></div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-secondary mt-2 mr-2" data-dismiss="modal">Tutup</button>
                <input type="submit" value="Simpan" id="btn-badal" class="btn btn-sm btn-primary mt-2">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal presensi -->
<div class="modal fade" id="modalCatatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPresensiLabel">Catatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="catatan">
      </div>
    </div>
  </div>
</div>

    <div class="container">
        <?php if( $this->session->flashdata('pesan') ) : ?>
            <div class="row">
                <div class="col-12">
                    <?= $this->session->flashdata('pesan');?>
                    </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php if(COUNT($kelas) + COUNT($pembinaan) != 0):?>
                <?php foreach ($kelas as $kelas) :?>
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group shadow">
                            <li class="list-group-item list-group-item-warning"><i class="fa fa-calendar-day mr-2"></i><?= $kelas['hari'] . "[" . $kelas['jam'] . "] " . date('d-M-Y', strtotime($kelas['tgl']))?></li>
                            <li class="list-group-item"><i class="fa fa-user-tie mr-2"></i><?= $kelas['nama_kpq']?></li>
                            <li class="list-group-item"><i class="fa fa-book mr-2"></i><?= $kelas['program_kbm']?></li>
                            <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= $kelas['peserta']?></li>
                            <li class="list-group-item">
                                <a href="#modalPresensi" data-id="<?= $kelas['id_kelas']?>|<?= $kelas['id_kbm']?>|kelas" data-toggle="modal" class="btn btn-sm btn-primary modal-presensi"><i class="fa fa-user-check"></i></a>
                                <a href="#modalCatatan" data-id="<?= $kelas['id_kbm']?>|kelas" data-toggle="modal" class="btn btn-sm btn-success modal-catatan"><i class="fa fa-clipboard"></i></a>
                            </li>
                        </ul>
                    </div>
                <?php endforeach;?>
                <?php foreach ($pembinaan as $pembinaan) :?>
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group shadow">
                            <li class="list-group-item list-group-item-warning"><i class="fa fa-calendar-day mr-2"></i><?= $pembinaan['hari'] . "[" . $pembinaan['jam'] . "] " . date('d-M-Y', strtotime($pembinaan['tgl']))?></li>
                            <li class="list-group-item"><i class="fa fa-user-tie mr-2"></i><?= $pembinaan['nama_kpq']?></li>
                            <li class="list-group-item"><i class="fa fa-book mr-2"></i><?= $pembinaan['program_kbm']?></li>
                            <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= $pembinaan['peserta']?></li>
                            <li class="list-group-item">
                                <a href="#modalPresensiPembinaan" data-id="<?= $pembinaan['id_kelas']?>|<?= $pembinaan['id_kbm']?>|pembinaan" data-toggle="modal" class="btn btn-sm btn-primary modalPresensiPembinaan"><i class="fa fa-user-check"></i></a>
                                <!-- <a href="#modalCatatan" data-id="<?= $pembinaan['id_kbm']?>|pembinaan" data-toggle="modal" class="btn btn-sm btn-success modal-catatan"><i class="fa fa-clipboard"></i></a> -->
                            </li>
                        </ul>
                    </div>
                <?php endforeach;?>
            <?php else :?>
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                      <i class="fa fa-info-circle mr-1 text-warning"></i> Anda tidak memiliki jadwal badal
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>
    
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#jadwal_badal").addClass("active");

    $(".modal-presensi").click(function(){
        let data = $(this).data("id");
        data = data.split("|");
        let id_kelas = data[0];
        let id_kbm = data[1];
        let tipe = data[2];
        
        $("#id-kelas").val(id_kelas);
        $("#id-kbm").val(id_kbm);
        $("#tipe").val(tipe);

        $.ajax({
            url: "<?= base_url()?>kelas/get_peserta_aktif",
            data: {id: id_kelas, tipe: tipe},
            method: "POST",
            dataType: "json",
            async: true,
            success: function(data){
                let html = `<ul class="list-group"><li class="list-group-item list-group-item-info"><i class="fa fa-users"></i> List Peserta</li>`;
                for (let i = 0; i < data.length; i++) {
                    html += `<li class="list-group-item" style="text-transform: capitalize"><input type="checkbox" value="`+data[i].id_peserta+`"name="peserta[]" id="sesuai`+i+`">
                <label for="sesuai`+i+`">`+data[i].nama_peserta.toLowerCase()+`</label></li>`
                }
                html += `</ul>`;

                $(".list-peserta-sesuai").html(html);
            }
        })
    })

    
    $(".modalPresensiPembinaan").click(function(){
        let data = $(this).data("id");
        data = data.split("|");
        let id_kelas = data[0];
        let id_kbm = data[1];
        let tipe = data[2];
        
        $("#id_kelas_pembinaan").val(id_kelas);
        $("#id_kbm_pembinaan").val(id_kbm);

        $.ajax({
            url: "<?= base_url()?>kelas/get_peserta_aktif",
            data: {id: id_kelas, tipe: tipe},
            method: "POST",
            dataType: "json",
            async: true,
            success: function(data){
                let html = `<ul class="list-group"><li class="list-group-item list-group-item-info"><i class="fa fa-users"></i> List Peserta</li><li class="list-group-item">`;
                html = "";
                index = 1;
                data.forEach(peserta => {
                    html += `
                            <div class="form-group row">
                                <input type="hidden" name="nip[]" value="`+peserta.id_peserta+`">
                                <div class="col-8">`+index+`. `+peserta.nama_peserta+`</div>
                                <div class="col-2">
                                    <select name="keterangan[]" id="keterangan" class="form form-control-sm">
                                        <option value="hadir" selected>Hadir</option>
                                        <option value="tidak hadir">Tdk Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                    </select>
                                </div>
                            </div>`;
                    index++;
                });
                // for (let i = 0; i < data.length; i++) {
                //     html += `<li class="list-group-item" style="text-transform: capitalize"><input type="checkbox" value="`+data[i].id_peserta+`"name="peserta[]" id="sesuai`+i+`">
                // <label for="sesuai`+i+`">`+data[i].nama_peserta.toLowerCase()+`</label></li>`
                // }
                html += `</li></ul>`;

                $(".list-peserta-pembinaan").html(html);
            }
        })
    })

    $(".modal-catatan").click(function(){
        let data = $(this).data("id");
        data = data.split("|");

        id = data[0];
        tipe = data[1];

        $.ajax({
            url: "<?= base_url()?>kelas/get_catatan_badal",
            data: {id: id, tipe: tipe},
            dataType: "json",
            method: "POST",
            async: true,
            success: function(data){
                $("#catatan").html(data.catatan)
            }
        })
    })
</script>