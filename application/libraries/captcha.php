<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
 
class Captcha{
	
    function __construct(){
    }
	public function generateCaptcha(){
		$captchaText = array(
			"5 + 3 + 7",
			"2 x 9 x 1",
			"10 + 3 - 6",
			"7 x 9",
			"1 + 2 + 5",
			"12 : 3",
			"5 + 7 - 2",
			"11 x 1 x 1",
			"5 + 1 + 3",
			"3 + 7 + 3",
			"25 - 6",
			"24 : 4",
			"20 - 5 - 3",
			"3 x 7",
			"2 + 1"
		);
		$num = rand(0,14);
		$text = $captchaText[$num];
		return array("key"=>$num,"text"=>$text);
	}
	public function checkAnswer($key,$answer){
		$answerList = array(
			15,18,7,63,8,4,10,11,9,13,19,6,12,21,3
		);
		if($answer == $answerList[$key]){
			return true;
		}
		else{
			return false;
		}
	}
}