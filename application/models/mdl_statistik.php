<?php
Class Mdl_statistik extends CI_Model{
	
	public function getAllStatistikByDate($date){
		$query = $this->db->get_where("tbl_listing_view",array('tanggal'=>$date,"id_user"=>$this->session->userdata('id_user')));
		return $query->num_rows();
	}
	
	public function getStatistikListingByDate($id,$date){
		$query = $this->db->get_where("tbl_listing_view",array("id_listing_member"=>$id,'tanggal'=>$date,"id_user"=>$this->session->userdata('id_user')));
		return $query->num_rows();
	}
	
	public function cekStatistikDate($date){
		$query = $this->db->get_where("tbl_statistik",array("tipe_statistik"=>3,'tanggal'=>$date));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getVisitorCount($date){
		return $this->db->get_where('tbl_statistik',array("tipe_statistik" => 3, "tanggal" => $date))->result();
	}
	
	public function updateVisitorCount($updateData,$date){
		$this->db->where(array("tipe_statistik" => 3, "tanggal" => $date));
		$this->db->update('tbl_statistik',$updateData);
	}
	
	public function insertVisitorCount($insertData){
		$this->db->insert('tbl_statistik',$insertData);
	}
	
	public function cekStatistikMonth($type,$month,$year){
		$query = $this->db->get_where("tbl_statistik",array("tipe_statistik"=>$type,'bulan'=>$month,'tahun'=>$year));
		if($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getListingCount($type,$month,$year){
		return $this->db->get_where('tbl_statistik',array("tipe_statistik"=>$type,'bulan'=>$month,'tahun'=>$year))->result();
	}
	
	public function updateListingCount($updateData,$type,$month,$year){
		$this->db->where(array("tipe_statistik"=>$type,'bulan'=>$month,'tahun'=>$year));
		$this->db->update('tbl_statistik',$updateData);
	}
	
	public function insertListingCount($insertData){
		$this->db->insert('tbl_statistik',$insertData);
	}
	
}

