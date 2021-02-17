<div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="<?= base_url()?>kelas" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> kembali</a>
                </div>
                
                <!-- data kelas  -->
                <div class="col-12 mb-3">
                    <ul class="list-group shadow">
                        <li class="list-group-item"><i class="fa fa-book mr-2"></i><?= $kelas['program']?></li>
                        <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= $kelas['koor']?></li>
                        <li class="list-group-item"><i class="fa fa-map-marker-alt mr-2"></i><?= ucwords(strtolower($kelas['tempat']))?></li>
                        <?php if($jadwal) :?>
                            <?php foreach ($jadwal as $jadwal) :?>
                                <li class="list-group-item"><i class="fa fa-clock"></i> <?= $jadwal['hari'] . " " . $jadwal['jam']?></li>
                            <?php endforeach;?>
                        <?php endif;?>
                        <li class="list-group-item d-flex justify-content-center">
                            <span><a href="<?= base_url()?>kelas/tahsin/<?= md5($kelas['id_kelas'])?>" class="btn btn-sm btn-secondary mr-2">tahsin</a></span>
                            <span><a href="<?= base_url()?>kelas/tahfidz/<?= md5($kelas['id_kelas'])?>" class="btn btn-sm btn-secondary mr-2">tahfidz</a></span>
                            <span><a href="<?= base_url()?>kelas/b_arab/<?= md5($kelas['id_kelas'])?>" class="btn btn-sm btn-primary mr-2">b.arab</a></span>
                        </li>
                    </ul>
                </div>
                <!-- data kelas -->

                <div class="col-12 mb-3" id="listPeserta">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success"><strong>Peserta</strong></li>
                        <div id="list-peserta"></div>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<!-- modal peserta -->
    <div class="modal fade" id="formLaporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formLaporanTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalTop">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link active' id="btn-form-1"><i class="fas fa-list"></i></a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-2"><i class="fas fa-redo"></i></a>
                            </li> -->
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-3"><i class="fa fa-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="msg-form"></div>
                        <div id="form-1">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-warning">Laporan Peserta</li>
                                <div id="list-laporan"></div>
                            </ul>
                        </div>

                        <!-- <div id="form-2">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-warning">Murojaah Peserta</li>
                                <div id="list-murojaah"></div>
                            </ul>
                        </div> -->

                        <div id="form-3">
                            <form id="formAddLaporan">
                                <input type="hidden" name="no_peserta" id="no_peserta" required>
                                <input type="hidden" name="id_kelas" id="id_kelas" value="<?= $kelas['id_kelas']?>" required>
                                <div class="form-group">
                                    <label for="program">Program</label>
                                    <input type="text" name="program" id="program" class="form-control form-control-sm" required value="<?= $kelas['program']?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_awal">Tgl. Awal</label>
                                    <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_akhir">Tgl. Akhir</label>
                                    <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Nilai</label>
                                    <input type="number" name="nilai" id="nilai" class="form-control form-control-sm" required>
                                </div>

                                <?php if($kelas['tipe_kelas'] == "reguler") :?>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <select name="keterangan" id="keterangan" class="form-control form-control-sm" required>
                                            <option value="">Pilih Keterangan</option>
                                            <option value="Lulus">Lulus</option>
                                            <option value="Tidak Lulus">Tidak Lulus</option>
                                        </select>
                                    </div>
                                <?php else :?>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control form-control-md" required></textarea>
                                    </div>
                                <?php endif;?>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-md btn-primary">Tambah Laporan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- modal peserta -->

