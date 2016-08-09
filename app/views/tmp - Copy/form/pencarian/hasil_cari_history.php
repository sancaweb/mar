<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri.'cicilan/hasil_cari_view';
?>">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="noreg">No. Registrasi Nasabah</option>
		  <option value="nama">Nama Nasabah</option>
		  <option value="id_pinjaman">ID Pinjaman</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Search</button>
</form>

<?php if (isset($hasil_cari)){?>
<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data Nasabah</h5>
                            
    </div>
	<div class="box-content box-table">
<table class="table table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>No Registrasi</th>
                  <th>Nama</th>
                  <th>ID Pinjaman</th>
                  <th>Jumlah Pinjaman</th>
                  <th>Pinjaman Terakhir</th>
				  
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="7">TOTAL: <strong><?php if (isset($total_cari)){echo $total_cari;}?></strong></td>		
				</tr>
			  </tfoot>
              <tbody>
			  
			  <?php if ($hasil_cari){
			   $i=0;
				 foreach ($hasil_cari as $hasil_cari){
				 $i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $hasil_cari->noreg;?></td>
                  <td><?php echo $hasil_cari->nama;?></td>
                  <td><?php echo $hasil_cari->id_pinjaman;?></td>
                  <td>
				  <?php echo 'Rp. '.number_format( $hasil_cari->jumlah_pinjaman, 0 , '' , '.' );?>
				  </td>
                  <td>				  
				  <a target="_blank" href="<?php echo $this->uri->baseUri.'pinjaman/view_detail/'.base64_encode($hasil_cari->id_pinjaman);?>" >
				  <?php if ($hasil_cari->saldo_akhir == '0'){
						echo 'Sisa Rp. '.number_format( $hasil_cari->saldo_akhir, 0 , '' , '.' ).' (Lunas)';
				  
				  }else{
						echo 'Sisa Rp. '.number_format( $hasil_cari->saldo_akhir, 0 , '' , '.' );
				  }?>
				  </a>
				  
				  </td>
                  <td>
				  
					<a target="_blank" class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>cicilan/history/<?php echo base64_encode($hasil_cari->id_pinjaman);?>">
                    <i class="icon-zoom-in"></i> View History 
                    </a>
					
				  </td>
                </tr>
				<?php
				 }
			   }?>
              </tbody>
            </table>
			</div>
			</div>
			<?php }?>