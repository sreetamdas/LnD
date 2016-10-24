<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
    }
    function addmoderators($data)
    {
        if($this->db->insert('mod',$data)){
            return 1;
        }
        else
            return 0;
    }
    function getalltickets()
    {

        $data = $this->db->get('ticket')->result_array();
        return $data;
    }

}

