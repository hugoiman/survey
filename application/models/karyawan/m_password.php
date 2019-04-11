<?php
class M_password extends CI_Model{

  function m_update_password($nipg,$password_baru){
    $this->db->query("UPDATE tb_user SET password = md5('$password_baru') WHERE nipg = '$nipg'");
  }
}
?>
