<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
 
class Banner{
	
    function __construct(){
    }
	public function getBannerPic(){
		$bannerData = array();
		$CI =& get_instance();
		$CI->load->model('mdl_banner'); 

		$top1 = $CI->mdl_banner->getBannerPhotoByID(1);
		$side1 = $CI->mdl_banner->getBannerPhotoByID(2);
		$side2 = $CI->mdl_banner->getBannerPhotoByID(3);
		$side3 = $CI->mdl_banner->getBannerPhotoByID(4);
		$side4 = $CI->mdl_banner->getBannerPhotoByID(5);
		$side5 = $CI->mdl_banner->getBannerPhotoByID(6);
		$bottom1 = $CI->mdl_banner->getBannerPhotoByID(7);
		$bottom2 = $CI->mdl_banner->getBannerPhotoByID(8);
		
		if($top1 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($top1[0]->expired_date);
			if(($expired > $now) && ($top1[0]->status == 1)){
				$bannerData['top1']['pic'] = $top1[0]->photo;
				$bannerData['top1']['url'] = $top1[0]->url;
			}
			else{
				$bannerData['top1']['pic'] = "top_default.jpg";
				$bannerData['top1']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['top1']['pic'] = "top_default.jpg";
			$bannerData['top1']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($side1 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($side1[0]->expired_date);
			if(($expired > $now) && ($side1[0]->status == 1)){
				$bannerData['side1']['pic'] = $side1[0]->photo;
				$bannerData['side1']['url'] = $side1[0]->url;
			}
			else{
				$bannerData['side1']['pic'] = "side_default1.jpg";
				$bannerData['side1']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['side1']['pic'] = "side_default1.jpg";
			$bannerData['side1']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($side2 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($side2[0]->expired_date);
			if(($expired > $now) && ($side2[0]->status == 1)){
				$bannerData['side2']['pic'] = $side2[0]->photo;
				$bannerData['side2']['url'] = $side2[0]->url;
			}
			else{
				$bannerData['side2']['pic'] = "side_default2.jpg";
				$bannerData['side2']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['side2']['pic'] = "side_default2.jpg";
			$bannerData['side2']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($side3 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($side3[0]->expired_date);
			if(($expired > $now) && ($side3[0]->status == 1)){
				$bannerData['side3']['pic'] = $side3[0]->photo;
				$bannerData['side3']['url'] = $side3[0]->url;
			}
			else{
				$bannerData['side3']['pic'] = "side_default3.jpg";
				$bannerData['side3']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['side3']['pic'] = "side_default3.jpg";
			$bannerData['side3']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($side4 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($side4[0]->expired_date);
			if(($expired > $now) && ($side4[0]->status == 1)){
				$bannerData['side4']['pic'] = $side4[0]->photo;
				$bannerData['side4']['url'] = $side4[0]->url;
			}
			else{
				$bannerData['side4']['pic'] = "side_default4.jpg";
				$bannerData['side4']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['side4']['pic'] = "side_default4.jpg";
			$bannerData['side4']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($side5 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($side5[0]->expired_date);
			if(($expired > $now) && ($side5[0]->status == 1)){
				$bannerData['side5']['pic'] = $side5[0]->photo;
				$bannerData['side5']['url'] = $side5[0]->url;
			}
			else{
				$bannerData['side5']['pic'] = "side_default5.jpg";
				$bannerData['side5']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['side5']['pic'] = "side_default5.jpg";
			$bannerData['side5']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($bottom1 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($bottom1[0]->expired_date);
			if(($expired > $now) && ($bottom1[0]->status == 1)){
				$bannerData['bottom1']['pic'] = $bottom1[0]->photo;
				$bannerData['bottom1']['url'] = $bottom1[0]->url;
			}
			else{
				$bannerData['bottom1']['pic'] = "bottom_default.jpg";
				$bannerData['bottom1']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['bottom1']['pic'] = "bottom_default.jpg";
			$bannerData['bottom1']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		if($bottom2 != false){
			$now = strtotime(date("Y-m-d"));
			$expired = strtotime($bottom2[0]->expired_date);
			if(($expired > $now) && ($bottom2[0]->status == 1)){
				$bannerData['bottom2']['pic'] = $bottom2[0]->photo;
				$bannerData['bottom2']['url'] = $bottom2[0]->url;
			}
			else{
				$bannerData['bottom2']['pic'] = "bottom_default.jpg";
				$bannerData['bottom2']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
			}
		}
		else{
			$bannerData['bottom2']['pic'] = "bottom_default.jpg";
			$bannerData['bottom2']['url'] = "www.rumahta.com/index.php/page/page_detail/15/pasang-iklan";
		}
		
		return($bannerData);
		
	}
}