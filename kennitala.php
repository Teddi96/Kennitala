<?php 
/*
 * PHP function til ad athuga hvort
 * Kennitala se rett (gild) eda ekki 
 * http://www.skra.is/thjodskra/um-thjodskra-/um-kennitolur/
 */ 

date_default_timezone_set('America/Los_Angeles');

function kennitala($tala) {
	// ath lengd 
	if(strlen($tala) == 10) {
		$tala; 
	} else {
		return "Ogild kennitala"; 
	}

	// d = dagur, m = manudur, y = ar (2 tolurstafir)
	$format = 'dmy';	

	//Faum fyrstu 6 tolustafina
	$date = mb_substr($tala, 0, 6);

	// Faum dagsetningu
	$d = DateTime::createFromFormat($format, $date);
	
	// True or False athugun, villa ef ogild
	if($d && $d->format($format) == $date) {
		$tala;
	} else {
		return "Ogild Kennitala";
	}
	
	// next two fra og med 20. 
	$safe = mb_substr($tala, -4, -2);
	
	if($safe >= 20) {
		$tala;
	} else {
		return "Ogild Kennitala";
	}
	

	/* Array fyrir modulus 11 reikning */
	$weight = array( 2, 3, 4, 5, 6, 7,
			 2, 3, 4, 5, 6, 7, 
			 2, 3, 4, 5, 6, 7,
			 2, 3, 4, 5, 6, 7);
	
	// Fyrstu 8 tolurnar
	$first_8 = mb_substr($tala, 0,8);
	
	// Oryggistalan
	$first_9 = mb_substr($tala, 0, 9);
	
	// Turn it around.. Hentugara
	$reverse = strrev( $first_8 );
	
	for ( $i = 0, $sum = 0; $i < strlen( $reverse ); $i++ ) {
		$sum += substr( $reverse, $i, 1 ) * $weight[ $i ];
	}

	$reminder = $sum % 11;
	
	switch( $reminder ) {
		case 0: 
			$result = $first_8 . 0;
			break;
		
		case 1: 
			$result = "n/a";
			break;
		
		default: 
			$check_digit = 11 - $reminder;
			$result = $first_8 . $check_digit;
			break;
	} 

	if( $result == $first_9 ) {
		$tala;
	} else {
		return "Ogild Kennitala";
	}  


	// seinasti tolustafurinn merkir old faedingar
	$century = mb_substr($tala, 9, 10); // Seinasti stafur i kennitolu
	$year = mb_substr($tala, -6, -4); // Faedingarar (i.e: 65 fyrir 1965)
	$d = DateTime::createFromFormat('y', $year); // Til ad breyta 65 i 1965
	$year = $d->format('Y'); // Til ad geta notad 1965
	
	// Ef 19. old. 
	if($century == 8) {
		if(preg_match('/18../', $year)) {
			return "Gild kennitala"; 
		} else {
			return "Ogild Kennitala"; 
		}
	}

	// Ef 20. old
	elseif($century == 9) {
		if(preg_match('/19../', $year)) {
			return "Gild Kennitala"; 
		} else {
			return "Ogild Kennitala"; 
		}
	}

	// Ef 21. old. 
	elseif($century == 0) {
		if(preg_match('/20../', $year)) {
			return "Gild Kennitala"; 
		} else {
			return "Ogild Kennitala"; 
		}
	}  
	
}


?>
