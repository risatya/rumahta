<?php
Class Mdl_banner extends CI_Model{
	
	function getBannerPhotoByID($id_info_banner){
		$query = $this->db->get_where('tbl_banner',array('id_info_banner'=>$id_info_banner));
		if($query->num_rows() < 1){
			return false;
		}
		else{
			return $this->db->get_where('tbl_banner',array('id_info_banner'=>$id_info_banner))->result();
		}
	}
	
	function getAvailableBannerCount($id){
		$now = date("Y-m-d H:i:s");
		$query = $this->db->get_where('tbl_banner',array('posisi'=>$id,'expired_date >='=>$now));
		return $query->num_rows();
	}
	
	// function getBannerPosition($posisi){
		// return $this->db->get_where("tbl_info_banner",array("posisi_banner"=>$posisi))->result();
	// }
	
	function getBannerPriceByPosition($posisi){
		return $this->db->get_where("tbl_harga_banner",array("posisi"=>$posisi))->result();
	}
	
	function insertDataBannerDummy($insertData){
		$this->db->insert("tbl_banner_dummy",$insertData);
	}
	
	function cekBannerDummy($token){
		$query = $this->db->get_where('tbl_banner_dummy',array('token'=>$token,'id_user'=>$this->session->userdata("id_user")));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function cekBannerDummyByID($id){
		$query = $this->db->get_where('tbl_banner_dummy',array('id_banner_dummy'=>$id,'id_user'=>$this->session->userdata("id_user")));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getBannerDetailByToken($token){
		$this->db->select("*");
		$this->db->from("tbl_banner_dummy");
		$this->db->where(array("token"=>$token));
		$this->db->join("tbl_harga_banner","tbl_banner_dummy.id_harga = tbl_harga_banner.id_harga","left");
		return $this->db->get()->result();
	}
	
	function getBannerDetailByID($id){
		$this->db->select("*");
		$this->db->from("tbl_banner_dummy");
		$this->db->where(array("id_banner_dummy"=>$id));
		$this->db->join("tbl_harga_banner","tbl_banner_dummy.id_harga = tbl_harga_banner.id_harga","left");
		return $this->db->get()->result();
	}
	
	function getKonfirmasiByID(){
		$this->db->select('*');
		$this->db->from('tbl_banner_dummy');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user'),'status'=>0));
		$this->db->order_by('id_banner_dummy','desc');
		$this->db->join('tbl_info_banner','tbl_banner_dummy.id_info_banner = tbl_info_banner.id_info_banner', 'left');
		$this->db->join('tbl_harga_banner','tbl_banner_dummy.id_harga = tbl_harga_banner.id_harga', 'left');
		return $this->db->get()->result();
	}
	
	function deleteBannerDummyByID($id){
		$this->db->delete("tbl_banner_dummy",array('id_banner_dummy'=>$id));
	}
	
	function updateBannerDummyByID($id){
		$this->db->where(array('id_banner_dummy'=>$id));
		$this->db->update('tbl_banner_dummy',array("status"=>1));
	}
	
	function getIDInfoBanner($id){
		$this->db->select('id_info_banner');
		$this->db->from('tbl_banner_dummy');
		$this->db->where(array("id_banner_dummy"=>$id));
		return $this->db->get()->result();
	}
	
	function insertKonfirmasi($insertData){
		$this->db->insert("tbl_konfirmasi_banner",$insertData);
	}
	
}

