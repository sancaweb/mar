
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/js/demo.js"></script>
	
	<!-- bootstrap color picker -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>	
	
	<!-- lightbox -->
    <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>lightbox/js/lightbox.min.js" type="text/javascript"></script>	
	
	<!-- priceformat -->
	<script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/priceformat/jquery.price_format.min.js" type="text/javascript" ></script>
	<script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>plugins/priceformat/jquery.price_format.min.js" type="text/javascript" ></script>
	
	<?php 
		if(isset($page)){
			if($page=='rekanan'){
			$this->output('admin/js/form_rekanan');
		}
			if($page=='gallery'){
			$this->output('admin/js/form_gallery');
		}
		
		
		
		if($page=='produk' || $page=='kategori'){
			?>
			<script>
			function ResetForm() {
				document.getElementById("form_produk").reset();
			}
			$(".my-colorpicker").colorpicker();
			</script>
			<?php
		}
		
		if($page=='voucher' || $page=='pro_generate_voucher'){
			?>
			<script>
			$('#div_potongan').on('keyup', "input[id^='potongan']", function() {
			$("input[id^='potongan']").priceFormat({
				prefix: "",
				thousandsSeparator: ",",
				centsLimit: 0
			});
			});
			</script>
			<script>
			$('#div_potongan2').on('keyup', "input[id^='potongan2']", function() {
			$("input[id^='potongan2']").priceFormat({
				prefix: "",
				thousandsSeparator: ",",
				centsLimit: 0
			});
			});
			</script>
			<?php
			
		}
		
		if($page=='produk'){
			?>
			
			<script>
			$('#div_harga,#div_harga2').on('keyup', "input[id^='harga'],input[id^='harga2']", function() {
			$("input[id^='harga'],input[id^='harga2']").priceFormat({
				prefix: "",
				thousandsSeparator: ",",
				centsLimit: 0
			});
			});
			</script>
			
			<?php
		}
		
		if($page=='about'){
			?>
			<script type="text/javascript">
				var specialKeys = new Array();
				specialKeys.push(8); //Backspace
				$(function () {
					$("#telpon,#telpon_edit").bind("keypress", function (e) {
						var keyCode = e.which ? e.which : e.keyCode
						var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
						$(".error").css("display", ret ? "none" : "inline");
						return ret;
					});
					$("#telpon,#telpon_edit").bind("paste", function (e) {
						return false;
					});
					$("#telpon,#telpon_edit").bind("drop", function (e) {
						return false;
					});
				});
			</script>
			
			<?php
		}
		
		if($page=='penerima_voucher' || $page=='inbox' || $page=='sentitems'){
			?>
			<!-- date-range-picker -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
			<script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>/plugins/daterangepicker/daterangepicker.js"></script>
			<script>
			//Date range picker
			$('#reservation').daterangepicker();
			//Date range as a button
			$('#daterange-btn').daterangepicker(
				{
				  ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					'Last 7 Days': [moment().subtract(6, 'days'), moment()],
					'Last 30 Days': [moment().subtract(29, 'days'), moment()],
					'This Month': [moment().startOf('month'), moment().endOf('month')],
					'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
				  },
				  startDate: moment().subtract(29, 'days'),
				  endDate: moment()
				},
			function (start, end) {
			  //$('#reportrange input').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
				$("#dari_tgl").val(start.format('YYYY-MM-DD')); 
				$("#ke_tgl").val(end.format('YYYY-MM-DD'));
			}
			);
			</script>
			<?php
		}
		
		if($page=='inbox' || $page=='sentitems' || $page=='pesan' || $page=='pesan'){
			?>
			<script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/js/chosen.jquery.min.js" type="text/javascript"></script>
			  <script src="<?php echo $this->uri->baseUri.ADM_STYLE;?>dist/js/prism.js" type="text/javascript" charset="utf-8"></script>
			  <script type="text/javascript">
			  $("#dropdown-ajax").chosen({
				no_results_text: "Oops, nothing found!",
				width: "100%"
			  });
			  </script>
			<?php
		}
		
		
		} //END if $page
	?>
	<script>
	  $(document).on('focusin', function(e) {
			if ($(e.target).closest(".mce-window").length) {
				e.stopImmediatePropagation();
			}
		});
	  </script>
	  
	  
  </body>
</html>