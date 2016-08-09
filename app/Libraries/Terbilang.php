<?php
namespace Libraries;

class Terbilang {
    
    public function __construct(){
        
    }
	public function rp_terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return $this->rp_terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return $this->rp_terbilang($x / 10) . " puluh" . $this->rp_terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . $this->rp_terbilang($x - 100);
  elseif ($x < 1000)
    return $this->rp_terbilang($x / 100) . " ratus" . $this->rp_terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . $this->rp_terbilang($x - 1000);
  elseif ($x < 1000000)
    return $this->rp_terbilang($x / 1000) . " ribu" . $this->rp_terbilang($x % 1000);
  elseif ($x < 1000000000)
    return $this->rp_terbilang($x / 1000000) . " juta" . $this->rp_terbilang($x % 1000000);
}
	
}