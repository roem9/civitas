<?php
    function sedia($str, $sedia){
        $data = 0;
        if ($sedia != 0){
            foreach ($sedia as $sedia) {
                if($sedia == $str){
                    $data++;
                }
            }
        }
        
        return $data;
    }

    if(!isset($sedia)){
        $sedia = 0;
    }
?>
        <div class="container">
            <?php if( $this->session->flashdata('pesan') ) : ?>
                <div class="row">
                    <div class="col-12">
                        <?= $this->session->flashdata('pesan');?>
                        </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info"><i class="fa fa-info-circle text-info mr-1"></i> Silahkan pilih jadwal yang Anda sanggupi kemudian simpan dengan menekan tombol simpan yang terletak di bagian paling bawah laman ini</div>
                </div>
            </div>
            <form action="<?= base_url()?>kesediaan/add_kesediaan" method="post">
                <div class="row">
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Ahad</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="ahad|07.00" id="ahad 07.00" class="mr-3" <?php if(sedia('ahad 07.00', $sedia) == 1){echo "checked";}?>><label for="ahad 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="ahad|08.30" id="ahad 08.30" class="mr-3" <?php if(sedia('ahad 08.30', $sedia) == 1){echo "checked";}?>><label for="ahad 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="ahad|10.00" id="ahad 10.00" class="mr-3" <?php if(sedia('ahad 10.00', $sedia) == 1){echo "checked";}?>><label for="ahad 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="ahad|13.00" id="ahad 13.00" class="mr-3" <?php if(sedia('ahad 13.00', $sedia) == 1){echo "checked";}?>><label for="ahad 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="ahad|15.30" id="ahad 15.30" class="mr-3" <?php if(sedia('ahad 15.30', $sedia) == 1){echo "checked";}?>><label for="ahad 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="ahad|17.00" id="ahad 17.00" class="mr-3" <?php if(sedia('ahad 17.00', $sedia) == 1){echo "checked";}?>><label for="ahad 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Senin</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="senin|07.00" id="senin 07.00" class="mr-3" <?php if(sedia('senin 07.00', $sedia) == 1){echo "checked";}?>><label for="senin 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="senin|08.30" id="senin 08.30" class="mr-3" <?php if(sedia('senin 08.30', $sedia) == 1){echo "checked";}?>><label for="senin 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="senin|10.00" id="senin 10.00" class="mr-3" <?php if(sedia('senin 10.00', $sedia) == 1){echo "checked";}?>><label for="senin 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="senin|13.00" id="senin 13.00" class="mr-3" <?php if(sedia('senin 13.00', $sedia) == 1){echo "checked";}?>><label for="senin 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="senin|15.30" id="senin 15.30" class="mr-3" <?php if(sedia('senin 15.30', $sedia) == 1){echo "checked";}?>><label for="senin 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="senin|17.00" id="senin 17.00" class="mr-3" <?php if(sedia('senin 17.00', $sedia) == 1){echo "checked";}?>><label for="senin 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Selasa</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="selasa|07.00" id="selasa 07.00" class="mr-3" <?php if(sedia('selasa 07.00', $sedia) == 1){echo "checked";}?>><label for="selasa 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="selasa|08.30" id="selasa 08.30" class="mr-3" <?php if(sedia('selasa 08.30', $sedia) == 1){echo "checked";}?>><label for="selasa 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="selasa|10.00" id="selasa 10.00" class="mr-3" <?php if(sedia('selasa 10.00', $sedia) == 1){echo "checked";}?>><label for="selasa 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="selasa|13.00" id="selasa 13.00" class="mr-3" <?php if(sedia('selasa 13.00', $sedia) == 1){echo "checked";}?>><label for="selasa 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="selasa|15.30" id="selasa 15.30" class="mr-3" <?php if(sedia('selasa 15.30', $sedia) == 1){echo "checked";}?>><label for="selasa 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="selasa|17.00" id="selasa 17.00" class="mr-3" <?php if(sedia('selasa 17.00', $sedia) == 1){echo "checked";}?>><label for="selasa 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Rabu</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="rabu|07.00" id="rabu 07.00" class="mr-3" <?php if(sedia('rabu 07.00', $sedia) == 1){echo "checked";}?>><label for="rabu 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="rabu|08.30" id="rabu 08.30" class="mr-3" <?php if(sedia('rabu 08.30', $sedia) == 1){echo "checked";}?>><label for="rabu 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="rabu|10.00" id="rabu 10.00" class="mr-3" <?php if(sedia('rabu 10.00', $sedia) == 1){echo "checked";}?>><label for="rabu 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="rabu|13.00" id="rabu 13.00" class="mr-3" <?php if(sedia('rabu 13.00', $sedia) == 1){echo "checked";}?>><label for="rabu 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="rabu|15.30" id="rabu 15.30" class="mr-3" <?php if(sedia('rabu 15.30', $sedia) == 1){echo "checked";}?>><label for="rabu 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="rabu|17.00" id="rabu 17.00" class="mr-3" <?php if(sedia('rabu 17.00', $sedia) == 1){echo "checked";}?>><label for="rabu 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Kamis</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="kamis|07.00" id="kamis 07.00" class="mr-3" <?php if(sedia('kamis 07.00', $sedia) == 1){echo "checked";}?>><label for="kamis 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="kamis|08.30" id="kamis 08.30" class="mr-3" <?php if(sedia('kamis 08.30', $sedia) == 1){echo "checked";}?>><label for="kamis 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="kamis|10.00" id="kamis 10.00" class="mr-3" <?php if(sedia('kamis 10.00', $sedia) == 1){echo "checked";}?>><label for="kamis 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="kamis|13.00" id="kamis 13.00" class="mr-3" <?php if(sedia('kamis 13.00', $sedia) == 1){echo "checked";}?>><label for="kamis 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="kamis|15.30" id="kamis 15.30" class="mr-3" <?php if(sedia('kamis 15.30', $sedia) == 1){echo "checked";}?>><label for="kamis 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="kamis|17.00" id="kamis 17.00" class="mr-3" <?php if(sedia('kamis 17.00', $sedia) == 1){echo "checked";}?>><label for="kamis 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Jumat</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="jumat|07.00" id="jumat 07.00" class="mr-3" <?php if(sedia('jumat 07.00', $sedia) == 1){echo "checked";}?>><label for="jumat 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="jumat|08.30" id="jumat 08.30" class="mr-3" <?php if(sedia('jumat 08.30', $sedia) == 1){echo "checked";}?>><label for="jumat 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="jumat|10.00" id="jumat 10.00" class="mr-3" <?php if(sedia('jumat 10.00', $sedia) == 1){echo "checked";}?>><label for="jumat 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="jumat|13.00" id="jumat 13.00" class="mr-3" <?php if(sedia('jumat 13.00', $sedia) == 1){echo "checked";}?>><label for="jumat 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="jumat|15.30" id="jumat 15.30" class="mr-3" <?php if(sedia('jumat 15.30', $sedia) == 1){echo "checked";}?>><label for="jumat 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="jumat|17.00" id="jumat 17.00" class="mr-3" <?php if(sedia('jumat 17.00', $sedia) == 1){echo "checked";}?>><label for="jumat 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4 mb-2">
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-info"><i class="fa fa-calendar-day mr-3"></i>Sabtu</li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="sabtu|07.00" id="sabtu 07.00" class="mr-3" <?php if(sedia('sabtu 07.00', $sedia) == 1){echo "checked";}?>><label for="sabtu 07.00">07.00 - 08.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 60</div></span></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="sabtu|08.30" id="sabtu 08.30" class="mr-3" <?php if(sedia('sabtu 08.30', $sedia) == 1){echo "checked";}?>><label for="sabtu 08.30">08.30 - 10.00</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="sabtu|10.00" id="sabtu 10.00" class="mr-3" <?php if(sedia('sabtu 10.00', $sedia) == 1){echo "checked";}?>><label for="sabtu 10.00">10.00 - 11.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="sabtu|13.00" id="sabtu 13.00" class="mr-3" <?php if(sedia('sabtu 13.00', $sedia) == 1){echo "checked";}?>><label for="sabtu 13.00">13.00 - 14.30</label></li>
                            <li class="list-group-item"><input type="checkbox" name="sedia[]" value="sabtu|15.30" id="sabtu 15.30" class="mr-3" <?php if(sedia('sabtu 15.30', $sedia) == 1){echo "checked";}?>><label for="sabtu 15.30">15.30 - 17.00</label></li>
                            <li class="list-group-item d-flex justify-content-between"><span><input type="checkbox" name="sedia[]" value="sabtu|17.00" id="sabtu 17.00" class="mr-3" <?php if(sedia('sabtu 17.00', $sedia) == 1){echo "checked";}?>><label for="sabtu 17.00">17.00 - 18.30</label></span><span><div class="btn btn-sm btn-outline-success">OT: 90</div></span></li>
                        </ul>
                    </div>
                    
                    <div class="col-12">
                        <input type="submit" value="Simpan" class="btn btn-primary btn-md btn-block" id="btn-simpan">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="overlay"></div>
<script>
    $("#kesediaan").addClass("active");
    $("#btn-simpan").click(function(){
        var c = confirm('Yakin akan menyimpan data kesediaan mengajar?')
        return c;
    })
</script>

