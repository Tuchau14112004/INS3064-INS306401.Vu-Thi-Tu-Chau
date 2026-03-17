# Session 06 – Database Design

## Part 1: Normalization

# Database Design Exercises

## Part 1: Normalization

### Task 1 — Identify Violations

From the **Student_Grades_Raw** table:

| Issue | Explanation |
|------|-------------|
| Redundant Columns | StudentName, CourseName, ProfessorName, ProfessorEmail appear multiple times for the same IDs |
| Update Anomaly | If a professor changes their email, it must be updated in many rows |
| Update Anomaly | If a course name changes, multiple rows must be edited |
| Transitive Dependency | ProfessorEmail depends on ProfessorName rather than the primary key |
| Data Redundancy | Course and professor information repeat for each student enrollment |

---

### Task 2 — Decompose to 3NF

The data is decomposed into four tables to remove redundancy and ensure **Third Normal Form (3NF)**.

| Table Name | Primary Key | Foreign Key | Normal Form | Description |
| :--- | :--- | :--- | :--- | :--- |
| Students | student_id | None | 3NF | Stores student information |
| Courses | course_id | professor_id | 3NF | Stores course details and the professor teaching the course |
| Professors | professor_id | None | 3NF | Stores professor information including email |
| Enrollments | enrollment_id | student_id, course_id | 3NF | Links students to courses and stores their grade |

---

### Schema Design

| Table | Primary Key | Foreign Key(s) | Non-key Columns |
|------|-------------|---------------|----------------|
| Students | student_id | None | student_name |
| Courses | course_id | professor_id | course_name |
| Professors | professor_id | None | professor_name, professor_email |
| Enrollments | enrollment_id | student_id, course_id | grade |

---

### SQL Implementation

```sql
CREATE TABLE Students (
    student_id INT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL
);

CREATE TABLE Professors (
    professor_id INT PRIMARY KEY AUTO_INCREMENT,
    professor_name VARCHAR(100) NOT NULL,
    professor_email VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE Courses (
    course_id INT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES Professors(professor_id)
);

CREATE TABLE Enrollments (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    course_id INT,
    grade VARCHAR(5),
    FOREIGN KEY (student_id) REFERENCES Students(student_id),
    FOREIGN KEY (course_id) REFERENCES Courses(course_id)
);

## Part 2: Relationships

Author — Book  
Relationship Type: **One-to-Many (1:N)**  
FK Location: **book.author_id**

Citizen — Passport  
Relationship Type: **One-to-One (1:1)**  
FK Location: **passport.citizen_id**

Customer — Order  
Relationship Type: **One-to-Many (1:N)**  
FK Location: **orders.customer_id**

Student — Class  
Relationship Type: **Many-to-Many (N:N)**  
FK Location: **student_classes junction table**

Team — Player  
Relationship Type: **One-to-Many (1:N)**  
FK Location: **players.team_id**
