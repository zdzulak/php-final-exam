<?php ob_start();

// authentication check
require_once('auth.php');

// set the page title
$page_title = null;
$page_title = 'Entries';

// embed the header
require_once('header.php');

// connect
require_once('db.php');

// write the sql query
$sql = "SELECT * FROM journal";

// execute the query and store the results
$cmd = $conn->prepare($sql);
$cmd->execute();
$entries = $cmd->fetchAll();

// start the html display table
echo '<a href="entry.php" title="Add a New Entry">Add a New Entry</a>
<table class="table table-striped table-hover"><thead><th>Journal Entry</th><th>Picture</th><th>Date</th>
<th>Edit</th><th>Delete</th></thead><tbody>';

// loop through the results and show each movie in a new row and each value in a new column
foreach ($entries as $entry) {
	echo '<tr><td>' . $entry['entry'] . '</td>
		<td><img src="' . $entry['picture'] . '"alt="user image" /></td>
		<td>' . $entry['date'] . '</td>
		<td><a href="entry.php?movie_id=' . $entry['user_id'] . '">Edit</a></td>
		<td><a href="delete-entry.php?movie_id=' . $entry['user_id'] . '"
			onclick="return confirm(\'Are you sure you want to delete this entry?\');">Delete</td></tr>';
}

// close the table and body
echo '</tbody></table>';

// disconnect
$conn = null;

// embed footer
require_once('footer.php');
ob_flush();
?>
