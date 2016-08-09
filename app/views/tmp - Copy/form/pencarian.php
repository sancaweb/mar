<?php if (isset($pencarian)){
if ($pencarian=='input_pinjaman'){
$this->output(TMP.'form/pencarian/'.$pencarian);
}elseif ($pencarian=='hasil_cari_cicilan'){
$this->output(TMP.'form/pencarian/'.$pencarian);

}elseif($pencarian=='cari_cicilan'){
$this->output(TMP.'form/pencarian/'.$pencarian);
}elseif($pencarian=='hasil_cari_history'){
$this->output(TMP.'form/pencarian/'.$pencarian);
}elseif($pencarian=='view_cicilan'){
$this->output(TMP.'form/pencarian/'.$pencarian);
}elseif($pencarian=='cari_tabungan'){
$this->output(TMP.'form/pencarian/'.$pencarian);
}

}
?>