<?php
class M_kritik_saran extends CI_Model{

  function m_get_all_kritik_saran(){ //menampilkan list saran
		return $this->db->query("select s.id_saran, s.waktu, k.name, s.subjek, s.saran FROM tb_saran s INNER JOIN tb_karyawan k ON s.nipg=k.nipg order by id_saran desc");
	}

  function m_get_kritik_saran($id_saran){
		$data = $this->db->query("SELECT * FROM tb_saran s
			JOIN tb_karyawan k ON s.nipg = k.nipg
			JOIN tb_divisi d ON d.id_divisi = k.id_divisi
			WHERE s.id_saran = $id_saran");
		return $data;
	}

	function m_hapus_kritik_saran($where){
		$this->db->where($where);
		$this->db->delete('tb_saran');
	}
}
?>
