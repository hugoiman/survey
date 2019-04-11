  <?php
    $this->load->view('admin/header');
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <div class="panel panel-info">
        <div class="panel-heading">
           <b>Statistik Kuesioner</b>
        </div>
        <div class="panel-body">
          <?php foreach ($judul as $judul){ ?>
            <a type="button" class="btn btn-default btn-block" value="<?php echo $judul['id_kuesioner']; ?>" href="<?php echo base_url('admin/statistik_kuesioner/'); echo $judul['id_kuesioner']; ?>"><?php echo $judul['judul_kuesioner']; ?> </a>
          <?php } ?>
        </div>
    </section>
  </div>
  <?php
    $this->load->view('admin/footer');
  ?>
