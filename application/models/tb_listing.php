<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tb_listing extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


	function get_posts($count)
	{
		$query = $this->db->get('tbl_listing', $count)->result();
		return $query;
	}
	
}