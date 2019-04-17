<?php ob_start();

// authentication check
require_once('auth.php');

// set page title
$page_title = null;
$page_title = 'Entry Details';

// embed the header
require_once('header.php');

// initialize variables
$user_id = null;
$email = null;
$entry = null;
$picture = null;
$date = null;


// check the url for a user_id parameter and store the value in a variable if we find one
if (empty($_GET['user_id']) == false) {
	$user_id = $_GET['user_id'];


	// connect
	require_once('db.php');

	// write the sql query
	$sql = "SELECT * FROM journal WHERE user_id = :user_id";

	// execute the query and store the results
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':user_id', $user_id, PDO::PARAM_INT);
	$cmd->execute();
	$profiles = $cmd->fetchAll();

	// populate the fields for the selected movie from the query result
	foreach ($profiles as $profile) {
		$entry = $profile['entry'];
		$picture = $profile['picture'];
		$date = $profile['date'];
	}

	// disconnect
	$conn = null;
}

?>

	<div class="container">
		<h1>Entry Details</h1>
	    <form method="post" action="save-entry.php">
	        <fieldset class="form-group">
	            <label for="entry" class="col-sm-2">Entry:</label>
	            <input name="entry" id="entry" required value="<?php echo $entry; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="picture" class="col-sm-2">Picture:</label>
	            <input name="picture" id="picture" type="file" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="date" class="col-sm-2">Date:</label>
	            <input name="date" id="date" required type="date" value="<?php echo $date; ?>" />
	        </fieldset>
	        <input name="user_id" type="hidden" value="<?php echo $user_id; ?>" />
	        <button type="submit" class="col-sm-offset-2 btn btn-success">Submit</button>
	    </form>
	</div>

<?php // embed footer
require_once('footer.php');
ob_flush(); ?>
