<?php
 $data_session = array(
  'tree1' => "kuesioner",
  'tree2'=> "sub_kuesioner"
);
$this->session->set_userdata($data_session);
    $this->load->view('admin/header');
  ?>
  <head>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/delete_modal.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  </head>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="panel panel-info">
        <div class="panel-heading">
          <b>Sub Kuesioner</b>
        </div>

        <div class="panel-body">
        <button class="btn btn-success" class="btn btn-info add" role="dialog" aria-hidden="true" data-toggle="modal" data-target="#add_modal"><i class="fa fa-plus"></i> Tambah Sub Kuesioner</button>
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th class="col-md-1">No</th>
                <th>Sub Kuesioner</th>
                <th class="col-md-2" style="text-align:center">Aksi</th>
              </tr>
              </thead>
              <tbody>
              <?php
              $no = 1;
              foreach($sub_kuesioner as $data){
                ?>
              <tr>
                <td style="text-align:center"><?php echo $no++; ?></td>
                <td><?php echo $data['sub_kuesioner']; ?>
                </td>
                <td style="text-align:center"><div class="btn-group">
                  <div class="col-md-6">
                    <button type="button" data-id1="<?php echo $data['sub_kuesioner']; ?>" data-id2="<?php echo $data['id_sub']; ?>" class="btn btn-info edit" role="dialog" aria-hidden="true" data-toggle="modal" data-target="#edit_modal"><i class="fa fa-edit"></i></button>
                  </div>
                  <div class="col-md-4">
                    <button type="button" class="btn btn-danger" role="dialog" aria-hidden="true" data-toggle="modal" data-target="#confirm_delete" data-href='<?php echo base_url('admin/hapus_sub_kuesioner/'); echo $data['id_sub']; ?>'><i class="fa fa-trash"></i></button>
                  </div>
                </td>
              </tr>
              <?php } ?>
              </tfoot>
            </table>
          </div>
        </div>
      </section>
    </div>

    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Edit</div>

      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('admin/edit_sub_kuesioner'); ?>" method="POST">
          <div class="form-group">
            <label for="sub" class="col-form-label">Sub Kuesioner</label>
            <input type="text" class="form-control" name="sub1" id="sub_kuesioner">
            <input type="hidden" class="form-control" name="sub2" id="id_sub">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

 <div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah</div>

      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('admin/tambah_sub_kuesioner'); ?>" method="POST">
          <div class="form-group">
            <label for="sub" class="col-form-label">Sub Kuesioner</label>
            <input type="text" class="form-control" name="sub" id="sub_kuesioner" required>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
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
            <p>Apakah anda ingin menghapus sub kuesioner ini ?.</p>
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
    <script type="text/javascript">
      //Hapus Data
      $(document).ready(function() {
          $('#confirm_delete').on('show.bs.modal', function(e) {
              $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
          });
      });
      $(document).on("click", ".edit", function () {
          var sub_kuesioner = $(this).data('id1');
          var id_sub = $(this).data('id2');
          $("#sub_kuesioner").val(sub_kuesioner);
          $("#id_sub").val(id_sub);
      });
    </script>


  <?php
    $this->load->view('admin/footer');
  ?>
