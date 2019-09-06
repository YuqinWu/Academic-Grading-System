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
$query = "SELECT c.name, c.code, u.name AS school
FROM Course c, University u 
WHERE c.professor = '$email' AND u.school_code = c.school_code;";

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "courses taught by <b>$email</b> has the following:";
if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no result!</b>";
}
// Printing courses in HTML
print '<ul>';
while ($tuple = mysqli_fetch_array($result)) {
	print '<li> Name: '.$tuple['name'];
	print '<br> Code: '.$tuple['code'];
	print '<br> School: '.$tuple['school'].'</li><br>';
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 