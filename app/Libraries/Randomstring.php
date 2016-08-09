<?php
namespace Libraries;

class Randomstring {
    
    public function __construct(){
        
    }
	
	public function randomstring($x)
	{
	$length=$x;
	$characters = '23456789ABCDEFGHJKLMNPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
	}
	
}