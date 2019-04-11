<?php
  $data_session = array(
   'tree1' => "informasi",
   'tree2'=> "daftar informasi"
  );
  $this->session->set_userdata($data_session);
  $this->load->view('admin/header');
  $counter = 1;
?>
  <head>
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
    <?php foreach ($informasi as $data){ ?>
		<section class="content" id="info">
      <form action="<?php echo base_url(); ?>c_admin/simpan_feedback_informasi" method="post" enctype="multipart/form-data">
  			<div class="panel panel-info">
  				<div class="panel-heading">
  					<b>Informasi</b>
  				</div>
  				<div class="panel-body">
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-read-info">
                <input type="hidden" id="id_informasi" name="id_informasi" value="<?php echo $data['id_informasi']; ?>">
                <h3><b><?php echo $data['judul'] ?></b></h3>
                <h5>Status: <?php echo $data['status'] ?>
                  <span class="mailbox-read-time pull-right">Updated:
                    <?php echo date('l,d F Y, H:i:s', strtotime($data['waktu'])); ?></span></h5>
              </div>
              <!-- /.mailbox-read-info -->
              <div class="mailbox-controls with-border text-right">
                <div class="btn-group">
                  <button type="button" id="edit" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Edit">
                    <i class="fa fa-edit"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" role="dialog" aria-hidden="true" data-toggle="modal" title="Hapus" data-target="#confirm_delete">
                <i class="fa fa-trash-o"></i></button>
              </div>

              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <?php echo $data['informasi'] ?>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer" <?php if ($data['file'] == ''){ echo "hidden";} ?>>
              <ul class="mailbox-attachments clearfix">
                <li>

                    <?php
                      $info = new SplFileInfo($data['file']);
                      $ext = $info->getExtension();
                      switch ($ext) {
                        case 'jpg': echo '<span class="mailbox-attachment-icon has-img"><img src="'.base_url().'assets/file_informasi/'.$data['file'].'" alt="Attachment">';break;
                        case 'jpeg': echo '<span class="mailbox-attachment-icon has-img"><img src="'.base_url().'assets/file_informasi/'.$data['file'].'" alt="Attachment">';break;
                        case 'docx': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i>';break;
                        case 'pptx': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-powerpoint-o"></i>';break;
                        case 'xls': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i>';break;
                        case 'pdf': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i>';break;
                        case 'rar': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i>';break;
                        case 'zip': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i>';break;
                        default: echo '<span class="mailbox-attachment-icon"><i class="fa fa-file"></i>';break;
                      }
                    ?>
                    </span>
                  <div class="mailbox-attachment-info">
                    <a href="<?php echo base_url()?>assets/file_informasi/<?php echo $data['file']; ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo substr($data['file'],0,16); ?>...</a>
                      <!-- <span class="mailbox-attachment-size">
                        1,245 KB -->
                        <a href="<?php echo base_url()?>assets/file_informasi/<?php echo $data['file']; ?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                      <!-- </span> -->
                  </div>
                </li>
              </ul>
            </div>
            <!-- /.box-footer -->
  				</div>
  			</div>
        <div id="warning"></div>
        <div id="success"></div>
      </form>
  	</section>

    <?php foreach ($informasi as $data){ ?>
    <form id="form" hidden action="<?php echo base_url(); ?>admin/edit_informasi" method="post" enctype="multipart/form-data">
      <input type="hidden" name="nipg" id="nipg" value="<?php echo $this->session->userdata("nipg"); ?>">
      <input type="hidden" name="id_informasi" id="id_informasi" value="<?php echo $data['id_informasi']; ?>">
      <input type="hidden" name="old_file" id="old_file" value="<?php echo $data['file']; ?>">
      <input type="text" name="str_hapus" id="str_hapus">
		  <section class="content">
				<div class="panel panel-info">
					<div class="panel-heading">
						<b>Edit Informasi</b>
					</div>
					<div class="panel-body">
            <div class="form-group col-md-9">
              <label>Judul</label>
              <input type="text" class="form-control" id="judul" value="<?php echo $data['judul']; ?>" name="judul" required>
            </div>
            <div class="form-group col-md-3">
              <label>Status</label>
              <select id="status" name="status" class="form-control">
                <option value="Aktif" <?php if ($data['status'] == "Aktif") { echo "selected"; } ?>> Aktif</option>
                <option value="Tidak Aktif" <?php if ($data['status'] == "Tidak Aktif") { echo "selected"; } ?>> Tidak Aktif</option>
              </select>
            </div>
						<div class="form-group">
							<label>Informasi</label>
              <textarea id="compose-textarea" class="form-control informasi" name="informasi" style="height: 200px"><?php echo $data['informasi']; ?></textarea>
						</div>
            <div class="box-footer" id="attachment" <?php if ($data['file'] == ''){ echo "hidden";} ?>>
              <ul class="mailbox-attachments clearfix">
                <li>
                    <?php
                      $info = new SplFileInfo($data['file']);
                      $ext = $info->getExtension();
                      switch ($ext) {
                        case 'jpg': echo '<span class="mailbox-attachment-icon has-img"><img src="'.base_url().'assets/file_informasi/'.$data['file'].'" alt="Attachment">';break;
                        case 'jpeg': echo '<span class="mailbox-attachment-icon has-img"><img src="'.base_url().'assets/file_informasi/'.$data['file'].'" alt="Attachment">';break;
                        case 'docx': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i>';break;
                        case 'pptx': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-powerpoint-o"></i>';break;
                        case 'xls': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-excel-o"></i>';break;
                        case 'pdf': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i>';break;
                        case 'rar': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i>';break;
                        case 'zip': echo '<span class="mailbox-attachment-icon"><i class="fa fa-file-zip-o"></i>';break;
                        default: echo '<span class="mailbox-attachment-icon"><i class="fa fa-file"></i>';break;
                      }
                    ?>
                  </span>
                  <div class="mailbox-attachment-info">
                    <a href="<?php echo base_url()?>assets/file_Informasi/<?php echo $data['file']; ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> <?php echo substr($data['file'],0,16); ?>...</a>
                      <!-- <span class="mailbox-attachment-size">
                        1,245 KB -->
                        <button type="button" class="btn btn-default btn-xs pull-right" role="dialog" aria-hidden="true" data-toggle="modal" title="Hapus File" data-target="#confirm_delete_file">
                        <i class="fa fa-trash-o"></i></button>
                  </div>
                </li>
              </ul>
            </div>
            <div class="form-group" id="box-file" <?php if ($data['file'] != ''){ echo "hidden";} ?>>
              <div class="btn btn-default">
                <!-- <i class="fa fa-paperclip"></i> Attachment -->
                <input type="file" name="file" id="file">
              </div>
              <button type="button"  id="reset" class="btn btn-default"><i class="fa fa-times"></i></button>
              <p class="help-block">Max. 2MB</p>
            </div>
            <div class="box-footer">
              <button type="button" class="btn btn-danger" id="batal"><i class="fa fa-times"></i> Batal</button>
              <div class="pull-right">
                <button type="submit" class="btn btn-primary" id="submit" name="submit"><i class="fa fa-paper-plane-o"></i> Edit</button>
              </div>
            </div>
					</div>
				</div>
		  </section>
    </form>
  <?php } ?>
  </div>
  <?php } ?>
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
          <p>Apakah anda ingin menghapus informasi ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
          <a><button type="button" class="btn btn-danger btn-ok">Ya</button></a>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm_delete_file" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          <p>Apakah anda ingin menghapus file ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="hapus_file">Ya</button>
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
<script>
  $(document).ready(function () {
    $("#file").change(function () {
      $('#str_hapus').val("");
    });
    $('#edit').click(function () {
      $('#form').show();
      $('#info').hide();
    });
    $('#batal').click(function () {
      $('#form').hide();
      $('#info').show();
    });
    $('#hapus_file').click(function () {
      $('#attachment').hide();
      $('#box-file').show();
      $('#str_hapus').val("hapus file");
    });
    $('#reset').click(function () {
      $('#file').val('')
      $('#str_hapus').val("hapus file");
    });
    $('.btn-ok').click(function () {
      var id_informasi = $('#id_informasi').val();
      bootoast.toast({
        message: 'Informasi berhasil dihapus',
        type: 'success'
      });
      $.ajax({
        url: "<?php echo base_url('admin/hapus_informasi/');?>"+id_informasi,
        success: function (respons) {
          setTimeout(function() {
            window.location.href= '<?php echo base_url('admin/daftar_informasi'); ?>';
          }, 1500);
        },
        error:function(error){
          alert("Informasi gagal dihapus");
        }
      })
    });
  });
</script>
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
