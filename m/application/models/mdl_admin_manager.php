<?php
Class Mdl_admin_manager extends CI_Model{
	
	function getAllAdmin(){
		$this->db->select('*');
		$this->db->from('tbl_admin');
		$this->db->order_by('status','desc');
		$this->db->order_by('id_admin','asc');
		return $this->db->get()->result();
	}
	
	function cekAdminByID($id){
		$query = $this->db->get_where('tbl_admin',array('id_admin'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function insertNewAdmin($insertData){
		$this->db->insert('tbl_admin',$insertData);
	}
	
	function updateStatusAdmin($id,$updateData){
		$this->db->where('id_admin',$id);
		$this->db->update('tbl_admin',$updateData);
	}
	
	function getAdminDetail($id){
		return $this->db->get_where("tbl_admin",array('id_admin'=>$id))->result();
	}
	
	function deleteAdmin($id){
		$this->db->delete('tbl_admin',array('id_admin' => $id));
	}
	
	function updateAdmin($updateData,$id){
		$this->db->where(array("id_admin" => $id));
		$this->db->update("tbl_admin",$updateData);
	}
	
}