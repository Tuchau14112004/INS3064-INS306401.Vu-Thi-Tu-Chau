# Session 06 – Database Design

## Part 1: Normalization

Original Table: Student_Grades_Raw

| StudentID | StudentName | CourseID | CourseName | ProfessorName | ProfessorEmail | Grade |
|-----------|-------------|----------|------------|---------------|----------------|-------|
| 1 | Nguyen An | 101 | Database Systems | Dr. Le | le@uni.edu | A |
| 1 | Nguyen An | 102 | Web Development | Dr. Tran | tran@uni.edu | B+ |
| 2 | Tran Binh | 101 | Database Systems | Dr. Le | le@uni.edu | A- |

### Final Schema (3NF)

| Table Name | Primary Key | Foreign Key | Description |
|------------|-------------|-------------|-------------|
| students | student_id | None | Stores student info |
| professors | professor_id | None | Stores professor info |
| courses | course_id | professor_id | Stores course information |
| enrollments | id | student_id, course_id | Stores grades |

---

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
