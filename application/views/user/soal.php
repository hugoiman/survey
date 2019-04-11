<?php
    $this->load->view('user/header');
    $counter = 1;
  ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="alert alert-info" role="alert">
				<p>Info! <br> Mohon masukan data dengan benar.<br> 1 = Sangat Tidak Setuju, 2 = Tidak Setuju, 3 = Ragu-ragu, 4 = Setuju,
					5 = Sangat Setuju.
				</p>
			</div>
		</section>
		<?php foreach ($judul as $title){ ?>
		<section class="content">
				<div class="panel panel-info">
					<div class="panel-heading">
						<b><?php echo $title['judul_kuesioner']; ?></b>
					</div>
					<div class="panel-body">
						<?php } ?>
						<form class="" action="<?php echo base_url('simpan_jawaban'); ?>" method="post">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
								<thead>

										<tr>
											<th></th>
											<th class="col-md-7"></th>
											<th class="col-md-1" style="text-align:center">1</th>
											<th class="col-md-1" style="text-align:center">2</th>
											<th class="col-md-1" style="text-align:center">3</th>
											<th class="col-md-1" style="text-align:center">4</th>
											<th class="col-md-1" style="text-align:center">5</th>
										</tr>
									</thead>

								<?php
								$c = 1;
								$counter = 0;
								foreach($sub as $sub){?>
									<thead>
										<tr>
											<th class="col-md-6" colspan="7"><?php echo $sub['sub_kuesioner'] ?></th>
										</tr>
									</thead>
									<tbody>
											<?php

												$d = "datas".$c;
												foreach ($$d as $data) {
											?>
											<tr>
											<input type="hidden" name="id_sub[<?php $counter ?>]" value="<?php echo $data['id_sub']; ?>">
												<input type="hidden" name="id_kuesioner" value="<?php echo $data['id_kuesioner']; ?>">
												<input type="hidden" name="id_sk[<?php $counter ?>]" value="<?php echo $data['id_sk']; ?>">
												<td>
													<?php echo $counter+1; ?>
												</td>

												<td>
													<?php echo $data['soal_kuesioner']; ?>
												</td>
												<?php if(isset($data['jawaban'])){ ?>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="1" <?php if($data[ 'jawaban']=='1' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="2" <?php if($data[ 'jawaban']=='2' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="3" <?php if($data[ 'jawaban']=='3' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="4" <?php if($data[ 'jawaban']=='4' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="5" <?php if($data[ 'jawaban']=='5' ){ echo
													'checked'; } ?> required> </td>
												<?php } else{ ?>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="1" required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="2" required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="3" required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="4" required> </td>
												<td style="text-align:center"><input type="radio" name="pilihan[<?php echo $counter ?>]" value="5" required> </td>
												<?php } ?>
											</tr>
											<?php $counter++; } ?>
									</tbody>
								<?php $c++;} ?>
								</table>
							</div>
							<button type="submit" class="btn btn-primary" style="float:right">Submit</button>
							<a onclick="window.history.back();return false;" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
						</form>
					</div>
				</div>
		</section>
	</div>
	<!-- /.content-wrapper -->

	<?php
    $this->load->view('user/footer');
  ?>
