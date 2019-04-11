<?php
class Kuesioner extends CI_Controller{

  function __construct(){
    parent::__construct();
	if($this->permission() == false){
		redirect(base_url());
	  }else{
		$this->load->model('admin/m_kuesioner');
	  }
  }

  function permission(){ //hak akses
	$lvl = $this->session->userdata("level");
	if($lvl == "admin"){
		return true;
	}else{
		return false;
	}
}

  //1.  Daftar Kuesioner
  function daftar_kuesioner(){ //menampilkan daftar kuesioner
		$data['kuesioner'] = $this->m_kuesioner->m_get_all_kuesioner()->result_array();
		$this->load->view('admin/daftar_kuesioner', $data);
	}

  //  Informasi Kuesioner
  function informasi_responden($id_kuesioner){
		$where = array('id_kuesioner' => $id_kuesioner);
		$data['info_kuesioner'] = $this->m_kuesioner->m_get_judul('tb_kuesioner',$where)->result_array();
		$data['jumlah_responden'] = $this->m_kuesioner->m_get_JmlResponden($id_kuesioner)->num_rows();
		$data['statistik_sub'] = $this->m_kuesioner->m_get_statistik_sub($id_kuesioner)->num_rows();
		$data['respon_per_direktorat'] = $this->m_kuesioner->m_get_responDirektorat($id_kuesioner)->result_array();
		$data['respon_per_pangkat'] = $this->m_kuesioner->m_get_responPangkat($id_kuesioner)->result_array();
		$data['respon_per_usia'] = $this->m_kuesioner->m_get_responUsia($id_kuesioner)->result_array();
		$this->load->view('admin/responden',$data);
	}

  function informasi_statistik($id_kuesioner){
		$where = array('id_kuesioner' => $id_kuesioner);
		$direktorat = 'Direktorat';
		$a['id_sub'] = $this->m_kuesioner->m_get_sub_tanggapan($id_kuesioner)->result_array();
		$data['jumlah_responden'] = $this->m_kuesioner->m_get_JmlResponden($id_kuesioner)->num_rows();
		$i = 0;

		foreach($a['id_sub'] as $aa){
			$i++;
			$data['statistik'.$i] = $this->m_kuesioner->m_get_statistik($aa['id_sub'], $direktorat,$id_kuesioner);
		}
		$data['direktorat'] = $direktorat;
		$data['isEmpty'] = $this->m_kuesioner->m_isEmpty($direktorat);
		$data['jumlah'] = $i;
		$data['judul'] = $this->m_kuesioner->m_get_judul('tb_kuesioner', $where)->result_array();
		$data['info_kuesioner'] = $this->m_kuesioner->m_get_judul('tb_kuesioner',$where)->result_array();
		$data['statistik_sub'] = $this->m_kuesioner->m_get_statistik_sub($id_kuesioner)->num_rows();
		$this->load->view('admin/statistik',$data);
	}
  function data_statistik(){ //cari statistik
		$direktorat = $this->input->post('direktorat');
		$id_kuesioner = $this->input->post('id_kuesioner');
		$where = array('id_kuesioner' => $id_kuesioner);
		$a['id_sub'] = $this->m_kuesioner->m_get_sub_tanggapan($id_kuesioner)->result_array();
		$data['jumlah_responden'] = $this->m_kuesioner->m_get_JmlResponden($id_kuesioner)->num_rows();
		$i = 0;

		foreach($a['id_sub'] as $aa){
			$i++;
			$data['statistik'.$i] = $this->m_kuesioner->m_get_statistik($aa['id_sub'], $direktorat,$id_kuesioner);
		}
		$data['isEmpty'] = $this->m_kuesioner->m_isEmpty($direktorat);
		$data['direktorat'] = $direktorat;
		$data['jumlah'] = $i;
		$data['judul'] = $this->m_kuesioner->m_get_judul('tb_kuesioner', $where)->result_array();
		$data['info_kuesioner'] = $this->m_kuesioner->m_get_judul('tb_kuesioner',$where)->result_array();
		$data['statistik_sub'] = $this->m_kuesioner->m_get_statistik_sub($id_kuesioner)->num_rows();
		$this->load->view('admin/statistik',$data);
	}

