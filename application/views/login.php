<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login | PGAS Solution</title>

	<link rel="icon" href="<?php echo base_url()?>/assets/dist/img/favicon.ico" type="image/ico">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" id="body">
<div class="login-box">
  <div class="login-logo" style="style: 50px">
  <center>
  <div>
						<img src="<?php echo base_url()?>assets/dist/img/favicon.png" class="img-circle" style="width: 150px; height: 150px;" alt="User Image">
					</div>
          </center>
  </div>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <span id="result"></span>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" id="uname" placeholder="NIPG" name="nipg" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="pass" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script> -->
<script>
$(document).ready(function () {
  var input = document.getElementById("body");
  input.addEventListener("keyup", function(event) {
      event.preventDefault();
      if (event.keyCode === 13) {
          document.getElementById("submit").click();
      }
  });
	$(document).on('click', '#submit', function (){
		var nipg = $('#uname').val();
    var pass = $('#pass').val();
    if(nipg == '' || pass == '')
        {
            $('#result').html("<div class='alert alert-warning alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='icon fa fa-warning'></i>Isi login terlebih dahulu</div>");
						return false;
        }
		$.ajax({
			url: "<?php echo base_url('auth/login')?>",
			method: "POST",
			data: {nipg:nipg, password:pass},
			dataType: "text",
			success: function (data) {
			  if (data == 'wrong'){
          $('#result').html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='icon fa fa-danger'></i>Username / password salah</div>");
        }else if(data == "admin"){
          window.location = '<?php echo base_url('admin/daftar_karyawan'); ?>';
        }else if(data == "karyawan"){
          window.location = '<?php echo base_url('daftar_kuesioner'); ?>';
        }else if (data == "Tidak Aktif") {
          $('#result').html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button></i>Status anda <b>Tidak Aktif.</b><br>Anda tidak diizinkan melakukan login</div>");
        }
      }
		})
	});
});

</script>
</body>
</html>
