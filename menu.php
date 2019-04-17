<?php ob_start();

// authentication check
require_once('auth.php');

// set the page title
$page_title = null;
$page_title = 'Main Menu';

// embed the header
require_once('header.php');
?>

<main class="container">

   <h1>COMP1006 Application</h1>

   <ul class="list-group">
      <li class="list-group-item"><a href="entries.php" title="Entries">Entries</a></li>
   </ul>
</main>

<?php
// embed footer
require_once('footer.php');
ob_flush();
?>