	function informasi_tanggapan($id_kuesioner){
		$nipg['nipg'] = $this->m_kuesioner->m_get_id_terakhir($id_kuesioner)->result_array();
		$data_id = 0;
		foreach($nipg['nipg'] as $nipg){
			$data_id = $nipg['nipg'];
		}
		$where = array(
			'id_kuesioner' => $id_kuesioner
		);
		$data['sub'] = $this->m_kuesioner->m_get_sub_tanggapan($id_kuesioner)->result_array();
		$i = 1;
		foreach($data['sub'] as $a){
			$data['datas'.$i] = $this->m_kuesioner->m_get_tanggapan($data_id, $a['id_sub'],$id_kuesioner)->result_array();
			$i++;
		}
		$where = array('id_kuesioner' => $id_kuesioner);
		$data['info_kuesioner'] = $this->m_kuesioner->m_get_judul('tb_kuesioner',$where)->result_array();
		$data['jumlah_responden'] = $this->m_kuesioner->m_get_JmlResponden($id_kuesioner)->num_rows();
		$data['statistik_sub'] = $this->m_kuesioner->m_get_statistik_sub($id_kuesioner)->num_rows();
		// $data['isi_tanggapan'] = $this->m_kuesioner->m_get_tanggapan()->result_array();
		$data['data_responden'] = $this->m_kuesioner->m_get_dataResponden($id_kuesioner)->result_array();
		$data['id_kuesioner'] = $id_kuesioner;
		$this->load->view('admin/tanggapan',$data);
	}

  function data_tanggapan(){ //cari tanggapan
		$nipg = $this->input->post('nipg');
		$data['nipg'] = $this->input->post('nipg');
		$id_kuesioner = $this->input->post('id_kuesioner');
		$where = array(
			'id_kuesioner' => $id_kuesioner
		);
		$data['sub'] = $this->m_kuesioner->m_get_sub_tanggapan($id_kuesioner)->result_array();
		$i = 1;
		foreach($data['sub'] as $a){
			$data['datas'.$i] = $this->m_kuesioner->m_get_tanggapan($nipg, $a['id_sub'],$id_kuesioner)->result_array();
			$i++;
		}
		$where = array('id_kuesioner' => $id_kuesioner);
		$data['info_kuesioner'] = $this->m_kuesioner->m_get_judul('tb_kuesioner',$where)->result_array();
		$data['jumlah_responden'] = $this->m_kuesioner->m_get_JmlResponden($id_kuesioner)->num_rows();
		$data['statistik_sub'] = $this->m_kuesioner->m_get_statistik_sub($id_kuesioner)->num_rows();
		// $data['isi_tanggapan'] = $this->m_kuesioner->m_get_tanggapanResponden($nipg)->result_array();
		$data['data_responden'] = $this->m_kuesioner->m_get_dataResponden($id_kuesioner)->result_array();
		$data['id_kuesioner'] = $id_kuesioner;
		$this->load->view('admin/tanggapan', $data);
	}

  //  Ganti status kuesioner
  function cekStatus_kuesioner($id_kuesioner){ //Toogle Close or Open
    $cekStatus['test'] = $this->m_kuesioner->m_get_cekStatus_kuesioner($id_kuesioner)->result_array();
    foreach ($cekStatus['test'] as $data) {
      if($data['status'] == "non aktif"){
        $this->aktivasi_kuesioner($id_kuesioner);
      }
      else{
        $this->deaktivasi_kuesioner($id_kuesioner);
      }
    }
  }

  function aktivasi_kuesioner($id_kuesioner){
		$where = array(
			'id_kuesioner' => $id_kuesioner
		);
		$data = array(
			'status' => 'aktif'
		);
		$this->m_kuesioner->m_set_status($data, $where);
	}

  function deaktivasi_kuesioner($id_kuesioner){

		$where = array(
			'id_kuesioner' => $id_kuesioner
		);
		$data = array(
			'status' => 'non aktif'
		);
		$this->m_kuesioner->m_set_status($data, $where);
	}

  //  Edit Kuesioner
  function detail_kuesioner($id_kuesioner){ //melihat detail kuesioner
		$where = array(
				'id_kuesioner' => $id_kuesioner
			);
		$data['judul'] = $this->m_kuesioner->m_get_judul('tb_kuesioner', $where)->result_array();
		$data['check'] = $this->m_kuesioner->m_get_checked('tb_target_kuesioner', $where)->result_array();
		// $data['record'] = $this->m_kuesioner->m_get_soal('tb_soal_kuesioner', $where)->result_array();
		$this->load->view('admin/edit_kuesioner', $data);
	}

