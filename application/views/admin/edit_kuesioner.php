  <?php
    $this->load->view('admin/header');
  ?>
  <head>
    <link href="<?php echo base_url()?>assets/css/bootoast.css" rel="stylesheet" type="text/css">
  </head>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="panel panel-info">
        <div class="panel-heading">
           <b>Edit Kuesioner</b>
        </div>
        <div class="panel-body">
        <form action="<?php echo base_url('admin/edit_kuesioner'); ?>" method="POST" >
          <div class="form-group">
            <label>Judul Kuesioner</label>
            <?php
            foreach($judul as $title){
            ?>
            <div class="id-kuesioner" id="<?php echo $title['id_kuesioner']; ?>"></div>
            <input type="hidden" name="id_kuesioner" value="<?php echo $title['id_kuesioner']; ?>">

            <div class="row">
              <div class="col-md-10">
                <input class="form-control" type="text" name="judul" value="<?php echo $title['judul_kuesioner']; ?>" required>
              </div>
            </div>
            <br>
            <div class="form-group">
            <label>Periode</label>
            <div class="input-group date col-md-3">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            <input type="text" name="periode" value="<?php echo $title['periode'];?>" class="form-control pull-right" id="datepicker" data-date-format='MM yyyy' >
          </div>
          <br>
          <?php
          $div1 = '';$div2 = '';$div3 = '';$div4 = '';$div5 = '';$div6 = '';$div7 = '';$div8 = '';
          $div9 = '';$div10 = '';$div11 = '';$div12 = '';$div13 = '';
              foreach($check as $checkbox){
                if ($checkbox['id_divisi']==1){$div1 = 'checked';}
                else if ($checkbox['id_divisi']==2){$div2 = 'checked';}
                else if ($checkbox['id_divisi']==3){$div3 = 'checked';}
                else if ($checkbox['id_divisi']==4){$div4 = 'checked';}
                else if ($checkbox['id_divisi']==5){$div5 = 'checked';}
                else if ($checkbox['id_divisi']==6){$div6 = 'checked';}
                else if ($checkbox['id_divisi']==7){$div7 = 'checked';}
                else if ($checkbox['id_divisi']==8){$div8 = 'checked';}
                else if ($checkbox['id_divisi']==9){$div9 = 'checked';}
                else if ($checkbox['id_divisi']==10){$div10 = 'checked';}
                else if ($checkbox['id_divisi']==11){$div11 = 'checked';}
                else if ($checkbox['id_divisi']==12){$div12 = 'checked';}
                else if ($checkbox['id_divisi']==13){$div13 = 'checked';}
              }
              ?>
          <div class="form-group">
  					<label>Target Responden</label>
              <div class="checkbox">
                <label>
                  <input type="checkbox" id="ceksemua">Semua Divisi
                </label>
              </div>
              <div class="row">
                <div class="col-md-3 bg">
                  <small><b>Direktorat Utama</b></small>
                </div>
                <div class="col-md-3 bg">
                  <small><b>Direktorat Teknik & Pengembangan</b></small>
                </div>
                <div class="col-md-3 bg">
                  <small><b>Direktorat Operasi</b></small>
                </div>
                <div class="col-md-3 bg">
                  <small><b>Direktorat Keuangan & Administrasi</b></small>
                </div>
              </div>
              <div id="boxes">
                <div class="row">
                  <div class="col-md-3 bg">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="1" <?php echo $div1; ?>>
                        Divisi K3PL & Pengamanan Perusahaan
                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="2" <?php echo $div2; ?>>
                        Sekretaris Perusahaan
                      </label>
                    </div>
                    <div class="checkbox" >
                      <label>
                        <input type="checkbox" name="divisi[]" value="3" <?php echo $div3; ?>>
                        Divisi Audit
                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 bg">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="4" <?php echo $div4; ?>>
                        Divisi Manajemen Proyek EPC

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="5" <?php echo $div5; ?>>
                        Koordinator Pelaksana Proyek EPC

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="6" <?php echo $div6; ?>>
                        Divisi Komersial

                      </label>
                    </div>
                      </div>
                      <div class="col-md-3 bg">
                        <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="7" <?php echo $div7; ?>>
                        Divisi Pelaksana Proyek Operasi

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="8" <?php echo $div8; ?>>
                        Divisi Manajemen Proyek Operasi

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="9" <?php echo $div9; ?>>
                        Divisi Kalibrasi Instrumentasi & Manufaktur

                      </label>
                    </div>
                  </div>
                  <div class="col-md-3 bg">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="10" <?php echo $div10; ?>>
                        Divisi Keuangan

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="11" <?php echo $div11; ?>>
                        Divisi Logistik & Administrasi

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="12" <?php echo $div12; ?>>
                        Divisi SDM

                      </label>
                    </div>
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="divisi[]" value="13" <?php echo $div13; ?>>
                        Divisi Informasi, Komunikasi & Telekomunikasi

                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class='alert alert-warning alert-dismissible' style="display:none;" id="kosong"><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='icon fa fa-warning'></i>Masukkan Soal</div>
          <div class='alert alert-success alert-dismissible' style="display:none;" id="insert"><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='icon fa fa-check'></i> Data Inserted!</div>
          <div class='alert alert-info alert-dismissible' style="display:none;" id="update"><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='icon fa fa-check'></i> Data Updated!</div>
          <div class='alert alert-danger alert-dismissible' style="display:none;" id="delete"><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><i class='icon fa fa-check'></i> Data Deleted!</div>
          <div id="live_data"></div>
          <a onclick="window.history.back();return false;" class="btn btn-warning"><i class="fa fa-reply"></i> Back</a>
           <button type="submit" name="submit" class="btn btn-info" id="simpan">Save </button>
              </div>
        </form>
      </div>
    </section>
  </div>

  <?php
    $this->load->view('admin/footer');
  ?>
  <script src="<?php echo base_url()?>assets/js/bootoast.min.js"></script>
<script>

$(document).ready(function(){
  $('#simpan').click(function(){
    var divisi = [];
    $(':checkbox:checked').each(function(i){
      divisi[i] = $(this).val();
    });
    if(divisi.length === 0){ //tell you if the array is empty
      bootoast.toast({
        message: 'Silahkan pilih target kuesioner setidaknya satu divisi.',
        type: 'warning'
      });
      return false;
    }
  });

  $.fn.datepicker.dates['en'] = {
      days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
      daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
      daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
      months: ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
      monthsShort: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
      today: "Today",
      clear: "Clear",
      format: "mm/dd/yyyy",
      titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
      weekStart: 0
  };
  $("#datepicker").datepicker({
    orientation: 'auto bottom',
    autoclose: true,
    viewMode: "months",
    minViewMode: "months"
  });

    function fetch_data(){
      var id = $('.id-kuesioner').attr('id');
      $.ajax({
        url:"<?php echo base_url('admin/kuesioner/list_soal'); ?>",
        method:"POST",
        data: {id:id},
        success:function(data){
            $('#live_data').html(data);
        }
      });
    }

    fetch_data();
    $(document).on('click', '#btn_add', function(){
      var id = $('.id-kuesioner').attr('id');
      var sub = $('#nb').val();
      var soal = $('#na').val();
      if(soal == ''){
        $("#kosong").fadeIn();
        $("#kosong").delay(1000).fadeOut();
        return false;
      }
      $.ajax({
        url:"<?php echo base_url('admin/kuesioner/tambah_soal'); ?>",
        method:"POST",
        data:{id:id,sub:sub,soal:soal},
        dataType:"text",
        success:function(data){
          $("#insert").fadeIn();
          $("#insert").delay(1000).fadeOut();
          fetch_data();
        }
      })
    });

    function edit_sub(id, sub, column_name){
      $.ajax({
        url:"<?php echo base_url('admin/kuesioner/edit_sub'); ?>",
        method:"POST",
        data:{id:id, sub:sub, column_name:column_name},
        dataType:"text",
        success:function(data){
          //alert(data);
          $("#update").fadeIn();
          $("#update").delay(1000).fadeOut();
          fetch_data();
        }
      });
    }

    function edit_soal(id, soal, column_name){
      $.ajax({
        url:"<?php echo base_url('admin/kuesioner/edit_soal'); ?>",
        method:"POST",
        data:{id:id, soal:soal, column_name:column_name},
        dataType:"text",
        success:function(data){
          //alert(data);
          $("#update").fadeIn();
          $("#update").delay(1000).fadeOut();
          fetch_data();
        }
      });
    }

    $(document).on('change', '.soal', function(){
        var id = $(this).data("id1");
        var soal = $(this).val();
        edit_soal(id, soal, "soal_kuesioner");
    });

    $(document).on('change', '.sub', function(){
        var id = $(this).data("id3");
        var sub = $(this).val();
        edit_sub(id, sub, "soal_kuesioner");
    });

    $(document).on('click', '.btn_delete', function(){
      var id=$(this).data("id2");
      if(confirm("Anda yakin ingin menghapus soal ini ?")){
        $.ajax({
          url:"<?php echo base_url('admin/kuesioner/hapus_soal'); ?>",
          method:"POST",
          data:{id:id},
          dataType:"text",
          success:function(data){
            $("#delete").fadeIn();
            $("#delete").delay(1000).fadeOut();
            fetch_data();
          }
        });
      }
    });
    $(document).ready(function() {
      $('#ceksemua').click(function() {
        var checked = $(this).prop('checked');
        $('#boxes').find('input:checkbox').prop('checked', checked);
      });
    })
  });
</script>
