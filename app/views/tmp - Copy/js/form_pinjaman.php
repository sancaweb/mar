<script type="text/javascript">
        function hitung() {
			
			var pinjaman = $("#jumlah_pinjaman").val();
			$("#jumlah_pinjaman2").val(pinjaman).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			var tenor = $("#tenor").val();
			var bunga=$("#bunga").val();
			
			
			bunga_jasa = (parseInt(bunga)*parseInt(pinjaman)) / 100;			
			$("#bunga_jasa").val(bunga_jasa);
			$("#bunga_jasa2").val(bunga_jasa).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			bunga_jasa_total = parseInt(bunga_jasa) * parseInt(tenor);
			$("#bunga_jasa_total").val(bunga_jasa_total);
			$("#bunga_jasa_total2").val(bunga_jasa_total).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			
			
			saldo = parseInt(bunga_jasa_total) + parseInt(pinjaman);
			$("#saldo").val(saldo);
			$("#saldo2").val(saldo).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			/*
			total_cicilan = parseInt(saldo) / parseInt(tenor);
			$("#total_cicilan").val(total_cicilan);
			$("#total_cicilan2").val(total_cicilan).priceFormat({ prefix: 'Rp. ', centsSeparator: '.', thousandsSeparator: ',', centsLimit: 0 });
			*/
			// Decimal ceil
			jumlah_cicilan=100*Math.ceil(parseInt(parseInt(saldo) / parseInt(tenor))/1000)*10;
			$("#jumlah_cicilan").val(jumlah_cicilan);
			$("#jumlah_cicilan2").val(jumlah_cicilan).priceFormat({ prefix: 'Rp. ', centsSeparator: '.', thousandsSeparator: ',', centsLimit: 0 });
			cicilan_pokok = parseInt(jumlah_cicilan) - parseInt(bunga_jasa);
			$("#cicilan_pokok").val(cicilan_pokok);
			$("#cicilan_pokok2").val(cicilan_pokok).priceFormat({ prefix: 'Rp. ', centsSeparator: '.', thousandsSeparator: ',', centsLimit: 0 });
			
			simpanan = (5*parseInt(pinjaman)) / 100;			
			$("#simpanan").val(simpanan);
			$("#simpanan2").val(simpanan).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			}
    </script>