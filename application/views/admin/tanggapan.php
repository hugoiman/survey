<?php
    $this->load->view('admin/header');
  ?>
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php
        foreach ($info_kuesioner as $data) {
          echo $data['judul_kuesioner'];
        ?>,<small> <?php echo $data['periode']; ?></small>
        <?php
        }
        ?>
      </h1>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
          <?php foreach ($info_kuesioner as $data){ ?>
          <a href="<?php echo base_url('admin/informasi-responden/');echo $data['id_kuesioner']; ?>">
          <?php } ?>
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Responden</span>
              <span class="info-box-number">
                <?php
                echo $jumlah_responden;
                ?>
              </span>

              <div class="progress">
                <div class="progress-bar" style="width:0%"></div>
              </div>
                  <span class="progress-description">
                    <!-- 70% Increase in 30 Days -->
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <!-- <a href="informasi-statistik"> -->
          <?php foreach ($info_kuesioner as $data){ ?>
          <a href="<?php echo base_url('admin/informasi-statistik/');echo $data['id_kuesioner']; ?>">
          <?php } ?>
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-bar-chart-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Statistik</span>
              <span class="info-box-number">
                <?php
                  echo $statistik_sub;
                ?>
              </span>

              <div class="progress">
                <div class="progress-bar" style="width: 0%"></div>
              </div>
                  <span class="progress-description">
                    <!-- 70% Increase in 30 Days -->
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <?php foreach ($info_kuesioner as $data){ ?>
          <a href="<?php echo base_url('admin/informasi-tanggapan/');echo $data['id_kuesioner']; ?>">
          <?php } ?>
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-quote-left"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tanggapan</span>
              <span class="info-box-number">
                <?php
                echo $jumlah_responden;
                ?>
              </span>

              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
                  <span class="progress-description">
                    <!-- 70% Increase in 30 Days -->
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          </a>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <!-- Bar chart -->
          <div class="panel panel-info">
        <div class="panel-heading">
          <b>Daftar Tanggapan</b>
        </div>
        <div class="panel-body">
          <div class="box-body">
            <div class="table-responsive">
  					<div class="panel-body">
  						<form class="form" action="<?php echo base_url('admin/data_tanggapan');?>" method="post">
                <div class="row">
                  <div class="col-md-4 col-xs-9">
                      <div class="form-group">
                        <select class="form-control select2" name="nipg" style="width: 100%;">
                          <?php foreach ($data_responden as $data_responden){
                            if ($data_responden['nipg'] == $nipg){ ?>
                              <option selected value="<?php echo $data_responden['nipg'] ?>"><?php echo $data_responden['name']?></option>
                            <?php }
                            else{ ?>
                              <option value="<?php echo $data_responden['nipg'] ?>"><?php echo $data_responden['name']?></option>
                          <?php }
                          } ?>
                        </select>

                          <input type="hidden" name="id_kuesioner" value="<?php echo $id_kuesioner; ?>">

                      </div>
                    </div>
                    <div class="col-md-1 col-xs-1">
                      <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                  </div>
    						</form>

                  <div class="box-body">
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
												<td style="text-align:center"><input disabled type="radio" name="pilihan[<?php echo $counter ?>]" value="1" <?php if($data[ 'jawaban']=='1' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input disabled type="radio" name="pilihan[<?php echo $counter ?>]" value="2" <?php if($data[ 'jawaban']=='2' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input disabled type="radio" name="pilihan[<?php echo $counter ?>]" value="3" <?php if($data[ 'jawaban']=='3' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input disabled type="radio" name="pilihan[<?php echo $counter ?>]" value="4" <?php if($data[ 'jawaban']=='4' ){ echo
													'checked'; } ?> required> </td>
												<td style="text-align:center"><input disabled type="radio" name="pilihan[<?php echo $counter ?>]" value="5" <?php if($data[ 'jawaban']=='5' ){ echo
													'checked'; } ?> required> </td>
												<?php } ?>
											</tr>
											<?php $counter++; } ?>
									</tbody>
								<?php $c++;} ?>
								</table>
                </div>
  					  </div>
            </div>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
	</div>
  <script src="<?php echo base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
  <!-- <script src="jquery-1.11.2.min.js"></script> -->
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
  </script>
		<?php
    $this->load->view('admin/footer');
  ?>
