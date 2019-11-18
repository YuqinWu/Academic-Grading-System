<?php

// Connection parameters 
$host = 'localhost';
$username = 'yuqinwu';
$password = '83995160';
$database = 'yuqinDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());
print 'Connected successfully!<br>';

// Getting the input parameters:
$school = $_REQUEST['school_code'];
$course = $_REQUEST['course_code'];

// Get the attributes of the user with the given username
$query = "SELECT c.name, s.title, s.type, s.maximum_score, s.due_date
FROM Assignment s, Course c
WHERE s.school_code = '$school' AND s.course_code = '$course' AND s.course_code = c.code AND s.school_code = c.school_code;";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "the course <b>$course</b> in this school <b>$school</b> has the following assignment(s):";

if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no result!</b>";
}
// Printing courses in HTML
print '<ul>';
while ($tuple = mysqli_fetch_array($result)) {
	print '<li> Course: '.$tuple['name'];
	print '<br> Assignment: '.$tuple['title'];
	print '<br>Type: '.$tuple['type'];
	print '<br> Maximum Score: '.$tuple['maximum_score'];
	print '<br><b> Due: '.$tuple['due_date'].'</b></li><br>';
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 