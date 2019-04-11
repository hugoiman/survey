<?php
 $data_session = array(
    'tree1' => "kuesioner",
    'tree2'=> "buat kuesioner"
  );
  $this->session->set_userdata($data_session);
    $this->load->view('admin/header');
  ?>
<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/select2/dist/css/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
<link href="<?php echo base_url()?>assets/css/bootoast.css" rel="stylesheet" type="text/css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content">
		<div class="panel panel-info">
			<div class="panel-heading">
				<b>Buat Kuesioner</b>
			</div>
			<div class="panel-body">
				<form action="<?php echo base_url('admin/tambah_kuesioner'); ?>" method="POST">
					<div class="form-group">
						<label>Judul Kuesioner</label>
						<input class="form-control" type="text" name="judul" placeholder="Tuliskan judul kuesioner" required>
					</div>
					<div class="form-group">
						<label>Periode</label>
						<div class="input-group date col-md-3">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input required type="text" name="periode" class="form-control pull-right" id="datepicker" data-date-format='MM yyyy'>
						</div>
					</div>
          <div class="form-group">
						<label>Target Responden</label>
              <div class="checkbox">
                <label><input type="checkbox" id="ceksemua">Semua Divisi</label>
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
                    <label><input type="checkbox" name="divisi[]" value="1">Divisi K3PL & Pengamanan Perusahaan</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="2">Sekretaris Perusahaan</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="3">Divisi Audit</label>
                  </div>
                </div>
                <div class="col-md-3 bg">
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="4">Divisi Manajemen Proyek EPC</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="5">Koordinator Pelaksana Proyek EPC</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="6">Divisi Komersial</label>
                  </div>
                </div>
                <div class="col-md-3 bg">
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="7">Divisi Pelaksana Proyek Operasi</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="8">Divisi Manajemen Proyek Operasi</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="9">Divisi Kalibrasi Instrumentasi & Manufaktur</label>
                  </div>
                </div>
                <div class="col-md-3 bg">
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="10">Divisi Keuangan</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="11">Divisi Logistik & Administrasi</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="12">Divisi SDM</label>
                  </div>
                  <div class="checkbox">
                    <label><input type="checkbox" name="divisi[]" value="13">Divisi Informasi, Komunikasi & Telekomunikasi</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
  				<div class="form-group">
  					<label>Pertanyaan</label>
  				</div>

  				<div class="table-responsive">
  					<table class="table table-bordered" id="dynamic_field">
  						<tr>
  							<td class="col-md-3">
  								<select name="sub[]" class="form-control select2">
  									<?php foreach($sub as $subkues){?>
  									<option value="<?php echo $subkues['id_sub'] ?>">
  										<?php echo $subkues['sub_kuesioner'] ?>
  									</option>
  									<?php }?>
  								</select>
  							</td>
  							<td><input type="text" name="soal[]" placeholder="Tuliskan soal kuesioner" class="form-control name_list" required /></td>
  							<td class="col-md-1"><button type="button" name="add" id="add" class="btn btn-success">Add</button></td>
  						</tr>
  					</table>
  				</div>
    			<button type="submit" name="submit" class="btn btn-info" id="create">Create</button>
    		</form>
    	</div>
    </section>
  </div>
		<?php
    $this->load->view('admin/footer');
    ?>
  <script>
    $(document).ready(function () {
      $('#create').click(function(){
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

      var i = 1;
      $('#add').click(function () {
        i++;
        $('#dynamic_field').append('<tr id="row' + i +
        '"><td><select name="sub[]" class="form-control"><?php foreach($sub as $subkues){?><option value="<?php echo $subkues['id_sub'] ?>"><?php echo $subkues['sub_kuesioner'] ?></option><?php }?></td><td><input type="text" name="soal[]" placeholder="Tuliskan soal kuesioner" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
        i + '" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i> </button></td></tr>');
      });

      $(document).on('click', '.remove', function () {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
      });
    });
	</script>
  <script src="<?php echo base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo base_url()?>assets/js/bootoast.min.js"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })

    $(document).ready(function() {
      $('#ceksemua').click(function() {
        var checked = $(this).prop('checked');
        $('#boxes').find('input:checkbox').prop('checked', checked);
      });
    })
	</script>
