<!-- Modal edit program -->
    <div class="modal fade" id="modalEditProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditProgramLabel">Edit Program</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url()?>kelas/edit_program" method="post">
                    <input type="hidden" name="id" id="id-edit-program">
                    <div class="form-group">
                        <label for="peserta">Peserta</label>
                        <input type="text" name="peserta" id="peserta-koor" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="program-kelas">Program</label>
                        <select name="program" id="program-kelas" class="form-control form-control-sm">
                            <option value="">Pilih Program</option>
                            <?php foreach ($program as $program) :?>
                                <option value="<?= $program['nama_program']?>"><?= $program['nama_program']?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Edit" class="btn btn-sm btn-success" id="btn-edit-program">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!-- Modal edit program -->

<!-- Modal badal -->
    <div class="modal fade" id="modalBadal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBadalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="info-badal">
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <i class="fa fa-info-circle mr-1 text-info"></i> Pastikan untuk mendapatkan pembadal terlebih dahulu sebelum melakukan pengajuan badal
                        </div>
                    </div>
                </div>
                <form action="<?= base_url()?>kelas/add_badal" method="post">
                    <input type="hidden" name="id_jadwal" id="id-jadwal-badal">
                    <input type="hidden" name="id_kelas" id="id-kelas-badal">
                    <input type="hidden" name="program" id="program-badal">
                    <div class="form-group">
                        <label for="koor-badal">Koordinator</label>
                        <input type="text" name="koor" id="koor-badal" class="form-control form-control-sm" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgl-badal">Tgl Badal</label>
                        <input type="date" name="tgl" id="tgl-badal" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="waktu-badal">Waktu</label>
                        <select name="waktu" id="waktu-badal" class="form-control form-control-sm" required>
                            <option value="">Pilih waktu</option>
                            <option value="05.00-06.30">05.00-06.30</option>
                            <option value="06.00-07.30">06.00-07.30</option>
                            <option value="07.00-08.30">07.00-08.30</option>
                            <option value="08.30-10.00">08.30-10.00</option>
                            <option value="10.00-11.30">10.00-11.30</option>
                            <option value="13.00-14.30">13.00-14.30</option>
                            <option value="15.30-17.00">15.30-17.00</option>
                            <option value="16.00-17.30">16.00-17.30</option>
                            <option value="17.00-18.30">17.00-18.30</option>
                            <option value="18.30-20.00">18.30-20.00</option>
                            <option value="19.30-21.00">19.30-21.00</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="catatan-badal">Catatan</label>
                        <textarea name="catatan" id="catatan-badal" class="form-control form-control-sm" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="tempat-badal">Tempat</label>
                        <textarea name="tempat" id="tempat-badal" class="form-control form-control-sm" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="nip-badal">dibadal oleh</label>
                        <select name="nip" id="nip-badal" class="form-control form-control-sm" required>
                            <option value="">Pilih Pengajar</option>
                            <?php foreach ($kpq as $pengajar) :?>
                                <?php if($pengajar['nama_kpq'] != "Muhammad Ru"):?>
                                    <option value="<?= $pengajar['nip']?>"><?= $pengajar['nama_kpq']?></option>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-sm btn-secondary mr-2" data-dismiss="modal">Tutup</button>
                        <input type="submit" value="Simpan" id="btn-badal" class="btn btn-sm btn-primary">
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
<!-- Modal badal -->

