<?php
class Kritik_saran extends CI_Controller{

  function __construct(){
    parent::__construct();
    if($this->permission() == false){
      redirect(base_url());
    }else{
      $this->load->model('admin/m_kritik_saran');
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

  function daftar_kritik_saran(){
    $data['kritik_saran'] = $this->m_kritik_saran->m_get_all_kritik_saran()->result_array();
    $this->load->view('admin/daftar_kritik_saran', $data);
  }

  function kritik_saran($id_saran){
    $data['kritik_saran'] = $this->m_kritik_saran->m_get_kritik_saran($id_saran)->result_array();
    $this->load->view('admin/kritik_saran', $data);
  }

  function hapus_kritik_saran($id_saran){
    $where = array('id_saran' => $id_saran);
    $this->m_kritik_saran->m_hapus_kritik_saran($where);
    echo "<script>history.go(-1);</script>";
  }
}
?>
