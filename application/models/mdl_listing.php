<?php
Class Mdl_listing extends CI_Model{
	
	function getPaketInfo(){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		$this->db->join('tbl_info_paket','tbl_paket.id_info_paket = tbl_info_paket.id_info_paket', 'left');
		return $this->db->get()->result();
	}
	
	function getPaketInfo2($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user'),'id_listing_member'=>$id));
		//$this->db->join('tbl_info_paket','tbl_listing_member.status_paket = tbl_info_paket.id_info_paket', 'left');
		return $this->db->get()->result();
	}
	
	function getPremiumListingForPage($num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket !=',1);
		$this->db->order_by('RAND()');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getFreeListingForPage($num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket',1);
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getFreeListingForPageRandom($num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('status_paket',1);
		$this->db->order_by('RAND()');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getListingForPage($num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->order_by('submit_date','desc');
		//$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	
	
	function getListingByStatusCategory($cat,$num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->order_by('status_listing','desc');
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		$this->db->where('tbl_kategori.status_kategori',$cat);
		return $this->db->get()->result();
	}
	
	function getListingByCategory($id,$num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('tbl_listing_member.id_kategori',$id);
		$this->db->order_by('status_listing','desc');
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getMemberListing(){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user')));
		$this->db->order_by('id_listing_member','desc');
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		return $this->db->get()->result();
	}
	
	function getListingByID($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_listing_member'=>$id,'id_user'=>$this->session->userdata('id_user')));
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten');
		return $this->db->get()->result();
	}
	
	function getListingByIDUser($id,$num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('tbl_listing_member.id_user',$id);
		$this->db->order_by('status_listing','desc');
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function getListingMemberByIDUser($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_user'=>$id));
		return $this->db->get()->result();
	}
	
	function getListingMemberByIDUser2($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_user'=>$id));
		$this->db->order_by('id_listing_member','desc');
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		return $this->db->get()->result();
	}
	
	function getListingPhotoByID($id){
		return $this->db->get_where('tbl_listing_photo',array('id_listing_member'=>$id))->result();
	}
	
	function getPhotoByID($id){
		return $this->db->get_where('tbl_listing_photo',array('id_listing_photo'=>$id))->result();
	}
	
	function getListingCoverByID($id){
		return $this->db->get_where('tbl_listing_photo',array('id_listing_member'=>$id,'cover'=>1))->result();
	}
	
	function getFasilitasLokasiByID($id){
		return $this->db->get_where('tbl_fasilitas_lokasi',array('id_listing_member'=>$id))->result();
	}
	
	function getFasilitasKiosByID($id){
		return $this->db->get_where('tbl_fasilitas_kios',array('id_listing_member'=>$id))->result();
	}
	
	function getFasilitasKamarByID($id){
		return $this->db->get_where('tbl_fasilitas_kamar',array('id_listing_member'=>$id))->result();
	}
	
	function getFasilitasKostByID($id){
		return $this->db->get_where('tbl_fasilitas_kost',array('id_listing_member'=>$id))->result();
	}
	
	function getQuota($id){
		$this->db->select('*');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user'),'id_paket'=>$id));
		return $this->db->get()->result();
	}
	
	function getPaket($id_paket){
		$this->db->select('id_info_paket');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$this->session->userdata('id_user'),"id_paket" => $id_paket));
		return $this->db->get()->result();
	}
	
	function getCategory(){
		return $this->db->get('tbl_kategori')->result();
	}
	
	function insertListing($insertData){
		$this->db->insert("tbl_listing",$insertData);
	}
	
	function insertListingMember($insertData){
		$this->db->insert("tbl_listing_member",$insertData);
	}
	
	function insertListingPhoto($insertData){
		$this->db->insert("tbl_listing_photo",$insertData);
	}
	
	function insertFasilitasLokasi($insertData){
		$this->db->insert("tbl_fasilitas_lokasi",$insertData);
	}
	
	function insertFasilitasKios($insertData){
		$this->db->insert("tbl_fasilitas_kios",$insertData);
	}
	
	function insertFasilitasKamar($insertData){
		$this->db->insert("tbl_fasilitas_kamar",$insertData);
	}
	
	function insertFasilitasKost($insertData){
		$this->db->insert("tbl_fasilitas_kost",$insertData);
	}
	
	function getPrimaryKey($hash){
		$this->db->select('id_listing');
		$this->db->from('tbl_listing');
		$this->db->where(array('token'=>$hash));
		return $this->db->get()->result();
	}
	
	function getPrimaryKey2($hash){
		$this->db->select('id_listing_member');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('token'=>$hash));
		return $this->db->get()->result();
	}
	
	function getListingInterval($id_paket){
		$this->db->select('id_info_paket');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_paket'=>$id_paket,'id_user'=>$this->session->userdata('id_user')));
		return $this->db->get()->result();
	}
	
	function getMonthInterval($param){
		$this->db->select('durasi_listing');
		$this->db->from('tbl_info_paket');
		$this->db->where(array('id_info_paket' => $param));
		return $this->db->get()->result();
	}
	
	function updateQuota($id,$param){
		$this->db->where('id_paket',$id);
		$this->db->update('tbl_paket',array("quota"=>$param));
	}
	
	function updateListingDetail1($id,$updateData){
		$this->db->where(array("id_listing"=>$id));
		$this->db->update('tbl_listing',$updateData);
	}
	
	function cekListingCoverByID($id){
		$query = $this->db->get_where('tbl_listing_photo',array('id_listing_member'=>$id,'cover'=>1));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function cekListingByID($id){
		$query = $this->db->get_where('tbl_listing_member',array('id_listing_member'=>$id,'id_user'=>$this->session->userdata('id_user')));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function cekListingByIDListing($id){
		$query = $this->db->get_where('tbl_listing_member',array('id_listing_member'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function setOldListingCover($id){
		$this->db->where(array('id_listing_member'=>$id,'cover'=>1));
		$this->db->update('tbl_listing_photo',array("cover"=>0));
	}
	
	function getListingID($param){
		$this->db->select('id_listing');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_listing_member'=>$param,'id_user'=>$this->session->userdata('id_user')));
		return $this->db->get()->result();
	}
	
	function updateKabupaten($id,$kab){
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->update('tbl_listing_member',array("id_kabupaten"=>$kab));
	}
	
	function updateFasilitasLokasi($id,$updateData){
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->update('tbl_fasilitas_lokasi',$updateData);
	}
	
	function updateFasilitasKios($id,$updateData){
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->update('tbl_fasilitas_kios',$updateData);
	}
	
	function updateFasilitasKamar($id,$updateData){
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->update('tbl_fasilitas_kamar',$updateData);
	}
	
	function updateFasilitasKost($id,$updateData){
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->update('tbl_fasilitas_kost',$updateData);
	}
	
	function updateCover($id){
		$this->db->where(array('id_listing_photo'=>$id));
		$this->db->update('tbl_listing_photo',array("cover"=>1));
	}	
	
	function getListingMemberID($param){
		$this->db->select('id_listing_member');
		$this->db->from('tbl_listing_photo');
		$this->db->where(array('id_listing_photo'=>$param));
		return $this->db->get()->result();
	}
	
	function deleteDetailListingByID($id){
		$this->db->delete("tbl_listing",array('id_listing'=>$id));
	}
	
	function deleteFasilitasLokasiByID($id){
		$this->db->delete("tbl_fasilitas_lokasi",array('id_listing_member'=>$id));
	}
	
	function deleteFasilitasKiosByID($id){
		$this->db->delete("tbl_fasilitas_kios",array('id_listing_member'=>$id));
	}
	
	function deleteFasilitasKamarByID($id){
		$this->db->delete("tbl_fasilitas_kamar",array('id_listing_member'=>$id));
	}
	
	function deleteFasilitasKostByID($id){
		$this->db->delete("tbl_fasilitas_kost",array('id_listing_member'=>$id));
	}
	
	function deleteListingMemberByID($id){
		$this->db->delete("tbl_listing_member",array('id_listing_member'=>$id));
	}
	
	function deleteListingPhoto($id){
		$this->db->delete("tbl_listing_photo",array('id_listing_photo'=>$id));
	}
	
	function deleteListingPhotoByID($id){
		$this->db->delete("tbl_listing_photo",array('id_listing_member'=>$id));
	}
	
	function deleteListingViewByID($id){
		$this->db->delete("tbl_listing_view",array('id_user'=>$id));
	}
	
	function markListing($id,$updateData){
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->update('tbl_listing_member',$updateData);
	}
	
	function getCountListingByIDUser($id){
		$query = $this->db->get_where('tbl_listing_member',array('id_user' => $id));
		return $query->num_rows();
	}
	
	function searchListing($searchData,$num,$offset){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		if($searchData['keyword'] != null){ $this->db->like('judul',$searchData['keyword']);}
		if($searchData['location'] != null){ $this->db->where('tbl_listing_member.id_kabupaten',$searchData['location']);}
		if($searchData['kamar_tidur_min'] != null){ $this->db->where('tbl_listing.jml_ktidur >=',$searchData['kamar_tidur_min']);}
		if($searchData['kamar_tidur_max'] != null){ $this->db->where('tbl_listing.jml_ktidur <=',$searchData['kamar_tidur_max']);}
		if($searchData['kamar_mandi_min'] != null){ $this->db->where('tbl_listing.jml_kmandi >=',$searchData['kamar_mandi_min']);}
		if($searchData['kamar_mandi_max'] != null){ $this->db->where('tbl_listing.jml_kmandi <=',$searchData['kamar_mandi_max']);}
		if($searchData['lbangunan_min'] != null){ $this->db->where('tbl_listing.luas_bangunan >=',$searchData['lbangunan_min']);}
		if($searchData['lbangunan_max'] != null){ $this->db->where('tbl_listing.luas_bangunan <=',$searchData['lbangunan_max']);}
		if($searchData['ltanah_min'] != null){ $this->db->where('tbl_listing.luas_tanah >=',$searchData['ltanah_min']);}
		if($searchData['ltanah_max'] != null){ $this->db->where('tbl_listing.luas_tanah <=',$searchData['ltanah_max']);}
		$this->db->where_in('tbl_listing_member.id_kategori',$searchData['category']);
		$this->db->order_by('status_listing','desc');
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}
	
	function countSearchListing($searchData){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		if($searchData['keyword'] != null){ $this->db->like('judul',$searchData['keyword']);}
		if($searchData['location'] != null){ $this->db->where('tbl_listing_member.id_kabupaten',$searchData['location']);}
		if($searchData['kamar_tidur_min'] != null){ $this->db->where('tbl_listing.jml_ktidur >=',$searchData['kamar_tidur_min']);}
		if($searchData['kamar_tidur_max'] != null){ $this->db->where('tbl_listing.jml_ktidur <=',$searchData['kamar_tidur_max']);}
		if($searchData['kamar_mandi_min'] != null){ $this->db->where('tbl_listing.jml_kmandi >=',$searchData['kamar_mandi_min']);}
		if($searchData['kamar_mandi_max'] != null){ $this->db->where('tbl_listing.jml_kmandi <=',$searchData['kamar_mandi_max']);}
		if($searchData['lbangunan_min'] != null){ $this->db->where('tbl_listing.luas_bangunan >=',$searchData['lbangunan_min']);}
		if($searchData['lbangunan_max'] != null){ $this->db->where('tbl_listing.luas_bangunan <=',$searchData['lbangunan_max']);}
		if($searchData['ltanah_min'] != null){ $this->db->where('tbl_listing.luas_tanah >=',$searchData['ltanah_min']);}
		if($searchData['ltanah_max'] != null){ $this->db->where('tbl_listing.luas_tanah <=',$searchData['ltanah_max']);}
		$this->db->where_in('tbl_listing_member.id_kategori',$searchData['category']);
		$this->db->order_by('status_listing','desc');
		$this->db->order_by('id_listing_member','desc');
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->num_rows();
	}
	
}

