<div class="middle-content">
	<div class="container">
		<div class="row isi"><!-- second row -->
			<?php if($viewall_kabar){
				foreach($viewall_kabar as $kabar){
					$kategori_id=$kabar->kategori;
					$nama_kategori=$this->kabar->nama_kategori($kategori_id)->nama_kategori;
					?>
					
				<div class="col-md-4"><!-- first column -->
					<div class="widget-item">
						<h3 class="widget-title"><?php echo $nama_kategori?></h3>
						<div class="sample-thumb">
						<a href="<?php echo $this->image->ambil_gambar($kabar->keterangan);?>" target="_blank">
							<img class="thumbnail img-responsive morph" style="height:200px;" src="<?php echo $this->image->ambil_gambar($kabar->keterangan);?>" alt="New Event" title="New Event">
						</a>
						</div> <!-- /.sample-thumb -->
						<h4 class="consult-title"><?php echo $kabar->judul;?></h4>
						<?php echo $this->readmore->readmore($this->image->del_img($kabar->keterangan),250).' ... '; ?>
					</div> <!-- /.widget-item -->
				</div> <!-- /.col-md-4 -->
					<?php
				}
			}else{
				?>
				<div class="col-md-4"><!-- first column -->
					<div class="widget-item">
						<h3 class="widget-title">Tidak ada data</h3>
						<div class="sample-thumb">
							<img src="<?php echo $this->uri->baseUri.STYLE;?>images/event_3.jpg" alt="New Event" title="New Event">
						</div> <!-- /.sample-thumb -->
						<h4 class="consult-title">Tidak ada data</h4>
						<p>Tidak ada data</p>
					</div> <!-- /.widget-item -->
				</div> <!-- /.col-md-4 -->	
				
				<?php
			}?>
		</div> <!-- /.row second -->
		
		<div class="row isi">
		<div class="col-md-12">
		<ul class="pagination pagination-sm no-margin pull-right">
			<?php if ($pageLinks): ?>
					
					<?php foreach ($pageLinks as $paging): ?>
						<?php echo '<li>'.$paging; ?></li>
						
					<?php endforeach; ?>
				
						<?php endif; ?>
		  </ul>
		</div>
		</div>
		
	</div> <!-- /.container -->
</div> <!-- /.middle-content -->