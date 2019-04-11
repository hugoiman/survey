<?php
class Kuesioner extends CI_Controller{

  function __construct(){
    parent::__construct();
	if($this->permission() == false){
		redirect(base_url());
	}else{
		$this->load->model('karyawan/m_kuesioner');
	}
  }

  function permission(){
	$lvl = $this->session->userdata("level");
	$status = $this->session->userdata("status");
	if($lvl == "karyawan" && $status == "Aktif"){
		return true;
	}else{
		return false;
	}
}

  function daftar_kuesioner(){
    $z = $this->m_kuesioner->m_get_id_kuesioner();
		$data['id_kuesioner'] = $z->result_array();
		$data['jml_kuesioner'] = $z->num_rows();
		$i = 0;
		foreach($data['id_kuesioner'] as $aa){
			$i++;
			$data['kuesioner'.$i] = $this->m_kuesioner->m_get_kuesioner($this->session->userdata('nipg'), $aa['id_kuesioner']);
			$data['judul'.$i] = $this->m_kuesioner->m_get_judulSelected($aa['id_kuesioner']);
		}
		$this->load->view('user/daftar_kuesioner', $data);
  }

  function get_respon($id_kuesioner){
		$nipg = $this->session->userdata("nipg");
		$cekStatus['status'] = $this->m_kuesioner->m_get_cekStatus_kuesioner($id_kuesioner)->result_array();

		if($cekStatus['status'] == null){
			redirect(base_url('404'));
		}else{
			foreach ($cekStatus['status'] as $data) {
				if($data['status'] == "aktif"){
					$data = $this->m_kuesioner->m_get_respon('tb_respon_kuesioner',$nipg, $id_kuesioner);
					if ($data->num_rows() > 0){
						$this->tampil_soal_terisi($id_kuesioner);
					}
					else{
						$this->tampil_soal($id_kuesioner);
					}
				}
				else{
					redirect(base_url('404'));
				}
			}
		}
	}

  function tampil_soal($id_kuesioner){ //165
		$where = array(
			'id_kuesioner' => $id_kuesioner //165
		);
		$data['judul'] = $this->m_kuesioner->m_tampil_soal('tb_kuesioner',$where)->result_array();
		$data['sub'] = $this->m_kuesioner->m_get_sub($id_kuesioner)->result_array();
		$i = 1;
		foreach($data['sub'] as $a){
			$where2 = array(
				'id_sub' => $a['id_sub'],
				'id_kuesioner' => $id_kuesioner
			);
			$data['datas'.$i] = $this->m_kuesioner->m_tampil_soal('tb_soal_kuesioner',$where2)->result_array();
			$i++;
		}
		$this->load->view('user/soal', $data);
	}

	function tampil_soal_terisi($id_kuesioner){
		$id_kuesioner_kuesioner = $id_kuesioner;
		$nipg = $this->session->userdata("nipg");
		$where = array(
			'id_kuesioner' => $id_kuesioner
		);
		$data['judul'] = $this->m_kuesioner->m_tampil_soal('tb_kuesioner',$where)->result_array();
		$data['sub'] = $this->m_kuesioner->m_get_sub($id_kuesioner)->result_array();
		$i = 1;
		foreach($data['sub'] as $a){

			$id_sub = $a['id_sub'];

			$data['datas'.$i] = $this->m_kuesioner->m_tampil_soal_terisi($id_kuesioner,$nipg,$id_sub)->result_array();
			$i++;
		}

		$this->load->view('user/soal', $data);
	}

	function simpan_jawaban(){
		$id_sk = $_POST["id_sk"];
		$id_kuesioner = $_POST["id_kuesioner"];
		$id_sub = $_POST["id_sub"];
		$pilihan = $_POST["pilihan"];
		$nipg = $this->session->userdata("nipg");
		$where = array( //kondisi apakah nipg ini sudah menjawab kuesioner ini ?
			'nipg' => $nipg,
			'id_kuesioner' => $id_kuesioner
		);
		$cek_data = $this->m_kuesioner->m_cek_jawaban('tb_respon_kuesioner', $where);//cek apakah sudah dijawab
		if ($cek_data->num_rows() > 0){ //jika sudah dijawab update jawaban
			for ($i = 0 ; $i < count($pilihan) ; $i++) {
				$where = array(
					'id_sk' => $id_sk[$i],
					'nipg' => $nipg,
					'id_kuesioner' => $id_kuesioner
				);
				$jawaban = array(
					'jawaban' => $pilihan[$i]
				);
				$answer['jawab'] = $this->m_kuesioner->m_get_jawaban($id_sk[$i], $nipg, $id_kuesioner)->result_array();//get jawaban sebelumnya
				foreach($answer['jawab'] as $a){ //
					$ans = $a['jawaban'];
					if($ans == "1"){ //jika jawaban sebelumnya 1 maka kurangi 1 pada jawaban 1, dst sampai jawaban 5
						$this->m_kuesioner->m_update_statistik2($id_sk[$i], 'jawaban1');
					}else if($ans == "2"){
						$this->m_kuesioner->m_update_statistik2($id_sk[$i], 'jawaban2');
					}else if($ans == "3"){
						$this->m_kuesioner->m_update_statistik2($id_sk[$i], 'jawaban3');
					}else if($ans == "4"){
						$this->m_kuesioner->m_update_statistik2($id_sk[$i], 'jawaban4');
					}else{
						$this->m_kuesioner->m_update_statistik2($id_sk[$i], 'jawaban5');
					}
				}
				$this->m_kuesioner->m_update_jawaban('tb_respon_kuesioner', $where, $jawaban); //update jawaban yang baru
				if($pilihan[$i] == "1"){ //jika jawaban terbaru 1 tambah 1 pada jawaban 1, dst sampai jawaban 5
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban1');
				}else if($pilihan[$i] == "2"){
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban2');
				}else if($pilihan[$i] == "3"){
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban3');
				}else if($pilihan[$i] == "4"){
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban4');
				}else{
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban5');
				}
			}
		}
		else{ //jika belum dijawab insert jawaban
			for ($i = 0 ; $i < count($pilihan) ; $i++) {
				$jawaban = array(
					'id_sk' => $id_sk[$i],
					'nipg' => $this->session->userdata("nipg"),
					'id_kuesioner' => $id_kuesioner,
					'id_sub' => $id_sub[$i],
					'jawaban' => $pilihan[$i]
				);
				$this->m_kuesioner->m_simpan_jawaban('tb_respon_kuesioner', $jawaban);//insert jawaban yang baru
				if($pilihan[$i] == "1"){ //jika jawaban terbaru 1 tambah 1 pada jawaban 1, dst sampai jawaban 5
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban1');
				}else if($pilihan[$i] == "2"){
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban2');
				}else if($pilihan[$i] == "3"){
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban3');
				}else if($pilihan[$i] == "4"){
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban4');
				}else{
					$this->m_kuesioner->m_update_statistik1($id_sk[$i], 'jawaban5');
				}
		 	}
		}
		header('Location:daftar_kuesioner');
	}


}
?>