  function edit_kuesioner(){ //edit kuesioner
		$id_kuesioner = $this->input->post('id_kuesioner');
		$data = array(
				'judul_kuesioner' => $this->input->post('judul'),
				'periode' => $this->input->post('periode')
		);
		$where = array(
				'id_kuesioner' => $id_kuesioner
		);
		$divisi = $this->input->post('divisi');
		$numberdiv = count($this->input->post('divisi'));
		$this->m_kuesioner->m_delete_target($where);
		for($i=0; $i<$numberdiv; $i++){
			$data2 = array(
				'id_kuesioner' => $id_kuesioner,
				'id_divisi' => $divisi[$i]
			);
			$this->m_kuesioner->m_target_kuesioner($data2);

    }
		$id_kuesioner = $this->m_kuesioner->m_edit_judul($data, $where);
		redirect('admin/daftar_kuesioner');
	}

  function list_soal(){ //menampilkan list soal
		$id = $this->input->post('id');
		$query = $this->m_kuesioner->m_get_soal($id);
		$data['datasoal'] = $query->result_array();
		$data['jumlahsoal'] = $query->num_rows();

		$data['sub'] = $this->m_kuesioner->m_get_sub('tb_sub_kuesioner')->result_array();
		 $output = '
      <div class="table-responsive">
           <table class="table table-bordered">
                <tr>
					 <th width="25%">Sub kuesioner</th>
					 <th width="65%">Soal kuesioner</th>
                     <th width="10%">Action</th>
				</tr>';

		$combobox = '';
		$combobox2 = '';
		foreach($data['sub'] as $sub){
				$combobox2 .= '<option value="'.$sub['id_sub'].'">'.$sub['sub_kuesioner'].'</option>';
		}

		if($data['jumlahsoal'] > 0)
		{
			foreach($data['datasoal'] as $a)
			{
				foreach($data['sub'] as $sub){
					if($a['id_sub'] == $sub['id_sub']){
						$combobox .= '<option value="'.$sub['id_sub'].'" selected>'.$sub['sub_kuesioner'].'</option>';
					} else {
						$combobox .= '<option value="'.$sub['id_sub'].'">'.$sub['sub_kuesioner'].'</option>';
					}
				}
			$output .= '
					<tr>
								<td>
								<select class="form-control sub" data-id3="'.$a["id_sk"].'">
									'.$combobox.'
								</select>
								</td>
								<td><input class="form-control soal" data-id1="'.$a["id_sk"].'" value="'.$a["soal_kuesioner"].'"></input></td>
								<td><button type="button" name="delete_btn" data-id2="'.$a["id_sk"].'" class="btn btn-md btn-danger btn_delete"><i class="glyphicon glyphicon-remove"></i></button></td>
                            </tr>
			';
			$combobox = '';
			}
			  $output .= '
						<tr>
						<td>
								<select id="nb" class="form-control">
									'.$combobox2.'
								</select>
								</td>
                <td><input class="form-control" id="na"></input></td>
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-md btn-success">Add</button></td>
           </tr>';
		}else{
			$output .= '
						<tr>
						<td>
								<select id="nb" class="form-control">
								'.$combobox2.'
								</select>
								</td>
                <td><input class="form-control" id="na"></input></td>
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-md btn-success">Add</button></td>
           </tr>';

		}
		 $output .= '</table>
      					</div>';
 		echo $output;
	}

  function tambah_soal(){ //menambahkan soal
		$data = array(
			'id_kuesioner' => $this->input->post('id'),
			'id_sub' => $this->input->post('sub'),
			'soal_kuesioner' => $this->input->post('soal')
		);
    $this->m_kuesioner->m_tambah_soal($data);
		// $id = $this->m_kuesioner->m_tambah_soal($data);
		// 	$data2 = array(
		// 		'id_kuesioner' => $this->input->post('id'),
		// 		'id_sk' => $id,
		// 		'id_sub' => $this->input->post('sub'),
		// 		'jawaban1' => 0,
		// 		'jawaban2' => 0,
		// 		'jawaban3' => 0,
		// 		'jawaban4' => 0,
		// 		'jawaban5' => 0
		// 	);
		// $this->m_kuesioner->m_statistik_default($data2);
	}

