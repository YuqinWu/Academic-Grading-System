LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/university.dat"
REPLACE INTO TABLE University
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(school_code, name);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/professor.dat"
REPLACE INTO TABLE Professor
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(email, name);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/student.dat"
REPLACE INTO TABLE Student
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(email, name);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/term.dat"
REPLACE INTO TABLE Term
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(term, school_code, start_time, end_time);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/website.dat"
REPLACE INTO TABLE Website
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(address, syllabus, announcement);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/course.dat"
REPLACE INTO TABLE Course
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(code, school_code, term, section, name, professor, website);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/enrollment.dat"
REPLACE INTO TABLE Enrollment
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(student, course_code, school_code, final_grade);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/material.dat"
REPLACE INTO TABLE Material
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(title, course_code, school_code, type);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/assignment.dat"
REPLACE INTO TABLE Assignment
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(title, type, course_code, school_code, maximum_score, due_date);

LOAD DATA LOCAL INFILE "/Users/seven/Documents/Seven/UChicago/CS53001-Database/hw8/data/submission.dat"
REPLACE INTO TABLE Submission
FIELDS TERMINATED BY '|'
LINES TERMINATED BY '\n'
(student, assignment_title, course_code, school_code, submitted_time, graded, score);