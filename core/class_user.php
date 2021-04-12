<?php
class User {

    protected static $_instance; 
	protected static $userid; 
	protected static $history = array();

    private function __construct() {   
		if (!isset($_SESSION['user_id'])) {
			$_SESSION['user_id'] = time() . '_' . random_int(100, 999);
			$_SESSION['user_history'] = array();
		} 
		self::$userid = $_SESSION['user_id'];
		self::$history = $_SESSION['user_history'];
    }

    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    protected function __clone() {

    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    public static function addNumber($number) { // запись загаданного числа в историю
    	$_SESSION['user_history'][] = $number;
    	self::$history = $_SESSION['user_history'];
    }

    public static function getHistory() { // получение истории загаданных чисел
    	return self::$history;
    }

    public static function getLastNumber() { // получение последнего загаданного числа
    	if (empty(self::$history)) {
    		return 0;
    	} else {
    		$last_number = end(self::$history); 
    		reset(self::$history);
    		return $last_number;
    	}
    }

}