<!-- Modal presensi -->
    <div class="modal fade" id="modalPresensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPresensiLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row" id="info-presensi">
                    <div class="col-12">
                        <div class="alert alert-info" role="alert">
                            <i class="fa fa-info-circle mr-1 text-info"></i> Jika KBM dilakukan sesuai jadwal pilih "Sesuai", jika KBM dilakukan tidak sesuai dengan jadwal pilh "Ganti"
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="alert alert-warning" role="alert">
                            <i class="fa fa-exclamation-circle mr-1 text-warning"></i> Jika peserta melakukan pembatalan KBM secara mendadak, rekap hanya diisi dengan waktu KBM dan tanpa mengisi peserta yang hadir. Harap dikomunikasikan kepada peserta dikarenakan pembatalan mendadak maka akan tetap dimasukkan ke rekap KBM
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="btn-form-1">Sesuai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="btn-form-2">Ganti</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url()?>kelas/add_kbm" method="post" id="form-1">
                            <input type="hidden" name="id_jadwal" id="id-jadwal-sesuai">
                            <input type="hidden" name="id_kelas" id="id-kelas-sesuai">
                            <input type="hidden" name="koor" id="koor-sesuai">
                            <input type="hidden" name="keterangan" value="sesuai">
                            <div class="form-group">
                                <label for="tgl-badal">Tgl KBM</label>
                                <input type="date" name="tgl" id="tgl-badal" class="form-control form-control-sm" required>
                            </div>
                            <div class="list-peserta-sesuai"></div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-secondary mt-2 mr-2" data-dismiss="modal">Tutup</button>
                                <input type="submit" value="Simpan" id="btn-badal" class="btn btn-sm btn-primary mt-2">
                            </div>
                        </form>

                        <form action="<?= base_url()?>kelas/add_kbm" method="post" id="form-2">
                            <input type="hidden" name="id_jadwal" id="id-jadwal-ganti">
                            <input type="hidden" name="id_kelas" id="id-kelas-ganti">
                            <input type="hidden" name="koor" id="koor-ganti">
                            <input type="hidden" name="keterangan" value="ganti">
                            <div class="form-group">
                                <label for="tgl-ganti">Tgl KBM</label>
                                <input type="date" name="tgl" id="tgl-ganti" class="form-control form-control-sm" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu-ganti">Waktu</label>
                                <select name="jam" id="waktu-ganti" class="form-control form-control-sm" required>
                                    <option value="">Pilih waktu</option>
                                    <option value="05.00-06.30">05.00-06.30</option>
                                    <option value="06.00-07.30">06.00-07.30</option>
                                    <option value="07.00-08.30">07.00-08.30</option>
                                    <option value="08.30-10.00">08.30-10.00</option>
                                    <option value="10.00-11.30">10.00-11.30</option>
                                    <option value="13.00-14.30">13.00-14.30</option>
                                    <option value="15.30-17.00">15.30-17.00</option>
                                    <option value="16.00-17.30">16.00-17.30</option>
                                    <option value="17.00-18.30">17.00-18.30</option>
                                    <option value="18.30-20.00">18.30-20.00</option>
                                    <option value="19.30-21.00">19.30-21.00</option>
                                </select>
                            </div>
                            <div class="list-peserta-ganti"></div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-sm btn-secondary mt-2 mr-2" data-dismiss="modal">Tutup</button>
                                <input type="submit" value="Simpan" id="btn-badal" class="btn btn-sm btn-primary mt-2">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- Modal presensi -->

<!-- Modal KBM -->
    <div class="modal fade" id="modalKbm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalKbmLabel">Detail KBM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info"><i class="fa fa-info-circle text-info mr-1"></i>Jika Anda salah menginputkan KBM ataupun ingin membatalkan badal, silahkan menghapus KBM dengan memilih gambar <i class="fa fa-trash-alt"></i></div>
                    </div>
                </div>
                <div id="list-kbm"></div>
                
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-sm btn-secondary mt-2 mr-2" data-dismiss="modal">Tutup</button>
                </div>
            </div>
            </div>
        </div>
    </div>
