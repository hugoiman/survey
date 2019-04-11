<?php
    $this->load->view('admin/header');
  ?>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                <div class="progress-bar" style="width:100%"></div>
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
          <!-- Bar chart -->
          <div class="panel panel-info">
            <div class="panel-heading">
              <b>Direktorat</b>
            </div>
            <div class="panel-body">

                <div class="box-body">
                  <div id="columnchart_direktorat"></div>
                </div>
                <!-- /.box-body-->

              <!-- /.box -->
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- Bar chart -->
          <div class="panel panel-info">
            <div class="panel-heading">
              <b>Kepangkatan</b>
            </div>
            <div class="panel-body">

                <div class="box-body">
                  <div id="columnchart_pangkat"></div>
                </div>
                <!-- /.box-body-->

              <!-- /.box -->
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <!-- Bar chart -->
          <div class="panel panel-info">
            <div class="panel-heading">
              <b>Usia</b>
            </div>
            <div class="panel-body">
                <div class="box-body">
                  <div id="columnchart_usia"></div>
                </div>
                <!-- /.box-body-->
              <!-- /.box -->
            </div>
          </div>
        </div>
      </div>
    </section>
	</div>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Responden ", { role: "style" } ],
        <?php foreach ($respon_per_direktorat as $data) {
        echo "['Direktorat Utama',  {$data['d_utama']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['Diretorat Teknik & Pengembangan',  {$data['d_teknik_pengembangan']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['Direktorat Operasi',  {$data['d_operasi']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['Direktorat Keuangan & Administrasi', {$data['d_keuangan_administrasi']}, 'rgba(67, 144, 226, 0.65)']";
        } ?>
      ]);
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
        { calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation"
        },2]
      );

      var options = {
        // width: 1000,
        // height: 350,
        bar: {groupWidth: "70%"},
        legend: { position: "none" },
        viewWindow: {
          min: [7, 30, 0],
          max: [17, 30, 0]
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_direktorat"));
      chart.draw(view, options);
    }
  </script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Responden ", { role: "style" } ],
        <?php foreach ($respon_per_pangkat as $data) {
        echo "['Staff sd Sr.Staff',  {$data['staff']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['Supervisor',  {$data['supervisor']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['Assistant Manager',  {$data['asman']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['Manager', {$data['manager']}, 'rgba(67, 144, 226, 0.65)'],";
        echo "['AVP',{$data['avp']}, 'rgba(67, 144, 226, 0.65)']";
        } ?>
      ]);
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
        { calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation"
        },2]
      );

      var options = {
        // width: 1000,
        // height: 350,
        bar: {groupWidth: "70%"},
        legend: { position: "none" },
        viewWindow: {
          min: [7, 30, 0],
          max: [17, 30, 0]
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_pangkat"));
      chart.draw(view, options);
    }
  </script>
  <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Responden ", { role: "style" } ],
        <?php foreach ($respon_per_usia as $data) {
        echo "['<=25 thn',  {$data['u25']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['26 sd 30 thn',  {$data['u30']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['31 sd 35 thn',  {$data['u35']} , 'rgba(67, 144, 226, 0.65)'],";
        echo "['36 sd 40 thn', {$data['u40']}, 'rgba(67, 144, 226, 0.65)'],";
        echo "['>=41 thn', {$data['u41']}, 'rgba(67, 144, 226, 0.65)']";
        } ?>
      ]);
      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
        { calc: "stringify",
          sourceColumn: 1,
          type: "string",
          role: "annotation"
        },2]
      );

      var options = {
        // width: 1000,
        // height: 350,
        bar: {groupWidth: "70%"},
        legend: { position: "none" },
        viewWindow: {
          min: [7, 30, 0],
          max: [17, 30, 0]
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_usia"));
      chart.draw(view, options);
    }
  </script>
		<?php
    $this->load->view('admin/footer');
  ?>
