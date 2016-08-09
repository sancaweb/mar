
<form name="form_input_cicilan" id="form_input_cicilan" class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action=" <?php echo $this->uri->baseUri.'cicilan/input_cicilan';?>">
  <div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="hidden" id="noreg" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->noreg;}?>">
      <input name="noreg2" type="text" id="noreg2" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->noreg;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama"  type="hidden" id="nama" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->nama;}?>">
      <input name="nama2" type="text" id="nama2" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->nama;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="id_pinjaman" >ID Pinjaman</label>
    <div class="controls">
      <input name="id_pinjaman" type="hidden" id="id_pinjaman" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->id_pinjaman;}?>">
      <input name="id_pinjaman2" type="text" id="id_pinjaman2" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->id_pinjaman;}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tgl_pinjaman">Tanggal Pinjaman</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl_pinjaman" class="span2" type="hidden" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_pinjaman;}?>" >
			<input name="tgl_pinjaman2" class="span2" type="text" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tgl_pinjaman;}?>" readonly>
			<span class="add-on" ><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="jumlah_pinjaman">Jumlah Pinjaman</label>
    <div class="controls">
      <input name="jumlah_pinjaman" type="hidden" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->jumlah_pinjaman;}?>" id="jumlah_pinjaman" >
	<input type="text" id="jumlah_pinjaman2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format( $data_pinjaman->jumlah_pinjaman, 0 , '' , '.' );}?>" readonly></span>
	<span class="add-on">
	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="tenor">Lama (Tenor) Pinjaman</label>
    <div class="controls">
		<input name="tenor" id="tenor" type="hidden" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tenor;}?>"  >
		<input name="tenor2" id="tenor2"  type="text" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->tenor;}?>" readonly>
		<span class="add-on">Bulan</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_bulan">Bunga/Jasa perbulan</label>
    <div class="controls">
      <input name="bunga_bulan" type="hidden" id="bunga_bulan" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->bunga_bulan;}?>">
	  <input name="bunga_bulan2" type="text" id="bunga_bulan2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->bunga_bulan,0,'','.');}?>"readonly>
	  <span class="add-on">Rumus: bunga(%) X Pinjaman</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Cicilan Pokok Perbulan</label>
    <div class="controls">
      <input name="cicilan_pokok" type="hidden" id="cicilan_pokok" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->cicilan_pokok;}?>" readonly>
      <input name="cicilan_pokok2" type="text" id="cicilan_pokok2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan_pokok,0,'','.');}?>" readonly>
	  <span class="add-on">Rumus: Total Cicilan - bunga per bulan.</span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="total_cicilan">Total Cicilan Perbulan</label>
    <div class="controls">
      <input name="total_cicilan" type="hidden" id="total_cicilan" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->cicilan;}?>">
      <input name="total_cicilan" type="text" id="total_cicilan" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->cicilan,0,'','.');}?>"readonly>
	  <span class="add-on">Rumus: Saldo / Tenor</span>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="saldo">Saldo Akhir</label>
    <div class="controls">
      <input name="saldo" type="hidden" id="saldo" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->saldo_akhir;}?>">
      <input name="saldo2" type="text" id="saldo2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->saldo_akhir,0,'','.');}?>" readonly>
	  <span class="add-on">Rumus: (Bunga/Jasa x Tenor) + pinjaman</span>
    </div>
  </div>
  
  <?php 
  $cek_piutang=$data_pinjaman->saldo_akhir + $data_pinjaman->denda;
  if ($cek_piutang <= '0'){
  ?>
  <div class="box">
     <div class="box-header">
     <i class="icon-file icon-large"></i>
     <h5>Rincian Pembayaran</h5>
                            
    </div>
	<div class="box-content box-table"><br/>
	<div class="alert alert-block alert-info">
            <p>
             Nasabah sudah menyelesaikan cicilan. 
            </p>
            </div>
  
  <div class="control-group">
    <div class="controls">
	<button type="button" class="btn btn-danger" onClick="history.go(-1);return true;"><i class="icon-backward"></i> Back</button>
	
    </div>
  </div>
  </div>
  </div>
</form>
  
  <?php
  }else{
  ?>
  <div class="box">
     <div class="box-header">
     <i class="icon-file icon-large"></i>
     <h5>Rincian Pembayaran Cicilan ke : <?php if ($cicilan_ke >= $data_pinjaman->tenor){echo 'Terakhir';}else{echo $cicilan_ke;}?></h5>
         <input name="cicilan_ke" type="hidden" id="cicilan_ke" value="<?php echo $cicilan_ke;?>" >                   
    </div>
	<div class="box-content box-table"><br/>
	 <div class="row">
	<div class="span8">
  <div class="control-group">
    <label class="control-label" for="jtempo">Jatuh Tempo</label>
    <div class="controls">
      <input name="jtempo" type="text" id="jtempo" value="<?php echo $jtempo;?>" readonly>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="tgl_pembayaran">Tanggal Pembayaran</label>
    <div class="controls">
		<div  class="input-prepend date">			
			<input name="tgl_pembayaran" onchange="hitungDenda();" class="span2 pembayaran" type="text" id="datepicker">
			<!--
			<input name="tgl_pembayaran2" class="span2" type="text" value="<?php //echo date('Y-m-d')?>" readonly>
			-->			
			<span class="add-on" id="klik_Tanggal"><i class="icon-th" ></i></span>
		 </div>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Sisa Denda</label>
    <div class="controls">
      <input name="sisa_denda" type="hidden" id="sisa_denda" value="<?php echo $data_pinjaman->denda;?>">
      <input name="sisa_denda2" type="text" value="<?php echo 'Rp. '.number_format($data_pinjaman->denda,0,'','.');?>" id="sisa_denda2" readonly>
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_jasa_total">Denda Hari Ini</label>
    <div class="controls">
      <input name="denda" type="hidden" id="denda" value="0">
      <input name="denda2" type="text" id="denda2" value="Rp. 0" readonly><br/>
	  <span id="jml_hari" class="bg-info"></span>
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="bunga_bulan">Bunga/Jasa perbulan</label>
    <div class="controls">
      <input name="r_bunga_bulan" type="hidden" id="r_bunga_bulan" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->bunga_bulan;}?>">
	  <input name="r_bunga_bulan2" type="text" id="r_bunga_bulan2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->bunga_bulan,0,'','.');}?>"readonly>
	 </div>
  </div>
  
  </div><!-- END span 8-->
  <div class="span4">
  
  <div class="control-group">
    <label class="control-label" for="sisa">Sisa Saldo Pinjaman</label>
    <div class="controls">
      <input name="sisa_saldo" type="hidden" id="sisa" value="<?php if (isset($data_pinjaman)){echo $data_pinjaman->saldo_akhir;}?>">
      <input name="sisa_saldo2" type="text" id="sisa2" value="<?php if (isset($data_pinjaman)){echo 'Rp. '.number_format($data_pinjaman->saldo_akhir,0,'','.');}?>" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="r_cicilan_pokok2">Cicilan Pokok</label>
    <div class="controls">
      <input name="r_cicilan_pokok" type="hidden" id="r_cicilan_pokok" >
      <input name="r_cicilan_pokok2" type="text" id="r_cicilan_pokok2"  readonly>
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="r_total_cicilan">Total Cicilan </label>
    <div class="controls">
      <input name="r_total_cicilan" type="hidden" id="r_total_cicilan" value="">
      <input name="r_total_cicilan2" type="text" id="r_total_cicilan2" value="" readonly>
	  
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="byr_denda">Pelunasan</label>
    <div class="controls">
	<?php
		if($sisa_cicilan >= 5){
		?>
			<select class="span4" name="pelunasan" id="pelunasan" onchange="lunaskan();" >
				<option value="YES"> YES</option>
				<option value="NO" selected>NO </option>
			</select>
		<?php
		}else{
			?>
			<select class="span4" disabled >
				<option value="YES"> YES</option>
				<option value="NO" selected>NO </option>
			</select>
			<input id="pelunasan" type="hidden" value="NO" name="pelunasan" />
			<?php
		}
		?>
	
	<span id="error_lunas" class="bg-info"></span>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="byr_denda_all">Bayar Seluruh Denda?</label>
    <div class="controls">
	<select class="span4" name="byr_denda_all" id="byr_denda_all" onchange="total_bayar_all();" required>
		<option value=""> Pilih Salah satu</option>
		<option value="YES"> YES</option>
		<option value="NO" >NO </option>
	</select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="byr_denda">Bayar Denda Hari ini?</label>
    <div class="controls">
	<select class="span4" name="byr_denda" id="byr_denda" onchange="totbay();" required>
		<option value=""> Pilih Salah satu</option>
		<option value="YES"> YES</option>
		<option value="NO" >NO </option>
	</select>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="total_bayar">Total Pembayaran</label>
    <div class="controls">
      <input name="total_bayar" type="hidden" id="total_bayar" value="">
      <input name="total_bayar2" type="text" id="total_bayar2" value="" readonly>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="pembayaran">Pembayaran</label>
    <div class="controls">
      <input name="pembayaran" autocomplete="off" class="span3" type="text" id="pembayaran" onkeyup="hitung();" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
      <input name="pembayaran2" class="span3" type="text" id="pembayaran2" readonly>
	  <span id="pesan_selisih" class="bg-info"></span>
	  <!--
	   -->
    </div>
  </div>
  
  </div><!-- END Span4 -->
  
  </div>
  
  <div class="control-group">
    <div class="controls">
	<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'cicilan/input_cari';?>"><i class="icon-backward"></i> Back</a>
      <button type="submit" id="submit" class="btn btn-primary">Simpan <i class="icon-envelope icon-large"></i></button>
      
    </div>
  </div>
  </div>  
  </div>
</form>
  <?php  
  }?>
