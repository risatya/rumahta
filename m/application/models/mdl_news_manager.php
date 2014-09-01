<?php
Class Mdl_news_manager extends CI_Model{
	
	function getAllNews(){
		$this->db->select('*');
		$this->db->from('tbl_artikel');
		$this->db->order_by('id_artikel','desc');
		return $this->db->get()->result();
	}
	
	function insertNews($insertData){
		$this->db->insert('tbl_artikel',$insertData);
	}
	
	function cekNewsByID($id){
		$query = $this->db->get_where('tbl_artikel',array('id_artikel'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function updateStatusNews($id,$updateData){
		$this->db->where('id_artikel',$id);
		$this->db->update('tbl_artikel',$updateData);
	}
	
	function getNewsDetailByID($id){
		$this->db->select('*');
		$this->db->from('tbl_artikel');
		$this->db->where(array('id_artikel' => $id));
		return $this->db->get()->result();
	}
	
	function updateNews($id,$updateData){
		$this->db->where(array('id_artikel' => $id));
		$this->db->update('tbl_artikel',$updateData);
	}
	
	function deleteNews($id){
		$this->db->delete('tbl_artikel',array('id_artikel' => $id));
	}
	
}