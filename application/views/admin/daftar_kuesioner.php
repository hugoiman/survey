  <?php
   $data_session = array(
    'tree1' => "kuesioner",
    'tree2'=> "daftar kuesioner"
  );
  $this->session->set_userdata($data_session);
    $this->load->view('admin/header');
  ?>
  <head>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,600,700" rel="stylesheet"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/toggle.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/delete_modal.css">
    <link href="<?php echo base_url()?>assets/css/bootoast.css" rel="stylesheet" type="text/css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootoast.min.js"></script>
  </head>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="panel panel-info">
        <div class="panel-heading">
          <b>Data Kuesioner</b>
        </div>
        <div class="table-responsive">
        <div class="panel-body">
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-4">Judul Kuesioner</th>
                <th class="col-md-2" style="text-align:center">Periode</th>
                <th class="col-md-1" style="text-align:center">Status</th>
                <th class="col-md-2" style="text-align:center">Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
              foreach($kuesioner as $data){
                ?>
               <input type="hidden" name="id_kuesioner" value="<?php echo $data['id_kuesioner']; ?>">
              <tr>
                <td><?php echo $no++; ?></td>
                <td><a href="<?php echo base_url('admin/informasi-responden/'); echo $data['id_kuesioner']; ?>"><?php echo $data['judul_kuesioner']; ?></a></td>
                <td style="text-align:center"><?php echo $data['periode']; ?></td>
                <td style="text-align:center">
                  <?php if($data['status']=='non aktif'){?>
                    <button type="button" class="btn btn-lg btn-toggle" value="<?php echo $data['id_kuesioner']; ?>" onclick="cekStatus(<?php echo $data['id_kuesioner']; ?>);" data-toggle="button" aria-pressed="false" autocomplete="off">
                      <div class="handle"><p style="overflow: hidden; text-indent: 100%; white-space: nowrap;">Close</p></div>
                    </button>
                  <?php }else{?>
                    <button type="button" class="btn btn-lg btn-toggle active" value="<?php echo $data['id_kuesioner']; ?>" onclick="cekStatus(<?php echo $data['id_kuesioner']; ?>);" data-toggle="button" aria-pressed="true" autocomplete="off">
                      <div class="handle"></div><p style="overflow: hidden; text-indent: 100%; white-space: nowrap;">Open</p>
                    </a>
                  <?php }?>
                </td>
                <td style="text-align:center">
                  <!-- <div class="btn-group"> -->
                    <div class="row">
                      <div class="col-md-4" style="margin-left:10px">
                        <a title="Edit" href="<?php echo base_url('admin/detail_kuesioner/'); echo $data['id_kuesioner']; ?>" type="button" class="btn btn-info"><i class="fa fa-edit"></i></a>
                      </div>
                      <div class="col-md-4" style="margin-left:-10px">
                        <button type="button" class="btn btn-warning dup" data-id1="<?php echo $data['judul_kuesioner']; ?>" data-id2="<?php echo $data['id_kuesioner']; ?>" data-id3="<?php echo $data['periode'] ?>" role="dialog" aria-hidden="true" data-toggle="modal" title="Duplicate" data-target="#duplicate_data"><i class="fa fa-copy"></i></button>
                      </div>
                      <div class="col-md-4" style="margin-left:-10px">
                        <button type="button" class="btn btn-danger" role="dialog" aria-hidden="true" data-toggle="modal" title="Delete" data-target="#confirm_delete" data-href='<?php echo base_url('admin/hapus_kuesioner/'); echo $data['id_kuesioner']; ?>'><i class="fa fa-trash"></i></button>
                      </div>
                    </div>
                  <!-- </div> -->
                </td>
              </tr>
              <?php } ?>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
      </section>
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
            <p>Apakah anda ingin menghapus kuesioner ini ?.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
            <a class="btn-ok"><button type="button" class="btn btn-danger btn-ok">Ya</button></a>
          </div>
        </div>
      </div>
    </div>

   <div class="modal fade" id="duplicate_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-title">Duplikat</div>
        </div>
        <div class="modal-body">
      <form action="<?php echo base_url('admin/duplikat_kuesioner'); ?>" method="POST">
        <div class="form-group">
          <label>Judul Kuesioner</label>
          <input required type="text" class="form-control" name="judul_kuesioner" id="judul">
          <input required type="hidden" class="form-control" name="id_kuesioner_origin" id="id_origin">
        </div>
        <div class="form-group">
          <label>Periode</label>
          <div class="input-group date">
          <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
          <input required type="text" name="periode" class="form-control pull-right" id="datepicker" data-date-format='MM yyyy' >
        </div>
        </div>
        <div class="form-group">
        <div class="form-group">
						<label>Target Responden</label>
						<div class="checkbox">
							<label>
								<input type="checkbox" id="ceksemua">
								Semua Divisi
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
											<input type="checkbox" name="divisi[]" value="1">
											Divisi K3PL & Pengamanan Perusahaan
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="2">
											Sekretaris Perusahaan
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="3">
											Divisi Audit

										</label>
									</div>
								</div>
								<div class="col-md-3 bg">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="4">
											Divisi Manajemen Proyek EPC

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="5">
											Koordinator Pelaksana Proyek EPC

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="6">
											Divisi Komersial

										</label>
									</div>
								</div>
								<div class="col-md-3 bg">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="7">
											Divisi Pelaksana Proyek Operasi

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="8">
											Divisi Manajemen Proyek Operasi

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="9">
											Divisi Kalibrasi Instrumentasi & Manufaktur

										</label>
									</div>
								</div>
								<div class="col-md-3 bg">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="10">
											Divisi Keuangan

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="11">
											Divisi Logistik & Administrasi

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="12">
											Divisi SDM

										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="divisi[]" value="13">
											Divisi Informasi, Komunikasi & Telekomunikasi

										</label>
									</div>
								</div>
							</div>
						</div>
                    </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary" id="duplikat">Duplikat</button>
        </div>
      </form>
      </div>
      </div>
    </div>
  </div>

    <!-- END -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
      //Hapus Data
      $(document).ready(function() {
        $('#duplikat').click(function(){
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

          $('#confirm_delete').on('show.bs.modal', function(e) {
              $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
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
            autoclose: true,
            viewMode: "months",
            minViewMode: "months"
        });

        $('#ceksemua').click(function() {
          var checked = $(this).prop('checked');
          $('#boxes').find('input:checkbox').prop('checked', checked);
        });
      });

      $(document).on("click", ".dup", function () {
          var judul = $(this).data('id1');
          var id = $(this).data('id2');
          var per = $(this).data('id3');
          $("#judul").val(judul);
          $("#datepicker").val(per);
          $("#id_origin").val(id);
      });

    </script>
    <script>
      function cekStatus(x){
        // alert(x);
        var id_kuesioner = x;
        $.ajax({
          url:'<?php echo base_url('admin/cekStatus/'); ?>' + id_kuesioner,
          data : id_kuesioner ,
          success:function(respons){
            // $('#_result').html(respons);
          },error:function(error){
            alert("gagal");
          }
        });
      }
    </script>

  <?php
    $this->load->view('admin/footer');
  ?>
