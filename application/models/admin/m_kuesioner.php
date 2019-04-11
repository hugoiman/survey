<?php
class M_kuesioner extends CI_Model{

  function m_get_sub(){
		return $this->db->get('tb_sub_kuesioner');
	}

  //1.  Daftar Kuesioner
  function m_get_all_kuesioner(){ //menampilkan list kuesioner
		$this->db->order_by("id_kuesioner", "desc");
		return $this->db->get('tb_kuesioner');
	}

  //  Ganti status kuesioner
  function m_get_cekStatus_kuesioner($id_kuesioner){
		$data = $this->db->query("SELECT status FROM tb_kuesioner WHERE id_kuesioner = $id_kuesioner");
		return $data;
	}

  function m_set_status($data, $where){
		$this->db->where($where);
		$this->db->update('tb_kuesioner',$data);
	}

  //  Informasi Kuesioner
  function m_get_JmlResponden($id_kuesioner){ //menghitung jumlah responden pada kuesioner
		$jml = $this->db->query("SELECT * FROM tb_respon_kuesioner where id_kuesioner = ".$id_kuesioner." GROUP BY nipg");
		return $jml;
	}

  function m_get_statistik_sub($id_kuesioner){
		return $this->db->query("SELECT DISTINCT id_sub FROM tb_soal_kuesioner WHERE id_kuesioner = $id_kuesioner");
	}

  function m_get_responDirektorat($id_kuesioner){
		return $this->db->query("SELECT
		(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
			JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE c.direktorat = 'Direktorat Utama' AND a.id_kuesioner = $id_kuesioner) as d_utama,
		(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
			JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE c.direktorat = 'Direktorat Teknik dan Pengembangan' AND a.id_kuesioner = $id_kuesioner) as d_teknik_pengembangan,
		(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
			JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE c.direktorat = 'Direktorat Operasi' AND a.id_kuesioner = $id_kuesioner) as d_operasi,
		(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
			JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE c.direktorat = 'Direktorat Keuangan dan Administrasi' AND a.id_kuesioner = $id_kuesioner) as d_keuangan_administrasi"
			);
	}

	function m_get_responPangkat($id_kuesioner){
		return $this->db->query("SELECT
			(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
				JOIN tb_karyawan b ON a.nipg = b.nipg
				WHERE b.grade = 'Staff' AND a.id_kuesioner = $id_kuesioner) as staff,
			(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
				JOIN tb_karyawan b ON a.nipg = b.nipg
				WHERE b.grade = 'Supervisor' AND a.id_kuesioner = $id_kuesioner) as supervisor,
			(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
				JOIN tb_karyawan b ON a.nipg = b.nipg
				WHERE b.grade = 'Assistant Manager' AND a.id_kuesioner = $id_kuesioner) as asman,
			(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
				JOIN tb_karyawan b ON a.nipg = b.nipg
				WHERE b.grade = 'Manager' AND a.id_kuesioner = $id_kuesioner) as manager,
			(SELECT count(DISTINCT a.nipg) FROM tb_respon_kuesioner a
				JOIN tb_karyawan b ON a.nipg = b.nipg
				WHERE b.grade = 'AVP' AND a.id_kuesioner = $id_kuesioner) as avp"
		);
	}

	function m_get_responUsia($id_kuesioner){
		return $this->db->query("SELECT
			(SELECT COUNT(DISTINCT a.nipg) FROM tb_karyawan a
				JOIN tb_respon_kuesioner b ON a.nipg = b.nipg
				WHERE b.id_kuesioner = $id_kuesioner AND YEAR(CURDATE()) - YEAR(a.tgl_lahir) <= 25) AS u25,
			(SELECT COUNT(DISTINCT a.nipg) FROM tb_karyawan a
				JOIN tb_respon_kuesioner b ON a.nipg = b.nipg
				WHERE b.id_kuesioner = $id_kuesioner AND YEAR(CURDATE()) - YEAR(a.tgl_lahir) BETWEEN 26 AND 30) AS u30,
			(SELECT COUNT(DISTINCT a.nipg) FROM tb_karyawan a
				JOIN tb_respon_kuesioner b ON a.nipg = b.nipg
				WHERE b.id_kuesioner = $id_kuesioner AND YEAR(CURDATE()) - YEAR(a.tgl_lahir) BETWEEN 31 AND 35) AS u35,
			(SELECT COUNT(DISTINCT a.nipg) FROM tb_karyawan a
				JOIN tb_respon_kuesioner b ON a.nipg = b.nipg
				WHERE b.id_kuesioner = $id_kuesioner AND YEAR(CURDATE()) - YEAR(a.tgl_lahir) BETWEEN 36 AND 40) AS u40,
			(SELECT COUNT(DISTINCT a.nipg) FROM tb_karyawan a
				JOIN tb_respon_kuesioner b ON a.nipg = b.nipg
				WHERE b.id_kuesioner = $id_kuesioner AND YEAR(CURDATE()) - YEAR(a.tgl_lahir) >= 41) AS u41"
		);
	}

