<?php
require_once('../../../private/initialize.php');

// Set default values for all variables the page needs.
$errors = array();
$state = array(
  'name' => '',
  'code' => '',
  'country_id' => '' 
);

if(isset($_GET['id'])) {
  $state['country_id'] = $_GET['id'];
} else{
  $state['country_id']= 1; //set to US by default if the user got here from the add state list
}

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['name'])) { $state['name'] = h($_POST['name']); }
  if(isset($_POST['code'])) { $state['code'] = h($_POST['code']); }
  if(isset($_POST['country_id'])) { $state['country_id'] = h($_POST['country_id']); }


  $result = insert_state($state);
  if($result === true) {
    $new_id = db_insert_id($db);
    redirect_to('show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }
}

?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>New State</h1>

  <?php echo display_errors($errors); ?>

  <form action="new.php" method="post">
     	Name<br />
    	<input type="text" name="name" value="<?php echo $state['name']; ?>" /><br />
     	Code<br />
   	 	<input type="text" name="code" value="<?php echo $state['code']; ?>" /><br />
    	Country<br />
    	<select name="country_id">
    		<?php
    			$countries_result = find_all_countries();
				while($country = db_fetch_assoc($countries_result)) {
					if($country['id'] == $state['country_id']){
						echo "<option value='".$country['id']."' selected>". $country['name'] ."</option>";
					} else{
						echo "<option value='".$country['id']."' >". $country['name'] ."</option>";
					}
				}
    		?>
    	</select>
    	<input type="submit" name="submit" value="Create"  />
   </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
