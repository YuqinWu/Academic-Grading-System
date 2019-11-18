<?php
session_start();
if(!isset($_SESSION['email']))
	die('Direct access not permitted');

// Connection parameters 
$host = 'localhost';
$username = 'yuqinwu';
$password = '83995160';
$database = 'yuqinDB';

// Attempting to connect
$dbcon = mysqli_connect($host, $username, $password, $database)
   or die('Could not connect: ' . mysqli_connect_error());

// Getting the input parameter:
$school = $_GET['school'];
$code = $_GET['code'];
str_replace("'", "", $school);
str_replace("'", "", $code);
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];
$_SESSION['school'] = $school;
$_SESSION['code'] = $code;
$query = "CALL getAssignments($code, $school);";

$result = mysqli_query($dbcon, $query)
  or die('Query failed: ' . mysqli_error($dbcon));

print "<h2>Assignment(s) for course $code:</h2>";
if (mysqli_num_rows($result)==0) {
	print "<br><b>There is no assignment for this course!</b>";
}
else{
	//printing courses in HTML
	print '<ul>
		<table>
		<tr>
		<th> Title </th>
		<th> Type </th>
		<th> Max Score </th> 
		<th> Due </th>
		</tr>';
	while ($tuple = mysqli_fetch_array($result)) 
	{
		print '<tr><td><a href= "submission.php?title='.$tuple['title'].'">'.$tuple['title'].'</a></td>';
		print '<th>'.$tuple['type']. '</th>';
		print '<th>'.$tuple['maximum_score']. '</th>';
		print '<th>'.$tuple['due_date']. '</th>';
		if($identity == 0)
		{
			print '<td><a href="edit_assignment.php?code='.$tuple['code'].'&school='.$tuple['school_code'].'&title='.$tuple['title'].'&type='.$tuple['type'].'&max_score='.$tuple['maximum_score'].'&due='.$tuple['due_date'].'"><button>Edit</button></a></td>';
			print '<td><a href="remove_assignment.php?title='.$tuple['title'].'" onClick="return confirm(\'Are you sure you want to remove?\')"><button>Remove</button></a></td>';
		}
		print '</tr>';
	}
	print '</table>';
}

if($identity == 0)
{
	print '<hr>You can add a new assignment below:(all fields required)';
	print '<form method=get action="add_assignment.php">
				Assignment Title:<br>
				<input type="text" name="title" required><br>
				Assignment Type:<br>
				<select name="type">
				    <option value = "performance">performance</option>
    				<option value = "assignment">assignment</option>
    				<option value = "exam">exam</option>
    				<option value = "quiz">quiz</option>
    				<option value = "presentation">presentation</option>
    				<option value = "other">other</option>
				</select><br>
				Max Score:<br>
				<input type="number" name="max_score" required><br>
				Due Date:<br>
				<input type="datetime-local" name="due" required><br>
				<input type="submit" value="Add"></form>';
}
// Printing courses in HTML
print'<hr>Back to <a href="profile.php">Profile</a>';
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 