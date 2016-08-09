		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>nasabah/input">
  <div class="control-group">
    <label class="control-label" for="noreg">No. Registrasi</label>
    <div class="controls">
      <input name="noreg" type="hidden" id="noreg" value="<?php if (isset($noreg)){echo $noreg;}?>">
      <input name="noreg2" type="text" id="noreg" value="<?php if (isset($noreg)){echo $noreg;}?>" disabled>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama" type="text" id="nama" placeholder="Nama Nasabah"  minlength="2" required> 
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="noktp">No. KTP</label>
    <div class="controls">
      <input name="noktp" type="text" id="noktp" placeholder="No. KTP" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
	
	</div>
  </div>
  <div class="control-group">
		<label class="control-label" for="tlp">Telpon/HP</label>
    <div class="controls">
      <input name="tlp" type="text" id="tlp" placeholder="Telpon" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" >
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
	</div>
  
  <div class="control-group">
    <label class="control-label" for="nama_suamiistri">Nama Suami / Istri</label>
    <div class="controls">
      <input name="suamiistri" type="text" id="nama_suamiistri" placeholder="Nama suami/istri" minlength="3" data-validation-minlength-message="Isikan data yang benar" >
    </div>
  </div>
  <div class="box">
        <div class="box-header">
        <i class="icon-home"></i>
        <h5>Alamat Nasabah</h5>
        </div>
		<div class="box-content">
	  <div class="control-group">
		<label class="control-label" for="dusun">Kampung/Dusun</label>
    <div class="controls">
      <input name="dusun" type="text" id="dusun" placeholder="dusun" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="rtrw">RT/RW</label>
    <div class="controls">
      <input name="rtrw" type="text" id="rtrw" placeholder="Rt/Rw" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="propinsi">Provinsi</label>
    <div class="controls">
      <select name="propinsi" id="propinsi" >
		<option value="'">--Pilih Provinsi--</option>
		<?php if ($propinsi){
		 foreach($propinsi as $dataprop){
			?>
			<option value="<?php echo $dataprop->id_prov;?>"><?php echo $dataprop->nama_prov;?></option>
			<?php
		 }
		}?>
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota">Kabupaten/ Kota</label>
    <div class="controls">
      <select name="kab" id="kota" required>
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan">Kecamatan</label>
    <div class="controls">
      <select name="kec" id="kec" required>
		</select>
    </div>
	</div>
	
	
	  <div class="control-group">
		<label class="control-label" for="desa">Desa/Kelurahan</label>
    <div class="controls">
      <input name="desa" type="text" id="desa" placeholder="desa" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	
    </div>
  </div>
  
  <div class="box">
        <div class="box-header">
        <i class="icon-user"></i>
        <h5>Keluarga tak Serumah</h5>
        </div>
		<div class="box-content">
	  <div class="control-group">
		<label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama_kel" type="text" id="nama" placeholder="nama" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>	
	
  <div class="control-group">
		<label class="control-label" for="tlp_kel">Telpon/HP</label>
    <div class="controls">
      <input name="tlp_kel" type="text" id="tlp_kel" placeholder="Telpon" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" >
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="dusun">Kampung/Dusun</label>
    <div class="controls">
      <input name="dusun_kel" type="text" id="dusun" placeholder="dusun" minlength="2" data-validation-minlength-message="Isikan data yang benar" required> 
    </div>
	</div>
	  <div class="control-group">
		<label class="control-label" for="rtrw">RT/RW</label>
    <div class="controls">
      <input name="rtrw_kel" type="text" id="rtrw" placeholder="Rt/Rw" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="propinsi2">Provinsi</label>
    <div class="controls">
      <select name="propinsi_kel" id="propinsi2">
		<option value="">--Pilih Provinsi--</option>
		<?php if ($propinsi){
		 foreach($propinsi as $dataprop2){
			?>
			<option value="<?php echo $dataprop2->id_prov;?>"><?php echo $dataprop2->nama_prov;?></option>
			<?php
		 }
		}?>
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kota2">Kabupaten/ Kota</label>
    <div class="controls">
      <select name="kab_kel" id="kota2" required>
		</select>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="kecamatan2">Kecamatan</label>
    <div class="controls">
      <select name="kec_kel" id="kec2" required>
		</select>
    </div>
	</div>
	
	  <div class="control-group">
		<label class="control-label" for="desa">Desa/Kelurahan</label>
    <div class="controls">
      <input name="desa_kel" type="text" id="desa" placeholder="desa" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
    </div>
	</div>
    </div>
  </div>
  
	<div class="box">
        <div class="box-header">
        <i class="icon-briefcase"></i>
        <h5>Data Usaha/ Pekerjaan Nasabah</h5>
        </div>
		<div class="box-content">
		<div class="control-group">
			<label class="control-label" for="pekerjaan">Usaha/ Pekerjaan</label>
			<div class="controls">
			  <input name="pekerjaan" class="span5" type="text" id="pekerjaan" placeholder="Pekerjaan" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
			</div>
		  </div>
		<div class="control-group">
			<label class="control-label" for="nama_usaha">Nama Usaha</label>
			<div class="controls">
			  <input name="nama_pekerjaan" class="span5" type="text" id="nama_usaha" placeholder="Nama Usaha" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
			</div>
		  </div>
		<div class="control-group">
		<label class="control-label" for="alamat_usaha">Alamat Usaha</label>
		<div class="controls">
		  <input name="alamat_pekerjaan" class="span5" type="text" id="alamat_usaha" placeholder="Alamat Usaha" minlength="2" data-validation-minlength-message="Isikan data yang benar" required>
		</div>
		</div>
		<div class="control-group">
		<label class="control-label" for="telpon">Telpon</label>
    <div class="controls">
      <input name="tlp_pekerjaan" type="text" id="telpon" placeholder="Telpon" minlength="5" data-validation-minlength-message="Isikan data yang benar, minimal 5 karakter" >
	  <span class="error" style="color: Red; display: none;">Hanya nomer yang di ijinkan.ex. 08xxxxxx</span>
    </div>
	</div>
		
		</div>
	</div>
  
  <div class="control-group">
    <label class="control-label" for="status">status</label>
    <div class="controls">
		<select name="status">
		  <option value="AKTIF">Aktif</option>
		  <option value="NON AKTIF">Non Aktif</option>
		</select>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
	<button type="button" class="btn btn-danger" onClick="history.go(-1);return true;"><i class="icon-backward"></i> Back</button>
      <button type="submit" class="btn btn-primary">Simpan <i class="icon-folder-open"></i></button>
      
    </div>
  </div>
</form>