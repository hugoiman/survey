<?php
class Auth extends CI_Controller{

	function __construct(){
		parent::__construct();
		  $this->load->model('m_auth');
	}

  function index(){
    if($this->session->userdata('islogin') != "logged"){
			$this->load->view('login');
    }else if($this->session->userdata('islogin') == "logged" && $this->session->userdata('level') == "admin"){
			redirect(base_url("karyawan/daftar_karyawan"));
    }else if($this->session->userdata('islogin') == "logged" && $this->session->userdata('level') == "karyawan"){
			redirect(base_url("daftar_kuesioner"));
    }
  }
  function logout(){
    $this->session->sess_destroy();
    redirect(base_url());
  }
  function login(){
    $username = $this->input->post('nipg');
    $password = $this->input->post('password');

    $where = array(
      'nipg' => $username,
      'password' => md5($password)
    );
    $get = $this->m_auth->cek_login('tb_user',$where);
      foreach ($get->result_array() as $getLevel) {
        $who =  $getLevel['level'];
      }

    $cek = $this->m_auth->cek_login("tb_user", $where)->num_rows();
    if ($get->num_rows() > 0) {
      $where = array(
      'nipg' => $username
    );
      $ambildata = $this->m_auth->cek_login('tb_karyawan',$where)->result_array();
      foreach ($ambildata as $data) {
        $data_session = array(
          'name' => $data['name'],
          'nipg'=> $data['nipg'],
					'status'=> $data['status'],
          'id_divisi'=> $data['id_divisi'],
          'level' => $who,
          'islogin' => 'logged'
        );
        $this->session->set_userdata($data_session);
      }
      $id = $this->session->userdata("id_divisi");
      $ambildata2 = $this->m_auth->get_division($id)->result_array();
      foreach ($ambildata2 as $data2) {
        $data_session2 = array(
          'nama_divisi'=> $data2['nama_divisi']
        );
        $this->session->set_userdata($data_session2);
      }
      if($who == 'admin'){
        echo "admin";
      }else if($who == 'karyawan' && $data_session['status'] == 'Aktif'){
        echo "karyawan";
      }elseif ($data_session['status'] == 'Tidak Aktif') {
      	echo "Tidak Aktif";
      }
    }else{
      echo "wrong";
    }

  }
}
