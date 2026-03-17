# Session 06 - Database Design

## Part 1: Normalization

Raw table: Student_Grades_Raw

| Table Name | Primary Key | Foreign Key | Normal Form | Description |
|-------------|-------------|-------------|-------------|-------------|
| students | student_id | None | 3NF | Stores student information |
| courses | course_id | None | 3NF | Stores course information |
| professors | professor_id | None | 3NF | Stores professor information |
| enrollments | id | student_id, course_id | 3NF | Stores student grades in courses |

Explanation:

The original table contained redundant data:
- StudentName depends only on StudentID
- CourseName depends only on CourseID
- ProfessorEmail depends on ProfessorName

To achieve 3NF, the data is separated into four tables:
Students, Courses, Professors, and Enrollments.
## Part 2: Relationships

1. Author — Book  
Relationship Type: One-to-Many (1:N)  
FK Location: book.author_id

2. Citizen — Passport  
Relationship Type: One-to-One (1:1)  
FK Location: passport.citizen_id

3. Customer — Order  
Relationship Type: One-to-Many (1:N)  
FK Location: orders.customer_id

4. Student — Class  
Relationship Type: Many-to-Many (N:N)  
FK Location: student_classes (junction table)

5. Team — Player  
Relationship Type: One-to-Many (1:N)  
FK Location: players.team_id
