<?php
 $data_session = array(
  'tree1' => "password"
);
$this->session->set_userdata($data_session);
  $this->load->view('admin/header');
  $counter = 1;
?>
  <head>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo base_url()?>assets/css/bootoast.css" rel="stylesheet" type="text/css">
  </head>
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content">
				<div class="panel panel-info">
					<div class="panel-heading">
						<b>Ganti Password</b>
					</div>
					<div class="panel-body">
            <div>
                <div id="warning"></div>
                <div id="success"></div>
              </div>
            <form class="form-horizontal">
              <!-- <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Password Lama</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password_lama" name="password_lama" required>
                </div>
              </div> -->
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Password Baru</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password_baru" name="password_baru" required>
                </div>
              </div>
              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Konfirmasi Pass</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="konfirmasi_password" onkeyup="cekPass();" name="konfirmasi_password" required>
                </div>
              </div>
              <div id="cek">
              </div>
                            <div class="form-group">
                <div class="col-sm-12">
                  <p class="btn btn-primary btn-sm pull-right" id="simpan_password">Simpan</p>
                </div>
              </div>
            </form>
					</div>
				</div>
		</section>
	</div>
	<!-- /.content-wrapper -->

  <!-- <script src="jquery.toaster.js"></script> -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>
  function cekPass() {
      var x = $("#password_baru").val();
      var y = $("#konfirmasi_password").val();
      if (x!=y){
        // $("#tdk_cocok").fadeOut();
        // $("#cocok").fadeIn();
        $("#cek").html("<div class='alert alert-danger alert-dismissible'></i> Password tidak cocok!</div>");
      }else{
        // $("#cocok").fadeOut();
        // $("#tdk_cocok").fadeIn();
        $("#cek").html("<div class='alert alert-success alert-dismissible'><i class='icon fa fa-check'></i> Password cocok!</div>");
      }
  }
  </script>
  <script>
    $(document).ready(function(){
      $("#simpan_password").click(function(){
        var nipg = $("#nipg").val();
        var password_baru = $("#password_baru").val();
        var konfirmasi_password = $("#konfirmasi_password").val();
        var jumlah_pass_baru = $('#password_baru').val().length;
        var jumlah_konfirmasi_pass = $('#konfirmasi_password').val().length;
        var encrypt_pass = md5(password_baru);
        if (password_baru == "" || konfirmasi_password == "") {
          bootoast.toast({
            message: 'Harap lengkapi isi form.',
        	  type: 'warning'
          });
        }
        if(konfirmasi_password != password_baru){
          bootoast.toast({
            message: 'Konfirmasi password tidak sesuai.',
        	  type: 'warning'
          });
        }
        if(jumlah_pass_baru < 6 || jumlah_pass_baru > 18 || jumlah_konfirmasi_pass < 6 || jumlah_konfirmasi_pass > 18){
          bootoast.toast({
            message: 'Password harus berjumlah 6-18 karakter.',
        	  type: 'warning'
          });
        }
        if(konfirmasi_password != "" && konfirmasi_password == password_baru &&
          jumlah_pass_baru >= 6 && jumlah_pass_baru <= 18 && jumlah_konfirmasi_pass >= 6 && jumlah_konfirmasi_pass <= 18){
          $.ajax({
            url:"<?php echo base_url('admin/edit_password'); ?>",
            type : "post",
            data : {'nipg': nipg,'password_baru': password_baru},
            success:function(respons){
              bootoast.toast({
                message: 'Berhasil ganti password.',
                type: 'success'
              });
              $("#password_baru").val("");
              $("#konfirmasi_password").val("");
            },
            error:function(error){
              alert("gagal ubah password");
            }
          });
        }
      });
    });
  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.5.0/js/md5.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/bootoast.min.js"></script>

  <?php
    $this->load->view('admin/footer');
  ?>
