<?php 
/*
 * PHP function til að athuga hvort
 * Kennitala sé rétt (gild) eða ekki 
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
	

	/* Hér á koma útreikningar 
	 * á öryggistöluni.
	 */
	


	// seinasti tölustafurinn merkir öld fæðingar
	// Athuga aðeins hvort 8, 9 eða 0 er nuna. 
	
	$century = mb_substr($tala, 9, 10); // Seinasti stafur í kennitölu
	$year = mb_substr($tala, -6, -4); // Fæðingarár (dæmi: 65 fyrir 1965)
	$d = DateTime::createFromFormat('y', $year); // Til að breyta 65 í 1965
	$year = $d->format('Y'); // Til að geta notað 1965
	
	// Ef 19. öld. 
	if($century == 8) {
		if(preg_match('/18../', $year)) {
			return "Gild kennitala"; 
		} else {
			return "Ógild Kennitala"; 
		}
	}

	// Ef 20. öld
	elseif($century == 9) {
		if(preg_match('/19../', $year)) {
			return "Gild Kennitala"; 
		} else {
			return "Ógild Kennitala"; 
		}
	}

	// Ef 21. öld. 
	elseif($century == 0) {
		if(preg_match('/20../', $year)) {
			return "Gild Kennitala"; 
		} else {
			return "Ógild Kennitala"; 
		}
	}  

	
	
}


?>
