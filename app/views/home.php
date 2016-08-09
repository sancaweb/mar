<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Contoh Print</title>
  </head>
  <body>
    <h3>Contoh 1</h3>
    <ul>
      <?php foreach ($contoh1 as $ct1) { ?>
      <li><a href="<?= $this->location('invoice/' . $ct1->id); ?>" target="_blank"><?= str_pad($ct1->id, 6, '0', STR_PAD_LEFT); ?></a></li>
      <?php } ?>
    </ul>
    <h3>Contoh 2</h3>
    <ul>
      <?php foreach ($contoh2 as $ct2) { ?>
      <li><a href="<?= $this->location('summary/' . $ct2->tanggal); ?>" target="_blank"><?= str_pad($ct2->tanggal, 6, '0', STR_PAD_LEFT); ?></a></li>
      <?php } ?>
    </ul>
	
	<ul>
	<li>
	<a href="<?php echo $this->uri->baseUri.'prin/prin_kwitansi';?>" target="_blank"> Prin Kwitansi</a>	
	</li>
	<li>
	<a href="<?php echo $this->uri->baseUri.'prin/prin_laporan';?>" target="_blank"> Prin Laporan</a>	
	</li>
	</ul>
  </body>
</html>