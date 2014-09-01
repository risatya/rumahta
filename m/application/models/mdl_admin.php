<?php
Class Mdl_admin extends CI_Model{
	
	function validateLogin(){
		$query = $this->db->get_where('tbl_admin',array('username'=>$this->input->post('username'),'password'=>sha1($this->input->post('password'))));
		if($query->num_rows() > 0){
			$query2 = $this->db->get_where('tbl_admin',array('username'=>$this->input->post('username'),'password'=>sha1($this->input->post('password')),"status"=>1));
			if($query2->num_rows() > 0){
				return 1;
			}
			else{
				return 2;
			}
		}
		else{
			return 3;
		}
	}
	
	function getAdminProfile(){
		return $this->db->get_where("tbl_admin",array("id_admin" => $this->session->userdata("id_admin")))->result();
	}
	
	function getIDAdminByUsername(){
		return $this->db->get_where("tbl_admin",array("username" => $this->input->post('username')))->result();
	}
	
	function getListingSubmitStatistik($date){
		$query = $this->db->get_where("tbl_listing_member",array('submit_date'=>$date));
		return $query->num_rows();
	}
	
	function getMemberDetail($id){
		return $this->db->get_where("tbl_user",array('id_user'=>$id))->result();
	}
	
	function getMemberStatistik($date){
		$query = $this->db->get_where("tbl_user",array('submit_date'=>$date));
		return $query->num_rows();
	}
	
	function getAllMember($num,$offset){
		$this->db->order_by("id_user","desc");
		$this->db->limit($num,$offset);
		return $this->db->get("tbl_user")->result();
	}
	
	function getSearchMember($num,$offset,$keyword){
		$this->db->order_by("id_user","desc");
		$this->db->like("nama",$keyword);
		$this->db->or_like("username",$keyword);
		$this->db->limit($num,$offset);
		return $this->db->get("tbl_user")->result();
	}
	
	function count_search($table,$keyword){
		$this->db->like("nama",$keyword);
		$this->db->or_like("username",$keyword);
		$query = $this->db->get($table);
		return $query->num_rows();
	}
	
	function updateMemberByID($id,$param){
		$this->db->where('id_user',$id);
		$this->db->update('tbl_user',$param);
	}
	
	function deleteBannerByIDUser($id){
		$this->db->delete("tbl_banner",array('id_user'=>$id));
	}
	
	function deleteBannerDummyByIDUser($id){
		$this->db->delete("tbl_banner_dummy",array('id_user'=>$id));
	}
	
	function deletePaketByIDUser($id){
		$this->db->delete("tbl_paket",array('id_user'=>$id));
	}
	
	function deletePaketDummyByIDUser($id){
		$this->db->delete("tbl_paket_dummy",array('id_user'=>$id));
	}
	
	function deleteKonfirmasiBannerByID($id){
		$this->db->delete("tbl_konfirmasi_banner",array('id_user'=>$id));
	}
	
	function deleteKonfirmasiListingByID($id){
		$this->db->delete("tbl_konfirmasi_listing",array('id_user'=>$id));
	}
	
	function deleteTestimoniByID($id){
		$this->db->delete("tbl_testimoni",array('id_user'=>$id));
	}
	
	function deleteUrlMemberByID($id){
		$this->db->delete("tbl_url",array('id_user'=>$id));
	}
	
	function deleteUserByID($id){
		$this->db->delete("tbl_user",array('id_user'=>$id));
	}
	
}

