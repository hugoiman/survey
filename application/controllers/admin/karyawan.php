<?php
class Karyawan extends CI_Controller{

  function __construct(){
    parent::__construct();
    if($this->permission() == false){
      redirect(base_url());
    }else{
      $this->load->model('admin/m_karyawan');
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

  function daftar_karyawan(){
    $data['karyawan'] = $this->m_karyawan->m_get_daftar_karyawan()->result_array();
    $data['divisi'] = $this->m_karyawan->m_get_divisi()->result_array();
    $data['direktorat'] = $this->m_karyawan->m_get_direktorat()->result_array();
    $this->load->view('admin/daftar_karyawan', $data);
  }

  function tambah_karyawan(){
    $nipg = $this->input->post('nipg');
    $name = $this->input->post('name');
    $gender = $this->input->post('gender');
    $tgl_lahir = $this->input->post('tgl_lahir');
    $grade = $this->input->post('grade');
    $division = $this->input->post('divisi');
    $direktorat = $this->input->post('direktorat');
    $password = md5("pgasol");
    $where1 = array(
      'nipg' => $nipg,
      'name' => $name,
      'gender' => $gender,
      'tgl_lahir' => $tgl_lahir,
      'grade' => $grade,
      'id_divisi' => $division,
      'id_direktorat' => $direktorat,
      'status' => 'Aktif'
    );
    $where2 = array(
      'nipg' => $nipg,
      'password' => $password,
      'level' => 'karyawan'
    );
    $cek_nipg = $this->m_karyawan->m_check_nipg($nipg)->num_rows();
    if ($cek_nipg > 0) {
      echo "<script>alert('NIPG sudah pernah digunakan. Silahkan coba lagi.');</script>";
      echo "<script>history.go(-1);</script>";
    }
    else{
      $this->m_karyawan->m_simpan_karyawan($where1, $where2);
      redirect('admin/daftar_karyawan');
    }
  }

  function cek_direktorat(){
    $id_divisi = $this->input->post('id_divisi');
    $data['direktorat'] = $this->m_karyawan->m_pilih_direktorat($id_divisi)->result_array();
    foreach ($data['direktorat'] as $data) {
      echo '<option value="'.$data['id_direktorat'].'">'.$data['direktorat'].'</option>';
    }
  }

  function edit_karyawan(){
    $nipg = $this->input->post('nipg');
    $nipg2 = $this->input->post('nipg2');
    $name = $this->input->post('name');
    $gender = $this->input->post('gender');
    $tgl_lahir = $this->input->post('tgl_lahir');
    $grade = $this->input->post('grade');
    $division = $this->input->post('divisi');
    $direktorat = $this->input->post('direktorat');
    $status = $this->input->post('status');
    $data = array(
      'nipg' => $nipg2,
      'name' => $name,
      'gender' => $gender,
      'tgl_lahir' => $tgl_lahir,
      'grade' => $grade,
      'id_divisi' => $division,
      'id_direktorat' => $direktorat,
      'status' => $status
    );
    $this->m_karyawan->m_update_karyawan($nipg,$data);
    redirect('admin/daftar_karyawan');
  }

  function hapus_karyawan($nipg){
    $this->m_karyawan->m_hapus_karyawan($nipg);
    redirect('admin/daftar_karyawan');
  }
}
?>
