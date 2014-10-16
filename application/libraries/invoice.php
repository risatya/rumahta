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
		http://".$base_url()."index.php/home/verifikasi/".$config['verification_key']."
			
		Data pendaftaran anda :
		Username : ".$config['username']."
		Password : ".$config['password']."
			
		terima kasih telah mendaftar di Rumahta.Com
		
		Mohon data login anda diingat dan simpan baik-baik jangan sampai diketahui orang lain
			
		regards,
		Rumahta.com
		";
		
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
			
		Pembayaran dapat di transfer ke rekening:
			
		- BCA, No. Rek. 3900121643, Cab. Pettarani, a/n M. Asharyadi
			
		- Bank Mandiri, No. Rek. 1520005060161, KCP. Panakkukang, a/n M. Asharyadi
		
		- BNI, No. Rek. 0130624849, Cab. Mattoangin, a/n M. Asharyadi
		
		- BRI, No. Rek. 358101003494504, Cab. Sungai Saddang, a/n M. Asharyadi
		
			
		Untuk prosedur / cara pembayaran selengkapnya dapat anda lihat di member area pada menu Listing -> peraturan & ketentuan.

		Dan setelah pembayaran dilakukan silakan konfirmasikan pembayaran anda dengan mengisikan data transaksi pada menu Listing -> Konfirmasi Pembayaran.

		Jika ada yang kurang jelas atau ingin ditanyakan silakan hubungi kami klik http://rumahta.com/page/page_detail/3/kontak
		
		Best Regards,
		rumahta.com
		
		";
		
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
			
		Pembayaran dapat di transfer ke rekening:
			
		- BCA, No. Rek. 3900121643, Cab. Pettarani, a/n M. Asharyadi
			
		- Bank Mandiri, No. Rek. 1520005060161, KCP. Panakkukang, a/n M. Asharyadi
		
		- BNI, No. Rek. 0130624849, Cab. Mattoangin, a/n M. Asharyadi
		
		- BRI, No. Rek. 358101003494504, Cab. Sungai Saddang, a/n M. Asharyadi
		
			
		Untuk prosedur / cara pembayaran selengkapnya dapat anda lihat di member area pada menu Banner -> peraturan & ketentuan.

		Dan setelah pembayaran dilakukan silakan konfirmasikan pembayaran anda dengan mengisikan data transaksi pada menu Banner -> Konfirmasi Pembayaran.

		Jika ada yang kurang jelas atau ingin ditanyakan silakan hubungi kami klik http://rumahta.com/page/page_detail/3/kontak
		
		Best Regards,
		rumahta.com
		
		";
		
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
		
		Sebelum membuat iklan listing/banner sebaiknya anda membaca terlebih dahulu ' Peraturan & Ketentuan ' pada menu listing/banner dimember area anda.
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
		
		Sebelum membuat iklan listing/banner sebaiknya anda membaca terlebih dahulu ' Peraturan & Ketentuan ' pada menu listing/banner dimember area anda.
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
	
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
	
	public function invoice_pesan_paket_for_admin($config){
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Pemberitahuan Pemesanan paket baru (".date('d-M-Y').")";
		$message = "
		PEMBERITAHUAN
		
		Terdapat pemesanan paket baru pada tanggal :
		
		".date('d-M-Y')."
		Username pemesan : ".$config['order_from']."
		Jenis Paket : ".$config['order_paket']."
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@rumahta.com','rumahta.com');
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
	
	public function invoice_konfirmasi_paket_for_admin($config){
		//load CI instance..
		$CI = & get_instance();
		$CI->load->library('email');
		
		$subject  = "Pemberitahuan Konfirmasi paket baru (".date('d-M-Y').")";
		$message = "
		PEMBERITAHUAN
		
		Terdapat Konfirmasi paket pada tanggal :
		
		".date('d-M-Y')."
		Username pemesan : ".$config['order_from']."
		Jenis Paket : ".$config['order_paket']."
		
		Sistem Pembayaran : ".$config['sistem']."
		Tanggal Pembayaran : ".$config['tgl_bayar']."
		Besar Pembayaran : ".$config['besar_bayar']."
		Bank asal : ".$config['bank_asal']."
		Bank Tujuan : ".$config['bank_tujuan']."
		No Rekening : ".$config['no_rek']."
		Catatan pemesan : ".$config['pesan']."
		
		Terima kasih.
		Regards,
		Rumahta.com
		";
	
		$CI->email->from('mail@rumahta.com','rumahta.com');
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