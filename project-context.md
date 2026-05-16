# DEPED Region V - Recruitment Management System

## Project Overview
- **Type**: Web Application (Laravel/PHP)
- **Purpose**: Online recruitment and selection management system for DEPED Region V Regional Office
- **Team**: Solo developer

---

## User Roles

| Role | Description |
|------|-------------|
| Applicant | Job seekers who register and apply |
| HR | Human Resources staff who manage postings and evaluate applicants |
| Board | Evaluation board for final scoring (later phase) |
| Admin | System administrator |

---

## Application Flow

### Public (No Login Required)
1. **Main Page** - System showcase, available jobs preview
2. **Job Listings** - View all open positions with filters/pagination

### Registration (Option C - Hybrid)
1. Basic registration - email, password, name only
2. First time applying to a job:
   - Show inline form with applicant_profile fields (personal info, address, etc.)
   - Also show the 4 sectors (Education, Training, Experience, Eligibility) + extra docs
   - After submit → Save to `applicant_profiles` table
3. Subsequent applications:
   - Profile fields auto-filled from database
   - Just fill/update the 4 sectors + documents

### Application Flow
1. Browse jobs → Click "Apply"
2. Complete profile (if needed - first time)
3. Fill 4 sectors: Education, Training, Experience, Eligibility (each with file upload)
4. Upload extra requirements via document_types
5. Submit → Get application_code ({position_code}-{year}-{sequence})

### HR Flow
1. Create job posting from plantilla_positions
2. Set: department → position (filtered), salary, deadline, requirements
3. Upload job description PDF
4. Set qualification standards (education, training, experience, eligibility)
5. Review applications → Per-sector evaluation (sector_evaluations)
6. Set overall status (qualified/disqualified)
7. IER page - select position → list all applicants → print (with hidden sensitive data)

---

## Database Schema

### 1. users
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| first_name | varchar(100) | |
| middle_name | varchar(100) | nullable |
| last_name | varchar(100) | |
| extension_name | varchar(10) | nullable |
| email | varchar | unique |
| password | varchar | |
| role | enum | applicant, hr, board, admin |
| status | enum | pending, active, inactive, suspended |
| remember_token | varchar | nullable |
| created_at, updated_at | timestamp | |

### 2. applicant_profiles
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| user_id | bigint | FK → users |
| date_of_birth | date | nullable (compute age) |
| gender | enum | male, female |
| civil_status | enum | Single, Married, Widowed, Separated, Annulled |
| citizenship | varchar(100) | nullable |
| religion | varchar(100) | nullable |
| ethnicity | varchar(100) | nullable |
| contact_number | varchar(20) | nullable |
| is_person_with_disability | boolean | default false |
| is_solo_parent | boolean | default false |
| is_member_of_indigenous_people | boolean | default false |
| region | varchar(100) | nullable |
| province | varchar(100) | nullable |
| city | varchar(100) | nullable |
| municipality | varchar(100) | nullable |
| barangay | varchar(100) | nullable |
| zip_code | varchar(20) | nullable |
| current_address | text | nullable |
| avatar_path | varchar(500) | nullable |
| created_at, updated_at | timestamp | |

### 3. plantilla_positions
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| department | varchar(150) | |
| position_name | varchar(200) | |
| position_code | varchar(50) | |
| plantilla_item_no | varchar(100) | unique |
| salary_grade | int | |
| is_active | boolean | default true |
| created_at, updated_at | timestamp | |

### 4. eligibility_types
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| name | varchar(255) | LET, CSE Professional, CSE Subprofessional, RA 1080, Other |
| is_active | boolean | default true |
| created_at, updated_at | timestamp | |

### 5. job_postings
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| plantilla_position_id | bigint | FK → plantilla_positions |
| monthly_salary | decimal(12,2) | HR manually input |
| description | text | nullable |
| required_education | varchar(255) | nullable |
| required_training | varchar(255) | nullable |
| required_experience | varchar(255) | nullable |
| required_eligibility | varchar(255) | nullable |
| requirements | json | nullable |
| deadline | datetime | |
| job_description_pdf | varchar(500) | nullable |
| status | enum | draft, open, closed |
| posted_at | datetime | nullable |
| created_at, updated_at | timestamp | |

