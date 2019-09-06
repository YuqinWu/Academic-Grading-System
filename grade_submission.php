<?php
session_start();
if(!isset($_SESSION['email']))
	die('Direct access not permitted');

// Getting the input parameter:
$student = $_GET['student'];
$title = $_SESSION['title'];
$school = $_SESSION['school'] ;
$code = $_SESSION['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];
$_SESSION['student'] = $student;
print '<form method=get action="update_grade.php">
		Submission '.$title.' from '.$student.':<br>
		Score:<br>
		<input type="number" name="score" required><br>
		<input type="submit" value="Submit"></form>';

print'<br>Back to <a href= "submission.php?title='.$title.'">'.$title.'</a>';
?> 