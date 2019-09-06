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

// Getting the input parameter:
$email = $_REQUEST['email'];

// Get the attributes of the user with the given username
$query = "SELECT c.name, c.code
FROM Enrollment e, Course c
WHERE e.student = '$email' AND e.course_code = c.code AND e.school_code = c.school_code";
$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "student <b>$email</b> has the following course(s):";
if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no result!</b>";
}
// Printing courses in HTML
print '<ul>';
while ($tuple = mysqli_fetch_array($result)) {
	print '<li> Code: '.$tuple['code'];
	print '<br> Name: '.$tuple['name'].'</li><br>';
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 