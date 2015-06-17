<?php 
/*
 * PHP function til að athuga hvort
 * Kennitala sé rétt (gild) eða ekki 
 * Notast við ákveðnar formúlu til þess
 * http://www.skra.is/thjodskra/um-thjodskra-/um-kennitolur/
 */ 


date_default_timezone_set('America/Los_Angeles');

function kennitala($tala) {
	// d = dagur, m = mánuður, y = ár (2 tölurstafir)
	$format = 'dmy';	

	//Faum fyrstu 6 tölustafina
	$date = mb_substr($tala, 0, 6);

	// Fáum dagsetningu
	$d = DateTime::createFromFormat($format, $date);
	
	// True or False athugun, villa ef ógild
	if($d && $d->format($format) == $date) {
		$tala;
	} else {
		return "Ógild Kennitala";
	}
	
	// Næstu tvær frá og með 20. 
	$safe = mb_substr($tala, -4, -2);
	
	if($safe >= 20) {
		$tala;
	} else {
		return "Ógild Kennitala";
	}
	
	// seinasti tölustafurinn merkir öld fæðingar
	// Athuga aðeins hvort 8, 9 eða 0 er nuna. 
	// TO DO: 
	// * Match to year given in date
	
	$century = mb_substr($tala, 9, 10);
	
	if($century == 8 Xor $century == 9 Xor $century == 0) {
		return "Gild Kennitala";
	} else {
		return "Ógild Kennitala";
	}
	
}


$string = "0809962849";

$done = kennitala($string);
echo $done;

?>
