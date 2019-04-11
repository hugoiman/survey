<?php
  $data_session = array(
   'tree1' => "kritik saran"
  );
  $this->session->set_userdata($data_session);
  $this->load->view('admin/header');
  $counter = 1;
?>
  <head>
    </style>
  	<!-- bootstrap wysihtml5 - text editor -->
  	<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link href="<?php echo base_url()?>assets/css/bootoast.css" rel="stylesheet" type="text/css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/delete_modal.css">
  </head>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
    <?php foreach ($kritik_saran as $data){ ?>
		<section class="content">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Data Kritik & Saran</b>
				</div>
				<div class="panel-body">
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <div class="mailbox-read-info">

              <h3><b><?php echo $data['subjek'] ?></b></h3>
              <h5>Dari: <?php echo $data['name'] ?> - <?php echo $data['nama_divisi']; ?>
                <span class="mailbox-read-time pull-right">
                  <?php echo date('l, d F Y, H:i', strtotime($data['waktu'])); ?></span></h5>
            </div>
            <!-- /.mailbox-read-info -->

            <!-- /.mailbox-controls -->
            <div class="mailbox-read-message">
              <?php echo $data['saran'] ?>
            </div>
            <!-- /.mailbox-read-message -->
          </div>
		</section>
  <?php } ?>
	</div>
  <!-- Modal HTML -->
  <div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <!-- <div id="confirm_delete" class="modal fade"> -->
    <div class="modal-dialog modal-confirm">
      <div class="modal-content">
        <div class="modal-header">
          <div class="icon-box">
            <i class="fa fa-close"></i>
          </div>
          <h4 class="modal-title">Apakah anda yakin?</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Apakah anda ingin menghapus saran ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
          <a><button type="button" class="btn btn-danger btn-ok">Ya</button></a>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->
  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
	<!-- /.content-wrapper -->

	<?php
  $this->load->view('admin/footer');
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.5.0/js/md5.min.js"></script>
<script src="<?php echo base_url()?>assets/js/bootoast.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- Page Script -->
<script>
  $(function () {
    //Add text editor
    $("#compose-textarea").wysihtml5();
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
