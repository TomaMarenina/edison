<?php
if (isset($_POST['guess'])) {
	$result = array();
	// предыдущее загаданное число, просто для алгоритма из головы
	$previous_number = $User::getLastNumber(); 
	// догадки экстрасенсов 
	$result[1] = $psychics1->makeGuess($previous_number);
	$result[2] = $psychics2->makeGuess($previous_number);
	$result[3] = $psychics3->makeGuess($previous_number);
	
	echo json_encode($result);
	exit();
}


if (isset($_POST['user_input'])) {
	$input = intval(trim($_POST['user_input'])); // число, загаданное юзером
	if (!validate_guess($input)) {
		$result['error'] = 'Число должно быть от 10 до 99';
	} else {
		$User::addNumber($input);
		$reliabilities = array(); // уровни достоверности экстрасенсов
		// проверка догадок экстрасенсов
		$reliabilities[1] = $psychics1->checkGuess($input);
		$reliabilities[2] = $psychics2->checkGuess($input);
		$reliabilities[3] = $psychics3->checkGuess($input);
		$result['reliabilities'] = $reliabilities;
	}
	echo json_encode($result);
	exit();
}


// проверка введенного юзером числа
function validate_guess($number) {
	if ($number < 10 || $number > 99) {
		return false;
	} else {
		return true;
	}
}