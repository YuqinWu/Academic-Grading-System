DROP TABLE IF EXISTS University;
CREATE TABLE University (
	school_code INT,
	name VARCHAR(50),
	PRIMARY KEY (school_code)
);

DROP TABLE IF EXISTS Professor;
CREATE TABLE Professor (
	email VARCHAR(50),
	name VARCHAR(50),
	PRIMARY KEY (email)
);

DROP TABLE IF EXISTS Student;
CREATE TABLE Student (
	email VARCHAR(50),
	name VARCHAR(50),
	PRIMARY KEY (email)
);

DROP TABLE IF EXISTS Term;
CREATE TABLE Term (
    term CHAR(4),
	school_code INT,
    start_time DATETIME,
    end_time DATETIME,
    FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
    PRIMARY KEY (term, school_code)
);

DROP TABLE IF EXISTS Website;
CREATE TABLE Website (
	address VARCHAR(50),
    syllabus VARCHAR(50),
	announcement VARCHAR(500),
	PRIMARY KEY (address)
);

DROP TABLE IF EXISTS Course;
CREATE TABLE Course (
	code INT,
    school_code INT,
    term CHAR(4),
    section INT,
	name VARCHAR(50),
    professor VARCHAR(50),
    website VARCHAR(50),
    FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
    FOREIGN KEY (term) REFERENCES Term(term) ON DELETE CASCADE,
	FOREIGN KEY (professor) REFERENCES Professor(email) ON DELETE SET NULL,
    FOREIGN KEY (website) REFERENCES Website(address) ON DELETE SET NULL,
	PRIMARY KEY (code, school_code)
);

DROP TABLE IF EXISTS Enrollment;
CREATE TABLE Enrollment (
	student VARCHAR(50),
    course_code INT,
    school_code INT,
	final_grade CHAR(1),
    FOREIGN KEY (student) REFERENCES Student(email) ON DELETE CASCADE,
    FOREIGN KEY (course_code) REFERENCES Course(code) ON DELETE CASCADE,
	FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
	PRIMARY KEY (student, course_code, school_code)
);

DROP TABLE IF EXISTS Material;
CREATE TABLE Material (
	title VARCHAR(50),
	course_code INT,
    school_code INT,
    type VARCHAR(50),
	FOREIGN KEY (course_code) REFERENCES Course(code) ON DELETE CASCADE,
	FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
	PRIMARY KEY (title, course_code, school_code)
);



DROP TABLE IF EXISTS Assignment;
CREATE TABLE Assignment (
	title VARCHAR(50),
    type VARCHAR(50),
    course_code INT,
    school_code INT,
	maximum_score INT,
    due_date DATETIME,
	FOREIGN KEY (course_code) REFERENCES Course(code) ON DELETE CASCADE,
	FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
	PRIMARY KEY (title, course_code, school_code)
);

DROP TABLE IF EXISTS Submission;
CREATE TABLE Submission (
	student VARCHAR(50),
	assignment_title VARCHAR(50),
    course_code INT,
    school_code INT,
    submitted_time DATETIME,
    graded INT,
	score FLOAT,
	FOREIGN KEY (student) REFERENCES Student(email) ON DELETE CASCADE,
    FOREIGN KEY (assignment_title) REFERENCES Assignment(title) ON DELETE CASCADE,
    FOREIGN KEY (course_code) REFERENCES Course(code) ON DELETE CASCADE,
	FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
	PRIMARY KEY (student, assignment_title, course_code, school_code)
);

DROP TABLE IF EXISTS ScoreGradedLog;
CREATE TABLE ScoreGradedLog (
	student VARCHAR(50),
    course_code INT,
    school_code INT,
	assignment_title VARCHAR(50),
    score FLOAT,
    grader VARCHAR(50),
    log_time DATETIME,
	FOREIGN KEY (student) REFERENCES Student(email) ON DELETE CASCADE,
    FOREIGN KEY (assignment_title) REFERENCES Assignment(title) ON DELETE CASCADE,
    FOREIGN KEY (course_code) REFERENCES Course(code) ON DELETE CASCADE,
	FOREIGN KEY (school_code) REFERENCES University(school_code) ON DELETE CASCADE,
	PRIMARY KEY (student, course_code, school_code, assignment_title, grader, log_time)
);

DROP TABLE IF EXISTS Users;
CREATE TABLE Users (
	email VARCHAR(50),
    name VARCHAR(50),
    password VARCHAR(50),
    type INT,
	PRIMARY KEY (email)
);