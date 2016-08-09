<?php

$total   = 0;
$kembali = 0;

function format_tanggal($tgl) {
  $namabulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
  $tahun     = substr($tgl, 0, 4);
  $bulan     = substr($tgl, 5, 2);
  $taggal    = substr($tgl, 8, 2);
  return $taggal . " " . $namabulan[(int)$bulan-1] . " ". $tahun;
}

function kembali($metode, $bayar, $jumlah) {
  if ($metode == 'TUNAI') {
    return number_format($bayar - $jumlah, 0, ',', '.');
  } else {
    return 0;
  }
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Invoice <?= str_pad($penjualan->id, 6, '0', STR_PAD_LEFT); ?></title>
		<link rel="stylesheet" href="<?= $this->uri->baseUri; ?>style.css">
	</head>
	<!--
	<body onload="window.print();"> -->
	<body >
		<header>
			<h1>KSP SUMBER BAROKAH</h1>
      <address>
				<p>Badan Hukum : 36 / BH / XIII.10 / V / III / 2008</p>
				<p>Jl. Syeh Quro Gg. Buana II Johar Utara Rt 02/18 Karawang Wetan</p>
			</address>
			<hr>
			<h2><b>KWITANSI PEMBAYARAN</b></h2>
			<!--
			<span>
        <img width='209' height='61' title='' alt='' src='data:image/png;base64,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'>
		-->
		</header>
		<article>
		<div id="kiri"><p> TGL CETAK/BAYAR: ................</p></div>
		<div id="kanan">ini adalah kolom sebelah kanan</div>
			<table class="meta">
				<tr>
					<th><span>Invoice</span></th>
					<td><span><?= str_pad($penjualan->id, 6, '0', STR_PAD_LEFT); ?></span></td>
				</tr>
				<tr>
					<th><span>Tanggal</span></th>
					<td><span><?= format_tanggal($penjualan->tanggal); ?></span></td>
				</tr>
			</table>
			<table class="inventory">
				<thead>
					<tr>
						<th><span>Barang</span></th>
						<th><span>Jumlah</span></th>
						<th><span>Satuan</span></th>
						<th><span>Subtotal</span></th>
					</tr>
				</thead>
				<tbody>
          <?php if ($penjualan_item) { foreach ($penjualan_item as $item) { ?>
					<tr>
						<td><span><?= $item->barang; ?></span></td>
						<td><span><?= $item->jumlah; ?></span></td>
						<td><span>Rp. <?= number_format($item->satuan, 0, ',', '.'); ?></span></td>
						<td><span>Rp. <?= number_format($item->jumlah * $item->satuan, 0, ',', '.'); ?></span></td>
					</tr>
          <?php $total += $item->jumlah * $item->satuan; } } else { ?>
          <tr>
            <td colspan="4"><span><i>Tidak ada item barang.</i></span></td>
          </tr>
          <?php } ?>
				</tbody>
			</table>
			<table class="balance">
				<tr>
					<th><span>Total</span></th>
					<td><span>Rp. <?= number_format($total, 0, ',', '.'); ?></span></td>
				</tr>
				<tr>
					<th><span>Metode</span></th>
					<td><span><?= $penjualan->metode_bayar; ?></span></td>
				</tr>
				<tr>
					<th><span>Bayar</span></th>
					<td><span>Rp. <?= number_format($penjualan->bayar, 0, ',', '.'); ?></span></td>
				</tr>
				<tr>
					<th><span>Kembali</span></th>
					<td><span>Rp. <?= kembali($penjualan->metode_bayar, $penjualan->bayar, $total); ?></span></td>
				</tr>
			</table>
		</article>
		<aside>
			<h1>Terima Kasih</h1>
		</aside>
	</body>
</html>