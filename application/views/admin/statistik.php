  <?php
    $this->load->view('admin/header');
  ?>
  <head>
  	<meta charset="utf-8">
  	<title>Pie Chart with Google Chart</title>
    <!--js google chart-->
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
  </head>
  <script type="text/javascript">
    google.load('visualization', '1', {packages: ['corechart']});
  </script>
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

    <?php
      $z = $jumlah;
      $jml = $jumlah_responden;
    ?>
    <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
          <?php foreach ($info_kuesioner as $data){ ?>
            <a href="<?php echo base_url('admin/informasi-responden/');echo $data['id_kuesioner']; ?>">
          <?php } ?>
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-group"></i>
                </span>
                <div class="info-box-content">
                  <span class="info-box-text">Responden</span>
                  <span class="info-box-number">
                  <?php
                    echo $jumlah_responden;
                  ?>
                  </span>
                  <div class="progress">
                    <div class="progress-bar" style="width:0%">
                    </div>
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
        </div>
        <!-- /.row -->


      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-info">
            <div class="panel-heading">
              <b>Statistik</b>
            </div>
            <div class="panel-body">
              <div class="box-body">
                <form class="form" action="<?php echo base_url('admin/data_statistik');?>" method="post">
                  <div class="row">
                    <div class="col-md-3 col-xs-10">
                      <div class="form-group">
                        <select class="form-control" id="direktorat" name="direktorat">
                          <option <?php if($direktorat == 'Direktorat'){echo 'selected';}?> value="Direktorat">Semua Direktorat</option>
                          <option <?php if($direktorat == 'Direktorat Utama'){echo 'selected';}?> value="Direktorat Utama">Direktorat Utama</option>
                          <option <?php if($direktorat == 'Direktorat Teknik dan Pengembangan'){echo 'selected';}?> value="Direktorat Teknik dan Pengembangan">Direktorat Teknik dan Pengembangan</option>
                          <option <?php if($direktorat == 'Direktorat Operasi'){echo 'selected';}?> value="Direktorat Operasi">Direktorat Operasi</option>
                          <option <?php if($direktorat == 'Direktorat Keuangan dan Administrasi'){echo 'selected';}?> value="Direktorat Keuangan dan Administrasi">Direktorat Keuangan dan Administrasi</option>
                         </select>
                      </div>
                    </div>
                    <?php foreach ($info_kuesioner as $data){ ?>
                    <input type="hidden" name="id_kuesioner" value="<?php echo $data['id_kuesioner']; ?>">
                    <?php } ?>
                    <div>
                      <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                      </button>
                    </div>
                    <div class="col-md-1" col-xs-6" style="float:right;margin: -33px 60px 0 0">
                      <?php if($isEmpty->num_rows() != 0){?>
                      <a onclick="window.open('<?php echo base_url('admin/cetak-pdf/'.$data['id_kuesioner'].'/'.rawurlencode($direktorat).'')?>', '', 'width=640, height=480, menubar=yes,location=yes,scrollbars=yes, resizeable=yes, status=yes, copyhistory=no,toolbar=no');" href="#"  class="btn btn-default"> <i class="fa fa-print fa-lg"></i> Cetak PDF</a>
                    <?php } ?>
                    </div>
                    <div class="col-md-1" col-xs-6" style="float:right;margin: -33px -30px 0 0">
                      <a href="<?php echo base_url('admin/cetak-excel/');echo $data['id_kuesioner']; ?>"  class="btn btn-default" style="float:right; margin:0 15px 0 0"> <i class="fa fa-download"> </i> Export to Excel</a>
                    </div>
                  </div>
                </form>

                <?php for($i=1; $i<=$z; $i++){
                $a = "statistik".$i;
                $result = $$a; ?>
                <div class="col-md-6">
                  <!-- BAR CHART -->
                  <div class="box box-success">
                    <div class="box-header with-border">
                    <?php  foreach ($result->result_array() as $row) {
                              extract($row);?>
                      <h3 class="box-title"><?php echo $sub_kuesioner; ?></h3>
                    <?php } ?>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                      </div>
                    </div>
                    <div class="box-body">
                      <div id="visualization<?php echo $i; ?>" style="height: 300px; width: 100%;"></div>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
              <?php } ?>
              </div>
            </div>
          </div>
        <!-- /.col (LEFT) -->
        </div>
      <!-- /.row -->
    </div>
    </section>
    <!-- /.content -->
  </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
   $(document).on('change', '#direktorat', function(){
        var direktorat = $(this).val();
        $("#dir").val(direktorat);

    });
  </script>
  <?php
    for($i=1; $i<=$z; $i++){
      $a = "statistik".$i;
      $result = $$a;
        //get number of rows returned
  ?>
      <script type="text/javascript">
        function drawVisualization() {
          // Create and populate the data table.
          var data = google.visualization.arrayToDataTable([
            ['Jawab', 'Jumlah'],
            <?php
            foreach ($result->result_array() as $row) {
              extract($row);
                echo "['Sangat Tidak Setuju', $jawaban1],";
                echo "['Tidak Setuju', $jawaban2],";
                echo "['Ragu-ragu', $jawaban3],";
                echo "['Setuju', $jawaban4],";
                echo "['Sangat Setuju', $jawaban5],";
                $title = "";
            } ?>
          ]);
          // Create and draw the visualization.
          new google.visualization.PieChart(document.getElementById('visualization<?php echo $i; ?>')).
          draw(data, {title:"<?php echo $title; ?>"});
        }

        google.setOnLoadCallback(drawVisualization);
      </script>
      <?php
    }
    ?>
  <?php
    $this->load->view('admin/footer');
  ?>
