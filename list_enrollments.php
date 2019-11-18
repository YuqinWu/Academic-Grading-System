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
$query = "SELECT s.name, s.email
FROM Course c, Enrollment e, Student s
Where c.school_code = '$school' AND c.code = '$course' AND c.school_code = e.school_code AND c.code = e.course_code AND e.student = s.email;";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "course <b>$course</b> in school <b>$school</b> has the following student(s):";
if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no result!</b>";
}
// Printing courses in HTML
print '<ul>';
while ($tuple = mysqli_fetch_array($result)) {
	print '<li> Name: '.$tuple['name'];
	print '<br> Email: '.$tuple['email'].'</li><br>';
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 