<script>
    $("#listPeserta").hide();

    peserta(<?= $kelas['id_kelas']?>);

    function peserta (data){
        let id = data;
        let html = "";

        data = {id: id};
        peserta = ajax_call("<?= base_url()?>kelas/get_peserta_aktif", data);

        if(peserta.length != 0){
            peserta.forEach(peserta => {
                html += 
                `<li class="list-group-item d-flex justify-content-between">
                    <span>`+peserta.nama_peserta+`</span>
                    <span>
                        <a href="#formLaporan" data-toggle="modal" data-id="`+peserta.no_peserta+`" class="btn btn-md list-group-item-success btnformLaporan"><i class="fa fa-plus"></i></a>
                    </span>
                </li>`;
            });

            $("#list-peserta").html(html)
            $("#listPeserta").show();
        } else {
            $("#listPeserta").hide();
        }
        
    }

    $("#list-peserta").on("click", ".btnformLaporan", function(){
        btn_3();
        let no_peserta = $(this).data("id");
        data = {no_peserta:no_peserta};

        reload_form(data)
    })

    $(document).on("click", "#btnDeleteLaporan", function(){
        if(confirm("Yakin akan menghapus laporan ini?")){
            let data = $(this).data("id");
            data = data.split("|");
            id = data[0];
            no_peserta = data[1];
    
            data = {id:id}
    
            ajax_call("<?= base_url()?>kelas/delete_laporan_arab", data);
            
            data = {no_peserta:no_peserta};
            reload_form(data)
            
            $(".msg-form").html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus laporan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            `);
        }
    })

    function reload_form(data){
        result = ajax_call("<?= base_url()?>kelas/get_peserta", data);
        $("#formLaporanTitle").html(result.nama_peserta)
        $("#no_peserta").val(result.no_peserta)

        html = "";
        result = ajax_call("<?= base_url()?>kelas/get_laporan_arab", data);
        result.forEach(result => {
            html += `
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        <a href="javascript:void(0)" data-id="`+result.id+`|`+result.no_peserta+`" id="btnDeleteLaporan" class="mr-1">
                            <i class="fa fa-minus-circle text-danger"></i>
                        </a>
                        <strong>`+result.periode+`</strong>
                    </span>
                </li>
                <li class="list-group-item">
                    <small>`+result.program+`<br>Nilai : `+result.nilai+`<br>catatan : `+result.keterangan+`</small>
                </li>
            `
        });
        $("#list-laporan").html(html);
    }

    // form add setoran submit 
    var finish = 1;
    $(document).on('submit','#formAddLaporan',function() {
        if(finish == 1){
            finish = 2;
            if(confirm("Yakin akan menambahkan laporan peserta?")){
                let no_peserta = $("#no_peserta").val()
                let id_kelas = $("#id_kelas").val()
                let program = $("#program").val()
                let tgl_awal = $("#tgl_awal").val()
                let tgl_akhir = $("#tgl_akhir").val()
                let nilai = $("#nilai").val()
                let keterangan = $("#keterangan").val()
                
                data = {no_peserta:no_peserta,id_kelas:id_kelas, program:program, tgl_awal:tgl_awal, tgl_akhir:tgl_akhir, nilai:nilai, keterangan:keterangan};

                ajax_call("<?= base_url()?>kelas/add_laporan_arab", data);

                $(".msg-form").html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan laporan<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                `);

                $("#modalTop").scrollTop(0);

                $("#formAddLaporan").trigger("reset");
                
                $(".form-delete").remove();

                finish = 1;
                data = {no_peserta:no_peserta}
                reload_form(data)
            } 
            else {
                finish = 1;
            }
        }
        return false;
    })

    function ajax_call(url_data, data){
        var result = "";
        $.ajax({
            url: url_data,
            method: "POST",
            dataType: "JSON",
            async: false,
            data: data,
            success: function(data){
                result = data;
            }
        })

        return result;
    }

    // btn modal 
        $("#btn-form-1").click(function(){
            btn_1();
            delete_msg();
        })
        
        $("#btn-form-2").click(function(){
            btn_2();
            delete_msg();
        })
        
        $("#btn-form-3").click(function(){
            btn_3();
            delete_msg();
        })

        function btn_1(){
            $("#btn-form-1").addClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").removeClass('active');
            
            $("#form-1").show();
            $("#form-2").hide();
            $("#form-3").hide();
        }

        function btn_2(){ 
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").addClass('active');
            $("#btn-form-3").removeClass('active');
            
            $("#form-1").hide();
            $("#form-2").show();
            $("#form-3").hide();
        }
        
        function btn_3(){
            $("#id_kelas_add").val("");
            $("#program_add").val("");
            $("#btn-form-1").removeClass('active');
            $("#btn-form-2").removeClass('active');
            $("#btn-form-3").addClass('active');
            
            $("#form-1").hide();
            $("#form-2").hide();
            $("#form-3").show();
        }
    // btn modal 

    function delete_msg(){
        $(".msg-form").html("")
    }
</script>

