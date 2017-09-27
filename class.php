<?php

class MyClass {
	private $name = 'Alex';
	public $name2 = 'Alex2';

	function __construct($param) {
		$this->name = $param;
	}

	function get_name() {
		return $this->name;
	}
}

class MyNewClass extends MyClass {
	public function get_name(){
		return $this->name . $this->name2;
		// return parent::get_name . $this->name2; - если в родительской объявлена private  переменная,
		// иначе надо объявить protected: protected $name = 'Alex'; 
	}
}

$var = new MyClass('123');
$var2 = new MyClass('555');

echo $var->get_name();
echo "<br>";
echo $var->name2;