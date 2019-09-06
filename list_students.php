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

// Listing tables in your database
$query = 'SELECT * FROM Student;';
$result = mysqli_query($dbcon, $query)
  or die('Show tables failed: ' . mysqli_error());

print "The registered students in $database database are:<br>";
if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no result!</b>";
}
// Printing table names in HTML
print '<ul>';
while ($tuple = mysqli_fetch_row($result)) {
   print '<li>Student Name: '.$tuple[1];
   print '<br>Email: '.$tuple[0].'<br></li>';
}
print '</ul>';

// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>