<?php ob_start();

// auth check
require_once('auth.php');

// header
$page_title = null;
$page_title = 'Saving your Entry...';
require_once('header.php');
require_once('appvars.php');

// save form inputs into variables
$entry = $_POST['entry'];
$picture = $_FILES['picture']['name'];
$picture_type = $_FILES['picture']['type'];
$picture_size = $_FILES['picture']['size'];
$date = $_POST['date'];

// create a variable to indicate if the form data is ok to save or not
$ok = true;

// check each value
if (empty($entry)) {
	// notify the user
	echo 'Entry is required<br />';

	// change $ok to false so we know not to save
	$ok = false;
}

if(!empty($picture)) {
	if ((($photo_type == 'image/gif') || ($photo_type == 'image/jpeg') || ($photo_type == 'image/jpg') || ($photo_type == 'image/png')) && ($photo_size > 0) && ($photo_size <= MAXFILESIZE)) {

		if ($_FILES['photo']['error'] == 0) {

		$target = UPLOADPATH . $photo;

	}

	else {
		echo '<p> There was a problem uploading your file</p>';
	}
}

else {
	echo '<p> You must submit either a png, jpeg, jpg or a png and your file cannot be greater than 32kb';
}

}

else {
	echo '<p> Please upload a photo! </p>';
}

if (empty($date)) {
	// notify the user
	echo 'Date is required<br />';

	// change $ok to false so we know not to save
	$ok = false;
}



if ($ok == true) {
	// connect to the database
	require_once('db.php');

	if (empty($user_id)) {
		// set up the SQL INSERT command
		$sql = "INSERT INTO journal (entry, picture, date) VALUES (:entry, :picture, :date)";
	}
	else {
		// set up the SQL UPDATE command to modify the existing movie
		$sql = "UPDATE journal SET entry = :entry, picture = :picture, date = :date WHERE user_id = :user_id";
	}

	// create a command object and fill the parameters with the form values
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':entry', $entry);
	$cmd->bindParam(':picture', $picture);
	$cmd->bindParam(':date', $date);

	// fill the movie_id if we have one
	if (!empty($user_id)) {
		$cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	}

	// execute the command
	$cmd->execute();

	// disconnect from the database
	$conn = null;

	// show confirmation
	echo "Entry Saved";
}

require_once('footer.php');
ob_flush();
?>
