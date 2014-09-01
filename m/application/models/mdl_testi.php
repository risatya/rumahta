<?php
Class Mdl_testi extends CI_Model{
	
	public function insertTesti($insertData){
		$this->db->insert("tbl_testimoni",$insertData);
	}
	
	public function getMemberTesti(){
		$this->db->select('*');
		$this->db->from('tbl_testimoni');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		$this->db->order_by('id_testimoni','desc');
		return $this->db->get()->result();
	}
	
	public function deleteTesti($id){
		$this->db->delete('tbl_testimoni',array('id_testimoni'=>$id));
	}
	
	public function cekTestimoni($id){
		$query = $this->db->get_where('tbl_testimoni',array("id_testimoni"=>$id,"id_user"=>$this->session->userdata('id_user')));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getTestiDetail($id){
		return $this->db->get_where('tbl_testimoni',array('id_testimoni'=>$id))->result();
	}
	
	public function updateTesti($id,$updateData){
		$this->db->where(array("id_testimoni"=>$id));
		$this->db->update('tbl_testimoni',$updateData);
	}
	
}

