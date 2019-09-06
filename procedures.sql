
#1. add an enrollment of a student into the enrollment table, also set the final_grade to default 'N'.
DROP PROCEDURE IF EXISTS addEnrollment;
DELIMITER |
CREATE PROCEDURE addEnrollment(	
	IN addemail		VARCHAR(50),    
	IN addCourse_code 		INT,	
	IN addSchool_code 		INT,
    IN type								INT)
BEGIN
	IF(type = 0) THEN
		UPDATE Course
		SET professor = addemail
		WHERE school_code = addSchool_code
		AND code = addCourse_code;
	ELSE
		INSERT INTO Enrollment (student, course_code, school_code, final_grade)
		VALUES(addemail, addCourse_code, addSchool_code,  'N');
	END IF;
END; |
DELIMITER ;

#2. For each enrollment, translating to the human understandable information.
DROP PROCEDURE IF EXISTS findAllNames;
DELIMITER |
CREATE PROCEDURE findAllNames(
	IN student 		VARCHAR(50),    
	IN course 		INT,
    IN school 		INT)
BEGIN
	SELECT s.name, c.name,  u.name
	FROM Student s, University u, Course c	
	WHERE s.email = student
	AND u.school_code = school
    AND c.code = course;
END |
DELIMITER ;


#3. Procedure to change a student's grade for a certain course.
DROP PROCEDURE IF EXISTS setFinalGrade;
DELIMITER |
CREATE PROCEDURE setFinalGrade(
	IN student 		VARCHAR(50),    
	IN course 		INT,
    IN school 		INT,
    IN grade			CHAR(1))
BEGIN
	UPDATE Enrollment
	SET final_grade = grade
	WHERE student = student
	AND school_code = school
    AND course_code = course;
END |
DELIMITER ;

DROP PROCEDURE IF EXISTS Signup;
DELIMITER |
CREATE PROCEDURE Signup(
	IN email 				VARCHAR(50),  
    IN name 				VARCHAR(50), 	
	IN password 		VARCHAR(50),
    IN type					INT)
BEGIN	
	INSERT INTO Users (email, name, password, type)
	VALUES(email, name, password, type);
	IF(type = 0) THEN
			INSERT INTO Professor VALUES(email, name);
        ELSE
			INSERT INTO Student VALUES(email, name);
	END IF;
END; |
DELIMITER ;

DROP PROCEDURE IF EXISTS checkEmail;
DELIMITER |
CREATE PROCEDURE checkEmail(	
	IN in_email 				VARCHAR(50))
BEGIN	
	SELECT email, name, password, type
	FROM Users
	WHERE email = in_email;
END; |
DELIMITER ;

DROP PROCEDURE IF EXISTS getEnrollment;
DELIMITER |
CREATE PROCEDURE getEnrollment(	
	IN in_email 				VARCHAR(50),
    IN identity 				INT)
BEGIN
	IF(identity = 0) THEN
		SELECT term, code,  school_code, section, name
		FROM Course
		WHERE professor = in_email;
	ELSE
		SELECT c.term, c.code, c.school_code, c.section, c.name
		FROM Enrollment e, Course c
		WHERE e.student = in_email AND e.course_code = c.code AND e.school_code = c.school_code;
	END IF;
END; |
DELIMITER ;

DROP PROCEDURE IF EXISTS getAssignments;
DELIMITER |
CREATE PROCEDURE getAssignments(	
	IN course			 		INT,
    IN school			 		INT)
BEGIN
		SELECT title, type, maximum_score, due_date
		FROM Assignment
		WHERE course_code = course AND school_code = school;
END; |
DELIMITER ;

DROP PROCEDURE IF EXISTS getSubmissions;
DELIMITER |
CREATE PROCEDURE getSubmissions(	
	IN course			INT,
    IN school			INT,
    IN in_title			VARCHAR(50))
BEGIN
		SELECT student, assignment_title, submitted_time, graded, score
		FROM Submission
		WHERE course_code = course AND school_code = school AND assignment_title = in_title;
END; |
DELIMITER ;

DROP PROCEDURE IF EXISTS getMySubmissions;
DELIMITER |
CREATE PROCEDURE getMySubmissions(
	IN in_email		VARCHAR(50),
	IN course			INT,
    IN school			INT,
    IN in_title			VARCHAR(50))
BEGIN
		SELECT assignment_title, submitted_time, graded, score
		FROM Submission
		WHERE student = in_email AND
        course_code = course AND 
        school_code = school AND
        assignment_title = in_title;
END; |
DELIMITER ;

DROP PROCEDURE IF EXISTS addSubmission;
DELIMITER |
CREATE PROCEDURE addSubmission(
	IN email		VARCHAR(50),
	IN school			INT,
    IN course			INT,
    IN title			VARCHAR(50))
BEGIN
		DELETE IGNORE FROM Submission
        WHERE student = email
        AND assignment_title = title
        AND type = in_type
        AND course_code = course
        AND school_code = school;
		INSERT INTO Submission VALUES(email, title, course, school, CURRENT_TIMESTAMP(), 0,0);
END; |
DELIMITER ;