  function edit_sub(){ //edit soal
		$where = array(
				'id_sk' => $this->input->post('id')
			);
		$data = array(
				'id_sub' => $this->input->post('sub'),
				// 'soal_kuesioner' => $this->input->post('soal')
			);
		$this->m_kuesioner->m_edit_tb_soal('tb_soal_kuesioner', $where, $data);
		$this->m_kuesioner->m_edit_tb_respon('tb_respon_kuesioner', $where, $data);
		// $this->m_kuesioner->m_edit_tb_statistik('tb_statistik', $where, $data);
	}

  function edit_soal(){ //edit soal
		$where = array(
				'id_sk' => $this->input->post('id')
			);
		$data = array(
				// 'id_sub' => $this->input->post('sub'),
				'soal_kuesioner' => $this->input->post('soal')
			);
		$this->m_kuesioner->m_edit_tb_soal('tb_soal_kuesioner', $where, $data);
		$this->m_kuesioner->m_edit_tb_respon('tb_respon_kuesioner', $where, $data);
		// $this->m_kuesioner->m_edit_tb_statistik('tb_statistik', $where, $data);
	}

  function hapus_soal(){ //delete soal
		$where = array(
				'id_sk' => $this->input->post('id')
			);
		$this->m_kuesioner->m_hapus_soal('tb_soal_kuesioner', $where);
	}

  //  Duplikat Kuesioner
  function duplikat_kuesioner(){
		$judul = array(
			'judul_kuesioner' => $this->input->post('judul_kuesioner'),
			'periode' => $this->input->post('periode'),
			'status' => 'aktif'
		);
		$id_clone = $this->m_kuesioner->m_buat_judul($judul);
		$id_origin = $this->input->post('id_kuesioner_origin');

    $divisi = $this->input->post('divisi');
		$numberdiv = count($this->input->post('divisi'));
		for($i = 0; $i < $numberdiv; $i++){
			$data = array(
				'id_kuesioner' => $id_clone,
				'id_divisi' => $divisi[$i]
			);
			$this->m_kuesioner->m_target_kuesioner($data);
    }

		$clone['datasoal'] = $this->m_kuesioner->m_get_soal_clone($id_origin)->result_array();
		foreach($clone['datasoal'] as $clonesoal){
			$data = array(
				'id_kuesioner' => $id_clone,
				'id_sub' => $clonesoal['id_sub'],
				'soal_kuesioner' => $clonesoal['soal_kuesioner']
			);
      $this->m_kuesioner->m_create_soal($data);
			// $id_sk = $this->m_kuesioner->m_create_soal($data);
			// $data2 = array(
			// 	'id_kuesioner' => $id_clone,
			// 	'id_sub' => $clonesoal['id_sub'],
			// 	'id_sk' => $id_sk,
			// 	'jawaban1' => 0,
			// 	'jawaban2' => 0,
			// 	'jawaban3' => 0,
			// 	'jawaban4' => 0,
			// 	'jawaban5' => 0
			// );
			// $this->m_kuesioner->m_statistik_default($data2);
		}

		redirect('admin/daftar_kuesioner');
		}

  //  Hapus kuesioner
  function hapus_kuesioner($id_kuesioner){ //hapus kuesioner
		$where = array(
				'id_kuesioner' => $id_kuesioner
			);
		$this->m_kuesioner->m_hapus_kuesioner('tb_kuesioner', $where);
		redirect('admin/daftar_kuesioner');
	}

  //  Buat Kuesioner
  function form_buat_kuesioner(){
    $data['sub'] = $this->m_kuesioner->m_get_sub()->result_array();
    $this->load->view('admin/buat_kuesioner', $data);
  }

