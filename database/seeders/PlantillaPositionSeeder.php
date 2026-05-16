<?php

namespace Database\Seeders;

use App\Models\PlantillaPosition;
use Illuminate\Database\Seeder;

class PlantillaPositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = [
            // Office of the Regional Director (20)
            ['department' => 'Office of the Regional Director', 'position_name' => 'Director IV', 'position_code' => 'DIR4', 'plantilla_item_no' => 'OSEC-DECSB-DIR4-390002-1998', 'salary_grade' => 28],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Director III', 'position_code' => 'DIR3', 'plantilla_item_no' => 'OSEC-DECSB-DIR3-390002-1998', 'salary_grade' => 27],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Attorney IV', 'position_code' => 'ATY4', 'plantilla_item_no' => 'OSEC-DECSB-ATY4-390017-2014', 'salary_grade' => 23],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Attorney III', 'position_code' => 'ATY3', 'plantilla_item_no' => 'OSEC-DECSB-ATY3-390001-2021', 'salary_grade' => 21],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Information Technology Officer I', 'position_code' => 'ITO1', 'plantilla_item_no' => 'OSEC-DECSB-ITO1-390016-2014', 'salary_grade' => 19],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390006-2004', 'salary_grade' => 18],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390008-2004', 'salary_grade' => 18],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390005-2004', 'salary_grade' => 15],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390006-2004', 'salary_grade' => 15],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Officer II', 'position_code' => 'ADOF2', 'plantilla_item_no' => 'OSEC-DECSB-ADOF2-390001-2004', 'salary_grade' => 11],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390005-2004', 'salary_grade' => 9],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390006-2004', 'salary_grade' => 9],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Assistant I', 'position_code' => 'ADAS1', 'plantilla_item_no' => 'OSEC-DECSB-ADAS1-390001-2015', 'salary_grade' => 7],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390013-2004', 'salary_grade' => 6],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390014-2004', 'salary_grade' => 6],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390015-2004', 'salary_grade' => 6],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390016-2004', 'salary_grade' => 6],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390017-2004', 'salary_grade' => 6],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390001-2004', 'salary_grade' => 4],
            ['department' => 'Office of the Regional Director', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390012-2004', 'salary_grade' => 4],

            // Curriculum and Learning Management Division (7)
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Chief Education Supervisor', 'position_code' => 'CES', 'plantilla_item_no' => 'OSEC-DECSB-CES-390001-1998', 'salary_grade' => 24],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390001-1998', 'salary_grade' => 22],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390002-1998', 'salary_grade' => 22],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390003-1998', 'salary_grade' => 22],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390004-1998', 'salary_grade' => 22],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390005-1998', 'salary_grade' => 22],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Librarian II', 'position_code' => 'LBRN2', 'plantilla_item_no' => 'OSEC-DECSB-LBRN2-390001-2016', 'salary_grade' => 15],

            // Policy Planning and Research Division (9)
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Chief Education Supervisor', 'position_code' => 'CES', 'plantilla_item_no' => 'OSEC-DECSB-CES-390004-2015', 'salary_grade' => 24],
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390014-2015', 'salary_grade' => 22],
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390015-2015', 'salary_grade' => 22],
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Planning Officer III', 'position_code' => 'PO3', 'plantilla_item_no' => 'OSEC-DECSB-PO3-390001-1998', 'salary_grade' => 18],
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Education Program Specialist II', 'position_code' => 'ES2', 'plantilla_item_no' => 'OSEC-DECSB-ES2-390001-2015', 'salary_grade' => 16],
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Education Program Specialist II', 'position_code' => 'ES2', 'plantilla_item_no' => 'OSEC-DECSB-ES2-390002-2015', 'salary_grade' => 16],
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Statistician I', 'position_code' => 'STAT1', 'plantilla_item_no' => 'OSEC-DECSB-STAT1-390001-2015', 'salary_grade' => 11],

            // Quality Assurance Division (12)
            ['department' => 'Quality Assurance Division', 'position_name' => 'Chief Education Supervisor', 'position_code' => 'CES', 'plantilla_item_no' => 'OSEC-DECSB-CES-390005-2015', 'salary_grade' => 24],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390016-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390017-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390018-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390019-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390020-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390021-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390022-2015', 'salary_grade' => 22],
            ['department' => 'Quality Assurance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390023-2015', 'salary_grade' => 22],

            // Field Technical Assistance Division (11)
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Chief Education Supervisor', 'position_code' => 'CES', 'plantilla_item_no' => 'OSEC-DECSB-CES-390003-2015', 'salary_grade' => 24],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390006-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390007-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390008-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390009-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390010-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390011-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390012-2015', 'salary_grade' => 22],
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390013-2015', 'salary_grade' => 22],

            // Education Support Services Division (15)
            ['department' => 'Education Support Services Division', 'position_name' => 'Chief Education Supervisor', 'position_code' => 'CES', 'plantilla_item_no' => 'OSEC-DECSB-CES-390001-2015', 'salary_grade' => 24],
            ['department' => 'Education Support Services Division', 'position_name' => 'Medical Officer IV', 'position_code' => 'MO4', 'plantilla_item_no' => 'OSEC-DECSB-MO4-390001-1998', 'salary_grade' => 23],
            ['department' => 'Education Support Services Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390001-2015', 'salary_grade' => 22],
            ['department' => 'Education Support Services Division', 'position_name' => 'Project Development Officer IV', 'position_code' => 'PDO4', 'plantilla_item_no' => 'OSEC-DECSB-PDO4-390001-2015', 'salary_grade' => 22],
            ['department' => 'Education Support Services Division', 'position_name' => 'Project Development Officer IV', 'position_code' => 'PDO4', 'plantilla_item_no' => 'OSEC-DECSB-PDO4-390002-2015', 'salary_grade' => 22],
            ['department' => 'Education Support Services Division', 'position_name' => 'Project Development Officer II', 'position_code' => 'PDO2', 'plantilla_item_no' => 'OSEC-DECSB-PDO2-390001-2015', 'salary_grade' => 15],
            ['department' => 'Education Support Services Division', 'position_name' => 'Dentist II', 'position_code' => 'DENT2', 'plantilla_item_no' => 'OSEC-DECSB-DENT2-390001-1998', 'salary_grade' => 17],
            ['department' => 'Education Support Services Division', 'position_name' => 'Dentist II', 'position_code' => 'DENT2', 'plantilla_item_no' => 'OSEC-DECSB-DENT2-390002-1998', 'salary_grade' => 17],
            ['department' => 'Education Support Services Division', 'position_name' => 'Nurse II', 'position_code' => 'NURS2', 'plantilla_item_no' => 'OSEC-DECSB-NURS2-390001-1998', 'salary_grade' => 16],
            ['department' => 'Education Support Services Division', 'position_name' => 'Engineer III', 'position_code' => 'ENGR3', 'plantilla_item_no' => 'OSEC-DECSB-ENGR3-390001-2015', 'salary_grade' => 19],
            ['department' => 'Education Support Services Division', 'position_name' => 'Engineer III', 'position_code' => 'ENGR3', 'plantilla_item_no' => 'OSEC-DECSB-ENGR3-390002-2015', 'salary_grade' => 19],
            ['department' => 'Education Support Services Division', 'position_name' => 'Nutritionist-Dietitian I', 'position_code' => 'NDTR1', 'plantilla_item_no' => 'OSEC-DECSB-NDTR1-390001-1998', 'salary_grade' => 11],

            // Human Resource Development Division (12)
            ['department' => 'Human Resource Development Division', 'position_name' => 'Chief Education Supervisor', 'position_code' => 'CES', 'plantilla_item_no' => 'OSEC-DECSB-CES-390002-2015', 'salary_grade' => 24],
            ['department' => 'Human Resource Development Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390002-2015', 'salary_grade' => 22],
            ['department' => 'Human Resource Development Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390003-2015', 'salary_grade' => 22],
            ['department' => 'Human Resource Development Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390004-2015', 'salary_grade' => 22],
            ['department' => 'Human Resource Development Division', 'position_name' => 'Education Program Supervisor', 'position_code' => 'EPSVR', 'plantilla_item_no' => 'OSEC-DECSB-EPSVR-390005-2015', 'salary_grade' => 22],
            ['department' => 'Human Resource Development Division', 'position_name' => 'Education Program Specialist II', 'position_code' => 'ES2', 'plantilla_item_no' => 'OSEC-DECSB-ES2-390003-2015', 'salary_grade' => 16],
            ['department' => 'Human Resource Development Division', 'position_name' => 'Education Program Specialist II', 'position_code' => 'ES2', 'plantilla_item_no' => 'OSEC-DECSB-ES2-390004-2015', 'salary_grade' => 16],

            // Administrative Division (40)
            ['department' => 'Administrative Division', 'position_name' => 'Chief Administrative Officer', 'position_code' => 'CAO', 'plantilla_item_no' => 'OSEC-DECSB-CAO-390001-1998', 'salary_grade' => 24],
            ['department' => 'Administrative Division', 'position_name' => 'Supervising Administrative Officer', 'position_code' => 'SAO', 'plantilla_item_no' => 'OSEC-DECSB-SAO-390001-2014', 'salary_grade' => 22],
            ['department' => 'Administrative Division', 'position_name' => 'Supervising Administrative Officer', 'position_code' => 'SAO', 'plantilla_item_no' => 'OSEC-DECSB-SAO-390002-2014', 'salary_grade' => 22],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390001-2014', 'salary_grade' => 18],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390002-2014', 'salary_grade' => 18],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390003-2014', 'salary_grade' => 18],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390004-2014', 'salary_grade' => 18],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390013-2014', 'salary_grade' => 15],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390014-2014', 'salary_grade' => 15],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390015-2014', 'salary_grade' => 15],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390018-2014', 'salary_grade' => 15],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer II', 'position_code' => 'ADOF2', 'plantilla_item_no' => 'OSEC-DECSB-ADOF2-390002-2004', 'salary_grade' => 11],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Officer II', 'position_code' => 'ADOF2', 'plantilla_item_no' => 'OSEC-DECSB-ADOF2-390003-2004', 'salary_grade' => 11],

            // Finance Division (16)
            ['department' => 'Finance Division', 'position_name' => 'Chief Administrative Officer', 'position_code' => 'CAO', 'plantilla_item_no' => 'OSEC-DECSB-CAO-390002-1998', 'salary_grade' => 24],
            ['department' => 'Finance Division', 'position_name' => 'Supervising Administrative Officer', 'position_code' => 'SAO', 'plantilla_item_no' => 'OSEC-DECSB-SAO-390003-2014', 'salary_grade' => 22],
            ['department' => 'Finance Division', 'position_name' => 'Accountant IV', 'position_code' => 'ACC4', 'plantilla_item_no' => 'OSEC-DECSB-ACC4-390001-1998', 'salary_grade' => 22],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Officer V', 'position_code' => 'ADOF5', 'plantilla_item_no' => 'OSEC-DECSB-ADOF5-390007-2004', 'salary_grade' => 18],
            ['department' => 'Finance Division', 'position_name' => 'Accountant III', 'position_code' => 'ACC3', 'plantilla_item_no' => 'OSEC-DECSB-ACC3-390001-2014', 'salary_grade' => 19],
            ['department' => 'Finance Division', 'position_name' => 'Accountant II', 'position_code' => 'ACC2', 'plantilla_item_no' => 'OSEC-DECSB-ACC2-390001-1998', 'salary_grade' => 16],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390002-2004', 'salary_grade' => 15],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390003-2004', 'salary_grade' => 15],
            ['department' => 'Finance Division', 'position_name' => 'Accountant I', 'position_code' => 'A1', 'plantilla_item_no' => 'OSEC-DECSB-A1-390022-2014', 'salary_grade' => 12],
            ['department' => 'Finance Division', 'position_name' => 'Accountant I', 'position_code' => 'A1', 'plantilla_item_no' => 'OSEC-DECSB-A1-390023-2014', 'salary_grade' => 12],
            ['department' => 'Finance Division', 'position_name' => 'Accountant I', 'position_code' => 'A1', 'plantilla_item_no' => 'OSEC-DECSB-A1-390024-2014', 'salary_grade' => 12],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Assistant V', 'position_code' => 'ADAS5', 'plantilla_item_no' => 'OSEC-DECSB-ADAS5-390004-2004', 'salary_grade' => 11],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Assistant V', 'position_code' => 'ADAS5', 'plantilla_item_no' => 'OSEC-DECSB-ADAS5-390005-2004', 'salary_grade' => 11],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Officer II', 'position_code' => 'ADOF2', 'plantilla_item_no' => 'OSEC-DECSB-ADOF2-390005-2004', 'salary_grade' => 11],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Assistant II', 'position_code' => 'ADAS2', 'plantilla_item_no' => 'OSEC-DECSB-ADAS2-390001-2004', 'salary_grade' => 8],
            ['department' => 'Finance Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390002-2004', 'salary_grade' => 6],

            // Additional Administrative Division positions
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390004-2004', 'salary_grade' => 9],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390005-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390006-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390007-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390008-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390009-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390010-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390011-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide VI', 'position_code' => 'ADA6', 'plantilla_item_no' => 'OSEC-DECSB-ADA6-390012-2004', 'salary_grade' => 6],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390002-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390003-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390004-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390005-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390006-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390007-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390008-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390009-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390010-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide IV', 'position_code' => 'ADA4', 'plantilla_item_no' => 'OSEC-DECSB-ADA4-390011-2004', 'salary_grade' => 4],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide I', 'position_code' => 'ADA1', 'plantilla_item_no' => 'OSEC-DECSB-ADA1-390001-2004', 'salary_grade' => 1],
            ['department' => 'Administrative Division', 'position_name' => 'Administrative Aide I', 'position_code' => 'ADA1', 'plantilla_item_no' => 'OSEC-DECSB-ADA1-390002-2004', 'salary_grade' => 1],

            // Additional Curriculum and Learning Management Division positions
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Administrative Officer IV', 'position_code' => 'ADOF4', 'plantilla_item_no' => 'OSEC-DECSB-ADOF4-390001-2004', 'salary_grade' => 15],
            ['department' => 'Curriculum and Learning Management Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390001-2004', 'salary_grade' => 9],

            // Additional Education Support Services Division positions
            ['department' => 'Education Support Services Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390002-2004', 'salary_grade' => 9],

            // Additional Human Resource Development Division positions
            ['department' => 'Human Resource Development Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390003-2004', 'salary_grade' => 9],

            // Additional Policy Planning and Research Division positions
            ['department' => 'Policy Planning and Research Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390008-2004', 'salary_grade' => 9],

            // Additional Quality Assurance Division positions
            ['department' => 'Quality Assurance Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390009-2004', 'salary_grade' => 9],

            // Additional Field Technical Assistance Division positions
            ['department' => 'Field Technical Assistance Division', 'position_name' => 'Administrative Assistant III', 'position_code' => 'ADAS3', 'plantilla_item_no' => 'OSEC-DECSB-ADAS3-390007-2004', 'salary_grade' => 9],
        ];

        foreach ($positions as $position) {
            PlantillaPosition::create($position);
        }
    }
}