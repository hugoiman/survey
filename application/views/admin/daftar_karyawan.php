<?php
$data_session = array(
  'tree1' => "karyawan",
  'tree2' => ""
);
$this->session->set_userdata($data_session);
    $this->load->view('admin/header');
  ?>
  <head>
    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/delete_modal.css">
  </head>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="panel panel-info">
        <div class="panel-heading">
          <b>Data Karyawan</b>
        </div>

        <div class="panel-body">
        <button class="btn btn-success" class="btn btn-info add" role="dialog" aria-hidden="true" data-toggle="modal" data-target="#add_karyawan_modal"><i class="fa fa-plus"></i> Tambah Karyawan</button>
          <div class="box-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIPG</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Umur</th>
                  <th>Pangkat</th>
                  <th>Divisi</th>
                  <th>Status</th>
                  <th style="text-align:center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $no = 1;
                foreach($karyawan as $data){
                  $tgl_lahir = new DateTime($data['tgl_lahir']);
                  $today = new DateTime('today');
                  $tahun = $today->diff($tgl_lahir)->y;
                ?>
                <tr>
                  <td style="text-align:center"><?php echo $no++; ?></td>
                  <td><?php echo $data['nipg']; ?></td>
                  <td><?php echo $data['name']; ?></td>
                  <td><?php if ($data['gender'] == 'L') {
                    $gender = 'Laki-laki';
                  }else {
                    $gender = 'Perempuan';
                  } echo $gender;?></td>
                  <td><?php echo $tahun." Tahun "; ?></td>
                  <td><?php echo $data['grade']; ?></td>
                  <td><?php echo $data['nama_divisi']; ?></td>
                  <td><?php echo $data['status']; ?></td>
                  <td><div class="btn-group">
                    <div class="col-md-6">
                      <button type="button" class="btn btn-info edit"
                      data-nipg="<?php echo $data['nipg']; ?>" data-nipg2="<?php echo $data['nipg']; ?>" data-name="<?php echo $data['name']; ?>"
                      data-gender="<?php echo $data['gender']; ?>" data-tgl_lahir="<?php echo $data['tgl_lahir']; ?>"
                      data-grade="<?php echo $data['grade']; ?>" data-direktorat="<?php echo $data['direktorat']; ?>"
                      data-divisi="<?php echo $data['id_divisi']; ?>" data-status="<?php echo $data['status']; ?>"
                      role="dialog" aria-hidden="true" data-toggle="modal" data-target="#edit_karyawan_modal"><i class="fa fa-edit"></i></button>
                    </div>
                    <div class="col-md-4">
                      <button type="button" class="btn btn-danger" role="dialog" aria-hidden="true" data-toggle="modal" data-target="#confirm_delete" data-href='<?php echo base_url('admin/hapus_karyawan/');echo $data['nipg']; ?>'><i class="fa fa-trash"></i></button>
                    </div>
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

    <div class="modal fade" id="edit_karyawan_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Edit</div>

      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url('admin/edit_karyawan'); ?>" method="POST">
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">NIPG</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nipg2" name="nipg2" required>
              <input type="hidden" class="form-control nipg" name="nipg" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select class="form-control" id="gender" name="gender" required>
                <option value="P">Perempuan</option>
                <option value="L">Laki-laki</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tgl lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Pangkat</label>
            <div class="col-sm-10">
              <select class="form-control" id="grade" name="grade" required>
                <option value="Staff">Staff</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Assistant Manager">Assistant Manager</option>
                <option value="Manager">Manager</option>
                <option value="avp">AVP</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Divisi</label>
            <div class="col-sm-10">
              <select class="form-control" id="edit_divisi" name="divisi" required>
                <?php foreach ($divisi as $data){ ?>
                  <option value="<?php echo $data['id_divisi']; ?>"><?php echo $data['nama_divisi']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Direktorat</label>
            <div class="col-sm-10">
            <select class="form-control" id="edit_direktorat" name="direktorat" required>
              <option>-- Pilih Direktorat --</option>
              <option></option>
            </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Status</label>
            <div class="col-sm-10">
              <select class="form-control" id="status" name="status" required>
                <option>-- Pilih Status --</option>
                <option value="Aktif">Aktif</option>
                <option value="Tidak Aktif">Tidak Aktif</option>
              </select>
            </div>
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

 <div class="modal fade" id="add_karyawan_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="modal-title">Tambah</div>

      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url('admin/tambah_karyawan'); ?>" method="POST">
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">NIPG</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="nipg" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputEmail" class="col-sm-2 control-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select class="form-control" name="gender" required>
                <option>-- Pilih Jenis Kelamin --</option>
                <option value="P">Perempuan</option>
                <option value="L">Laki-laki</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Tgl lahir</label>
            <div class="col-sm-10">
              <input type="date" class="form-control" name="tgl_lahir" required>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Pangkat</label>
            <div class="col-sm-10">
              <select class="form-control" name="grade" required>
                <option>-- Pilih Pangkat --</option>
                <option value="Staff">Staff</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Assistant Manager">Assistant Manager</option>
                <option value="Manager">Manager</option>
                <option value="AVP">AVP</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Divisi</label>
            <div class="col-sm-10">
            <select class="form-control" id="add_divisi" name="divisi" required>
                <option>-- Pilih Divisi --</option>
                <?php foreach ($divisi as $data){ ?>
                  <option value="<?php echo $data['id_divisi']; ?>"><?php echo $data['nama_divisi']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Direktorat</label>
            <div class="col-sm-10">
            <select class="form-control" id="add_direktorat" name="direktorat" required>
                <option>-- Pilih Direktorat --</option>
                <option></option>
              </select>
            </div>
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
            <p>Apakah anda ingin menghapus karyawan ini ?</p>
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
          var nipg = $(this).data('nipg');
          var nipg2 = $(this).data('nipg2');
          var name = $(this).data('name');
          var gender = $(this).data('gender');
          var tgl_lahir = $(this).data('tgl_lahir');
          var grade = $(this).data('grade');
          var direktorat = $(this).data('direktorat');
          var divisi = $(this).data('divisi');
          var status = $(this).data('status');
          $(".nipg").val(nipg);
          $("#nipg2").val(nipg2);
          $("#name").val(name);
          $("#gender").val(gender);
          $("#tgl_lahir").val(tgl_lahir);
          $("#grade").val(grade);
          $("#status").val(status);
          $("#edit_divisi").val(divisi);
          $("#edit_direktorat").val(direktorat);
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#add_divisi').change(function() {
          var id_divisi = $(this).val();
          $.ajax({
            url: "<?php echo base_url('admin/karyawan/cek_direktorat'); ?>",
            type: 'POST',
            data: {'id_divisi': id_divisi},
            success:function(response){
              $('#add_direktorat').html(response);
            }
          })
        });
      });
    </script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('#edit_divisi').change(function() {
          var id_divisi = $(this).val();
          $.ajax({
            url: "<?php echo base_url('admin/karyawan/cek_direktorat'); ?>",
            type: 'POST',
            data: {'id_divisi': id_divisi},
            success:function(response){
              $('#edit_direktorat').html(response);
            }
          })
        });
      });
    </script>


  <?php
    $this->load->view('admin/footer');
  ?>
