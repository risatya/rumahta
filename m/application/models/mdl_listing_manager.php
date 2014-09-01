<?php
Class Mdl_listing_manager extends CI_Model{
	
	function getPaketInfo($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_listing_member'=>$id));
		return $this->db->get()->result();
	}
	
	function getListingByID($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_listing_member'=>$id));
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten');
		return $this->db->get()->result();
	}
	
	function getListingByID2($id){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_listing_member'=>$id));
		return $this->db->get()->result();
	}
	
	function getListingPhotoByID($id){
		return $this->db->get_where('tbl_listing_photo',array('id_listing_member'=>$id))->result();
	}
	
	function getListingCoverByID($id){
		return $this->db->get_where('tbl_listing_photo',array('id_listing_member'=>$id,'cover'=>1))->result();
	}
	
	function getListingID($param){
		$this->db->select('id_listing');
		$this->db->from('tbl_listing_member');
		$this->db->where(array('id_listing_member'=>$param));
		return $this->db->get()->result();
	}
	
	function cekListingByID($id){
		$query = $this->db->get_where('tbl_listing_member',array('id_listing_member'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getPaket($id){
		$this->db->select('id_info_paket');
		$this->db->from('tbl_paket');
		$this->db->where(array('id_user'=>$id));
		return $this->db->get()->result();
	}
	
	function getAllListing($num,$offset){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		return $this->db->get()->result();
	}
	
	function getSearchListing($num,$offset,$keyword){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->order_by('id_listing_member','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		$this->db->like('tbl_listing.judul',$keyword);
		return $this->db->get()->result();
	}
	
	function count_search($keyword){
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->order_by('id_listing_member','desc');
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori');
		$this->db->like('tbl_listing.judul',$keyword);
		$query = $this->db->get();
		return $query->num_rows();

	}
	
}

