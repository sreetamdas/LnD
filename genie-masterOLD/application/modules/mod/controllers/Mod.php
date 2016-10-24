<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mod extends MX_Controller
{
	function __construct()
	{
		parent::__construct(); 
		$this->load->library('auth/ion_auth');
		$this->load->model('mod_model');
		$this->load->helper(array('form', 'url'));
		if(!$this->ion_auth->logged_in())
			redirect('/auth/login/','refresh');
		if(!$this->ion_auth->in_group(3))
			redirect('/auth/login/','refresh');
    $this->info = $this->mod_model->getmodinfo($this->ion_auth->get_user_id());
      }
    function _render_page($view,$data=null)
 {
	
	$this->load->view('dash', $data);
	$this->load->view($view, $data);
	$this->load->view('footer', $data);
 }

 function index()
 {
 	$this->_render_page('sample');
 }
 function tickets()
 {
  $pass['data'] = $this->mod_model->getalltickets();
  $tag = $this->info[0]['tags'];
  $arrayobj = new ArrayObject();
  foreach($pass['data'] as $row){
    $tags = explode(',',$row['tags']);
    $is_present = array_search($tag,$tags);

    if($is_present>-1){
      $arrayobj->append($row);
    }
  }
  $pass['data'] = $arrayobj;
  $this->_render_page('alltickets',$pass);
 }

}