<?php

class M_auth extends CI_Model{
  function cek_login($table,$where){
    return $this->db->get_where($table,$where);
  }
  function get_division($id){
    return $this->db->query("select nama_divisi from tb_divisi where id_divisi =".$id."");
  }
}
