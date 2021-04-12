<?php
class Psychic {

    private $psychicid; 
    private $reliability; // достоверность предсказаний
    
    public function __construct($id) {
        $this->psychicid = $id;
        if (empty($_SESSION['psychic'][$id])) {
    		$_SESSION['psychic'][$id] = array();
            $this->reliability = 0; // нейтральная достоверность
        } else {
            $this->reliability = intval($_SESSION['psychic'][$this->psychicid]['reliability']);
        }
    }

    public function makeGuess($user_last_number = 0) {
        $min = 10;
        $max = 99;
        if ($user_last_number) { // если догадки уже были, то диапазон сужается (просто так)
            $min = ($user_last_number - 25 < 10) ? 10 : $user_last_number - 25;
            $max = ($user_last_number + 25 > 99) ? 99 : $user_last_number + 25;
        }
        $guess = random_int($min, $max); // число от экстрасенса
        $_SESSION['psychic'][$this->psychicid]['guess_tmp'] = $guess; // временное хранение в сессии
        return $guess;
    }

    public function checkGuess($real_number) {
        // проверка догадки и изменение уровня достоверности экстрасенса
        if ($real_number == $_SESSION['psychic'][$this->psychicid]['guess_tmp']) { 
            $this->reliability++;
        } else {
            $this->reliability--;
        }
        // запись в сессию достоверности
        $_SESSION['psychic'][$this->psychicid]['reliability'] = $this->reliability;
        // запись в сессию догадки экстрасенса и удаление временной записи
        $_SESSION['psychic'][$this->psychicid]['guess'][] = $_SESSION['psychic'][$this->psychicid]['guess_tmp'];
        unset($_SESSION['psychic'][$this->psychicid]['guess_tmp']);
        return $this->reliability;
    }

    public function getHistory() {
        return $_SESSION['psychic'][$this->psychicid]['guess'];
    }

    public function getReliability() {
        return $this->reliability;
    }

}