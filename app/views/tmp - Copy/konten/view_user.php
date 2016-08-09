		<?php if (isset($pesan)){
		echo $pesan;
	}?>
	<!--
<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>tabungan/cari_tabungan">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="nasabah.noreg">No. Registrasi Nasabah</option>
		  <option value="nasabah.nama">Nama Nasabah</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Cari User</button>
</form> -->

<a class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="icon-plus-sign"></i> Add User</a>
<?php $this->output(TMP.'form/input_user');?>
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Tabungan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Grup</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="2">TOTAL: <?php echo $total_user;?></td>
				<td></td>				
				<td colspan="3">
				<div class="pagination">
				   <ul>
					<?php //if ($pageLinks): ?>
				
                <?php //foreach ($pageLinks as $paging): ?>
                    <?php //echo '<li>'.$paging; ?></li>
					
                <?php //endforeach; ?>
            
					<?php //endif; ?>
					</ul>
					</div>
				</td>							
				
				</tr>
			  </tfoot>
              <tbody>
			  <?php  if ($data_user){
			  //$i=$no; 
			  $i=0; 
				foreach ($data_user as $data_user){
				$ambil_grup=$this->user->ambil_grup($data_user->grup);
				$i++; 
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data_user->nama;?></td>
                  <td><?php echo $data_user->username;?></td>
                  <td><?php echo $ambil_grup->grup; ?></td>
                  <td>
				  <a class="btn btn-primary" data-toggle="modal" data-target="#myModal-<?php echo $data_user->id;?>"><i class="icon-wrench"></i> Edit User</a>
				  <a class="btn btn-primary" href="<?php echo $this->uri->baseUri.'user/delete_user/'.$data_user->id;?>"><i class="icon-remove"></i> Hapus User</a>
				  <?php //$this->output(TMP.'form/edit_user');?>				  
	<!-- MODAL -->
<div id="myModal-<?php echo $data_user->id;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Edit User</h3>
  </div>
  <div class="modal-body">
  <?php if($this->session->getValue('code_grup')=='s_adm' ){?>
    <form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri.'user/pro_edit';?>">
	<div class="control-group">
    <label class="control-label" for="nama">Nama</label>
    <div class="controls">
      <input name="nama" type="text" id="nama" value="<?php echo $data_user->nama;?>" required>
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="username">Username</label>
    <div class="controls">
      <input name="username" type="text" id="username" value="<?php echo $data_user->username;?>" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Password</label>
    <div class="controls">
      <input name="password" type="text" id="password" required>
    </div>
  </div>
	<div class="control-group">
		<label class="control-label" for="grup">Grup</label>
    <div class="controls">
      <select name="grup" id="grup" required>
		<option value="adm" <?php if ($data_user->grup == 'adm'){echo 'selected';}?>>Admin</option>
		<option value="s_adm" <?php if ($data_user->grup == 's_adm'){echo 'selected';}?>>Super Admin</option>
		</select>
    </div>
	</div>
	<input name="id" type="hidden" id="id" value="<?php echo $data_user->id;?>">
	  
	  
  </div>
  <div class="modal-footer">
  <button data-dismiss="modal" aria-hidden="true" type="button" class="btn btn-danger" ><i class="icon-backward"></i> Cancel</button>
  <button type="submit" class="btn btn-primary">Simpan <i class="icon-envelope icon-large"></i></button>
    
  </div>
  </form>
  <?php }else{
  ?>
	  <div class="alert alert-block alert-danger">
            <p>
             Maaf,yang berhak Edit User hanyalah Super Admin.
            </p>
            </div>
  <?php
  }?>
</div>
<!-- END MODAL -->
				  </td>
				  
                </tr>
				<?php
				}
			  } ?>
              </tbody>
            </table>
			</div>
			</div>