<?php
 $data_session = array(
    'tree1' => "kuesioner"
  );
  $this->session->set_userdata($data_session);
    $this->load->view('user/header');
  ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>List kuesioner</b>
				</div>
				<div class="panel-body">
						<?php if($jml_kuesioner == 0){
							echo '<center>Tidak ada kuesioner</center>';
						}else{
          for($i=1; $i<=$jml_kuesioner; $i++){
              $a = "kuesioner".$i;
              $result = $$a;
              $d = "judul".$i;
              $resultJudul = $$d;
              $judul = "";
              $id_kuesioner = "";
              foreach($resultJudul->result_array() as $cc){
                  $judul = $cc['judul_kuesioner'];
                  $id_kuesioner = $cc['id_kuesioner'];
                  $periode = $cc['periode'];
              }
              foreach($result->result_array() as $bb){
                if($bb['isset']==1){?>
						<a href="<?php echo base_url('kuesioner/'); echo $id_kuesioner; ?>" type="button" id="judul_kuesioner" class="btn btn-default btn-block">
							<?php echo $judul; ?> - <?php echo $periode; ?> <span id="judul_result" class="glyphicon glyphicon-ok"></span> </a>
						<?php }else{ ?>
						<a href="<?php echo base_url('kuesioner/'); echo $id_kuesioner; ?>" type="button" id="judul_kuesioner" class="btn btn-default btn-block">
							<?php echo $judul; ?> - <?php echo $periode; ?> </a>
						<?php }
          }
		  }
		}
          ?>
				</div>
			</div>
		</section>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#judul_kuesioner').change(function () {
				var judul_kuesioner = $('#judul_kuesioner').val();
				$.ajax({
					url: "<?php echo base_url(); ?>c_user/cek_judul_terbaca",
					type: "POST",
					data: {
						id_kuesioner: judul_kuesioner
					},
					success: function (data) {
						$('#judul_result').html(data);
					}
				});
			});
		});

	</script>
	<!-- /.content-wrapper -->

	<?php
    $this->load->view('user/footer');
  ?>
