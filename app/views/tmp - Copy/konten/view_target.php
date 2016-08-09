		<?php if (isset($pesan)){
		echo $pesan;
	}?>
	
<div class="box">
     <div class="box-header">
     <i class="icon-search icon-large"></i>
     <h5>Pencarian berdasarkan tanggal</h5>
                            
    </div>
	<div class="box-content box-table">
	<br/>
	<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>target/cari_target">
  <input name="waktu_awal" type="text" placeholder="Waktu Awal" id="datepicker">
  <span>Sampai -></span>
  <input name="waktu_akhir" type="text" placeholder="Waktu Akhir" id="datepicker2">
  <button type="submit" class="btn"><i class="icon-search"></i> Proses</button>
</form>
	</div>
</div>
<?php if ($page=='cari_target'){
?>
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data <?php if (isset($waktu_awal,$waktu_akhir)){echo 'Dari Tanggal '.$waktu_awal.' Sampai '.$waktu_akhir;}?></h5>
                            
    </div>
	<div class="box-content box-table">
	<br/>
	<form class="form-horizontal"  enctype="multipart/form-data" role="form" >
		<div class="row">
		<div class="span8">
	<div class="control-group">
    <label class="control-label" for="drop">Jumlah Pencairan</label>
    <div class="controls">
      <input name="drop" type="text" id="drop" value="<?php echo 'Rp. '.number_format($drop,0,'','.');?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="target">Target</label>
    <div class="controls">
      <input name="target" type="text" id="target" value="<?php echo 'Rp. '.number_format($target,0,'','.');?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="storting">Jumlah Penagihan (Storting)</label>
    <div class="controls">
      <input name="storting" type="text" id="storting" value="<?php echo 'Rp. '.number_format($storting,0,'','.');?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="ppc">PPC</label>
    <div class="controls">
      <input name="ppc" type="text" id="ppc" value="<?php echo $ppc.' %';?>" >
    </div>
  </div> 
  </div> <!-- END span8 -->
  <div class="span4">
   <div class="control-group">
    <label class="control-label" for="denda_all_cicilan">Total Denda</label>
    <div class="controls">
      <input name="denda_all_cicilan" type="text" id="denda_all_cicilan" value="<?php echo 'Rp. '.number_format($denda_all_cicilan,0,'','.');?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="denda_terbayar">Denda Terbayar</label>
    <div class="controls">
      <input name="denda_terbayar" type="text" id="denda_terbayar" value="<?php echo 'Rp. '.number_format($denda_terbayar,0,'','.');?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="sisa_denda">Sisa Denda</label>
    <div class="controls">
      <input name="sisa_denda" type="text" id="sisa_denda" value="<?php echo 'Rp. '.number_format($sisa_denda,0,'','.');?>" >
    </div>
  </div>
  <!-- 
  <div class="control-group">
    <label class="control-label" for="persentase">Persentase</label>
    <div class="controls">
      <input name="persentase" type="text" id="persentase" value="<?php //echo 'Rp. '.number_format($storting,0,'','.');?>" >
    </div>
  </div> -->
  </div><!-- END span4 -->
  </div> <!-- END ROW -->
  </form>
   
  </div>
  <!--
  <div class="modal-footer">
  <button  type="button" class="btn btn-danger" ><i class="icon-backward"></i> Back</button>
  
  <button type="submit" class="btn btn-primary" >Simpan <i class="icon-envelope icon-large"></i></button>
   
  </div> -->
  </div>
  
  
  

<?php
}?>