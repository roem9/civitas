        <div class="container">
            <div class="row">
                <div class="col-12 mb-3">
                    <a href="<?= base_url()?>kelas" class="btn btn-sm btn-success"><i class="fa fa-arrow-left"></i> kembali</a>
                </div>
                
                <!-- data kelas  -->
                <div class="col-12 mb-3">
                    <ul class="list-group shadow">
                        <li class="list-group-item list-group-item-secondary d-flex justify-content-between"><span><i class="fa fa-calendar-day mr-2"></i><?= $kelas['hari'] . " " . $kelas['jam']?></span><span>PM</span></li>
                        <li class="list-group-item"><i class="fa fa-book mr-2"></i><?= $kelas['program']?></li>
                        <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i>LKP TAR-Q</li>
                        <li class="list-group-item"><i class="fa fa-map-marker-alt mr-2"></i><?= ucwords(strtolower($kelas['tempat']))?></li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>
                                <a href="javascript:void(0)" data-id="<?= $kelas['id_kelas']?>" class="btn btn-sm btn-primary inputPresensi"><i class="fa fa-user-check"></i></a>
                                <a href="javascript:void(0)" data-id="<?= $kelas['id_kelas']?>" class="btn btn-sm btn-danger inputBadal"><i class="fa fa-exchange-alt"></i></a>
                                <a href="javascript:void(0)" data-id="<?= $kelas['id_kelas']?>" class="btn btn-sm btn-success listKbm"><i class="fa fa-list-ol"></i> <span class="badge badge-danger jum_kbm"><?= $kelas['kbm']?></span></a>
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- data kelas -->
                
                <!-- message  -->
                <div class="col-12">
                    <div id="msgDetail"></div>
                </div>
                <!-- message  -->

                <!-- form input data hadir  -->
                <div class="col-12" id="inputPresensi">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info">Input Presensi</li>
                        <li class="list-group-item">
                            <form id="formInputPresensi" method="POST">
                                <input type="hidden" name="id_kelas" id="id_kelas" value="<?= $kelas['id_kelas']?>">
                                <div class="form-group">
                                    <label for="tgl">Tgl KBM</label>
                                    <input type="date" name="tgl" id="tgl" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="materi">Materi Pembinaan</label>
                                    <textarea name="materi" id="materi" class="form-control form-control-sm" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="tugas">Tugas Pembinaan</label>
                                    <textarea name="tugas" id="tugas" class="form-control form-control-sm" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="list_peserta"><strong>List Peserta</strong></label>
                                    <div class="list_peserta"></div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSubmitFormInputPresensi">Input Presensi</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- form input data hadir  -->
                
                <!-- form input data hadir badal  -->
                <div class="col-12" id="inputBadal">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info">Input Badal</li>
                        <li class="list-group-item">
                            <form id="formInputBadal" method="POST">
                                <input type="hidden" name="id_kelas" id="id_kelas_badal" value="<?= $kelas['id_kelas']?>">
                                <div class="alert alert-warning"><i class="fa fa-exclamation-circle text-warning"></i> pastikan untuk mendapatkan pengganti terlebih dahulu sebelum mengajukan badal</div>
                                <div class="form-group">
                                    <label for="tgl">Tgl KBM</label>
                                    <input type="date" name="tgl" id="tgl_badal" class="form-control form-control-sm" required>
                                </div>
                                <div class="form-group">
                                    <label for="nip">Pengajar</label>
                                    <select name="nip" id="nip_badal" class="form-control form-control-sm">
                                        <option value="">Pilih Pengajar</option>
                                        <?php foreach ($kpq as $data) :?>
                                            <option value="<?= $data['nip']?>"><?= $data['nama_kpq']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-sm btn-primary" id="btnSubmitFormInputBadal">Input Badal</button>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>
                <!-- form input data hadir badal  -->

                <!-- list kbm  -->
                <div class="col-12" id="listKbm">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-info">List KBM</li>
                        <div class="list_kbm"></div>
                    </ul>
                </div>
                <!-- list kbm  -->

                <div class="col-12" id="editKbm">
                    <li class="list-group-item list-group-item-info title-kbm"></li>
                    <li class="list-group-item">
                        <form id="formEditPresensi" method="POST">
                            <input type="hidden" name="id_kbm" id="id_kbm_edit">
                            <input type="hidden" name="id_kelas" id="id_kelas_edit">
                            <div class="form-group">
                                <label for="tgl">Tgl KBM</label>
                                <input type="date" name="tgl" id="tgl_edit" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="materi">Materi Pembinaan</label>
                                <textarea name="materi" id="materi_edit" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tugas">Tugas Pembinaan</label>
                                <textarea name="tugas" id="tugas_edit" class="form-control form-control-sm" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="list_peserta"><strong>List Peserta</strong></label>
                                <div class="list_peserta_edit"></div>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-sm btn-success" id="btnSubmitFormEditPresensi">Edit Presensi</button>
                            </div>
                        </form>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#inputPresensi").hide();
    $("#listKbm").hide();
    $("#editKbm").hide();
    $("#inputBadal").hide();


    console.log(<?= $kelas['kbm']?>)
    if(<?=$kelas['kbm']?> >= 5){
        $(".inputPresensi").hide()
        $(".inputBadal").hide()
    } else {
        $(".inputPresensi").show()
        $(".inputBadal").show()
    }

    // show form input presensi 
    $(".inputPresensi").click(function(){
        delete_msg()
        $("#inputPresensi").show();
        $("#listKbm").hide();
        $("#editKbm").hide();
        $("#inputBadal").hide();

        var data = $(this).data("id");

        $('#formInputPresensi').trigger("reset");

        $.ajax({
            url: "<?= base_url()?>kelas/get_peserta_pembinaan_aktif",
            method: "POST",
            data: {id: data},
            dataType: "JSON",
            success: function(result){
                // console.log(result)
                html = "";
                index = 1;
                result.forEach(peserta => {
                    html += `
                            <div class="form-group row">
                                <input type="hidden" name="nip[]" value="`+peserta.nip+`">
                                <div class="col-8">`+index+`. `+peserta.nama_kpq+`</div>
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

                $(".list_peserta").html(html)
            }
        })
    })

    // show list kbm
    $(".listKbm").click(function(){
        delete_msg()
        $("#inputPresensi").hide();
        $("#listKbm").show();
        $("#editKbm").hide();
        $("#inputBadal").hide();
        
        var data = $(this).data("id");

        list_kbm(data);
    })

    // show form input badal
    $(".inputBadal").click(function(){
        delete_msg()
        $("#inputPresensi").hide();
        $("#listKbm").hide();
        $("#editKbm").hide();
        $("#inputBadal").show();
        
        var data = $(this).data("id");
    })

    //delete kbm
    $(".list_kbm").on("click", "#btnDelete", function(){
        let data = $(this).data("id");
        data = data.split("|");
        let id_kbm = data[0];
        let tgl = data[1];
        let id_kelas = data[2];

        if(confirm("Yakin akan menghapus kbm di tanggal "+tgl+"?"))
        $.ajax({
            url: "<?= base_url()?>kelas/delete_kbm_pembinaan",
            method: "POST",
            data: {id_kbm: id_kbm, id_kelas: id_kelas},
            dataType: "JSON",
            success: function(result){
                var msg = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menghapus KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                $('#msgDetail').html(msg);
                
                list_kbm(id_kelas);
                $(".jum_kbm").html(result)
                if(result == 5){
                    $(".inputPresensi").hide()
                    $(".inputBadal").hide()
                } else {
                    $(".inputPresensi").show()
                    $(".inputBadal").show()
                }
            }
        })
    })

    //edit kbm
    $(".list_kbm").on("click", "#btnEdit", function(){
        delete_msg()
        $("#inputPresensi").hide();
        $("#listKbm").hide();
        $("#editKbm").show();
        $("#inputBadal").hide();

        let data = $(this).data("id");
        data = data.split("|");
        let id_kbm = data[0];
        let tgl = data[1];

        $(".title-kbm").html(tgl);

        $.ajax({
            url: "<?= base_url()?>kelas/get_detail_kbm_pembinaan",
            method: "POST",
            dataType: "JSON",
            data: {id_kbm: id_kbm},
            success: function(result){
                // console.log(result)
                $("#id_kelas_edit").val(result.kbm.id_kelas);
                $("#id_kbm_edit").val(result.kbm.id_kbm);
                $("#tgl_edit").val(result.kbm.tgl);
                $("#materi_edit").val(result.kbm.materi);
                $("#tugas_edit").val(result.kbm.tugas);

                html = "";
                
                index = 1;
                result.peserta.forEach(peserta => {
                    if(peserta.keterangan == 'hadir') hadir = "selected"
                    else hadir = '';
                    if(peserta.keterangan == 'izin') izin = "selected"
                    else izin = '';
                    if(peserta.keterangan == 'sakit') sakit = "selected"
                    else sakit = '';
                    if(peserta.keterangan == 'tidak hadir') tdk_hadir = "selected"
                    else tdk_hadir = '';

                    if(result.badal.length != 0){
                        html += `
                            <div class="form-group row">
                                <input type="hidden" name="nip_edit[]" value="`+peserta.id_presensi+`">
                                <div class="col-8">`+index+`. `+peserta.nama_kpq+`</div>
                                <div class="col-2">
                                    <select name="keterangan_edit[]" class="form form-control-sm" disabled>
                                        <option value="hadir" `+hadir+`>Hadir</option>
                                        <option value="tidak hadir" `+tdk_hadir+`>Tdk Hadir</option>
                                        <option value="izin" `+izin+`>Izin</option>
                                        <option value="sakit" `+sakit+`>Sakit</option>
                                    </select>
                                </div>
                            </div>`;
                    } else {
                        html += `
                            <div class="form-group row">
                                <input type="hidden" name="nip_edit[]" value="`+peserta.id_presensi+`">
                                <div class="col-8">`+index+`. `+peserta.nama_kpq+`</div>
                                <div class="col-2">
                                    <select name="keterangan_edit[]" class="form form-control-sm">
                                        <option value="hadir" `+hadir+`>Hadir</option>
                                        <option value="tidak hadir" `+tdk_hadir+`>Tdk Hadir</option>
                                        <option value="izin" `+izin+`>Izin</option>
                                        <option value="sakit" `+sakit+`>Sakit</option>
                                    </select>
                                </div>
                            </div>`;
                    }
                    index++;
                });

                if(result.badal.length != 0){
                    $("#btnSubmitFormEditPresensi").hide();
                    html += '<p class="text-danger">Diisi Oleh : <b>'+result.badal.kpq+'</b></p>'
                    $("#tgl_edit").attr('disabled', 'disabled');
                    $("#materi_edit").attr('disabled', 'disabled');
                    $("#tugas_edit").attr('disabled', 'disabled');
                } else {
                    $("#btnSubmitFormEditPresensi").show();
                    $("#tgl_edit").removeAttr("disabled");
                    $("#materi_edit").removeAttr("disabled");
                    $("#tugas_edit").removeAttr("disabled");
                }

                $(".list_peserta_edit").html(html);
            }
        })
    })

    function list_kbm(id){
        $.ajax({
            url: "<?= base_url()?>kelas/get_list_kbm_pembinaan",
            method: "POST",
            data: {id_kelas: id},
            dataType: "JSON",
            success: function(result){
                // console.log(result)
                html = "";
                index = 1;
                if(result.kbm.length != 0){
                    result.kbm.forEach(kbm => {
                        html += `<li class="list-group-item d-flex justify-content-between">
                                    <span>`+kbm.tgl+`</span>
                                    <span>
                                        <a href="javascript:void(0)" id="btnDelete" data-id="`+kbm.id_kbm+`|`+kbm.tgl+`|`+kbm.id_kelas+`" class="btn btn-sm btn-outline-danger mr-1">hapus</a>
                                        <a href="javascript:void(0)" id="btnEdit" data-id="`+kbm.id_kbm+`|`+kbm.tgl+`" class="btn btn-sm btn-success">edit</a>
                                    </span>
                                </li>`;
                        index++;
                    });
                } else {
                    html += `<li class="list-group-item">
                                <div class="alert alert-warning"><i class="fa fa-exclamation-circle text-warning"></i> list kbm kosong</div>
                            </li>`;
                }
                $(".list_kbm").html(html)
            }
        })
    }

    // when form input presensi submit 
    $("#formInputPresensi").submit(function(){
        if(confirm("Yakin akan menambahkan kbm?")){
            let id_kelas = $("#id_kelas").val();
            let tgl = $("#tgl").val();
            let materi = $("#materi").val();
            let tugas = $("#tugas").val();
            let nip = [];
            $("input[name='nip[]']").each(function() {
                nip.push($(this).val());
            });

            let keterangan = [];
            $("select[name='keterangan[]'] option:selected").each(function(){
                keterangan.push($(this).val());
            });

            $.ajax({
                url: "<?= base_url()?>kelas/add_kbm_pembinaan",
                method: "POST",
                data: {id_kelas: id_kelas, tgl: tgl, materi: materi, tugas: tugas, nip: nip, keterangan: keterangan},
                success: function(result){
                    if(result == 0){
                        var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan KBM, tgl KBM yang Anda inputkan salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('#msgDetail').html(msg);
                    } else {
                        if(result == 5){
                            $(".inputPresensi").hide()
                            $(".inputBadal").hide()
                        } else {
                            $(".inputPresensi").show()
                            $(".inputBadal").show()
                        }
                        var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('#msgDetail').html(msg);
                        $(".jum_kbm").html(result)
                        $('#formInputPresensi').trigger("reset");
                        $("#inputPresensi").hide();
                    }
                }
            })
        }

        return false;
    })
    
    // when form input badal submit 
    $("#formInputBadal").submit(function(){
        if(confirm("Yakin akan menambahkan badal?")){
            let id_kelas = $("#id_kelas_badal").val();
            let tgl = $("#tgl_badal").val();
            let nip = $("#nip_badal").val();

            $.ajax({
                url: "<?= base_url()?>kelas/add_kbm_badal_pembinaan",
                method: "POST",
                data: {id_kelas: id_kelas, tgl: tgl, nip: nip},
                success: function(result){
                    if(result == 0){
                        var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal menambahkan KBM, tgl KBM yang Anda inputkan salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('#msgDetail').html(msg);
                    } else {
                        if(result == 5){
                            $(".inputPresensi").hide()
                            $(".inputBadal").hide()
                        } else {
                            $(".inputPresensi").show()
                            $(".inputBadal").show()
                        }
                        var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil menambahkan KBM Badal<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('#msgDetail').html(msg);
                        $(".jum_kbm").html(result)
                        $('#formInputBadal').trigger("reset");
                        $("#inputBadal").hide();
                    }
                }
            })
        }

        return false;
    })
    
    // when form edit presensi submit 
    $("#formEditPresensi").submit(function(){
        if(confirm("Yakin akan mengubah data kbm?")){
            let id_kelas = $("#id_kelas_edit").val();
            let id_kbm = $("#id_kbm_edit").val();
            let tgl = $("#tgl_edit").val();
            let materi = $("#materi_edit").val();
            let tugas = $("#tugas_edit").val();
            let nip = [];
            $("input[name='nip_edit[]']").each(function() {
                nip.push($(this).val());
            });

            let keterangan = [];
            $("select[name='keterangan_edit[]'] option:selected").each(function(){
                keterangan.push($(this).val());
            });

            $.ajax({
                url: "<?= base_url()?>kelas/edit_kbm_pembinaan",
                method: "POST",
                data: {id_kbm: id_kbm, tgl: tgl, materi: materi, tugas: tugas, nip: nip, keterangan: keterangan},
                success: function(result){
                    if(result == 0){
                        var msg = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fa fa-times-circle text-danger mr-1"></i> Gagal mengubah KBM, tgl KBM yang Anda inputkan salah<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('#msgDetail').html(msg);
                    } else {
                        var msg = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="fa fa-check-circle text-success mr-1"></i> Berhasil mengubah KBM<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>`;
                        $('#msgDetail').html(msg);
                        $("#editKbm").hide();
                        
                        list_kbm(id_kelas);
                        $("#listKbm").show();
                    }
                }
            })
        }

        return false;
    })

    function delete_msg(){
        $("#msgDetail").html("");
    }
</script>

