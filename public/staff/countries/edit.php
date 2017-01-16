<?php
require_once('../../../private/initialize.php');

// Set default values for all variables the page needs.

$errors = array();
$country = array(
  'name' => '',
  'code' => ''
);

$country_result = find_country_by_id($_GET['id']);
// No loop, only one result
$country = db_fetch_assoc($country_result);

if(is_post_request()) {

  // Confirm that values are present before accessing them.
  if(isset($_POST['name'])) { $country['name'] = h($_POST['name']); }
  if(isset($_POST['code'])) { $country['code'] = h($_POST['code']); }


  $result = update_country($country);
  if($result === true) {
    redirect_to('show.php?id=' . $country['id']);
  } else {
    $errors = $result;
  }
}

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}

?>
<?php $page_title = 'Staff: Edit Country ' . $country['name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Country List</a><br />

  <h1>Edit Country: <?php echo $country['name']; ?></h1>

  <?php echo display_errors($errors); ?>

  <form action="edit.php?id=<?php echo $country['id']; ?>"  method="post">
     	Name<br />
    	<input type="text" name="name" value="<?php echo $country['name']; ?>" /><br />
     	Code<br />
   	 	<input type="text" name="code" value="<?php echo $country['code']; ?>" /><br />
    	<br />
    	<input type="submit" name="submit" value="Edit"  />
  </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
