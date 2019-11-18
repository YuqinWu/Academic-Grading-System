<?php
	session_start();
	if(!isset($_SESSION['email']))
		die('Direct access not permitted');
	else
	{
		if(isset($_SESSION['code']))
			unset($_SESSION['code']);
		$host = 'localhost';
		$username = 'yuqinwu';
		$password = '83995160';
		$database = 'yuqinDB';
		// Attempting to connect
		$dbcon = mysqli_connect($host, $username, $password, $database)
   			or die('Could not connect: ' . mysqli_connect_error());

   		$email = $_SESSION['email'];
   		$identity = $_SESSION['identity'];
   		$query = "CALL getEnrollment('$email', $identity);";
   		$result = mysqli_query($dbcon, $query)
   			or die('Query failed: ' . mysqli_error($dbcon));

   		print '<h2>Welcome! '.$_SESSION["name"].'<br>Your course(s):</h2>';
   		if (mysqli_num_rows($result)==0) {
   			print "<br><b>There is no course for you! Try adding one from below</b>";
   		}
   		else
   		{
   			//printing courses in HTML
	 		print '<ul>
	 				<table>
					<tr>
					<th> University Code </th>
	  				<th> Term </th>
	  				<th> Course Code </th> 
	  				<th> Section </th>
	  				<th> Name </th>
	  				<th> Action </th>
					</tr>';
	 		while ($tuple = mysqli_fetch_array($result)) {
	 			print '<tr><th>'.$tuple['school_code']. '</th>';
	 			print '<th>'.$tuple['term']. '</th>';
	 			print '<th>'.$tuple['code']. '</th>';
	 			print '<th>'.$tuple['section']. '</th>';
	 			print '<td><a href= "course_info.php?code='.$tuple['code'].'&school='.$tuple['school_code'].'">'.$tuple['name'].'</a></td>';
	 			print '<td><a href="remove_course.php?code='.$tuple['code'].'&school=' .$tuple['school_code'].'" onClick="return confirm(\'Are you sure you want to remove?\')"><button>Remove</button></a></td></tr>';
	 		}
	 		print '</table>';
   		}
		mysqli_free_result($result);
		mysqli_next_result($dbcon);
	}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html> 
<head>
<title>Grading System</title>
</head>

<body>
<hr>
<h3>Search courses to add</h3>
<a href="list_courses.php">List of all courses helps graders to add courses</a>
<br>
<form method=get action="search_course.php">
	University:<br>
	<select name="university">
	<?php 
		$uniResult = mysqli_query($dbcon, "SELECT school_code, name FROM University;");
		while ($tuple = mysqli_fetch_array($uniResult)){
			print "<option value=". $tuple['school_code']. ">" . $tuple['name'] . "</option>";
		}
	?>
	</select>
	<br>
	Term:<br>
	<select name="term">
	<?php 
		$result = mysqli_query($dbcon, "SELECT DISTINCT term FROM Term;");
		while ($tuple = mysqli_fetch_array($result)){
			print "<option value=". $tuple['term']. ">" . $tuple['term'] . "</option>";
		}
	?>
	</select>
	<br>
<input type="submit" value="Search">
</form>
<?php
if($identity == 0)
{
	mysqli_free_result($uniResult);
	mysqli_free_result($result);
	mysqli_next_result($dbcon);
	print '<hr><h3>Create new Course</h3>';
	print '<form method=get action="create_course.php">
	University:<br>
	<select name="school">';
		$uniResult = mysqli_query($dbcon, "SELECT school_code, name FROM University;");
		while ($tuple = mysqli_fetch_array($uniResult)){
			print "<option value=". $tuple['school_code']. ">" . $tuple['name'] . "</option>";
		}
	print '</select>
	<br>
	Term:<br>
	<select name="term">';
		$result = mysqli_query($dbcon, "SELECT DISTINCT term FROM Term;");
		while ($tuple = mysqli_fetch_array($result)){
			print "<option value=". $tuple['term']. ">" . $tuple['term'] . "</option>";
		}
	print '</select>
	<br>
		Course Name:<br>
		<input type="text" name="name" required><br>
		Course Code:<br>
		<input type="number" name="code" required><br>
		Section:<br>
		<input type="number" name="section" required><br>
		Website:(not required)<br>
		<input type="url" name="website"><br>
		<input type="submit" value="Create"></form>';
}
?>
<hr><a href='grading_system.php'>Log out</a>
</body>
</html>
<?php
mysqli_free_result($uniResult);
mysqli_free_result($result);
// Closing connection
mysqli_close($dbcon);
?>