### 6. applications
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_code | varchar(20) | unique ({position_code}-{year}-{sequence}) |
| user_id | bigint | FK → users |
| job_id | bigint | FK → job_postings |
| status | enum | pending, qualified, disqualified |
| hr_notes | text | nullable |
| reviewed_by | bigint | FK → users |
| reviewed_at | datetime | nullable |
| created_at, updated_at | timestamp | |

### 7. applicant_education
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_id | bigint | FK → applications |
| level | varchar(100) | Bachelors, Masters, Doctorate |
| school_name | varchar(255) | |
| course | varchar(255) | nullable |
| units_completed | varchar(100) | nullable |
| year_graduated | year | nullable |
| file_path | varchar(500) | nullable |
| created_at, updated_at | timestamp | |

### 8. applicant_trainings
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_id | bigint | FK → applications |
| training_title | varchar(255) | |
| training_hours | int | nullable |
| date_conducted | date | nullable |
| file_path | varchar(500) | nullable |
| created_at, updated_at | timestamp | |

### 9. applicant_experience
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_id | bigint | FK → applications |
| employer | varchar(255) | |
| position | varchar(255) | |
| start_date | date | |
| end_date | date | nullable |
| is_present | boolean | default false |
| sector | varchar(100) | nullable |
| total_exp_years | decimal(5,2) | nullable |
| file_path | varchar(500) | nullable |
| created_at, updated_at | timestamp | |

### 10. applicant_eligibility
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_id | bigint | FK → applications |
| eligibility_type_id | bigint | FK → eligibility_types |
| other_name | varchar(255) | nullable |
| license_no | varchar(100) | nullable |
| date_issued | date | nullable |
| file_path | varchar(500) | nullable |
| created_at, updated_at | timestamp | |

### 11. document_types
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| name | varchar(255) | CRUD by HR |
| is_required | boolean | default true |
| is_active | boolean | default true |
| created_at, updated_at | timestamp | |

### 12. application_documents
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_id | bigint | FK → applications |
| document_type_id | bigint | FK → document_types |
| file_path | varchar(500) | |
| uploaded_at | datetime | nullable |
| created_at, updated_at | timestamp | |

### 13. sector_evaluations
| Column | Type | Notes |
|--------|------|-------|
| id | bigint | PK |
| application_id | bigint | FK → applications |
| sector | enum | education, training, experience, eligibility |
| status | enum | pending, qualified, disqualified |
| remarks | text | nullable |
| evaluated_by | bigint | FK → users |
| evaluated_at | datetime | nullable |
| created_at, updated_at | timestamp | |

---

## Seeders

| Seeder | Data |
|--------|------|
| PlantillaPositionSeeder | Already created |
| EligibilityTypeSeeder | LET, CSE Professional, CSE Subprofessional, RA 1080, Other |
| DocumentTypeSeeder | Letter of Intent, PDS, Work Experience Sheet, Checklist of Requirements, Omnibus Sworn Statement/CAV, Data Privacy Consent Form, Other Requirements |

---

## File Storage

- Local storage (file_path columns)
- Storage location: `storage/app/public/`

---

## IER (Initial Evaluation Result) - Future Phase

**Print view columns to hide:**
- Address
- Age
- Sex
- Civil Status
- Email Address
- Contact No.

**Visible columns:**
- No., Application Code, Names, Education, Training, Experience, Eligibility, Remarks

---

## Implementation Priority

### Phase 1: Foundation
1. User authentication (4 roles)
2. Plantilla positions management
3. Document types CRUD

### Phase 2: Applicant Portal
1. Registration + Profile completion
2. Job listing (public view)
3. Application submission (4 sectors + docs)

### Phase 3: HR Management
1. Job posting creation
2. Application review (sector evaluations)
3. Overall status (qualified/disqualified)

### Phase 4: Reports
1. IER page by position
2. Print view (hidden sensitive data)

---

## Notes

- Application code format: `{position_code}-{year}-{sequence}` (e.g., DIR4-2026-001)
- Qualification standards: Manual input by HR during job posting
- Education level dropdown: Bachelors, Masters, Doctorate
- Age computed from date_of_birth (not stored)