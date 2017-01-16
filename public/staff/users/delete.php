<?php
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
  redirect_to('index.php');
}

$id = h($_GET['id']);

$users_result = find_user_by_id($id);
// No loop, only one result
$user = db_fetch_assoc($users_result);

if(is_post_request()) {
	if(isset($_POST['no'])) {
		 redirect_to("show.php?id=".$id);
	} elseif(isset($_POST['yes'])) {
		delete_user($user);
		redirect_to("index.php");
	}
}
?>

<?php $page_title = 'Staff: Delete User ' . $user['first_name'] . " " . $user['last_name']; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to Users List</a><br />

  <h1>Username: <?php echo $user['username']; ?></h1>
  <h1>Are you sure you want to delete this user account?</h1>
  <p>
  <?php
		echo "<form name='delete' method='post' action='delete.php?id=".$id."'>";
		echo "<input type='submit' name='yes' value='Yes' /> ";
		echo "<input type='submit' name='no' value='No' /> ";
		echo "</form> ";
		
    	db_free_result($users_result);
  ?>
  </p>
  <br />

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
