<?php
class Password extends CI_Controller{

  function __construct(){
    parent::__construct();
    if($this->permission() == false){
      redirect(base_url());
    }else{
      $this->load->model('karyawan/m_password');
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

  function form_password(){
    $this->load->view('user/password');
  }

  function edit_password(){
    $nipg = $this->input->post('nipg');
    $password_baru = $this->input->post('password_baru');
    $update_session = array("password" => $password_baru);
    $this->session->set_userdata($update_session);
    $this->m_password->m_update_password($nipg,$password_baru );
  }

}
?>
