<?php
namespace Libraries;

class Image {
    
    public function __construct(){
        
    }
	
	public function del_img($kalimat)
	{
		$content = $kalimat;
		return $content = preg_replace("/<img[^>]+\>/i", "", $content); 
	}
	
	function ambil_gambar($string, $default = NULL) {
	/*  harviacode.com
	 *  gambar_pertama : untuk mendapatkan img src dalam string html
	 *  params: 
			string : string yang ingin diambil tag gambarnya ;
			default : url gambar default bila tag img tidak ditemukan,
				ex : http://localhost/siap/fileku/no-picture.jpg; */
		
		preg_match('@<img.+src="(.*)".*>@Uims', $string, $matches);
		$src = $matches ? $matches[1] : $default;
		 //$gambar=str_replace("../../../","/",$src);
		 return $src;
	}
	
}