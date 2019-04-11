<?php
class M_password extends CI_Model{

  function m_update_password($nipg,$new){
    $this->db->query("UPDATE tb_user SET password = md5('$new') WHERE nipg = '$nipg'");
  }
}
?>
