<form class="form-inline" enctype="multipart/form-data" role="form" method="POST" action="<?php echo $this->uri->baseUri;?>pinjaman/cari">
  <input name="katakunci" type="text" placeholder="Kata Kunci">
  <select name="berdasarkan" >
		  <option value="">-- Cari Berdasarkan --</option>
		  <option value="noreg">No. Registrasi Nasabah</option>
		  <option value="nama">Nama Nasabah</option>
		  <option value="id_pinjaman">ID Pinjaman</option>
		</select>
  <button type="submit" class="btn"><i class="icon-search"></i> Cari Pinjaman</button>
</form>

<div class="box">
     <div class="box-header">
     <i class="icon-user icon-large"></i>
     <h5>Data pinjaman</h5>
                            
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
                  <th>Total Cicilan</th>
                  <th>Action</th>
                </tr>
              </thead>
			  <tfoot>
				<tr>
				<td colspan="7">TOTAL: <?php if (isset($total_pinjaman)){echo $total_pinjaman;}?></td>
				</tr>
			  </tfoot>
              <tbody>
			  <?php if ($data_pinjaman){
			  $i=0;
				foreach ($data_pinjaman as $data_pinjaman){
				$i++;
				?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $data_pinjaman->noreg;?></td>
                  <td><?php echo $data_pinjaman->nama;?></td>
                  <td><?php echo $data_pinjaman->id_pinjaman;?></td>
                  <td><?php echo 'Rp. '.number_format($data_pinjaman->jumlah_pinjaman,0,'','.');?></td>
                  <td>
				  <?php echo 'Rp. '.number_format($data_pinjaman->cicilan,0,'','.');
				  if ($data_pinjaman->saldo_akhir == '0'){
					echo '&nbsp; (Lunas)';
				  }else{
					echo '&nbsp; (Belum Lunas)';
				  }
				  ?>
				  </td>
                  <td>
					<a target="_blank" class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>pinjaman/view_detail/<?php echo base64_encode($data_pinjaman->id_pinjaman);?>">
                    <i class="icon-zoom-in"></i> View Detail 
                    </a>
					<a target="_blank" class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>cicilan/history/<?php echo base64_encode($data_pinjaman->id_pinjaman);?>">
                    <i class="icon-zoom-in"></i> History Pembayaran 
                    </a>					
					<a class="btn btn-primary" href="<?php echo $this->uri->baseUri;?>pinjaman/edit_form/<?php echo base64_encode($data_pinjaman->noreg).'/'.base64_encode($data_pinjaman->id_pinjaman);?>">
                    <i class="icon-pencil"></i> Edit Pinjaman 
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