<!-- Modal KBM -->

        <div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12">
                        <?= $this->session->flashdata('pesan');?>
                        </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <?php if(COUNT($kelas)):?>
                    <?php foreach ($kelas as $kelas) :?>
                        <div class="col-12 col-md-3 mb-2">
                            <ul class="list-group shadow">
                                <?php if($kelas['tipe'] == "R"):?>
                                    <li class="list-group-item list-group-item-warning d-flex justify-content-between"><span><i class="fa fa-calendar-day mr-2"></i><?= $kelas['hari'] . " " . $kelas['jam']?></span><span><?= $kelas['tipe']?></span></li>
                                    <li class="list-group-item"><i class="fa fa-book mr-2"></i><?= $kelas['program']?></li>
                                    <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= $kelas['nama_peserta']?></li>
                                <?php elseif($kelas['tipe'] == "PK"):?>
                                    <li class="list-group-item list-group-item-primary d-flex justify-content-between"><span><i class="fa fa-calendar-day mr-2"></i><?= $kelas['hari'] . " " . $kelas['jam']?></span><span><?= $kelas['tipe']?></span></li>
                                    <li class="list-group-item d-flex justify-content-between"><span><i class="fa fa-book mr-2"></i><?= $kelas['program']?></span> 
                                        <?php if(date('d') < 5):?>
                                            <a href="#modalEditProgram" data-toggle="modal" class="modal-edit-program btn btn-sm btn-outline-success" data-id="<?= $kelas['id_kelas']?>|<?=$kelas['nama_peserta']?>|<?= $kelas['program']?>">edit</a></li>
                                        <?php endif;?>
                                    <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= ucwords(strtolower($kelas['nama_peserta']))?></li>
                                <?php elseif($kelas['tipe'] == "PL"):?>
                                    <li class="list-group-item list-group-item-danger d-flex justify-content-between"><span><i class="fa fa-calendar-day mr-2"></i><?= $kelas['hari'] . " " . $kelas['jam']?></span><span><?= $kelas['tipe']?></span></li>
                                    <li class="list-group-item d-flex justify-content-between"><span><i class="fa fa-book mr-2"></i><?= $kelas['program']?></span> 
                                        <?php if(date('d') < 5):?>
                                            <a href="#modalEditProgram" data-toggle="modal" class="modal-edit-program btn btn-sm btn-outline-success" data-id="<?= $kelas['id_kelas']?>|<?=$kelas['nama_peserta']?>|<?= $kelas['program']?>">edit</a></li>
                                        <?php endif;?>
                                    <li class="list-group-item"><i class="fa fa-user-circle mr-2"></i><?= ucwords(strtolower($kelas['nama_peserta']))?></li>
                                <?php endif;?>
                                <li class="list-group-item"><i class="fa fa-map-marker-alt mr-2"></i><?= ucwords(strtolower($kelas['tempat']))?></li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>
                                        <?php if($kelas['kbm'] < 5):?>
                                            <a href="#modalPresensi" data-id="<?= $kelas['id_kelas']?>|<?= $kelas['id_jadwal']?>|<?= $kelas['nama_peserta']?>|<?= $kelas['hari'] . " " . $kelas['jam']?>" data-toggle="modal" class="btn btn-sm btn-primary modal-presensi"><i class="fa fa-user-check"></i></a>
                                            <a href="#modalBadal" data-id="<?= $kelas['id_kelas']?>|<?= $kelas['id_jadwal']?>|<?= $kelas['nama_peserta']?>|<?= $kelas['program']?>|<?= $kelas['hari'] . " " . $kelas['jam']?>" data-toggle="modal" class="btn btn-sm btn-danger modal-badal"><i class="fa fa-exchange-alt"></i></a>
                                        <?php endif;?>
                                        <a href="#modalKbm" data-id="<?= $kelas['id_jadwal']?>" data-toggle="modal" class="btn btn-sm btn-success modal-kbm"><i class="fa fa-list-ol"></i> <span class="badge badge-danger cek"><?= $kelas['kbm']?></span></a>
                                    </span>
                                    <?php if($kelas['ot'] * 30 != 0):?>
                                        <!-- <div class="btn btn-outline-info btn-sm">OT : <?= $kelas['ot'] * 30?></div> -->
                                    <?php endif;?>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach;?>
                <?php else :?>
                    <div class="col-12 col-md-6">
                        <div class="alert alert-warning" role="alert">
                        <i class="fa fa-info-circle mr-1 text-warning"></i> Anda tidak memiliki kelas. Silahkan ambil kelas <a href="<?= base_url()?>kelas/wl">di sini</a>
                        </div>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>

<div class="overlay"></div>

