<?php
class M_kritik_saran extends CI_Model{

  function m_get_subs($table){
		return $this->db->get($table);
	}

	function m_simpan_saran($jawaban){ //insert saran
		$this->db->insert('tb_saran', $jawaban);
	}
}
?>
