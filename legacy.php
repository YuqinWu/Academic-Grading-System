
<form method=get action="add_course.php">
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
<input type="submit" value="Add">
</form>


2. a link to a php script (<tt>list_students.php</tt>) that list all students in my database, in order for user to look up:
<p>
<a href="list_students.php">List of students</a>
<hr>
3. a link to a php script (<tt>list_professors.php</tt>) that list all professors in my database, in order for user to look up:
<p>
<a href="list_professors.php">List of professors</a>
<hr>

4. a form to get all courses given a university code.  The script that runs when you press the <it>Submit</it> button is (<tt>list_courses.php<tt>). Please note down the course code you are going to look deeper.
<p>

<form method=get action="list_courses.php">
Enter school <b>code</b>:(you can look up from above link)<br>
<input type="text" name="school_code"><BR>
<input type="submit" value="Submit">
</form>

<hr>
<p>
5. Now you are able to see more information about the student and course information (<tt>list_enrollments.php</tt>) First we can get all students enrolling into this course
</p>
<form method=get action="list_enrollments.php">
Enter school <b>code</b>:<br>
<input type="text" name="school_code"><BR>
Enter course <b>code</b>:<br>
<input type="text" name="course_code"><BR>
<input type="submit" value="Submit">
</form>

<hr>
6. Conversely, you can find out what class(es) a student takes by providing the student's email. The script that runs when you press the <it>Submit</it> button is (<tt>check_enrollment.php<tt>).
<p>

Enter the student's email to find the enrollment (you can look up from above link)<br>
<form method=get action="check_enrollment.php">
<input type="text" name="email"><BR>
<input type="submit" value="Submit">
</form>
<hr>

7. You can also find out what class a professor is taking by providing the professor's email. The script that runs when you press the <it>Submit</it> button is (<tt>teaching.php<tt>).
<p>

Enter the professor's email to find the course teaching (you can look up from above link)<br>
<form method=get action="teaching.php">
<input type="text" name="email"><BR>
<input type="submit" value="Submit">
</form>
<hr>

8. now we can find all available assignments for a given course. The script that runs when you press the <it>Submit</it> button is (<tt>find_assignment.php<tt>).
<p>

Enter the student's email and course code to find the assignment(s) (you can look up from above form)<br>
<form method=get action="find_assignment.php">
Enter school <b>code</b>:<br>
<input type="text" name="school_code"><BR>
Enter course <b>code</b>:<br>
<input type="text" name="course_code"><BR>
<input type="submit" value="Submit">
</form>
<hr>

9. now we can find all submissions a student submitted for a given course. The script that runs when you press the <it>Submit</it> button is (<tt>find_submission.php<tt>).
<p>

Enter the student's email and course code to find the submission(s) (you can look up from above form)<br>
<form method=get action="find_submission.php">
Enter email:<br>
<input type="text" name="email"><BR>
Enter course <b>code</b>:<br>
<input type="text" name="course_code"><BR>
<input type="submit" value="Submit">
</form>