  function tambah_kuesioner(){ //membuat kuesioner baru
		$judul = array(
				'judul_kuesioner' => $this->input->post('judul'),
				'periode' => $this->input->post('periode'),
				'status' => 'aktif'
		);
		$id = $this->m_kuesioner->m_buat_judul($judul);
		$divisi = $this->input->post('divisi');
		$numberdiv = count($this->input->post('divisi'));
		for($i = 0; $i < $numberdiv; $i++){
			$data = array(
				'id_kuesioner' => $id,
				'id_divisi' => $divisi[$i]
			);
			$this->m_kuesioner->m_target_kuesioner($data);
    }
		$sub = $this->input->post('sub');
		$number = count($this->input->post('sub'));
		$soal = $this->input->post('soal');
		for($i=0; $i<$number; $i++){
			$data = array(
				'id_kuesioner' => $id,
				'id_sub' => $sub[$i],
				'soal_kuesioner' => $soal[$i]
			);
      $this->m_kuesioner->m_create_soal($data);
			// $id_sk = $this->m_kuesioner->m_create_soal($data);
			// $data2 = array(
			// 	'id_kuesioner' => $id,
			// 	'id_sub' => $sub[$i],
			// 	'id_sk' => $id_sk,
			// 	'jawaban1' => 0,
			// 	'jawaban2' => 0,
			// 	'jawaban3' => 0,
			// 	'jawaban4' => 0,
			// 	'jawaban5' => 0
			// );
			// $this->m_kuesioner->m_statistik_default($data2);
    }
		redirect('admin/daftar_kuesioner');
	}

  //  Data Sub Kuesioner
  function daftar_sub_kuesioner(){ //menampilkan list kuesioner
		$data['sub_kuesioner'] = $this->m_kuesioner->m_get_all_sub_kuesioner('tb_sub_kuesioner')->result_array();
		$this->load->view('admin/sub_kuesioner', $data);
	}

  function tambah_sub_kuesioner(){ //
		$sub = $this->input->post('sub');
		$data = array(
			'sub_kuesioner' => $sub
		);
		$this->m_kuesioner->m_simpan_sub($data);
		redirect('admin/sub_kuesioner');
	}

	function edit_sub_kuesioner(){ //edit sub
		$sub = $this->input->post('sub1');
		$id = $this->input->post('sub2');
		$data = array(
			'sub_kuesioner' => $sub
		);
		$where = array(
			'id_sub' => $id
		);
		$this->m_kuesioner->m_update_sub_kuesioner('tb_sub_kuesioner',$data, $where);
		redirect('admin/sub_kuesioner');
	}

	function hapus_sub_kuesioner($id_sub_kuesioner){ //hapus kuesioner
		$where = array(
				'id_sub' => $id_sub_kuesioner
			);
		$this->m_kuesioner->m_hapus_sub_kuesioner('tb_sub_kuesioner', $where);
		redirect('admin/sub_kuesioner');
	}

  //  Print doc
  function cetak_kuesioner_pdf($id_kuesioner, $dir){ //cetak pdf statistik
		$direktorat = rawurldecode($dir);
		$where = array('id_kuesioner' => $id_kuesioner);
		// $a['id_sub'] = $this->m_kuesioner->m_get_sub('tb_sub_kuesioner', $where)->result_array();
		$a['id_sub'] = $this->m_kuesioner->m_get_sub_tanggapan($id_kuesioner)->result_array();
		$data['jumlah_responden'] = $this->m_kuesioner->m_get_JmlResponden($id_kuesioner)->num_rows();
		$i = 0;
		foreach($a['id_sub'] as $aa){
			$i++;
			$data['statistik'.$i] = $this->m_kuesioner->m_get_statistik($aa['id_sub'], $direktorat,$id_kuesioner);
		}
		if($direktorat == 'Direktorat'){
			$data['direktorat'] = 'Semua Direktorat';

		}else{
			$data['direktorat'] = $direktorat;
		}
		$data['jumlah'] = $i;
		$where = array (
			'id_kuesioner' => $id_kuesioner
		);
		$data['judul'] = $this->m_kuesioner->m_get_judul('tb_kuesioner', $where)->result_array();
		$this->load->view('admin/print', $data);
	}

  function cetak_kuesioner_excel($id_kuesioner){
		$data['data_kuesioner'] = $this->m_kuesioner->m_get_data_kuesioner($id_kuesioner)->result_array();
		$data['pertanyaan'] = $this->m_kuesioner->m_get_pertanyaan($id_kuesioner)->result_array();
		$data['data_tanggapan'] = $this->m_kuesioner->m_get_allTanggapan($id_kuesioner)->result_array();
		$data['jumlah_soal_per_sub'] = $this->m_kuesioner->m_get_jumlah_soal_per_sub($id_kuesioner)->result_array();
		$data['nipg_pertama'] = $this->m_kuesioner->m_get_nipg_pertama($id_kuesioner)->result_array();
		$this->load->view('admin/export_excel', $data);
	}
}
?>
