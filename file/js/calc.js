function hitung_calc(){
	
	var price = document.getElementById("calc_price").value;
	var dp = document.getElementById("calc_dp").value;
	var bunga = document.getElementById("calc_bunga").value;
	var cicil_tahun = document.getElementById("calc_cicilan").value;
	
	var cicil_bulan,bungaVal,hrsByr;
	
	price = parseInt(price);
	dp = parseInt(dp);
	bunga = parseFloat(bunga);
	cicil_tahun = parseInt(cicil_tahun);
	
	cicil_bulan = 12 * cicil_tahun;
	bungaVal = (bunga/100)*price;
	hrsByr = price + bungaVal - dp;

	var total = hrsByr / cicil_bulan;
	document.getElementById('hasil').value = "Rp. " + total;
	
}
