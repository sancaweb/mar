<script type="text/javascript">
        function hitung() {
			var pelunasan = $("#pelunasan").val();
			var byr_denda = $("#byr_denda").val();
			var byr_denda_all = $("#byr_denda_all").val();
			var bunga_bulan = $("#bunga_bulan").val();
			var r_cicilan_pokok = $("#r_cicilan_pokok").val();
			var denda = $("#denda").val();
			var sisa_denda = $("#sisa_denda").val();
			var pembayaran = $("#pembayaran").val();
			$("#pembayaran2").val(pembayaran).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
			
			if(pelunasan=="NO"){
			if (byr_denda_all=="YES" && byr_denda=="YES"){
				sisa_pembayaran = parseInt(pembayaran) - parseInt(denda) - parseInt(sisa_denda);					
				}else if(byr_denda_all=="NO" && byr_denda=="YES"){
					sisa_pembayaran = parseInt(pembayaran) - parseInt(denda);
				}else if(byr_denda_all=="NO" && byr_denda=="NO"){
					sisa_pembayaran = parseInt(pembayaran);
				}else{
				
				}
				
			$("#r_total_cicilan").val(sisa_pembayaran);
			$("#r_total_cicilan2").val(sisa_pembayaran).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
			 
			<?php
			if($data_pinjaman->saldo_akhir <= '0'){
			?>
					cicilan_pokok = parseInt(sisa_pembayaran) - parseInt(bunga_bulan);
					$("#r_cicilan_pokok").val("0");
					$("#r_cicilan_pokok2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
			
			<?php
				}else{
					if($data_pinjaman->saldo_akhir < $data_pinjaman->bunga_bulan){
				?>
				cicilan_pokok = parseInt(sisa_pembayaran);
					$("#r_cicilan_pokok").val("0");
					$("#r_cicilan_pokok2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				
			
				<?php
				}else{
				?>
					cicilan_pokok = parseInt(sisa_pembayaran) - parseInt(bunga_bulan);
					$("#r_cicilan_pokok").val(cicilan_pokok);
					$("#r_cicilan_pokok2").val(cicilan_pokok).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				
				<?php
				}
				}
			?>
			
			var saldo = $("#saldo").val();
			
			sisa=parseInt(saldo) - parseInt(sisa_pembayaran);
			
			$("#sisa").val(sisa);
			$("#sisa2").val(sisa).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
			
			var total_bayar=$("#total_bayar").val();
			var pembayaran=$("#pembayaran").val();
			var pesan_selisih = document.getElementById("pesan_selisih");
			/*
			selisih = parseInt(total_bayar) * (65 / 100);
			
			selisih2=parseInt(total_bayar) - parseInt(selisih); */
			selisih2= parseInt(total_bayar) * (65 / 100);
			
			hasil_selisih=100*(Math.ceil(parseInt(selisih2)/100));
			if(pembayaran <= selisih2){
			
				pesan_selisih.innerHTML = '<span id="pesan_selisih" class="bg-warning">Minimal Pembayaran 65% dari total cicilan: ' + hasil_selisih + ' Rupiah</span>' ;
				document.getElementById("submit").disabled = true;
			}else{
				pesan_selisih.innerHTML = '<span id="pesan_selisih" class="bg-warning">Pembayaran sesuai.</span>' ;
				document.getElementById("submit").disabled = false;
			
			}
			}else{
				
				$("#sisa").val("0");
				$("#sisa2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				$("#r_cicilan_pokok").val("0");
					$("#r_cicilan_pokok2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
					$("#r_total_cicilan").val("0");
					$("#r_total_cicilan2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				//disini
			}
			
			}
				
		 function total_bayar_all(){
			var byr_denda_all = $("#byr_denda_all").val();
			var byr_denda = $("#byr_denda").val();
			var denda = $("#denda").val();
			var sisa_denda = $("#sisa_denda").val();
			var r_bunga_bulan = $("#r_bunga_bulan").val();
			var r_cicilan_pokok = $("#r_cicilan_pokok").val();
			<?php
			if($cicilan_ke == $tempo_akhir){
				if($cicilan_ke > $tempo_akhir){
					echo 'var saldo = $("#saldo").val();';
					echo 'var total_cicilan = parseInt(saldo) + parseInt(r_bunga_bulan);';
				}else{
					echo 'var total_cicilan = $("#saldo").val();';
				}
					
				}else{
					echo 'var total_cicilan = $("#total_cicilan").val();';
				}
			?>
			
			
			/* 
			 $("#pembayaran,#pembayaran2").val('');  */
			
				  if (byr_denda_all=="YES"){
					$("#byr_denda").val('YES');
					$('#byr_denda').attr('disabled', true);
					
					var saldo = $("#saldo").val();
					if(saldo <= 0){
						$("#sisa").val("0");
					$("#sisa2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
					$("#r_cicilan_pokok").val("0");
					$("#r_cicilan_pokok2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
					$("#r_total_cicilan").val("0");
					$("#r_total_cicilan2").val("0").priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
						total=parseInt(denda) + parseInt(sisa_denda);
					}else{
						total=parseInt(total_cicilan) + parseInt(denda) + parseInt(sisa_denda);
					}				
					
					
					$("#total_bayar").val(total);
					$("#total_bayar2").val(total).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				}else if(byr_denda_all=="NO"){
					/* $("#byr_denda").val('');   */
					$('#byr_denda').attr('disabled', false);
					 total=parseInt(total_cicilan);
					$("#total_bayar").val(total);
					$("#total_bayar2").val(total).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				  }else{
				
				}  
		} 
    </script>
		
	<script type="text/javascript">
	function totbay(){
			/* $("#pembayaran,#pembayaran2").val(''); */
			var byr_denda = $("#byr_denda").val();
			var denda = $("#denda").val();
			var r_bunga_bulan = $("#r_bunga_bulan").val();
			var r_cicilan_pokok = $("#r_cicilan_pokok").val(); 
			
			<?php
			if($cicilan_ke == $tempo_akhir){
				if($cicilan_ke > $tempo_akhir){
					echo 'var saldo = $("#saldo").val();';
					echo 'var total_cicilan = parseInt(saldo) + parseInt(r_bunga_bulan);';
				}else{
					echo 'var total_cicilan = $("#saldo").val();';
				}
					
				}else{
					echo 'var total_cicilan = $("#total_cicilan").val();';
				}
			?>
			
			
			
				  if (byr_denda == "YES"){
					total=parseInt(total_cicilan) + parseInt(denda);
					$("#total_bayar").val(total);
					$("#total_bayar2").val(total).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				}else if(byr_denda=="NO"){
					total=parseInt(total_cicilan);
					$("#total_bayar").val(total);
					$("#total_bayar2").val(total).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				}else{
					
				}
		}
	</script>
	<script type="text/javascript">
function hitungDenda() {
		$("#byr_denda").val('');
		$("#byr_denda_all").val('');
		$("#pembayaran").val('');
		
    var tjt = document.getElementsByName('jtempo')[0].value.split('-');
    var thn = tjt[0]; var bln = tjt[1]; var tgl = tjt[2];
    var t_jt = new Date(thn,bln-1,tgl,0,0,0,0);
 
    tjt = document.getElementsByName('tgl_pembayaran')[0].value.split('-');
    thn = tjt[0]; var bln = tjt[1]; var tgl = tjt[2];
    var t_by = new Date(thn,bln-1,tgl,0,0,0,0);
	
    var hari = hitungHari(t_jt,t_by);
    var minggu = hitungMinggu(t_jt,t_by);
    var denda = hari - minggu;
	var jml_hari = document.getElementById("jml_hari");
	jml_hari.innerHTML = '<span id="jml_hari" class="bg-info">0,5% x total_cicilan x Keterlambatan: ' + denda + ' hari</span>' ;
    /* alert ( 'Denda: ' + denda + ' hari' );
	hari_denda = denda; */
	/*
	100*Math.ceil(parseInt(parseInt(saldo) / parseInt(tenor))/1000)*10;
	var str_denda=denda.toString();
	var split_denda=str_denda.split("")[1];
	var int_split_denda=parseInt(split_denda);
	
	if (int_split_denda < 5){
		document.getElementById("denda").value= "kurang dari lima";
	}else{
		document.getElementById("denda").value= "Lebih dari lima";
	}
	denda_awal=parseInt(denda) * (0.5 * <?php echo $data_pinjaman->cicilan;?> / 100);
	*/
	denda_awal=parseInt(denda) * (0.5 * <?php echo $data_pinjaman->cicilan;?> / 100);
	total_denda=100*(Math.ceil(parseInt(denda_awal)/100)); //1100
	
	$("#denda").val(total_denda);
	$("#denda2").val(total_denda).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
	
}
function hitungHari(start,end) {
    if(start>=end) return 0;
    var satuhari=1000*60*60*24;
    var start_ms = start.getTime();
    var end_ms = end.getTime();
    var x_ms = end_ms - start_ms;
    return x_ms/satuhari;
}
function hitungMinggu(start, end) {
    if(start>=end) return 0;
    for(var count = {minggu:0}; start<=end; start.setDate(start.getDate() + 1)) {
        if(start.getDay() == 0) count.minggu++;
    }
    return count.minggu;
}
</script>


	
		<script type="text/javascript">
		function lunaskan(){
				
				var denda = $("#denda").val();
				var sisa_denda = $("#sisa_denda").val();
				var sisa=$("#sisa").val();
				
				
				total=parseInt(denda) + parseInt(sisa_denda) + parseInt(sisa);
				pengurangan=parseInt(total)*10/100;
				hasil=parseInt(total) - parseInt(pengurangan);
				total_lunas=100*(Math.ceil(parseInt(hasil)/100));
				
				
				$("#total_bayar").val(total_lunas);
				$("#total_bayar2").val(total_lunas).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: '.', centsLimit: 0 });
				
				$("#byr_denda").val('YES');				
				$('#byr_denda').attr('disabled', true);
				
				
				$("#byr_denda_all").val('YES');
				$('#byr_denda_all').attr('disabled', true);
		}
		
		$('#form_input_cicilan').on('submit', function() {
			$('input, select').attr('disabled', false);
		});
		</script>