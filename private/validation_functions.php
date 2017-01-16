<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  //improved to only take an actual valid formatted email
  function has_valid_email_format($value) {
		if (preg_match('/^[\w\_\.]+@[\w\_]+\.[\w]+$/', $value)){
    		return true;
		} else{
			return false;
		}  
	}
	//only allow uppercase letters for state code
   function has_valid_code_format($value) {
		if (preg_match('/^[A-Z]+$/', $value)){
    		return true;
		} else{
			return false;
		}
  }
  //retriction for phone numbers
  function has_valid_phone_format($value) {
		if (preg_match('/^[0-9\s\(\-\)]+$/', $value)){
    		return true;
		} else{
			return false;
		}
   }
   //restrictions for position. Important since database only takes int values
    function has_valid_position_format($value) {
		if (preg_match('/^[0-9]+$/', $value)){
    		return true;
		} else{
			return false;
		}
   }
   //checks username format
   function has_valid_username_format($value) {
		if (preg_match('/^[\w\_]+$/', $value)){
    		return true;
		} else{
			return false;
		}
  }
  //checks name formate. Can only user letters, spaces, and specific characters
  function has_valid_name_format($value){
  		if (preg_match('/^[A-Za-z\s\.\'\-\,]+$/', $value)){
  			return true;
  		} else{
  			return false;
  		}
  }
?>
