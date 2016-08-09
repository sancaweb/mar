<?php
	if (isset($pesan)){
	echo $pesan;
	}
?>

<form class="form-horizontal" data-toggle="validator" enctype="multipart/form-data" role="form" method="POST" action="<?php if ($page=='edit_kas'){echo $this->uri->baseUri.'kas/edit_kas';}else{echo $this->uri->baseUri.'kas/input_kas';}?>">
<?php if ($page=='edit_kas'){
echo '
	<input name="id" type="hidden" value="'.$data_kas->id.'" class="input-small" required>
';
}?>
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Input Kas</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover table-border">
		<thead>
            <tr>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Debet</th>
                <th>Kredit</th>
            </tr>
        </thead>
		
        <tbody>
			<tr>
                <td><input name="tgl" type="text" <?php if ($page=='edit_kas'){echo 'value="'.$data_kas->tgl.'"';}?> class="input-small" id="datepicker" required></td>
                <td><textarea name="uraian" required><?php if ($page=='edit_kas'){echo $data_kas->uraian;}?></textarea></td>
                <td><input name="debet" type="number" <?php if ($page=='edit_kas'){echo 'value="'.$data_kas->debet.'"';}?> class="input-large" placeholder="Debit" required></td>
                <td><input name="kredit" type="number" <?php if ($page=='edit_kas'){echo 'value="'.$data_kas->kredit.'"';}?> class="input-large" placeholder="Kredit" required></td>
            </tr>
			<tr>			
            <td colspan="3">
			<a type="button" class="btn btn-danger" href="<?php echo $this->uri->baseUri.'kas';?>"><i class="icon-backward"></i> Cancel</a>
				<button type="submit" class="btn btn-primary"><i class="icon-folder-open"></i> 
				<?php if ($page=='edit_kas'){
				echo 'Edit Kas';
				}else{
				echo 'Input Kas';
				
				}?></button>
			</td>
			<td colspan="2">
			</td>
			</tr>
        </tbody>
</table>
</div>
</div>
</form>