  function m_get_sub_tanggapan($id_kuesioner){
		return $this->db->query("SELECT rk.id_sub, sub_kuesioner FROM tb_respon_kuesioner rk JOIN tb_sub_kuesioner sk ON rk.id_sub=sk.id_sub where rk.id_kuesioner=$id_kuesioner group by rk.id_sub");
	}

  function m_get_statistik($id_sub, $direktorat,$id_kuesioner){ //menghitung statistik tiap kuesioner
		return $this->db->query("select
		(SELECT sub_kuesioner FROM tb_sub_kuesioner WHERE id_sub = ".$id_sub.") as sub_kuesioner,
		(select COUNT(a.jawaban) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
      JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE a.id_sub = ".$id_sub." and a.jawaban = 1 and c.direktorat LIKE '".$direktorat."%"."'
			and a.id_kuesioner = $id_kuesioner
		) as jawaban1,
		(select COUNT(a.jawaban) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
      JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE a.id_sub = ".$id_sub." and a.jawaban = 2 and c.direktorat LIKE '".$direktorat."%"."'
			and a.id_kuesioner = $id_kuesioner
		) as jawaban2,
		(select COUNT(a.jawaban) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
      JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE a.id_sub = ".$id_sub." and a.jawaban = 3 and c.direktorat LIKE '".$direktorat."%"."'
			and a.id_kuesioner = $id_kuesioner
		) as jawaban3,
		(select COUNT(a.jawaban) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
      JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE a.id_sub = ".$id_sub." and a.jawaban = 4 and c.direktorat LIKE '".$direktorat."%"."'
			and a.id_kuesioner = $id_kuesioner
		) as jawaban4,
		(select COUNT(a.jawaban) FROM tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
      JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE a.id_sub = ".$id_sub." and a.jawaban = 5 and c.direktorat LIKE '".$direktorat."%"."'
			and a.id_kuesioner = $id_kuesioner
		) as jawaban5
		");
	}

  function m_isEmpty($direktorat){
		return $this->db->query("SELECT * FROM tb_respon_kuesioner rk
			JOIN tb_karyawan k ON rk.nipg = k.nipg
			JOIN tb_direktorat d ON k.id_direktorat = d.id_direktorat
			where d.direktorat like '%".$direktorat."%' group by d.direktorat");
	}

  function m_get_id_terakhir($id_kuesioner){
		return $this->db->query("select nipg from tb_respon_kuesioner where id_kuesioner = $id_kuesioner limit 1");
	}

  function m_get_tanggapan($nipg, $id_sub,$id_kuesioner){ //get data tanggapan semua responden
		$tanggapan = $this->db->query("SELECT * FROM tb_respon_kuesioner a
		JOIN tb_soal_kuesioner b ON a.id_sk = b.id_sk
		JOIN tb_kuesioner c ON a.id_kuesioner = c.id_kuesioner
		WHERE a.nipg = ".$nipg." AND a.id_sub = ".$id_sub." AND a.id_kuesioner = ".$id_kuesioner."
		ORDER BY a.id_sk");
		return $tanggapan;
	}

  function m_get_dataResponden($id_kuesioner){
		$nipg = $this->db->query("SELECT DISTINCT a.nipg, a.name FROM tb_karyawan a
			JOIN tb_respon_kuesioner b
			ON a.nipg = b.nipg
			WHERE b.id_kuesioner = $id_kuesioner
			ORDER BY nipg DESC");
		return $nipg;
	}

  //  Edit Kuesioner
  function m_get_judul($table, $where){ //get sebuah judul
		return $this->db->get_where($table, $where);
	}

	function m_get_checked($table, $where){ //get checked
		return $this->db->get_where($table, $where);
	}

  function m_delete_target($where){
		$this->db->where($where);
		$this->db->delete('tb_target_kuesioner');
	}

  function m_target_kuesioner($data){
		$this->db->insert('tb_target_kuesioner', $data);
	}

  function m_edit_judul($data,$where){ //edit judul
		$this->db->where($where);
		$this->db->update('tb_kuesioner', $data);
	}

  function m_get_soal($id_kuesioner){ //get soal
		return $this->db->query('select s.id_kuesioner, k.judul_kuesioner, s.id_sub, sub_kuesioner, s.id_sk, s.soal_kuesioner FROM tb_soal_kuesioner s inner join tb_sub_kuesioner sb ON s.id_sub = sb.id_sub INNER JOIN tb_kuesioner k ON s.id_kuesioner = k.id_kuesioner where s.id_kuesioner = '.$id_kuesioner.' ORDER BY id_sub ASC');
	}

  function m_tambah_soal($data){ //buat / tambah soal
		$this->db->insert('tb_soal_kuesioner', $data);
		return $this->db->insert_id();
	}

  // function m_statistik_default($data){ //statistik awal setelah dibuat
	// 	$this->db->insert('tb_statistik', $data);
	// }

  function m_edit_tb_soal($table,$where,$data){ //edit soal
		$this->db->where($where);
		$this->db->update($table,$data);
	}

	// function m_edit_tb_statistik($table,$where,$data){ //edit soal
	// 	$this->db->where($where);
	// 	$this->db->update($table,$data);
	// }

	function m_edit_tb_respon($table,$where,$data){ //edit soal
		$this->db->where($where);
		$this->db->update($table,$data);
	}

  function m_hapus_soal($table,$where){ //delete soal
		$this->db->where($where);
		$this->db->delete($table);
	}

  //  Duplikat Kuesioner
  function m_buat_judul($data){ //simpan judul
		$this->db->insert('tb_kuesioner', $data);
		return $this->db->insert_id();
	}

  function m_get_soal_clone($id_kuesioner){ //get soal
		return $this->db->query("SELECT * from tb_soal_kuesioner where id_kuesioner = $id_kuesioner");
	}

  function m_create_soal($data){ //buat / tambah soal
		$this->db->insert('tb_soal_kuesioner', $data);
		return $this->db->insert_id();
	}

  //  Hapus Kuesioner
  function m_hapus_kuesioner($table,$where){ //delete kuesioner
		$this->db->where($where);
		$this->db->delete($table);
	}

  //  Daftar Sub Kuesioner
  function m_get_all_sub_kuesioner($table){
		$this->db->order_by("id_sub", "desc");
		return $this->db->get($table);
	}

  function m_simpan_sub($data){ //buat tambah sub
		$this->db->insert('tb_sub_kuesioner', $data);
	}

  function m_update_sub_kuesioner($table,$data,$where){ //edit soal
		$this->db->where($where);
		$this->db->update($table,$data);
	}

  function m_hapus_sub_kuesioner($table,$where){ //delete kuesioner
		$this->db->where($where);
		$this->db->delete($table);
	}

  //  Cetak doc
  function m_get_data_kuesioner($id_kuesioner){
		$data = $this->db->query("SELECT * From tb_kuesioner WHERE id_kuesioner = $id_kuesioner");
		return $data;
	}

  function m_get_pertanyaan($id_kuesioner){
		return $this->db->query("SELECT soal_kuesioner From tb_soal_kuesioner WHERE id_kuesioner = $id_kuesioner
			ORDER BY id_sub");
	}

	function m_get_allTanggapan($id_kuesioner){
		$data = $this->db->query("SELECT b.nipg, b.grade, c.direktorat, a.jawaban, YEAR(CURDATE()) - YEAR(b.tgl_lahir) as usia
			From tb_respon_kuesioner a
			JOIN tb_karyawan b ON a.nipg = b.nipg
			JOIN tb_direktorat c ON b.id_direktorat = c.id_direktorat
			WHERE id_kuesioner = $id_kuesioner");
		return $data;
	}

	function m_get_jumlah_soal_per_sub($id_kuesioner){
		$data = $this->db->query("SELECT b.sub_kuesioner, COUNT(b.sub_kuesioner) as jumlah_soal
			FROM tb_soal_kuesioner a
			JOIN tb_sub_kuesioner b ON a.id_sub = b.id_sub
			WHERE a.id_kuesioner = $id_kuesioner
			GROUP BY b.id_sub");
		return $data;
	}

	function m_get_nipg_pertama($id_kuesioner){
		$data = $this->db->query("SELECT nipg FROM tb_respon_kuesioner LIMIT 1");
		return $data;
	}
}
?>
