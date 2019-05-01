<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_model extends CI_Model{

    public function getAllfood(){

        return $this->db->get('food')->result_array();

    }

}

?>
