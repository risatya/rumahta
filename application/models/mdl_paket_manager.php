<?php
Class Mdl_paket_manager extends CI_Model{
	
	function getAllPaket($num,$offset){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->order_by('id_paket','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_info_paket', 'tbl_paket.id_info_paket = tbl_info_paket.id_info_paket');
		$this->db->join('tbl_user', 'tbl_paket.id_user = tbl_user.id_user');
		return $this->db->get()->result();
	}
	
	function getSearchPaket($num,$offset,$keyword){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->order_by('id_paket','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_info_paket', 'tbl_paket.id_info_paket = tbl_info_paket.id_info_paket');
		$this->db->join('tbl_user', 'tbl_paket.id_user = tbl_user.id_user');
		$this->db->like('tbl_user.nama', $keyword);
		$this->db->or_like('tbl_user.username', $keyword);
		return $this->db->get()->result();
	}
	
	function getAllInfoPaket(){
		return $this->db->get('tbl_info_paket')->result();
	}
	
	function getAllKonfirmasiListing($num,$offset){
		$this->db->select('*');
		$this->db->from('tbl_konfirmasi_listing');
		$this->db->order_by('confirmed','asc');
		$this->db->order_by('id_konfirmasi_listing','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_info_paket', 'tbl_konfirmasi_listing.id_info_paket = tbl_info_paket.id_info_paket');
		$this->db->join('tbl_user', 'tbl_konfirmasi_listing.id_user = tbl_user.id_user');
		return $this->db->get()->result();
	}
	
	function getAllPaketDetail($num,$offset){
		$this->db->select('*');
		$this->db->from('tbl_info_paket');
		$this->db->order_by('id_info_paket','asc');
		$this->db->where(array("status" => 1));
		$this->db->limit($num,$offset);
		return $this->db->get()->result();
	}
	
	function cekKonfirmasiListing($id){
		$query = $this->db->get_where('tbl_konfirmasi_listing',array('id_konfirmasi_listing'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getKonfirmasiListingDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_konfirmasi_listing');
		$this->db->where(array('id_konfirmasi_listing' => $id));
		$this->db->join('tbl_info_paket', 'tbl_konfirmasi_listing.id_info_paket = tbl_info_paket.id_info_paket');
		$this->db->join('tbl_user', 'tbl_konfirmasi_listing.id_user = tbl_user.id_user');
		return $this->db->get()->result();
	}
	
	function getKonfirmasiDetailByID($id){
		return $this->db->get_where('tbl_konfirmasi_listing',array('id_konfirmasi_listing'=>$id))->result();
	}
	
	function cekPaketMember($id_user,$id_paket){
		$query = $this->db->get_where('tbl_paket',array('id_user'=>$id_user,'id_info_paket'=>$id_paket));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function cekPaketByID($id){
		$query = $this->db->get_where('tbl_paket',array("id_paket" => $id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getPaketMember($id_user,$id_paket){
		return $this->db->get_where('tbl_paket',array('id_user'=>$id_user,'id_info_paket'=>$id_paket))->result();
	}
	
	function getPaketMemberByID($id){
		return $this->db->get_where('tbl_paket',array('id_paket'=>$id_user))->result();
	}
	
	function getPaketDetailByID($id){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->where(array("id_paket" => $id));
		$this->db->join('tbl_info_paket', 'tbl_paket.id_info_paket = tbl_info_paket.id_info_paket');
		$this->db->join('tbl_user', 'tbl_paket.id_user = tbl_user.id_user');
		return $this->db->get()->result();
	}
	
	function getPaketInfoByID($id){
		return $this->db->get_where('tbl_info_paket',array('id_info_paket' => $id))->result();
	}
	
	function updatePaketMember($id_paket,$updateData){
		$this->db->where('id_paket',$id_paket);
		$this->db->update('tbl_paket',$updateData);
	}
	
	function updateStatusKonfirmasiPaket($id){
		$this->db->where(array("id_konfirmasi_listing" => $id));
		$this->db->update('tbl_konfirmasi_listing',array("confirmed" => 1));
	}
	
	function updateInfoPaket($id,$updateData){
		$this->db->where('id_info_paket',$id);
		$this->db->update('tbl_info_paket',$updateData);
	}
	
	function insertPaketMember($insertData){
		$this->db->insert("tbl_paket",$insertData);
	}
	
	function cekInfoPaket($id){
		$query = $this->db->get_where('tbl_info_paket',array('id_info_paket'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function insertInfoPaket($insertData){
		$this->db->insert("tbl_info_paket",$insertData);
	}
	
	function deleteKonfirmasi($id){
		$this->db->delete("tbl_konfirmasi_listing",array("id_konfirmasi_listing" => $id));
	}
	
	function deletePaketByID($id){
		$this->db->delete('tbl_paket',array('id_paket' => $id));
	}
	
	function count_search($keyword){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->order_by('id_paket','desc');
		$this->db->join('tbl_info_paket', 'tbl_paket.id_info_paket = tbl_info_paket.id_info_paket');
		$this->db->join('tbl_user', 'tbl_paket.id_user = tbl_user.id_user');
		$this->db->like('tbl_user.nama', $keyword);
		$this->db->or_like('tbl_user.username', $keyword);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	/****************************** BANNER MODEL **************************/
	/****************************** BANNER MODEL **************************/
	/****************************** BANNER MODEL **************************/
	
	function getAllBannerInfo(){
		$this->db->order_by("id_info_banner","asc");
		return $this->db->get("tbl_info_banner")->result();
	}
	
	function getActiveBanner($id){
		$now = date("Y-m-d H:i:s");
		return $this->db->get_where('tbl_banner',array('id_info_banner'=>$id,'expired_date >='=>$now,'status' => 1))->result();
	}
	
	function getAllKonfirmasiBanner(){
		$this->db->select('*');
		$this->db->from('tbl_konfirmasi_banner');
		$this->db->order_by('confirmed','asc');
		$this->db->order_by('id_konfirmasi_banner','asc');
		$this->db->join('tbl_banner_dummy', 'tbl_konfirmasi_banner.id_banner_dummy = tbl_banner_dummy.id_banner_dummy');
		$this->db->join('tbl_user', 'tbl_banner_dummy.id_user = tbl_user.id_user');
		$this->db->join('tbl_info_banner', 'tbl_banner_dummy.id_info_banner = tbl_info_banner.id_info_banner');
		$this->db->join('tbl_harga_banner', 'tbl_banner_dummy.id_harga = tbl_harga_banner.id_harga');
		return $this->db->get()->result();
	}
	
	function cekKonfirmasiBanner($id){
		$query = $this->db->get_where('tbl_konfirmasi_banner',array('id_konfirmasi_banner'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getKonfirmasiBannerByID($id){
		return $this->db->get_where('tbl_konfirmasi_banner',array('id_konfirmasi_banner'=>$id))->result();
	}
	
	function getKonfirmasiBannerDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_konfirmasi_banner');
		$this->db->where(array('id_konfirmasi_banner' => $id));
		$this->db->join('tbl_banner_dummy', 'tbl_konfirmasi_banner.id_banner_dummy = tbl_banner_dummy.id_banner_dummy');
		$this->db->join('tbl_user', 'tbl_banner_dummy.id_user = tbl_user.id_user');
		$this->db->join('tbl_info_banner', 'tbl_banner_dummy.id_info_banner = tbl_info_banner.id_info_banner');
		$this->db->join('tbl_harga_banner', 'tbl_banner_dummy.id_harga = tbl_harga_banner.id_harga');
		return $this->db->get()->result();
	}
	
	function getBannerDummyDetail($id){
		$this->db->select('*');
		$this->db->from('tbl_konfirmasi_banner');
		$this->db->where(array('id_konfirmasi_banner' => $id));
		$this->db->join('tbl_banner_dummy', 'tbl_konfirmasi_banner.id_banner_dummy = tbl_banner_dummy.id_banner_dummy');
		$this->db->join('tbl_harga_banner', 'tbl_banner_dummy.id_harga = tbl_harga_banner.id_harga');
		$this->db->join('tbl_info_banner', 'tbl_banner_dummy.id_info_banner = tbl_info_banner.id_info_banner');
		return $this->db->get()->result();
	}
	
	function getBannerDetailFromTblBanner($id){
		$this->db->select('*');
		$this->db->from('tbl_banner');
		$this->db->where(array("tbl_banner.id_info_banner"=>$id));
		$this->db->join('tbl_user', 'tbl_banner.id_user = tbl_user.id_user');
		$this->db->join('tbl_info_banner', 'tbl_banner.id_info_banner = tbl_info_banner.id_info_banner');
		return $this->db->get()->result();
	}
	
	function getIDBannerDummyFromTblBannerDummy($id){
		$this->db->select('id_banner_dummy');
		$this->db->from('tbl_konfirmasi_banner');
		$this->db->where(array('id_konfirmasi_banner' => $id));
		return $this->db->get()->result();
	}
	
	function getIDInfoBannerFromTblKonfirmasi($id){
		$this->db->select('id_info_banner');
		$this->db->from('tbl_banner_dummy');
		$this->db->where(array('id_banner_dummy' => $id));
		return $this->db->get()->result();
	}
	
	function getInfoBanner($id){
		$this->db->select('*');
		$this->db->from('tbl_info_banner');
		$this->db->where(array('id_info_banner' => $id));
		// $this->db->join('tbl_banner','tbl_info_banner.id_info_banner = tbl_banner.id_info_banner','left');
		return $this->db->get()->result();
	}

	function cekBannerAvailability($id){
		$query = $this->db->get_where('tbl_banner',array('id_info_banner'=>$id));
		if($query->num_rows() > 0){
			return false;
		}
		else{
			return true;
		}
	}
	
	function cekBannerDetail($id){
		$query = $this->db->get_where('tbl_banner',array('id_info_banner'=>$id));
		if($query->num_rows() > 0){
			return false;
		}
		else{
			return true;
		}
	}
	
	function activateBanner($insertData){
		$this->db->insert("tbl_banner",$insertData);
	}
	
	function deleteBannerConfirmByID($id){
		$this->db->delete("tbl_konfirmasi_banner",array("id_konfirmasi_banner"=>$id));
	}

	function deleteBannerDummy($id){
		$this->db->delete("tbl_banner_dummy",array("id_banner_dummy"=>$id));
	}
	
	function getAllUsername(){
		$this->db->select('username');
		$this->db->from('tbl_user');
		$this->db->order_by('username','asc');
		return $this->db->get()->result();
	}
	
	function getIDUSerByUsername($username){
		$this->db->select('id_user');
		$this->db->from('tbl_user');
		$this->db->where(array('username' => $username));
		return $this->db->get()->result();
	}
	
	function cekUserByUsername($username){
		$query = $this->db->get_where('tbl_user',array('username'=>$username));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function insertBanner($insertData){
		$this->db->insert('tbl_banner',$insertData);
	}
	
	function deleteBannerByID($id){
		$this->db->delete('tbl_banner',array('id_banner' => $id));
	}
	
	/*****************************HARGA PAKET*******************************/
	/*****************************HARGA PAKET*******************************/
	/*****************************HARGA PAKET*******************************/
	/*****************************HARGA PAKET*******************************/
	
	function getAllHargaPaket(){
		$this->db->select('*');
		$this->db->from('tbl_harga_banner');
		$this->db->order_by('posisi','asc');
		return $this->db->get()->result();
	}
	
	function newPaketHarga($insertData){
		$this->db->insert('tbl_harga_banner',$insertData);
	}
	
	function cekHargaPaket($id){
		$query = $this->db->get_where('tbl_harga_banner',array('id_harga'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function updateHargaPaket($id,$updateData){
		$this->db->where(array("id_harga" => $id));
		$this->db->update('tbl_harga_banner',$updateData);
	}
	
	function deletePaketHarga($id_harga){
		$this->db->delete('tbl_harga_banner',array('id_harga' => $id_harga));
	}
	
}

