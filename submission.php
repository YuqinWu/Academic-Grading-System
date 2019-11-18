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
$title = $_GET['title'];
$school = $_SESSION['school'];
$code = $_SESSION['code'];
$email = $_SESSION['email'];
$identity = $_SESSION['identity'];
$_SESSION['title'] = $title;


print "<h2>Submission(s) for Assignment $title:</h2>";
if($identity == 0)
{
	$query = "CALL getSubmissions('$code', '$school', '$title');";
	$result = mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	if (mysqli_num_rows($result)==0) {
		print "<br><b>There is no submission!</b>";
	}
	else
	{
		//printing courses in HTML
		print '<ul>
				<table>
				<tr>
				<th> Student </th>
				<th> Title </th>
				<th> Submission Time </th>
				<th> Score </th> 
				<th> Graded </th>
				</tr>';
		while ($tuple = mysqli_fetch_array($result)) 
		{
			print '<tr><th>'.$tuple['student']. '</th>';
			print '<th>'.$tuple['assignment_title']. '</th>';
			print '<th>'.$tuple['submitted_time']. '</th>';
			print '<th>'.$tuple['score']. '</th>';
			print ($tuple['graded'] == 1)? '<th>Yes</th>':'<th>No</th>';
			if($identity == 0)
			{
				print '<td><a href="grade_submission.php?student='.$tuple['student'].'">Grade</a></td>';
			}
			print '</tr>';
		}
	}
	print '</table>';
}
else
{
	$query = "CALL getMySubmissions('$email', '$code', '$school', '$title');";

	$result = mysqli_query($dbcon, $query)
  		or die('Query failed: ' . mysqli_error($dbcon));

	if (mysqli_num_rows($result)==0) {
		print "<br><b>There is no submission!</b>";
	}
	else
	{
		//printing courses in HTML
		print '<ul>
				<table>
				<tr>
				<th> Title </th>
				<th> Submission Time </th>
				<th> Score </th> 
				<th> Graded </th>
				</tr>';
		while ($tuple = mysqli_fetch_array($result)) 
		{
			print '<tr><th>'.$tuple['assignment_title']. '</th>';
			print '<th>'.$tuple['submitted_time']. '</th>';
			print '<th><b>'.$tuple['score']. '</b></th>';
			print ($tuple['graded'] == 1)? '<th>Yes</th>':'<th>No</th>';
			print '</tr>';
		}
		print '</table>';
	}
	print '<br>Click Submit button to submit one submission:';
	print '<td><a href= "add_submission.php?title='.$title.'"><button>Submit</button></a></td><br>';
}

// Printing courses in HTML
print '<hr><a href= "course_info.php?code='.$code.'&school='.$school.'"><button>Back</button></a>';
print'<br><a href="profile.php">Profile</a>';
// Free result
mysqli_free_result($result);

// Closing connection
mysqli_close($dbcon);
?> 