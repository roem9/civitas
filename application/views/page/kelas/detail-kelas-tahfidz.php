<div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="<?= base_url()?>kelas" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> kembali</a>
                </div>
                
                <!-- data kelas  -->
                <div class="col-12 mb-3">
                    <ul class="list-group shadow">
                        <li class="list-group-item list-group-item-secondary d-flex justify-content-between"><span><i class="fa fa-calendar-day mr-2"></i><?= $kelas['hari'] . " " . $kelas['jam']?></span></li>
                        <li class="list-group-item"><i class="fa fa-book mr-2"></i><?= $kelas['program']?></li>
                        <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= $kelas['koor']?></li>
                        <li class="list-group-item"><i class="fa fa-map-marker-alt mr-2"></i><?= ucwords(strtolower($kelas['tempat']))?></li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <a href="javascript:void(0)" data-id="<?= $kelas['id_kelas']?>" class="btn btn-md btn-primary" id="btnPeserta">peserta</a>
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- data kelas -->

                <div class="col-12 mb-3" id="listPeserta">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success"><strong>Setoran Peserta</strong></li>
                        <div id="list-peserta"></div>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<!-- modal peserta -->
    <div class="modal fade" id="formHafalan" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formHafalanTitle"></h5>
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
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-2"><i class="fas fa-redo"></i></a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class='nav-link' id="btn-form-3"><i class="fa fa-plus"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body cus-font">
                        <div class="msg-form"></div>
                        <div id="form-1">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-warning">Hafalan Peserta</li>
                                <div id="list-hafalan"></div>
                            </ul>
                        </div>

                        <div id="form-2">
                            <ul class="list-group">
                                <li class="list-group-item list-group-item-warning">Murojaah Peserta</li>
                                <div id="list-murojaah"></div>
                            </ul>
                        </div>

                        <div id="form-3">
                            <form id="formAddSetoran">
                                <input type="hidden" name="no_peserta" id="no_peserta" required>
                                <input type="hidden" name="id_kelas" id="id_kelas" value="<?= $kelas['id_kelas']?>" required>
                                <div class="form-group">
                                    <label for="tgl_setor">Tgl. Setor</label>
                                    <input type="date" name="tgl_setor" id="tgl_setor" class="form-control form-control-md" value="<?= date('Y-m-d')?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis">Tipe Setoran</label>
                                    <select name="jenis" id="jenis" class="form-control form-control-md" required>
                                        <option value="">Pilih Tipe Setoran</option>
                                        <option value="Tambahan">Hafalan Tambahan</option>
                                        <option value="Murojaah">Murojaah</option>
                                    </select>
                                </div>
                                <h5><strong>List Setoran</strong></h5>
                                <div class="form-group">
                                    <label for="surat">Surah</label>
                                    <select name="surah" id="surah" data-id="0" class="form-control form-control-md" required>
                                        <option value="">Pilih Surah</option>
                                        <?php foreach ($surah as $surah) :?>
                                            <option value="<?= $surah['surah']?>|<?= $surah['ayat']?>"><?= $surah['surah']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="ayat">Ayat</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <input type="number" name="awal" id="awal0" min="1" max="" class="form-control form-control-md" required>
                                        </div>
                                        <div class="col-2">S.D</div>
                                        <div class="col-5">
                                            <input type="number" name="akhir" id="akhir0" min="1" max="" class="form-control form-control-md" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-add"></div>
                                <div class="d-flex justify-content-center">
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger mr-3" id="btnHapus"><i class="fa fa-minus"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-success" id="btnTambah"><i class="fa fa-plus"></i></a>
                                </div>
                                <div class="form-group">
                                    <label for="nilai">Nilai</label>
                                    <input type="number" name="nilai" id="nilai" class="form-control form-control-md" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Catatan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control form-control-md" required></textarea>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-md btn-primary">Tambah Setoran</button>
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

    var x = 0;
    var urut = 1;
    
    function option(){
        let data = ajax_call("<?= base_url()?>kelas/get_all_surah", "");
        // console.log(data);
        html = "";

        data.surah.forEach(data => {
            html += `<option value="`+data.surah+`|`+data.ayat+`">`+data.surah+`</option>`
        });

        return html;
    }

    $("#btnTambah").click(function(e){
        e.preventDefault();
        x++;
        urut++;
        $(".form-add").append(`
            <div class="form-group form`+x+` form-delete">
                <label for="surat">Surah `+urut+`</label>
                <select name="surah" id="surah" data-id="`+x+`" class="form-control form-control-md" required>
                    <option value="">Pilih Surah</option>`+option()+`
                </select>
            </div>
            <div class="form-group form`+x+` form-delete">
                <label for="ayat">Ayat `+urut+`</label>
                <div class="row">
                    <div class="col-5">
                        <input type="number" name="awal" id="awal`+x+`" min="1" max="" class="form-control form-control-md" required>
                    </div>
                    <div class="col-2">S.D</div>
                    <div class="col-5">
                        <input type="number" name="akhir" id="akhir`+x+`" min="1" max="" class="form-control form-control-md" required>
                    </div>
                </div>
            </div>`
        );
    })

    $("#btnHapus").click(function(e){
        if(x != 0){
            e.preventDefault();
            $(".form"+x).remove();
            x--;
            urut--;
        }
    })

    $("#btnPeserta").click(function(){
        let id = $(this).data("id");
        let html = "";

        data = {id: id};
        peserta = ajax_call("<?= base_url()?>kelas/get_peserta_aktif", data);

        if(peserta.length != 0){
            peserta.forEach(peserta => {
                html += 
                `<li class="list-group-item d-flex justify-content-between">
                    <span>`+peserta.nama_peserta+`</span>
                    <span>
                        <a href="#formHafalan" data-toggle="modal" data-id="`+peserta.no_peserta+`" class="btn btn-md list-group-item-success btnFormHafalan"><i class="fa fa-plus"></i></a>
                    </span>
                </li>`;
            });

            $("#list-peserta").html(html)
            $("#listPeserta").show();
        } else {
            $("#listPeserta").hide();
        }
        
    })

    // if surah change 
    $(document).on('change', "#surah", function(){
        let data = $(this).val();
        data = data.split("|");
        let surah = data[0];
        let ayat = data[1];

        let id = $(this).data("id");

        // if(id){
            $("#akhir"+id).attr({
                "max" : ayat
            });
        // } else {
        //     $("#akhir").attr({
        //         "max" : ayat
        //     });
        // }
    })

    $("#list-peserta").on("click", ".btnFormHafalan", function(){
        btn_3();
        let no_peserta = $(this).data("id");
        data = {no_peserta:no_peserta};

        reload_form(data)
    })

    $(document).on("click", "#btnDeleteSetoran", function(){
        if(confirm("Yakin akan menghapus setoran ini?")){
            let data = $(this).data("id");
            data = data.split("|");
            id = data[0];
            no_peserta = data[1];
    
            data = {id:id}
    
            ajax_call("<?= base_url()?>kelas/delete_setoran", data);
            
            data = {no_peserta:no_peserta};
            reload_form(data)
            
            $(".msg-form").html(`
            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus setoran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            `);
        }
    })

    function reload_form(data){
        result = ajax_call("<?= base_url()?>kelas/get_peserta", data);
        $("#formHafalanTitle").html(result.nama_peserta)
        $("#no_peserta").val(result.no_peserta)

        html = "";
        result = ajax_call("<?= base_url()?>kelas/get_setoran/Tambahan", data);
        result.forEach(result => {
            html += `
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        <a href="javascript:void(0)" data-id="`+result.id+`|`+result.no_peserta+`" id="btnDeleteSetoran" class="mr-1">
                            <i class="fa fa-minus-circle text-danger"></i>
                        </a>
                        <strong>`+result.tgl_setor+`</strong>
                    </span>
                    <span>
                        <strong>`+result.nilai+`</strong>
                    </span>
                </li>
                <li class="list-group-item">
                    <small>`+result.setoran+`<br>catatan : `+result.keterangan+`</small>
                </li>
            `
        });
        $("#list-hafalan").html(html);
        
        html = "";
        result = ajax_call("<?= base_url()?>kelas/get_setoran/Murojaah", data);
        result.forEach(result => {
            html += `
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        <a href="javascript:void(0)" data-id="`+result.id+`|`+result.no_peserta+`" id="btnDeleteSetoran" class="mr-1">
                            <i class="fa fa-minus-circle text-danger"></i>
                        </a>
                        <strong>`+result.tgl_setor+`</strong>
                    </span>
                    <span>
                        <strong>`+result.nilai+`</strong>
                    </span>
                </li>
                <li class="list-group-item">
                    <small>`+result.setoran+`<br>catatan : `+result.keterangan+`</small>
                </li>
            `
        });
        $("#list-murojaah").html(html);
    }

    // form add setoran submit 
    var finish = 1;
    $(document).on('submit','#formAddSetoran',function() {
        if(finish == 1){
            finish = 2;
            if(confirm("Yakin akan menambahkan setoran peserta?")){
                let no_peserta = $("#no_peserta").val()
                let id_kelas = $("#id_kelas").val()
                let tgl_setor = $("#tgl_setor").val()
                let jenis = $("#jenis").val()
                let nilai = $("#nilai").val()
                let keterangan = $("#keterangan").val()

                html = "";
                
                $("select[name='surah']").each(function(i){
                    let surah = $(this).find('option:selected').text();
                    let ayat = $("#awal"+i).val() + " s.d " +$("#akhir"+i).val()
                    html += surah+" "+ayat+"###";
                });

                setoran = html;
                
                data = {no_peserta:no_peserta, id_kelas:id_kelas, jenis:jenis,tgl_setor:tgl_setor,setoran:setoran,nilai:nilai,keterangan:keterangan};

                ajax_call("<?= base_url()?>kelas/add_setoran", data);

                $(".msg-form").html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan setoran<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                `);

                $("#modalTop").scrollTop(0);

                $("#formAddSetoran").trigger("reset");
                
                $(".form-delete").remove();
                x = 0;
                urut = 1;
                
                $("#tgl_setor").val(tgl_setor)
                
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

