<!-- Modal catatan -->
<div class="modal fade" id="modalCatatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCatatanLabel">Catatan Kelas</h5>
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
                <div class="col-12 mb-2">
                    <div class="alert alert-warning"><i class="fa fa-exclamation-circle text-warning mr-1"></i> mohon untuk membaca catatan terlebih dahulu sebelum mengambil waiting list</div>
                </div>
            </div>
            <div class="row">
                <?php if(COUNT($kelas) != 0):?>
                    <?php foreach ($kelas as $kelas) :?>
                        <div class="col-12 col-md-3 mb-2">
                            <ul class="list-group shadow">
                                <li class="list-group-item list-group-item-info"><i class="fa fa-book mr-2"></i><?= $kelas['program']?></li>
                                <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= ucwords(strtolower($kelas['nama_peserta']))?></li>
                                <li class="list-group-item"><i class="fa fa-map-marker-alt mr-2"></i><?= ucwords($kelas['tipe_kelas'])?></li>
                                <li class="list-group-item">
                                    <a href="#modalCatatan" data-id="<?= $kelas['id_kelas']?>" data-toggle="modal" class="btn btn-sm btn-success modal-catatan">catatan</a>
                                    <?php if($kelas['status'] == 'wl') :?>
                                        <a href="<?= base_url()?>kelas/ambil_wl/<?= $kelas['id_kelas']?>" onclick="return confirm('Yakin akan mengambil kelas ini?')" class="btn btn-sm btn-primary">ambil kelas</a>
                                    <?php elseif($kelas['status'] == 'konfirm') :?>
                                        <a href="<?= base_url()?>kelas/batal_wl/<?= $kelas['id_kelas']?>" onclick="return confirm('Yakin akan membatalkan kelas ini?')" class="btn btn-sm btn-danger">batalkan</a>
                                    <?php endif;?>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach;?>
                <?php else :?>
                    <div class="col-12 col-md-6">
                        <div class="alert alert-warning" role="alert">
                        <i class="fa fa-info-circle mr-1 text-warning"></i> Waiting list kosong
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#wl").addClass("active");

    $(".modal-catatan").click(function(){
        let id = $(this).data("id");

        $.ajax({
            url: "<?= base_url()?>kelas/get_catatan_kelas",
            data: {id: id},
            dataType: "json",
            method: "POST",
            async: true,
            success: function(data){
                let html = '<strong>Catatan</strong> : <br> '+data.catatan+' <br><br> <strong>Tempat</strong> : <br> '+data.tempat;
                $("#catatan").html(html)
            }
        })
    })
</script>


