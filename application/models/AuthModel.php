<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    function __construct()
  {
    parent::__construct();
  }

  function getAccountLogin($username,$password){
    return $this->db->query("SELECT * FROM user u, hak_akses ha WHERE u.username = '$username' and u.password = '$password' and u.id_hak_akses = ha.id_hak_akses")->result();
  }

}
