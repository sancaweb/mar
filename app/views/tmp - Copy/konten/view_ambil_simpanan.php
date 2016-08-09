		<?php if (isset($pesan)){
		echo $pesan;
	}?>
<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>simpanan/ambil_cari_simpanan">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="nasabah.noreg">No. Registrasi Nasabah</option>
		  <option value="nasabah.nama">Nama Nasabah</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Cari simpanan</button>
</form>
<?php if (isset($viewall_simpanan)){
?>
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Simpanan</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>No Registrasi</th>
                  <th>Nama</th>
                  <th>Total Simpanan</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="2">TOTAL: <?php if (isset($total_simpanan)){echo $total_simpanan;}?></td>						
				
				</tr>
			  </tfoot>
              <tbody>
			  <?php if ($viewall_simpanan){
			  $i=0; 
				foreach ($viewall_simpanan as $viewall_simpanan){
				$total_pinjaman=$this->pinjaman->total_pinjaman_noreg($viewall_simpanan->noreg);
				$i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $viewall_simpanan->noreg;?></td>
                  <td><?php echo $viewall_simpanan->nama;?></td>
                  <td><?php echo 'Rp. '.number_format($viewall_simpanan->saldo,0,'','.').' ('.$total_pinjaman.' x pinjaman)';?>
				  </td>
                  <td>
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>simpanan/ambil_form/<?php echo base64_encode($viewall_simpanan->noreg);?>">
                    <i class="icon-zoom-in"></i> Ambil Simpanan 
                    </a>
				  </td>
                </tr>
				<?php
				}
			  }else{ 
			  ?>
					<tr>
					<td colspan="5">
						<div class="alert alert-error">
						<p>
						Tidak ada data simpanan untuk nasabah yang dicari. Pastikan memasukan nama atau nomer registrasi dengan benar.
						</p>
						<p>
						<button type="button" class="btn btn-danger" onClick="history.go(-1);return true;"><i class="icon-backward"></i> Back</button>
						</p>
						</div>
					</td>
					</tr>
			  <?php
			  }?>
              </tbody>
            </table>
			</div>
			</div>
			<?php
}?>