<?php

  //
  // COUNTRY QUERIES
  //

  // Find all countries, ordered by name
  function find_all_countries() {
    global $db;
    $sql = "SELECT * FROM countries ORDER BY name ASC;";
    $country_result = db_query($db, $sql);
    return $country_result;
  }
  function find_country_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM countries ";
    $sql .= "WHERE id='" . $id . "';";
    $state_result = db_query($db, $sql);
    return $state_result;
  }
  
  
    function validate_country($country, $errors=array()) {
    if (is_blank($country['name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($country['name'], array('max' => 255))) {
      $errors[] = "Name must be less than or equal to 255 characters.";
    } elseif (!has_valid_name_format($country['name'])) {
      $errors[] = "Name must be in a valid format.";
    }
    
    if (is_blank($country['code'])) {
      $errors[] = "Code cannot be blank.";
    } elseif (!has_length($country['code'], array( 'max' => 255))) {
      $errors[] = "Code must be less than or equal to 255 characters.";
    } elseif (!has_valid_code_format($country['code'])) {
      $errors[] = "Code must be in a valid format.";
    }
    
    return $errors;
  }
  
  
  
    // Add a new country to the table
  // Either returns true or an array of errors
  function insert_country($country) {
    global $db;

    $errors = validate_country($country);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO countries ";
    $sql .= "(name, code) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysql_real_escape_string($country['name']) . "',";
    $sql .= "'" . mysql_real_escape_string($country['code']) . "'";
    $sql .= ");";    
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }
    function update_country($country) {
    global $db;

    $errors = validate_country($country);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE countries SET ";
    $sql .= "name='" . mysql_real_escape_string($country['name']) . "', ";
    $sql .= "code='" . mysql_real_escape_string($country['code']) . "'";
    $sql .= "WHERE id='" . mysql_real_escape_string($country['id']) . "' ";
    $sql .= "LIMIT 1;";           // For update_state statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }
  

  //
  // STATE QUERIES
  //

  // Find all states, ordered by name
  function find_all_states() {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find all states, ordered by name
  function find_states_for_country_id($country_id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE country_id='" . $country_id . "' ";
    $sql .= "ORDER BY name ASC;";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  // Find state by ID
  function find_state_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM states ";
    $sql .= "WHERE id='" . $id . "';";
    $state_result = db_query($db, $sql);
    return $state_result;
  }

  function validate_state($state, $errors=array()) {
    if (is_blank($state['name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($state['name'], array('max' => 255))) {
      $errors[] = "Name must be less than or equal to 255 characters.";
    } elseif (!has_valid_name_format($state['name'])) {
      $errors[] = "Name must be in a valid format.";
    }
    
    if (is_blank($state['code'])) {
      $errors[] = "Code cannot be blank.";
    } elseif (!has_length($state['code'], array( 'max' => 255))) {
      $errors[] = "Code must be less than or equal to 255 characters.";
    } elseif (!has_valid_code_format($state['code'])) {
      $errors[] = "Code must be in a valid format.";
    }
    
    return $errors;
  }

  // Add a new state to the table
  // Either returns true or an array of errors
  function insert_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO states ";
    $sql .= "(name, code, country_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysql_real_escape_string($state['name']) . "',";
    $sql .= "'" . mysql_real_escape_string($state['code']) . "',";
    $sql .= "'" . mysql_real_escape_string($state['country_id']) . "'";
    $sql .= ");";    
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a state record
  // Either returns true or an array of errors
  function update_state($state) {
    global $db;

    $errors = validate_state($state);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE states SET ";
    $sql .= "name='" . mysql_real_escape_string($state['name']) . "', ";
    $sql .= "code='" . mysql_real_escape_string($state['code']) . "'";
    $sql .= "WHERE id='" . mysql_real_escape_string($state['id']) . "' ";
    $sql .= "LIMIT 1;";           // For update_state statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // TERRITORY QUERIES
  //

  // Find all territories, ordered by state_id
  function find_all_territories() {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "ORDER BY state_id ASC, position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find all territories whose state_id (foreign key) matches this id
  function find_territories_for_state_id($state_id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE state_id='" . $state_id . "' ";
    $sql .= "ORDER BY position ASC;";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  // Find territory by ID
  function find_territory_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "WHERE id='" . $id . "';";
    $territory_result = db_query($db, $sql);
    return $territory_result;
  }

  function validate_territory($territory, $errors=array()) {
    if (is_blank($territory['name'])) {
      $errors[] = "Name cannot be blank.";
    } elseif (!has_length($territory['name'], array('max' => 255))) {
      $errors[] = "Name must be less than or equal to 255 characters.";
    } elseif (!has_valid_name_format($territory['name'])) {
      $errors[] = "Name must be in a valid format.";
    }
    
    if (is_blank($territory['position'])) {
      $errors[] = "Position cannot be blank.";
    } elseif (!has_length($territory['position'], array('max' => 11))) {
      $errors[] = "Position must be less than or equal to 11 digits.";
    }  elseif (!has_valid_position_format($territory['position'])) {
      $errors[] = "Position must be in a valid format.";
    }
    return $errors;
  }

  // Add a new territory to the table
  // Either returns true or an array of errors
  function insert_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO territories ";
    $sql .= "(name, state_id, position) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysql_real_escape_string($territory['name']) . "',";
    $sql .= "'" . mysql_real_escape_string($territory['state_id']) . "',";
    $sql .= "'" . mysql_real_escape_string($territory['position']) . "'";
    $sql .= ");";
    
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a territory record
  // Either returns true or an array of errors
  function update_territory($territory) {
    global $db;

    $errors = validate_territory($territory);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE territories SET ";
    $sql .= "name='" . $territory['name'] . "', ";
    $sql .= "position='" . mysql_real_escape_string($territory['position']) . "' ";
    $sql .= "WHERE id='" . mysql_real_escape_string($territory['id']) . "' ";
    $sql .= "LIMIT 1;";        
    // For update_territory statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE territoryment failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  //
  // SALESPERSON QUERIES
  //

  // Find all salespeople, ordered last_name, first_name
  function find_all_salespeople() {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // To find salespeople, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same territory ID.
  function find_salespeople_for_territory_id($territory_id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (salespeople_territories.salesperson_id = salespeople.id) ";
    $sql .= "WHERE salespeople_territories.territory_id='" . $territory_id . "' ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  // Find salesperson using id
  function find_salesperson_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM salespeople ";
    $sql .= "WHERE id='" . $id . "';";
    $salespeople_result = db_query($db, $sql);
    return $salespeople_result;
  }

  function validate_salesperson($salesperson, $errors=array()) {
    if (is_blank($salesperson['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($salesperson['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    } elseif (!has_valid_name_format($salesperson['first_name'])) {
      $errors[] = "First name must be in a valid format.";
    }
    
    if (is_blank($salesperson['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($salesperson['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    } elseif (!has_valid_name_format($salesperson['last_name'])) {
      $errors[] = "Last name must be in a valid format.";
    }
    
    if (is_blank($salesperson['phone'])) {
      $errors[] = "Phone number cannot be blank.";
    } elseif (!has_length($salesperson['phone'], array('max' => 255))) {
      $errors[] = "Phone number must be less than 255 characters.";
    } elseif (!has_valid_phone_format($salesperson['phone'])) {
      $errors[] = "Phone number must be in a valid format.";
    }

    if (is_blank($salesperson['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($salesperson['email'], array('max' => 255))) {
      $errors[] = "Email must be less than 255 characters.";
    } elseif (!has_valid_email_format($salesperson['email'])) {
      $errors[] = "Email must be in a valid format.";
    }


    return $errors;
  }

  // Add a new salesperson to the table
  // Either returns true or an array of errors
  function insert_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "INSERT INTO salespeople ";
    $sql .= "(first_name, last_name, phone, email) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysql_real_escape_string($salesperson['first_name']) . "',";
    $sql .= "'" . mysql_real_escape_string($salesperson['last_name']) . "',";
    $sql .= "'" . mysql_real_escape_string($salesperson['phone']) . "',";
    $sql .= "'" . mysql_real_escape_string($salesperson['email']) . "'";
    $sql .= ");";
    
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a salesperson record
  // Either returns true or an array of errors
  function update_salesperson($salesperson) {
    global $db;

    $errors = validate_salesperson($salesperson);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE salespeople SET ";
    $sql .= "first_name='" . mysql_real_escape_string($salesperson['first_name']) . "', ";
    $sql .= "last_name='" . mysql_real_escape_string($salesperson['last_name']) . "', ";
    $sql .= "phone='" . mysql_real_escape_string($salesperson['phone']) . "', ";
    $sql .= "email='" . mysql_real_escape_string($salesperson['email']) . "' ";
    $sql .= "WHERE id='" . mysql_real_escape_string($salesperson['id']) . "' ";
    $sql .= "LIMIT 1;";    // For update_salesperson statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // To find territories, we need to use the join table.
  // We LEFT JOIN salespeople_territories and then find results
  // in the join table which have the same salesperson ID.
  function find_territories_by_salesperson_id($id=0) {
    global $db;
    $sql = "SELECT * FROM territories ";
    $sql .= "LEFT JOIN salespeople_territories
              ON (territories.id = salespeople_territories.territory_id) ";
    $sql .= "WHERE salespeople_territories.salesperson_id='" . $id . "' ";
    $sql .= "ORDER BY territories.name ASC;";
    $territories_result = db_query($db, $sql);
    return $territories_result;
  }

  //
  // USER QUERIES
  //

  // Find all users, ordered last_name, first_name
  function find_all_users() {
    global $db;
    $sql = "SELECT * FROM users ";
    $sql .= "ORDER BY last_name ASC, first_name ASC;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  // Find user using id
  function find_user_by_id($id=0) {
    global $db;
    $sql = "SELECT * FROM users WHERE id='" . $id . "' LIMIT 1;";
    $users_result = db_query($db, $sql);
    return $users_result;
  }

  function validate_user($user, $errors=array()) {
    if (is_blank($user['first_name'])) {
      $errors[] = "First name cannot be blank.";
    } elseif (!has_length($user['first_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "First name must be between 2 and 255 characters.";
    } elseif (!has_valid_name_format($user['first_name'])) {
      $errors[] = "First name must be a valid format.";
    }

    if (is_blank($user['last_name'])) {
      $errors[] = "Last name cannot be blank.";
    } elseif (!has_length($user['last_name'], array('min' => 2, 'max' => 255))) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    } elseif (!has_valid_name_format($user['last_name'])) {
      $errors[] = "Last name must be a valid format.";
    }

    if (is_blank($user['email'])) {
      $errors[] = "Email cannot be blank.";
    } elseif (!has_length($user['email'], array('max' => 255))) {
       //added email max character limit to prevent error due to database char limit
       $errors[] = "Email must be less than or equal to 255 characters.";
    } elseif (!has_valid_email_format($user['email'])) {
      $errors[] = "Email must be a valid format.";
    }

    if (is_blank($user['username'])) {
      $errors[] = "Username cannot be blank.";
    } elseif (!has_length($user['username'], array('max' => 255))) {
      $errors[] = "Username must be less than or equal to 255 characters.";
    } elseif (!has_valid_username_format($user['username'])) {
      $errors[] = "Username must be a valid format.";
    } elseif(username_unique($user)==false){
       $errors[] = "The username you entered is already in use.";
    }
    return $errors;
  }

  // Add a new user to the table
  // Either returns true or an array of errors
  function insert_user($user) {
    global $db;

	
    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $created_at = date("Y-m-d H:i:s");
    $sql = "INSERT INTO users ";
    $sql .= "(first_name, last_name, email, username, created_at) ";
    $sql .= "VALUES (";
    $sql .= "'" . mysql_real_escape_string($user['first_name']) . "',";
    $sql .= "'" . mysql_real_escape_string($user['last_name']) . "',";
    $sql .= "'" . mysql_real_escape_string($user['email']) . "',";
    $sql .= "'" . mysql_real_escape_string($user['username']) . "',";
    $sql .= "'" . $created_at . "'";
    $sql .= ");";
    // For INSERT statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL INSERT statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }

  // Edit a user record
  // Either returns true or an array of errors
  function update_user($user) {
    global $db;

    $errors = validate_user($user);
    if (!empty($errors)) {
      return $errors;
    }

    $sql = "UPDATE users SET ";
    $sql .= "first_name='" . mysql_real_escape_string($user['first_name']) . "', ";
    $sql .= "last_name='" . mysql_real_escape_string($user['last_name']) . "', ";
    $sql .= "email='" . mysql_real_escape_string($user['email']) . "', ";
    $sql .= "username='" . mysql_real_escape_string($user['username']) . "' ";
    $sql .= "WHERE id='" . mysql_real_escape_string($user['id']) . "' ";
    $sql .= "LIMIT 1;";
    // For update_user statments, $result is just true/false
    $result = db_query($db, $sql);
    if($result) {
      return true;
    } else {
      // The SQL UPDATE statement failed.
      // Just show the error, not the form
      echo db_error($db);
      db_close($db);
      exit;
    }
  }
  
  function username_unique($user){
      	global $db;
      	
  		$sql = "SELECT * FROM users ";
  		$sql .= "WHERE username = '". mysql_real_escape_string($user['username'])."' ";
  		$sql .= "AND id != '". mysql_real_escape_string($user['id'])."'";
  		$sql .= "LIMIT 1;";
		$username_exists = db_query($db, $sql);
		if(mysqli_num_rows($username_exists)==1){
			return false;
		} else{
			return true;
		}
  }
    function delete_user($user){
      	global $db;
      	      	
  		$sql = "DELETE FROM users ";
  		$sql .= "WHERE id = '". mysql_real_escape_string($user['id'])."' ";
  		$sql .= "LIMIT 1;";
		$delete = db_query($db, $sql);
  		if($delete) {
      		return true;
    		} else {
      	// The SQL UPDATE statement failed.
      	// Just show the error, not the form
      	echo db_error($db);
      	db_close($db);
      	exit;
    }
  }

?>
