<?php

// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'yuqinwu';
$password = '83995160';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Getting the input parameters:
$email = $_REQUEST['email'];
$course = $_REQUEST['course_code'];

// Get the attributes of the user with the given username
$query = "SELECT c.name, s.assignment_title, s.type, s.graded, s.score
FROM Submission s, Course c
WHERE s.course_code = '$course' AND s.course_code = c.code AND s.student = '$email' ;";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no result!</b>";
}

print "Student <b>$email</b> in this course <b>$course</b> has the following submission(s):";

// Printing courses in HTML
print '<ul>';
while ($tuple = mysqli_fetch_array($result)) {
	print '<li> Course: '.$tuple['name'];
	print '<br> Assignment: '.$tuple['assignment_title'];
	print '<br>Type: '.$tuple['type'];
	print '<br> Is graded?: '.$tuple['graded'];
	print '<br><b> Score: '.$tuple['score'].'</b></li><br>';
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 