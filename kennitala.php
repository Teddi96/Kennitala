<?php 
/*
 * PHP function til a� athuga hvort
 * Kennitala s� r�tt (gild) e�a ekki 
 * Notast vi� �kve�nar form�lu til �ess
 * http://www.skra.is/thjodskra/um-thjodskra-/um-kennitolur/
 */ 


date_default_timezone_set('America/Los_Angeles');

function kennitala($tala) {
	// d = dagur, m = m�nu�ur, y = �r (2 t�lurstafir)
	$format = 'dmy';	

	//Faum fyrstu 6 t�lustafina
	$date = mb_substr($tala, 0, 6);

	// F�um dagsetningu
	$d = DateTime::createFromFormat($format, $date);
	
	// True or False athugun, villa ef �gild
	if($d && $d->format($format) == $date) {
		$tala;
	} else {
		return "�gild Kennitala";
	}
	
	// N�stu tv�r fr� og me� 20. 
	$safe = mb_substr($tala, -4, -2);
	
	if($safe >= 20) {
		$tala;
	} else {
		return "�gild Kennitala";
	}
	
	// seinasti t�lustafurinn merkir �ld f��ingar
	// Athuga a�eins hvort 8, 9 e�a 0 er nuna. 
	// TO DO: 
	// * Match to year given in date
	
	$century = mb_substr($tala, 9, 10);
	
	if($century == 8 Xor $century == 9 Xor $century == 0) {
		return "Gild Kennitala";
	} else {
		return "�gild Kennitala";
	}
	
}


$string = "0809962849";

$done = kennitala($string);
echo $done;

?>
