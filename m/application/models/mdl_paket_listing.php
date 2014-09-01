<?php
Class Mdl_paket_listing extends CI_Model{
	
	function getPaketInfo(){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		$this->db->join('tbl_info_paket','tbl_paket.id_info_paket = tbl_info_paket.id_info_paket', 'left');
		return $this->db->get()->result();
	}
	
	function getAllPaketInfo(){
		//return $this->db->get('tbl_info_paket')->result();
		$this->db->order_by("id_info_paket","asc");
		return $this->db->get('tbl_info_paket')->result();
	}
	
	function getPaketDetail($id){
		return $this->db->get_where('tbl_info_paket',array('id_info_paket'=>$id))->result();
	}
	
	function getPaketMemberDetail($id){
		return $this->db->get_where('tbl_paket',array('id_info_paket'=>$id,'id_user'=>$this->session->userdata('id_user')))->result();
	}
	
	function getPaketDummyByToken($token){
		return $this->db->get_where('tbl_paket_dummy',array('token'=>$token))->result();
	}
	
	function getQuota(){
		$this->db->select('quota');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		return $this->db->get()->result();
	}
	
	function getPaket(){
		$this->db->select('id_info_paket');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		return $this->db->get()->result();
	}
	
	function getIDInfoPaket($id){
		$this->db->select('id_info_paket');
		$this->db->from('tbl_paket_dummy');
		$this->db->where(array("id_paket_dummy"=>$id));
		return $this->db->get()->result();
	}
	
	function getKonfirmasiByID(){
		$this->db->select('*');
		$this->db->from('tbl_paket_dummy');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		$this->db->join('tbl_info_paket','tbl_paket_dummy.id_info_paket = tbl_info_paket.id_info_paket', 'left');
		return $this->db->get()->result();
	}
	
	function insertPaketDummy($insertData){
		$this->db->insert("tbl_paket_dummy",$insertData);
	}
	
	function cekPaketDummy($token){
		$query = $this->db->get_where('tbl_paket_dummy',array('token'=>$token,'id_user'=>$this->session->userdata("id_user")));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function cekPaketDummyByID($id){
		$query = $this->db->get_where('tbl_paket_dummy',array('id_paket_dummy'=>$id,'id_user'=>$this->session->userdata("id_user")));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function deletePaketDummyByID($id){
		$this->db->delete("tbl_paket_dummy",array('id_paket_dummy'=>$id));
	}
	
	function insertKonfirmasi($insertData){
		$this->db->insert("tbl_konfirmasi_listing",$insertData);
	}
	
}

