<?php
Class Mdl_page_manager extends CI_Model{
	
	function getAllPage(){
		return $this->db->get('tbl_page')->result();
	}
	
	function insertPage($insertData){
		$this->db->insert('tbl_page',$insertData);
	}
	
	function cekPageByID($id){
		$query = $this->db->get_where('tbl_page',array('id_page'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getPageDetailByID($id){
		$this->db->select('*');
		$this->db->from('tbl_page');
		$this->db->where(array('id_page' => $id));
		return $this->db->get()->result();
	}
	
	function deletePage($id){
		$this->db->delete('tbl_page',array('id_page' => $id));
	}
	
	function updatePage($id,$updateData){
		$this->db->where(array('id_page' => $id));
		$this->db->update('tbl_page',$updateData);
	}
	
}