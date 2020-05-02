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
                <li class="list-group-item active"><i class="fa fa-user mr-3 text-dark"></i> Profil</li>
                <li class="list-group-item"><?= $kpq['nama_kpq']?></li>
                <li class="list-group-item"><?= $kpq['nip']?></li>
                <li class="list-group-item d-flex justify-content-between">Gol. <?= $kpq['golongan']?> <span><a href="#modalDetailGolongan" data-id="<?= $kpq['golongan']?>" data-toggle="modal" class="badge badge-info modal-detail-golongan">info</a></span></li>
                <li class="list-group-item d-flex justify-content-between">Kelas <span><?= $kelas?></span></li>
            </ul>
        </div>
        <div class="col-12 col-md-6">
            <ul class="list-group">
                <li class="list-group-item active d-flex justify-content-between"><span><i class="fa fa-money-check mr-3 text-dark"></i> Honor</span> <span><a href="<?= base_url()?>home/detail_honor" class="badge badge-warning">print</a></span></li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-10">
                            Dibadal
                        </div>
                        <div class="col-2">
                            <span><?= COUNT($dibadal)?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-3">
                            KBM
                        </div>
                        <div class="col-7">
                            <span><?= rupiah($honor_kbm)?></span>
                        </div>
                        <div class="col-2">
                            <span><?= COUNT($kbm)?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-3">
                            Badal
                        </div>
                        <div class="col-7">
                            <span><?= rupiah($honor_badal)?></span>
                        </div>
                        <div class="col-2">
                            <span><?= COUNT($badal)?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-3">
                            Insentif
                        </div>
                        <div class="col-9">
                            <span><?= rupiah($honor_badal)?></span>
                        </div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">Total <span><?= rupiah($honor_badal+$honor_kbm)?></span> </li>
            </ul>
        </div>
    </div>
</div>

<script>
    $(".modal-detail-golongan").on("click", function(){
        let id = $(this).data("id");
        $("#modalDetailGolonganLabel").html("Detail Honor Golongan "+id)
        $.ajax({
            url: "<?= base_url()?>home/get_detail_golongan",
            method: "POST",
            data: {id:id},
            dataType: "json",
            async: true,
            success: function(data){
                let html = `<ul class="list-group"><li class="list-group-item active">KBM</li>`;
                $.each(data, function(i, data){
                    html += `<li class="list-group-item d-flex justify-content-between" style="text-transform: capitalize">`+data.tipe_kelas+`<span>`+formatRupiah(data.honor, 'Rp.')+`</span></li>`;
                })
                html += `</ul>`;
                $("#tipe_kelas").html(html)
            }
        })
        
        $.ajax({
            url: "<?= base_url()?>home/get_detail_ot",
            method: "POST",
            data: {id:id},
            dataType: "json",
            async: true,
            success: function(data){
                let html = '';
                for (let i = 0; i < data.length; i++) {
                    html += `<ul class="list-group mt-3"><li class="list-group-item active">Overtime `+data[i]['ot']+` Menit</li>`;
                    let urut = 1;
                    for (let j = 0; j < data[i]['honor'].length; j++) {
                        html += `<li class="list-group-item d-flex justify-content-between" style="text-transform: capitalize">`+urut+` KBM<span>`+formatRupiah(data[i]['honor'][j], 'Rp.')+`</span></li>`;

                        urut++
                    }

                    html += "</ul>"
                }
                $("#honor-ot").html(html)
            }
        })
    })

    $("#beranda").addClass("active");
</script>