<?php

class HttpMethod{
	const POST = "POST";
	const GET = "GET";
}

class FormInputElement{
	const TEXT = "text";
	const PASSWORD = "password";
	const SUBMIT = "submit";
}

class FormInput{
	private $type;
	private $name;
	private $id;
	private $value;

	function __construct($type, $name, $id, $value = ""){
		$this->type = $type;
		$this->name = $name;
		$this->id = $id;
		$this->value = $value;
	}

	function __toString(){
		$output = "";
		if($this->type != FormInputElement::SUBMIT){
			$output .= "<label>$this->name</label>";
		}
		$output .= "<input type=\"$this->type\" id=\"$this->name\" name=\"$this->id\" value=\"$this->value\"><br>\r\n";
		return $output;
	}
}

class Formbuilder{
	
	private $method = HttpMethod::GET;
	private $inputList = array();
	private $errorMessage = "";

	function __construct($method){
		$this->method = $method;
	}

	public function addFormInput($forminput){
		$this->inputList[] = $forminput;
	}

	public function getForm(){
		$output  = "";
		$output .= $this->getFormStart($this->method);
		if(strlen($this->errorMessage) > 1){
			$output .= "<div class=\"formmessage\">$this->errorMessage</div>";
		}
		foreach ($this->inputList as $input) {
			$output .= $input;
		}
		$output .= $this->getFormEnd();
		return $output;
	}

	public function setErrorMessage($message){
		$this->errorMessage = $message;
	}

	private function getFormStart($method){
		return "<form method=\"$method\">";
	}

	private function getFormEnd(){
		return "</form>";
	}
}