<script>
    $("#kelasku").addClass("active");

    // modal edit program
        $(".modal-edit-program").click(function(){
            let data = $(this).data("id");
            data = data.split('|')
            let id_kelas = data[0];
            let peserta = data[1];
            let program = data[2];

            // $("#id-edit-program").val(id_kelas);
            $("input[name='id_kelas']").val(id_kelas);
            $("#peserta-koor").val(peserta);
            $("#program-kelas").val(program);
        })
    // modal edit program

    // modal badal
        $(".modal-badal").click(function(){
            let data = $(this).data("id");
            data = data.split("|");
            let id_kelas = data[0];
            let id_jadwal = data[1];
            let peserta = data[2];
            let program = data[3];
            
            $("#modalBadalLabel").html("Badal "+data[4]);
            $("#id-jadwal-badal").val(id_jadwal);
            // $("#id-kelas-badal").val(id_kelas);
            $("input[name='id_kelas']").val(id_kelas);
            $("#koor-badal").val(peserta);
            $("#program-badal").val(program);
        })
    // modal badal
    
    // modal presensi
        $(".modal-presensi").click(function(){
            $("#info-presensi").show();
            $("#form-1").hide();
            $("#form-2").hide();
            $("#btn-form-1").removeClass("active");
            $("#btn-form-2").removeClass("active");
            
            let data = $(this).data("id");
            data = data.split("|");
            let id_kelas = data[0];
            let id_jadwal = data[1];
            let peserta = data[2];
            
            $("#modalPresensiLabel").html(data[3]);
            $("#id-jadwal-sesuai").val(id_jadwal);
            // $("#id-kelas-sesuai").val(id_kelas);
            $("input[name='id_kelas']").val(id_kelas);
            $("#koor-sesuai").val(peserta);
            
            $("#id-jadwal-ganti").val(id_jadwal);
            // $("#id-kelas-ganti").val(id_kelas);
            $("input[name='id_kelas']").val(id_kelas);
            $("#koor-ganti").val(peserta);

            $.ajax({
                url: "<?= base_url()?>kelas/get_peserta_aktif",
                data: {id: id_kelas},
                method: "POST",
                dataType: "json",
                async: true,
                success: function(data){
                    let html = `<ul class="list-group"><li class="list-group-item list-group-item-info"><i class="fa fa-users"></i> List Peserta</li>`;
                    for (let i = 0; i < data.length; i++) {
                        html += `<li class="list-group-item" style="text-transform: capitalize"><input type="checkbox" value="`+data[i].id_peserta+`"name="peserta_sesuai[]" id="sesuai`+i+`">
                    <label for="sesuai`+i+`">`+data[i].nama_peserta.toLowerCase()+`</label></li>`
                    }
                    html += `</ul>`;

                    $(".list-peserta-sesuai").html(html);
                    
                    html = `<ul class="list-group"><li class="list-group-item list-group-item-info"><i class="fa fa-users"></i> List Peserta</li>`;
                    for (let i = 0; i < data.length; i++) {
                        html += `<li class="list-group-item" style="text-transform: capitalize"><input type="checkbox" value="`+data[i].id_peserta+`"name="peserta_ganti[]" id="ganti`+i+`">
                                <label for="ganti`+i+`">`+data[i].nama_peserta.toLowerCase()+`</label></li>`
                    }
                    html += `</ul>`;
                    
                    $(".list-peserta-ganti").html(html);
                }
            })
        })
    // modal presensi

    // modal kbm
        $(".modal-kbm").click(function(){
            let id = $(this).data("id");

            $.ajax({
                url: "<?= base_url()?>kelas/get_detail_kbm",
                method: "POST",
                data: {id: id},
                dataType: "json",
                async: true,
                success: function(data){
                    // console.log(data)
                    let html = '';
                    let total = 0;
                    if (data.length != 0){
                        for (let i = 0; i < data.length; i++) {
                            let x = data[i].kbm.tgl;
                            x = x.split("-");
                            let d = x[2];
                            let m = x[1];
                            let y = x[0];
                            let tgl = d+"-"+m+"-"+y;

                            if(data[i].kbm.nip_badal == null){
                                html += `<ul class="list-group mb-2"><li class="list-group-item list-group-item-info d-flex justify-content-between">`+data[i].kbm.hari+`[`+data[i].kbm.jam+`] `+tgl+`<span><a href="<?= base_url()?>kelas/delete_kbm/`+data[i].kbm.id_kbm+`" onclick="return confirm('Anda yakin akan menghapus KBM ini?')"><i class="fa fa-trash-alt"></i></a></span></li>`;
                            } else {
                                html += `<ul class="list-group mb-2"><li class="list-group-item list-group-item-danger d-flex justify-content-between">`+data[i].kbm.hari+`[`+data[i].kbm.jam+`] `+tgl+`<span><a href="<?= base_url()?>kelas/delete_kbm/`+data[i].kbm.id_kbm+`" onclick="return confirm('Anda yakin akan menghapus KBM ini?')"><i class="fa fa-trash-alt"></i></a></span></li>`;
                                html += `<li class="list-group-item">Dibadal : `+data[i].kbm.nama_kpq+`</li>`;
                            }

                            total = parseInt(data[i].peserta_hadir.length + data[i].peserta_tidak_hadir.length)
                            if(total != 0){
                                html += `<li class="list-group-item">Peserta [`+total+`] = hadir [`+data[i].peserta_hadir.length+`] tidak hadir [`+data[i].peserta_tidak_hadir.length+`] </li>`
                            } else {
                                html += `<li class="list-group-item">
                                            <div class="alert alert-warning" role="alert">
                                                <i class="fa fa-info-circle mr-1 text-warning"></i> KBM belum direkap
                                            </div>
                                        </li>`;
                            }

                            html += `</ul>`;
                        }
                    } else {
                        html = `<div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-warning" role="alert">
                                            <i class="fa fa-info-circle mr-1 text-warning"></i> Tidak ada KBM
                                        </div>
                                    </div>
                                </div>`;
                    }

                    $("#list-kbm").html(html);
                }
            })
        })

        $("#form-1").hide();
        $("#form-2").hide();
        $("#btn-form-1").click(function(){
            $("#info-presensi").hide();
            $("#btn-form-1").addClass("active");
            $("#btn-form-2").removeClass("active");
            $("#form-1").show();
            $("#form-2").hide();
        })

        $("#btn-form-2").click(function(){
            $("#info-presensi").hide();
            $("#btn-form-1").removeClass("active");
            $("#btn-form-2").addClass("active");
            $("#form-1").hide();
            $("#form-2").show();
        })
    // modal kbm

    $("#btn-badal").click(function(){
        var c = confirm("Yakin akan mengajukan badal?");
        return c;
    })

    $("#btn-edit-program").click(function(){
        var c = confirm("Yakin akan mengubah program?");
        return c;
    })
</script>