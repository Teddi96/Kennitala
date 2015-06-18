<?php 
/*
 * PHP function til a� athuga hvort
 * Kennitala s� r�tt (gild) e�a ekki 
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
	

	/* H�r � koma �treikningar 
	 * � �ryggist�luni.
	 */
	


	// seinasti t�lustafurinn merkir �ld f��ingar
	// Athuga a�eins hvort 8, 9 e�a 0 er nuna. 
	
	$century = mb_substr($tala, 9, 10); // Seinasti stafur � kennit�lu
	$year = mb_substr($tala, -6, -4); // F��ingar�r (d�mi: 65 fyrir 1965)
	$d = DateTime::createFromFormat('y', $year); // Til a� breyta 65 � 1965
	$year = $d->format('Y'); // Til a� geta nota� 1965
	
	// Ef 19. �ld. 
	if($century == 8) {
		if(preg_match('/18../', $year)) {
			return "Gild kennitala"; 
		} else {
			return "�gild Kennitala"; 
		}
	}

	// Ef 20. �ld
	elseif($century == 9) {
		if(preg_match('/19../', $year)) {
			return "Gild Kennitala"; 
		} else {
			return "�gild Kennitala"; 
		}
	}

	// Ef 21. �ld. 
	elseif($century == 0) {
		if(preg_match('/20../', $year)) {
			return "Gild Kennitala"; 
		} else {
			return "�gild Kennitala"; 
		}
	}  

	
	
}


?>
