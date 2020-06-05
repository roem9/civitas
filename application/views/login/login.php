<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-5 col-md-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">أَهْلًا وَ سَهْلًا</h1>
                  </div>
                    <?php if( $this->session->flashdata('pesan') ) : ?>
                        <div class="row">
                            <div class="col-12">
                                <?= $this->session->flashdata('pesan');?>
                                </div>
                        </div>
                    <?php endif; ?>
                    <form action="" method="POST">
                        <div class="form-group">
                          <!-- <input type="text" class="form-control form-control-user" placeholder="Masukkan NIK" name="username" required> -->
                          <?= form_input('username', set_value('username', ''), 'class="form-control form-control-user" placeholder="NIK" required');?>
                        </div>
                        <div class="input-group mb-3">
                          <!-- <input type="password" class="form-control form-control-user" placeholder="Masukkan password" name="password" required> -->
                          <?= form_password('password', set_value('password', ''), 'id="password" class="form-control form-control-user" placeholder="Password" required');?>
                          <div class="input-group-append">
                            <span class="input-group-text bg-light" id="hidePass"><div class="i fa fa-eye-slash"></div></span>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text bg-light" id="showPass"><div class="i fa fa-eye"></div></span>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fa fa-sign-in-alt mr-1"></i> <b>Masuk</b></button>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    $("#hidePass").hide();
    
    $("#showPass").click(function(){
      $("#password").prop('type', 'text');
      $("#showPass").hide();
      $("#hidePass").show()
    })
    
    $("#hidePass").click(function(){
      $("#password").prop('type', 'password');
      $("#showPass").show();
      $("#hidePass").hide()
    })
  </script>