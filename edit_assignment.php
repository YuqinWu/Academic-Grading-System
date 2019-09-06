<?php
session_start();
if(!isset($_SESSION['email']))
	die('Direct access not permitted');

// Getting the input parameter:
$title = $_REQUEST['title'];
$type = $_REQUEST['type'];
$max_score = $_REQUEST['max_score'];
$due = $_REQUEST['due'];
$school = $_SESSION['school'] ;
$code = $_SESSION['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];
$_SESSION['$title'] = $title;
print '<form method=get action="update_assignment.php">
		Assignment '.$title.':<br>
		Type:<br>
		<input type="text" name="type" value="'.$type.'" required><br>
		Max Score:<br>
		<input type="number" name="max_score" value="'.$max_score.'" required><br>
		Due date:<br>
		<input type="datetime-local" name="due" value="'.$due.'" required><br>
		<input type="submit" value="Update"></form>';

print'<a href= "course_info.php?code='.$code.'&school='.$school.'&type='.$type.'&title='.$title.'"><button>Cancel</button></a>';
?> 