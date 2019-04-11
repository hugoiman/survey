<?php
class Kritik_saran extends CI_Controller{

  function __construct(){
    parent::__construct();
		if($this->permission() == false){
			redirect(base_url());
		}else{
			$this->load->model('karyawan/m_kritik_saran');
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

  function form_kritik_saran(){
    $data['sub'] = $this->m_kritik_saran->m_get_subs('tb_sub_kuesioner')->result_array();
    $this->load->view('user/kritik_saran', $data);
  }

  function simpan_kritik_saran(){
		$saran = $_GET["saran"];
		$subjek = $_GET["subjek"];
		$nipg = $_GET["nipg"];
		date_default_timezone_set("Asia/Jakarta");
		$data = array(
			'nipg' => $nipg,
			'subjek' => $subjek,
			'saran' => $saran,
			'waktu' => date("Y-m-d h:i:sa")
		);
		$this->m_kritik_saran->m_simpan_saran($data);
	}
}
?>
