  <?php
  $data_session = array(
    'tree1' => "kirit dan saran",
    'tree2'=> ""
  );
  $this->session->set_userdata($data_session);
    $this->load->view('admin/header');
  ?>

  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/i18n/jquery-ui-i18n.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/delete_modal.css">
  </head>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="panel panel-info">
        <div class="panel-heading">
          <b>Data Kritik & Saran</b>
        </div>
        <div class="table-responsive">
          <div class="panel-body">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="col-md-1" style="text-align:center">No</th>
                  <th class="col-md-3" style="text-align:center">Nama</th>
                  <th class="col-md-2" style="text-align:center">Tanggal</th>
                  <th class="col-md-3" style="text-align:center">Subjek</th>
                  <th class="col-md-1" style="text-align:center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach($kritik_saran as $data){
                  ?>
                 <input type="hidden" name="id_saran" value="<?php echo $data['id_saran']; ?>">
                <tr>
                  <td style="text-align:center"><?php echo $no++; ?></td>
                  <td><?php echo $data['name']; ?></td>
                  <td><?php echo date('l, d F Y', strtotime($data['waktu'])); ?></td>
                  <td><?php echo $data['subjek']; ?></td>
                  <td>
                    <div class="row">
                      <div class="col-md-5">
                        <a title="Open" href="<?php echo base_url('admin/kritik_saran/'); echo $data['id_saran']; ?>" type="button" class="btn btn-info"><i class="fa fa-edit"></i></a>
                      </div>
                      <div class="col-md-6">
                        <button type="button" class="btn btn-danger" role="dialog" aria-hidden="true" data-toggle="modal" title="Hapus" data-target="#confirm_delete" data-href='<?php echo base_url('admin/hapus_kritik_saran/'); echo $data['id_saran']; ?>'><i class="fa fa-trash"></i></button>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php } ?>
                </tfoot>
              </table>
            </div>
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
          <p>Apakah anda ingin menghapus saran ini ?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
          <a class="btn-ok"><button type="button" class="btn btn-danger btn-ok">Ya</button></a>
        </div>
      </div>
    </div>
  </div>
  <!-- END -->

  <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#confirm_delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      });
    });
  </script>

  <?php
    $this->load->view('admin/footer');
  ?>
