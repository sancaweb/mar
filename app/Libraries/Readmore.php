<?php
namespace Libraries;

class Readmore {
    
    public function __construct(){
        
    }
	
	public function readmore($kalimat,$num_char)
	{
		$kalimat=$kalimat;
		$num_char=$num_char;
		
		$cut_text = substr($kalimat,0, $num_char);			
		$jml_cut=strlen($cut_text) - 1;
		
		$char_terakhir=substr($cut_text,$jml_cut,$jml_cut);
		
		if ($char_terakhir !=' ') {
			$new_pos = strrpos($cut_text, ' ');
			return $hasil=substr($kalimat,0,$new_pos);
		}else{
			return $hasil=$cut_text;
		}
		
		
		 
	}
	
	public function potong($kalimat,$numchar){
		$num_char=$numchar;
		 $cut_text = substr($kalimat, 0, $num_char);
		 
		 if ($cut_text !=' ') { // jika huruf ke 50 (50 - 1 karena index dimulai dari 0) bukan  spasi
		$new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
		return $cut_text = substr($kalimat, 0, $new_pos);
		}
		
	}
	
}