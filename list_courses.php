<?php

// Connection parameters 
$host = 'mpcs53001.cs.uchicago.edu';
$username = 'yuqinwu';
$password = '83995160';
$database = $username.'DB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter:
$school = $_REQUEST['school_code'];

// Get the attributes of the user with the given username
$query = "SELECT s.name, s.school_code, c.term, c.name, c.code
FROM Course c, University s
WHERE c.school_code = s.school_code;";

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "We have the following course(s):";
if (mysqli_num_rows($result)==0) {
        print "<br><b>There is no result!</b>";
}
// Printing courses in HTML
print '<ul>
		<table>
		<tr>
			<th> University Name </th>
			<th> University Code </th>
			<th> Term </th>
			<th> Course Name </th> 
			<th> Course Code </th>
		</tr>';
while ($tuple = mysqli_fetch_array($result)) {
        print '<tr><th>'.$tuple[0].'</th>';
	 	print '<td>'.$tuple[1].'</td>';
	 	print '<th>'.$tuple[2].'</th>';
	 	print '<td>'.$tuple[3].'</td>';
	 	print '<td>'.$tuple[4]. '</td></tr>';
}
print '</table></ul>';

print'<br><a href="profile.php">Profile</a>';
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?>
