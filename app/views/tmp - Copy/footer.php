<footer class="application-footer">
            <div class="container">
                <p>http://sanca.web.id</p>
                <div class="disclaimer">
                    <p>Aplikasi pengolahan data koperasi.</p>
                    <p>Copyright © sancaweb Development Indonesia 2014</p>
                </div>
            </div>
        </footer>
		<!--
		<script src="<?php //echo $this->uri->baseUri.TMP;?>js/jquery-1.8.2.min.js" type="text/javascript" ></script>
		-->
		
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/jquery-2.1.1.min.js" type="text/javascript" ></script>
		<script src="<?php echo $this->uri->baseUri.TMP?>js/jui/jquery-ui.js" type="text/javascript"></script>
		
		
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/jqBootstrapValidation-1.3.7.min.js" type="text/javascript" ></script>
		
		
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/jsapi.js" type="text/javascript" ></script>
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-modal.js" type="text/javascript" ></script>
		
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-transition.js" type="text/javascript" ></script>
        <script src="<?php echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-collapse.js" type="text/javascript" ></script>
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-dropdown.js" type="text/javascript" ></script>
        
        
		
		<!--
		
		<script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap.min.js" type="text/javascript" ></script>
		
		
		<script src="<?php// echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-alert.js" type="text/javascript" ></script>
        
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-scrollspy.js" type="text/javascript" ></script>
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-tab.js" type="text/javascript" ></script>
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-tooltip.js" type="text/javascript" ></script>
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-popover.js" type="text/javascript" ></script>
        <script src="<?php// echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-button.js" type="text/javascript" ></script>
        
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-carousel.js" type="text/javascript" ></script>
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-typeahead.js" type="text/javascript" ></script>
        <script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-affix.js" type="text/javascript" ></script>
        -->
		<!--
		<script src="<?php //echo $this->uri->baseUri.TMP;?>js/bootstrap/bootstrap-datepicker.js" type="text/javascript" ></script>
        -->
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/jquery-tablesorter.js" type="text/javascript" ></script>
		
        <!--
		<script src="<?php //echo $this->uri->baseUri.TMP;?>js/jquery-chosen.js" type="text/javascript" ></script>
        -->
		<!--
		<script src="<?php// echo $this->uri->baseUri.TMP;?>js/virtual-tour.js" type="text/javascript" ></script>
        -->
		<script src="<?php echo $this->uri->baseUri.TMP;?>js/jquery.price_format.2.0.js" type="text/javascript" ></script>
        <script type="text/javascript">
		  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>
		
		<script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
			  changeMonth: true,
			  changeYear: true,
			  showAnim: "bounce",
			  dateFormat:"yy-mm-dd"
			});
			
			$('#klik_Tanggal').click(function() {
            $('#datepicker').datepicker('show');
            return false;
      });
            
        });
        $(function() {
            $('#datepicker2').datepicker({
			  changeMonth: true,
			  changeYear: true,
			  showAnim: "bounce",
			  dateFormat:"yy-mm-dd"
			});
            
        });
    </script>
	<!-- fungsi tabungan -->
	<script type="text/javascript">
	function nominal() {
			
			var pinjaman = $("#tabungan").val();
			$("#tabungan2").val(pinjaman).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			
			}
	</script>
	<?php if (isset($page)){if ($page=='ambil_form'){?>
	<script type="text/javascript">
	function simpanan() {
			
			var simpanan_keluar = $("#simpanan_keluar").val();
			$("#simpanan_keluar2").val(simpanan_keluar).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			
			var sisa_saldo = $("#sisa_saldo").val();
			sisa=parseInt(sisa_saldo) - parseInt(simpanan_keluar);
			$("#sisa").val(sisa);
			$("#sisa2").val(sisa).priceFormat({ prefix: 'Rp. ', centsSeparator: '', thousandsSeparator: ',', centsLimit: 0 });
			
			}
	</script>
	<?php }}?>
	
	<?php if (isset($page)){
	if ($page=='form_pinjaman'){
	
	?>
	<!-- fungsi penghitungan pinjaman -->
	
	<?php $this->output(TMP.'js/form_pinjaman');?>
	<?php
	}
	}?>
	
	<?php if (isset($page)){
		if ($page == 'form_cicilan'){
		
		?>
	<!-- fungsi penghitungan cicilan -->
	
	<?php
	$this->output(TMP.'js/form_cicilan');
	}
	}?>
	
	<!-- data kota dan provinsi -->
	<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi").change(function(){
    var propinsi = $("#propinsi").val();
    $.ajax({
        url: "<?php echo $this->uri->baseUri;?>datakota",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota").html(msg);
        }
    });
  });
  $("#kota").change(function(){
    var kota = $("#kota").val();
    $.ajax({
        url: "<?php echo $this->uri->baseUri;?>datakota/ambilkecamatan",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec").html(msg);
        }
    });
  });
});

</script>
	<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  //apabila terjadi event onchange terhadap object <select id=propinsi>
  $("#propinsi2").change(function(){
    var propinsi = $("#propinsi2").val();
    $.ajax({
        url: "<?php echo $this->uri->baseUri;?>datakota",
        data: "propinsi="+propinsi,
        cache: false,
        success: function(msg){
            //jika data sukses diambil dari server kita tampilkan
            //di <select id=kota>
            $("#kota2").html(msg);
        }
    });
  });
  $("#kota2").change(function(){
    var kota = $("#kota2").val();
    $.ajax({
        url: "<?php echo $this->uri->baseUri;?>datakota/ambilkecamatan",
        data: "kota="+kota,
        cache: false,
        success: function(msg){
            $("#kec2").html(msg);
        }
    });
  });
});

</script>

<script type="text/javascript">
        var specialKeys = new Array();
        specialKeys.push(8); //Backspace
        $(function () {
            $("#telpon,#tabungan,#tlp,#tlp_kel").bind("keypress", function (e) {
                var keyCode = e.which ? e.which : e.keyCode
                var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
                $(".error").css("display", ret ? "none" : "inline");
                return ret;
            });
            $("#telpon,#tabungan,#tlp,#tlp_kel").bind("paste", function (e) {
                return false;
            });
            $("#telpon,#tabungan,#tlp,#tlp_kel").bind("drop", function (e) {
                return false;
            });
        });
    </script>

    </body>
</html>