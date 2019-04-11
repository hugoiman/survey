<?php
 $data_session = array(
	'tree1' => "saran"
);
$this->session->set_userdata($data_session);
  $this->load->view('user/header');
  $counter = 1;
?>
  <head>
  	<!-- bootstrap wysihtml5 - text editor -->
  	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link href="<?php echo base_url()?>assets/css/bootoast.css" rel="stylesheet" type="text/css">
  </head>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content">
				<div class="panel panel-info">
					<div class="panel-heading">
						<b>Kritik & Saran</b>
					</div>
					<div class="panel-body">
            <div class="form-group">
							<label>Subjek</label>
							<select id="subjek" name="subjek" class="form-control select2">
                  <?php foreach($sub as $subkues){?>
                  <option value="<?php echo $subkues['sub_kuesioner'] ?>"><?php echo $subkues['sub_kuesioner'] ?></option>
                  <?php }?>
                  <option  data-divider="true" disabled>______________</option>
                  <option value="Lainnya">Lainnya</option>
              </select>
							<!-- <input class="form-control" id="subjek" type="text" name="subjek" placeholder="Tuliskan Subjek" required> -->
						</div>
						<div class="form-group">
							<label>Saran</label>
							<textarea class="form-control" id="saran" rows="5" placeholder="Ketik kritik dan saran anda..." required></textarea>
						</div>
							<br>
							<button type="submit" class="btn btn-primary" id="submit" name="submit" style="float:right">Submit</button>
							<a onclick="window.history.back();return false;" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
              <div id="warning"></div>
              <div id="success"></div>
					</div>
				</div>
		</section>
	</div>
	<!-- /.content-wrapper -->

	<?php
  $this->load->view('user/footer');
?>
<script>
$(document).ready(function () {
	$(document).on('click', '#submit', function () {
		var subjek = $('#subjek').val();
		var saran = $('#saran').val();
    var nipg = $('#nipg').val();
		if(saran == '' || subjek ==''){
      bootoast.toast({
				message: 'Silahkan lengkapi form terlebih dahulu.',
				type: 'warning'
			});
			return false;
    }else{
  		$.ajax({
  			url: "<?php echo base_url('simpan_kritik_saran'); ?>",
  			method: "get",
  			data: {'subjek':subjek,'saran':saran, 'nipg':nipg},
  			dataType: "text",
  			success: function (data) {
          bootoast.toast({
            message: 'Kritik dan saran anda terkirim.',
            type: 'success'
          });
          setTimeout(function () {
            location.reload();
          }, 1500);
  			},error: function (error) {
          bootoast.toast({
            message: 'Saran gagal diajukan.',
            type: 'danger'
          });
        }
  		})
    }
	});
});

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.5.0/js/md5.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootoast.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
