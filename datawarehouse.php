<?php
print'
<title>Data Warehouse</title>
<h1>Data Warehouse</h1>
There are two strong aspects at we can analyze in the view of data warehousing.
First of all, we need to assume two things: There are huge amount of data available, which means there are tons of professors, students, courses, assignments, and submissions in my database for us to analyze. We also need to assume there are actual submitted files(though it has not implemented so far) stored in my database. 
<br>
With these information, we can analyze the trend of performace of students over times, using the <b>submission, assignment, and course table</b>. We may horizontally conclude which schools generally gives higher grades while which schools are really strict on grades. We may also vertically analyze, while time elapses, whether the grades from a specific school inflated or deflated, and how the trend is.
<br>
Besides that, We can also use the data of each submission in <b>submission table</b>, doing image and letter recognition, which can later be used for Auto-grading ---- a new tecnique that is going to be implemented in next phase. The data of each submission can be feed into many Machine Learning algorithms, to generate a model, so as to help server recognize and categorize submission into groups, and therefore helps grader for easier grading. Besides that, it can also be used to learn patterns set up by the grader, so as to automatically grade submissions.
<hr>
<a href="grading_system.php">Back</a>
';
?> 