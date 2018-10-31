<?php
 
// genera una stringa casuale della lunghezza desiderata
 

function random_string($length) {
	
	define("STRING_LENGTH",32);
	define("NUM_MAX",    99);
	define("NUM_MIN",    0);
    $string = "";
    $psw_casuale = openssl_digest((time()+rand(NUM_MIN,NUM_MAX)), "sha224", false);
    // genera una stringa casuale che ha lunghezza
    // uguale al multiplo di 32 successivo a $length
    for ($i = 0; $i <= ($length/STRING_LENGTH); $i++)
        $string .= $psw_casuale;
 
    // indice di partenza limite
    $max_start_index = (STRING_LENGTH*$i)-$length;
 
    // seleziona la stringa, utilizzando come indice iniziale
    // un valore tra 0 e $max_start_point
    $random_string = substr($string, rand(NUM_MIN, $max_start_index), $length);
 
    return $random_string;
}
?>
