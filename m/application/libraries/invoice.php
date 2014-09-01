<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
 
class Invoice{
	
    function __construct(){
    }
	
	public function verifikasi_signup($config) {
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Verifikasi Pendafataran Rumahta.com";
		$message = "
		Proses pendaftaran member anda di rumahta.com hampir selesai.
		Silakan klik link dibawah ini untuk mengaktifkan akun anda.
		Link verifikasi:
		http://geeksdogood.org/rumahta_update4/index.php/home/verifikasi/".$config['verification_key']."
			
		Data pendaftaran anda :
		Username : ".$config['username']."
		Password : ".$config['password']."
			
		terima kasih telah mendaftar di rumahta.com
			
		regards,
		rumahta.com
		";
		
		$CI->email->from('mail@geeksdogood.org','rumahta.com');
		$CI->email->to($config['sendto']); 
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($CI->email->send()){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function invoice_listing($config) {
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Invoice Pemesanan Listing Rumahta.com (".date('d-M-Y').")";
		$message = "
		Invoice Pemesanan Listing Rumahta.com (".date('d-M-Y').")
		
		Terima Kasih !
		
		Pemesanan paket listing anda dengan detail sbb : 
		Jenis Paket : ".$config['jenis_paket']."
		Quota : ".$config['quota']."
		Durasi masing - masing listing: ".$config['durasi']." Bulan
		Akan kami aktifkan setelah anda melakukan pembayaran sebesar : 
		
		Rp. ".$config['harga']."

		Untuk prosedur / cara pembayaran selengkapnya dapat anda lihat pada:
		
			
		Dan setelah pembayaran dilakukan silakan konfirmasikan pembayaran anda dengan mengisikan data transaksi pada 
		menu Listing -> Konfirmasi Pembayaran.
		
		Best Regards,
		rumahta.com
		
		";
		
		$CI->email->from('mail@geeksdogood.org','rumahta.com');
		$CI->email->to($config['sendto']); 
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($CI->email->send()){
			return $message;
		}
		else{
			return false;
		}
	}
	
	public function invoice_banner($config) {
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Invoice Pemesanan Banner Rumahta.com (".date('d-M-Y').")";
		$message = "
		Invoice Pemesanan Banner Rumahta.com (".date('d-M-Y').")
		
		Terima Kasih !
		
		Pemesanan paket Banner anda dengan detail sbb : 
		Jenis Banner : ".$config['jenis_banner']."
		Durasi : ".$config['durasi']." Bulan
		Akan kami aktifkan setelah anda melakukan pembayaran sebesar : 
		
		Rp. ".$config['harga']."
			
		Silakan lakukan pembayaran dan konfirmasi sebelum tanggal : ".$config['expired_date']."

		Untuk prosedur / cara pembayaran selengkapnya dapat anda lihat pada:
			
		Dan setelah pembayaran dilakukan silakan konfirmasikan pembayaran anda dengan mengisikan data transaksi pada 
		menu Listing -> Konfirmasi Pembayaran.
		
		Best Regards,
		rumahta.com
		
		";
		
		$CI->email->from('mail@geeksdogood.org','rumahta.com');
		$CI->email->to($config['sendto']); 
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($CI->email->send()){
			return $message;
		}
		else{
			return false;
		}
	}
	
	public function invoice_activate_listing1($config){
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Pemberitahuan Aktivasi Paket Listing Rumahta.com (".date('d-M-Y').")";
		$message = "
		PEMBERITAHUAN
		
		Pemesanan paket Listing anda telah diaktifkan.
		Tanggal Pembayaran : ".$config['tgl_bayar']."
		
		Jenis Paket : ".$config['jenis_paket']."
		Quota telah ditambahkan menjadi : ".$config['quota']." Listing.
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@geeksdogood.org','rumahta.com');
		$CI->email->to($config['sendto']); 
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($CI->email->send()){
			return $message;
		}
		else{
			return false;
		}
	}
	
	public function invoice_activate_listing2($config){
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Pemberitahuan Aktivasi Paket Listing Rumahta.com (".date('d-M-Y').")";
		$message = "
		PEMBERITAHUAN
		
		Pemesanan paket Listing anda telah diaktifkan.
		Tanggal Pembayaran : ".$config['tgl_bayar']."
		
		Jenis Paket : ".$config['jenis_paket']."
		Quota : ".$config['quota']." Listing.
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@geeksdogood.org','rumahta.com');
		$CI->email->to($config['sendto']); 
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($CI->email->send()){
			return $message;
		}
		else{
			return false;
		}
	}
	
	public function invoice_activate_banner($config){
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Pemberitahuan Aktivasi Paket Listing Rumahta.com (".date('d-M-Y').")";
		$message = "
		PEMBERITAHUAN
		
		Banner pesanan anda telah diaktifkan.
		Jenis Banner = ".$config['jenis_banner']."
		
		Tanggal Pemasangan : ".date('d-M-Y')."
		Tanggal Expired : ".$config['expired_date']."
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@geeksdogood.org','rumahta.com');
		$CI->email->to($config['sendto']); 
		$CI->email->subject($subject);
		$CI->email->message($message);
		
		if($CI->email->send()){
			return $message;
		}
		else{
			return false;
		}
	}
	
}