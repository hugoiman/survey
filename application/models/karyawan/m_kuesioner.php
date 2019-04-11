<?php
class M_kuesioner extends CI_Model{

  function m_get_id_kuesioner(){ //get id kuesioner
		$div = $this->session->userdata("id_divisi");
		$data = $this->db->query("select tk.id_kuesioner from tb_target_kuesioner tk INNER JOIN tb_kuesioner k ON tk.id_kuesioner=k.id_kuesioner INNER JOIN tb_divisi d ON tk.id_divisi=d.id_divisi WHERE k.status='aktif' AND d.id_divisi= '".$div."'");
		return $data;
	}

  function m_get_kuesioner($nipg, $id_kuesioner){
		$data = $this->db->query('select IF( EXISTS(select nipg, id_kuesioner from tb_respon_kuesioner where nipg = '.$nipg.' AND id_kuesioner = '.$id_kuesioner.' GROUP BY id_kuesioner), 1, 0) as isset');
		return $data;
	}

  function m_get_judulSelected($id_kuesioner){ //get suatu judul
		$judul = $this->db->query("SELECT * FROM tb_kuesioner where id_kuesioner = ".$id_kuesioner."");
		return $judul;
	}

  function m_get_cekStatus_kuesioner($id_kuesioner){
		$data = $this->db->query("select * from tb_target_kuesioner tk INNER JOIN tb_kuesioner k ON tk.id_kuesioner=k.id_kuesioner INNER JOIN tb_divisi d ON tk.id_divisi=d.id_divisi WHERE k.status='aktif' AND d.id_divisi= '".$this->session->userdata("id_divisi")."' AND tk.id_kuesioner='".$id_kuesioner."'");
		return $data;
	}
  function m_get_respon($table,$nipg,$id_kuesioner){
		$cekData = $this->db->query("SELECT nipg
			FROM $table
			WHERE nipg = $nipg AND id_kuesioner = $id_kuesioner
		");
		return $cekData;
	}

  function m_tampil_soal($table, $where){ //tampilkan soal yg belum diisi
		return $this->db->get_where($table,$where);
	}

  function m_tampil_soal_terisi($where, $nipg, $id_sub){ //tampilkan soal yg sudah diisi
		$data = $this->db->query("SELECT
		rk.jawaban, rk.id_kuesioner, rk.id_sub,
		rk.id_sk, sk.soal_kuesioner
		FROM tb_respon_kuesioner as rk
		JOIN tb_soal_kuesioner as sk
		ON rk.id_sk = sk.id_sk
		WHERE rk.id_kuesioner = $where AND rk.nipg = $nipg AND rk.id_sub = $id_sub
		");
		return $data;
	}

  function m_get_sub($id_kuesioner){
		return $this->db->query('select s.id_sub, sb.sub_kuesioner FROM tb_soal_kuesioner s inner join tb_sub_kuesioner sb ON s.id_sub = sb.id_sub where s.id_kuesioner = '.$id_kuesioner.' GROUP BY id_sub ORDER BY id_sub asc');
	}

  function m_cek_jawaban($table, $where){ //cek apakah sudah pernah jawab
		$data = $this->db->get_where($table,$where);
		return $data;
	}

  function m_get_jawaban($id_sk, $nipg, $id_kuesioner){ //get jawaban kuesioner yg pernah diisi
		return $this->db->query('Select jawaban from tb_respon_kuesioner where id_sk = '.$id_sk.' AND nipg='.$nipg.' AND id_kuesioner = '.$id_kuesioner.'');
	}

  // function m_update_statistik1($id,$jawaban){ //menambah jawaban
	// 	$this->db->query('update tb_statistik set '.$jawaban.' = '.$jawaban.'+1 where id_sk = '.$id.'');
	// }

	// function m_update_statistik2($id,$jawaban){ //mengurang jawaban
	// 	$this->db->query('update tb_statistik set '.$jawaban.' = '.$jawaban.'-1 where id_sk = '.$id.'');
	// }

  function m_update_jawaban($table,$where,$jawaban){ //update jawaban kuesioner
		$this->db->where($where);
		$this->db->update($table, $jawaban);
	}

  function m_simpan_jawaban($table,$jawaban){ //insert jawaban kuesioner
		$this->db->insert($table, $jawaban);
	}
}
?>
