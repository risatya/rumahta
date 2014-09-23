<?php
Class Mdl_page extends CI_Model{
	
	public function cekListingDetail($id){
		$now = date("Y-m-d H:i:s");
		$query = $this->db->get_where('tbl_listing_member',array('id_listing_member'=>$id,'expired_date >='=>$now));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function getListingDetail($id){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('id_listing_member',$id);
		$this->db->join('tbl_listing', 'tbl_listing_member.id_listing = tbl_listing.id_listing', 'left');
		$this->db->join('tbl_kategori', 'tbl_listing_member.id_kategori = tbl_kategori.id_kategori', 'left');
		$this->db->join('tbl_kab_indo', 'tbl_listing_member.id_kabupaten = tbl_kab_indo.id_kabupaten', 'left');
		return $this->db->get()->result();
	}

	function hitungJumlahView($userURL){
		$oke = $this->db->query("select COUNT(view) as jumlah from tbl_view_listing where id_listing  = '$userURL'");
		return $oke->row_array();

	}
	
	function getMemberDetail($id){
		$this->db->select('nama,hp,telepon,alamat,user_photo,company_name,company_photo');
		$this->db->from('tbl_user');
		$this->db->where(array('id_user'=>$id));
		return $this->db->get()->result();
	}
	
	function addListingView($insertData){
		$this->db->insert("tbl_listing_view",$insertData);
	}

	function tambahListView($insertview){
		$this->db->insert("tbl_view_listing",$insertview);
	}
	
	public function cekStatusCategory($cat){
		$query = $this->db->get_where('tbl_kategori',array('status_kategori'=>$cat));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function cekIDCategory($cat){
		$query = $this->db->get_where('tbl_kategori',array('id_kategori'=>$cat));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function cekCategory($id){
		$query = $this->db->get_where('tbl_artikel',array('id_artikel'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function cekNews($id){
		$query = $this->db->get_where('tbl_artikel',array('id_artikel'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function cekTestimoni($id){
		$query = $this->db->get_where('tbl_testimoni',array('id_testimoni'=>$id));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getCountByStatusCategory($cat){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->join('tbl_kategori','tbl_listing_member.id_kategori = tbl_kategori.id_kategori','left');
		$this->db->where(array('tbl_kategori.status_kategori'=>$cat));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getCountByCategory($id){
		$now = date("Y-m-d H:i:s");
		$this->db->select('*');
		$this->db->from('tbl_listing_member');
		$this->db->where('expired_date >=',$now);
		$this->db->where('id_kategori',$id);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getNewsByID($id){
		return $this->db->get_where('tbl_artikel',array('id_artikel' => $id))->result();
	}
	
	public function getTestimoniByID($id){
		$this->db->select('*');
		$this->db->from('tbl_testimoni');
		$this->db->where(array('status_testi' => 1,'id_testimoni' => $id));
		$this->db->join('tbl_user', 'tbl_testimoni.id_user = tbl_user.id_user', 'left');
		return $this->db->get()->result();
	}
	
	function getAllNews($num,$offset){
		$this->db->select('*');
		$this->db->from('tbl_artikel');
		$this->db->where(array('status' => 1));
		$this->db->order_by('id_artikel','desc');
		$this->db->limit($num,$offset);
		return $this->db->get()->result();
	}
	
	public function getCountAllNews(){
		$this->db->select('*');
		$this->db->from('tbl_artikel');
		$this->db->where(array('status' => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getCountAllTesti(){
		$this->db->select('*');
		$this->db->from('tbl_testimoni');
		$this->db->where(array('status_testi' => 1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	function getAllTesti($num,$offset){
		$this->db->select('*');
		$this->db->from('tbl_testimoni');
		$this->db->where(array('status_testi' => 1));
		$this->db->order_by('id_testimoni','desc');
		$this->db->limit($num,$offset);
		$this->db->join('tbl_user', 'tbl_testimoni.id_user = tbl_user.id_user', 'left');
		return $this->db->get()->result();
	}
	
	function getPageDetail($id){
		return $this->db->get_where('tbl_page',array('id_page' => $id))->result();
	}
	
	/*function getStatistikListingTerpasang($month,$year){
		return $this->db->get_where("tbl_statistik",array("tipe_statistik"=>1,"bulan"=>$month,"tahun"=>$year))->result();
	}
	
	function getStatistikListingLaku($month,$year){
		return $this->db->get_where("tbl_statistik",array("tipe_statistik"=>2,"bulan"=>$month,"tahun"=>$year))->result();
	}*/
	
}

