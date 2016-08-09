<?php
namespace Libraries;

class Readmore {
    
    public function __construct(){
        
    }
	
	public function readmore($kalimat,$num_char)
	{
		$num_char=$num_char;
		$jml_kalimat=strlen($kalimat);
		if($jml_kalimat < $num_char){
			$mulai2=strrpos($kalimat, ' ');
			$num_char=$mulai2;
			$cut_text = substr($kalimat, 0, $num_char);
		 
			 if ($kalimat{$num_char + 1} !=' ') { // jika huruf ke $numchar ($numchar - 1 karena index dimulai dari 0) buka  spasi
			$new_pos = strpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
			return $cut_text = substr($kalimat, 0, $new_pos);
			}
		}else{
			$num_char=$num_char;
			$cut_text = substr($kalimat, 0, $num_char);
		 
			 if ($kalimat{$num_char + 1} !=' ') { // jika huruf ke $numchar ($numchar - 1 karena index dimulai dari 0) buka  spasi
			$new_pos = strrpos($cut_text, ' '); // cari posisi spasi, pencarian dari huruf terakhir
			return $cut_text = substr($kalimat, 0, $new_pos);
			}
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