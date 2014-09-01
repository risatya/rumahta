<?php
Class Mdl_testi_manager extends CI_Model{
	
	function getAllTestimoni(){
		$this->db->select('*');
		$this->db->from('tbl_testimoni');
		$this->db->order_by('status_testi','asc');
		$this->db->order_by('tanggal','desc');
		$this->db->join('tbl_user','tbl_testimoni.id_user = tbl_user.id_user');
		return $this->db->get()->result();
	}
	
	function cekTestimoniByID($id){
		$query = $this->db->get_where('tbl_testimoni',array('id_testimoni'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function updateStatusTestimoni($id,$updateData){
		$this->db->where('id_testimoni',$id);
		$this->db->update('tbl_testimoni',$updateData);
	}
	
}

