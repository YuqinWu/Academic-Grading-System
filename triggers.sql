DROP TRIGGER IF EXISTS CheckGrade;
DELIMITER |
# Check if the grade is update is one of the acceptable characters.
CREATE TRIGGER CheckGrade
BEFORE UPDATE ON Enrollment
FOR EACH ROW	
	BEGIN	
		IF(NEW.final_grade <> 'A' AND NEW.final_grade <> 'B' AND NEW.final_grade <> 'C' AND NEW.final_grade <> 'D' AND NEW.final_grade <> 'F' AND NEW.final_grade <> 'N') THEN
			 SET NEW.final_grade = OLD.final_grade;
		END IF;
	END; |
DELIMITER ;

DROP TRIGGER IF EXISTS ScoreChangesTrigger;
DELIMITER |
#log all updates when a grader grade/change grade to an assignment.
CREATE Trigger ScoreChangesTrigger
AFTER UPDATE ON Submission
FOR EACH ROW
	BEGIN
		IF(NEW.score <> OLD.score) THEN
			INSERT IGNORE INTO ScoreGradedLog VALUES(NEW.student, NEW.course_code, NEW.school_code, NEW.assignment_title, NEW.score, CURRENT_USER(), NOW());
		END IF;
END; |
DELIMITER ;

DROP TRIGGER IF EXISTS CheckTerm;
DELIMITER |
# Check if the term adding is the legal term format.
CREATE TRIGGER CheckTerm
BEFORE INSERT ON Term
FOR EACH ROW	
	BEGIN	
		IF(NEW.term NOT LIKE 'FA__' AND NEW.term NOT LIKE 'WI__' AND NEW.term NOT LIKE 'SP__' AND NEW.term NOT LIKE 'SU__') THEN
			 SET NEW.term = NULL;
		END IF;
	END; |
DELIMITER ;