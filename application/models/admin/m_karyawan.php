<?php
class M_karyawan extends CI_Model{

  function m_get_daftar_karyawan(){
		$data = $this->db->query("SELECT * FROM tb_karyawan k
			JOIN tb_user u ON k.nipg = u.nipg
			JOIN tb_divisi d ON d.id_divisi=k.id_divisi
			JOIN tb_direktorat e ON k.id_direktorat = e.id_direktorat
			WHERE u.level = 'karyawan' AND k.status != 'Terhapus'");
		return $data;
	}

  function m_get_divisi(){
		$data = $this->db->query("SELECT * FROM tb_divisi");
		return $data;
	}

  function m_get_direktorat(){
		$data = $this->db->query("SELECT * FROM tb_direktorat");
		return $data;
	}

  function m_pilih_direktorat($id_divisi){
		$data = $this->db->query("SELECT * FROM tb_direktorat a
			JOIN tb_divisi b ON a.id_direktorat = b.id_direktorat WHERE b.id_divisi = '$id_divisi'");
		return $data;
	}

  function m_simpan_karyawan($where1,$where2){
		$this->db->insert('tb_karyawan', $where1);
		$this->db->insert('tb_user', $where2);
	}

	function m_check_nipg($nipg){
		$this->db->where('nipg', $nipg);
    $query = $this->db->get("tb_karyawan");
		return $query;
	}

	function m_update_karyawan($nipg,$data){
		$this->db->where('nipg', $nipg);
		$this->db->update('tb_karyawan', $data);
	}

	function m_hapus_karyawan($nipg){
		$this->db->query("DELETE FROM tb_karyawan WHERE nipg = $nipg");
	}

}
?>
