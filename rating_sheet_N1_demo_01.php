<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rating Sheet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>@media print{a[href]:after{content:none}}</style>

</head>
<body>
<div class="container">
<?php

function letter_grade($grade){
	$letter_grade = '';
	if ($grade >= 93) {
		$letter_grade = 'O';
	}
	if ($grade >= 87 && $grade < 93) {
		$letter_grade = 'VS';
	}
	if ($grade >= 81 && $grade < 87) {
		$letter_grade = 'S';
	}
	if ($grade >= 75 && $grade < 81) {
		$letter_grade = 'MS';
	}
	if ($grade >= 65 && $grade < 75) {
		$letter_grade = 'NI';
	}
	else
		$grade = "";
	return ($letter_grade);
}

$servername = "localhost";
$username = "root";
$password = "Q1w2e3r4";
$dbname = "opensis";
$school_id = 1;
$wash_ave = 0;
$ss_ave = 0;
$ms_ave = 0;
$sp_ave = 0;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<br><form method='GET' action=''>";
echo "<select name='mp' style='font-size:80%'>";
echo "<option value=''>Select a marking period</option>";
$id_sql = "select marking_period_id,title from marking_periods where marking_period_id IN (16,18)";
$id_result = $conn->query($id_sql);
if ($id_result->num_rows > 0) {
	while($id_row = $id_result->fetch_assoc()) {
		echo "<option value='".$id_row["marking_period_id"]."'>".$id_row["title"]."</option>";
	}
}
echo "</select>&nbsp;";
echo "<select name='id' style='font-size:80%'>";
echo "<option value=''>Select a section</option>";
$id_sql = "select id,name from school_gradelevel_sections where sort_order = 1 order by sort_order asc";
$id_result = $conn->query($id_sql);
if ($id_result->num_rows > 0) {
	while($id_row = $id_result->fetch_assoc()) {
		echo "<option value='".$id_row["id"]."'>".$id_row["name"]."</option>";
	}
}
echo "</select>";
echo "&nbsp;&nbsp;<button type='submit' class='btn btn-xs btn-default'>Submit</button>";
echo "</form>";

if((!isset($_GET["id"])) or ($_GET["id"]=='')){
	$conn->close();
	exit;
}
$section_id = $_GET["id"];;
if((!isset($_GET["mp"])) or ($_GET["mp"]=='')){
	$conn->close();
	exit;
}
$marking_period_id = $_GET["mp"];

$mp_sql = "select syear,title from marking_periods where marking_period_id = $marking_period_id";
$mp_result = $conn->query($mp_sql);
$mp_row = $mp_result->fetch_assoc();
$syear = $mp_row['syear'];
$mp_title = $mp_row['title'];

?>
<br>
<div class="container text-center">
Lord's Jewels Christian School Inc.<br>
Rating Sheet - <?php echo $mp_title ?><br>
<?php
$section_name = "select school_gradelevels.title,school_gradelevel_sections.name from student_enrollment
				left join school_gradelevels on student_enrollment.grade_id = school_gradelevels.id
				left join school_gradelevel_sections on student_enrollment.section_id = school_gradelevel_sections.id
				where section_id = $section_id";
$section_name_result = $conn->query($section_name);
$section_name_row = $section_name_result->fetch_assoc();
$grade = "";
echo $section_name_row['title']." - ".$section_name_row['name'];
?>
<br>
SY <?php echo $syear ?>-<?php echo $syear+1 ?><br>
<br>
</div>
<table class='table table-bordered table-condensed table-striped table-hover' style='font-size:80%'>
<tr><td width='200' align=center><b>BOYS</b></td>
<?php
$subjects = "select distinct student_report_card_grades.course_period_id,courses.short_name,courses.subject_id
			 from student_report_card_grades
			 left join student_enrollment on student_report_card_grades.student_id = student_enrollment.student_id
			 left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
			 left join courses on course_periods.course_id = courses.course_id
			 where student_report_card_grades.marking_period_id = $marking_period_id and student_enrollment.section_id = $section_id and (courses.subject_id < 17 or courses.subject_id > 20)
			 order by FIELD(subject_id,1,2,6,3,4,5)";
$subjects_result = $conn->query($subjects);
if ($subjects_result->num_rows > 0){
	while($subjects_row = $subjects_result->fetch_assoc()){
		echo "<td width='50'><b>".$subjects_row['short_name']."</b></td>";
	}
}
/*$subjects = "select distinct student_report_card_grades.course_period_id,courses.short_name,courses.subject_id
			 from student_report_card_grades
			 left join student_enrollment on student_report_card_grades.student_id = student_enrollment.student_id
			 left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
			 left join courses on course_periods.course_id = courses.course_id
			 where student_report_card_grades.marking_period_id = $marking_period_id and student_enrollment.section_id = $section_id and courses.subject_id BETWEEN 17 and 20
       order by FIELD(subject_id,8,6,1,15,2,3,4,7,11,5,12,13,16,10,21,17,18,19,14,20,9)";
$subjects_result = $conn->query($subjects);
if ($subjects_result->num_rows > 0){
	while($subjects_row = $subjects_result->fetch_assoc()){
		echo "<td style='font-size:80%'><b>".$subjects_row['short_name']."</b></td>";
	}
}

*/
echo "<td align=center width='50'><b>QG</b></td><td align=center width='50'><b>C</b></td><td align=center width='50'><b>GM</b></td><td align=center width='50'><b>FM</b></td><td align=center width='50'><b>WS</b></td><td align=center width='50'><b>SPD</b></td><td align=center width='50'><b>SHS</b></td><td align=center width='50'><b>SP</b></td><td width='250' align=center><b>Comments</b></td></tr>";
$students = "select DISTINCT student_report_card_grades.student_id,students.last_name,students.first_name,students.gender
			 from student_report_card_grades
			 left join students on student_report_card_grades.student_id = students.student_id
			 left join student_enrollment on student_report_card_grades.student_id = student_enrollment.student_id
			 where student_report_card_grades.marking_period_id = $marking_period_id and student_enrollment.section_id = $section_id and students.gender = 'Male'
			 order by students.gender DESC, students.last_name ASC";
			 
			 
			 
			 
$students_result = $conn->query($students);
if ($students_result->num_rows > 0){
	while($students_row = $students_result->fetch_assoc()){
		$student_id = $students_row['student_id'];
		echo "<tr><td><a href='report_card_N1_demo_01.php?student=".$student_id."'>".$students_row['last_name'].", ".$students_row['first_name']."</a></td>";
		$grades = "select student_report_card_grades.grade_letter,courses.subject_id from student_report_card_grades
				   left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
				   left join courses on course_periods.course_id = courses.course_id
				   where student_report_card_grades.marking_period_id = $marking_period_id and student_id = $student_id and (courses.subject_id < 17 or courses.subject_id > 20)
				     order by FIELD(subject_id,1,2,6,3,4,5)";
					 
					 
		$grades_result = $conn->query($grades);
		if ($grades_result->num_rows > 0){
			$ga = 0;
			$h = 1;
			while($grades_row = $grades_result->fetch_assoc()){
				echo "<td>".$grades_row['grade_letter']."</td>";
				$ga = $ga + $grades_row['grade_letter'];
				$h = $h + 1;
			}
		}
		
		$ga = number_format($ga/($h - 1),2);
		
		$comments = "SELECT * FROM student_mp_comments where student_id = $student_id and marking_period_id = $marking_period_id order by id DESC";
		$comments_result = $conn->query($comments);
		$comments_row = $comments_result->fetch_assoc();
		echo "<td>".$ga."</td><td>";
		//get averages start
		$ave_sql = "SELECT * FROM character_building_nursery1 where student_id = $student_id and marking_period_id = $marking_period_id and section_id = $section_id and school_id = $school_id";
		$ave_result = $conn->query($ave_sql);
		$ave_row = $ave_result->fetch_assoc();
		$C_ave = ( $ave_row['c_1'] + $ave_row['c_2'] ) / 2;
		$GM_ave = ( $ave_row['gm_1'] + $ave_row['gm_2'] ) / 2;
		$FM_ave = ( $ave_row['fm_1'] + $ave_row['fm_2'] ) / 2;
		$WS_ave = ( $ave_row['ws_1'] + $ave_row['ws_2'] ) / 2;
		$SPD_ave = ( $ave_row['spd_1'] + $ave_row['spd_2'] ) / 2;
		$SHS_ave = ( $ave_row['shs_1'] + $ave_row['shs_2'] ) / 2;
		$SP_ave = ( $ave_row['sp_1'] + $ave_row['sp_2'] ) / 2;
		//get averages end
		echo letter_grade($C_ave)."</td><td>".letter_grade($GM_ave)."</td><td>".letter_grade($FM_ave)."</td><td>".letter_grade($WS_ave)."</td><td>".letter_grade($SPD_ave)."</td><td>".letter_grade($SHS_ave)."</td><td>".letter_grade($SP_ave)."</td><td style='font-size:80%'>".$comments_row['comment']."</td></tr>";
		
	}
	
	echo "<tr><td align=center>GIRLS</td>";
	$i = $h + 5;
	while ($i <> 0) {
		echo "<td></td>";
		$i = $i - 1;
	}
	echo "</tr>";
	
	$students = "select DISTINCT student_report_card_grades.student_id,students.last_name,students.first_name,students.gender
			 from student_report_card_grades
			 left join students on student_report_card_grades.student_id = students.student_id
			 left join student_enrollment on student_report_card_grades.student_id = student_enrollment.student_id
			 where student_report_card_grades.marking_period_id = $marking_period_id and student_enrollment.section_id = $section_id and students.gender = 'Female'
			 order by students.gender DESC, students.last_name ASC";
			 
	$students_result = $conn->query($students);
	if ($students_result->num_rows > 0){
		while($students_row = $students_result->fetch_assoc()){
			$student_id = $students_row['student_id'];
			echo "<tr><td><a href='report_card_N1_demo_01.php?student=".$student_id."'>".$students_row['last_name'].", ".$students_row['first_name']."</a></td>";
			$grades = "select student_report_card_grades.grade_letter,courses.subject_id from student_report_card_grades
						left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
						left join courses on course_periods.course_id = courses.course_id
						where student_report_card_grades.marking_period_id = $marking_period_id and student_id = $student_id and (courses.subject_id < 17 or courses.subject_id > 20)
						order by FIELD(subject_id,1,2,6,3,4,5)";
		
			$grades_result = $conn->query($grades);
			if ($grades_result->num_rows > 0){
				$ga = 0;
				$h = 1;
				while($grades_row = $grades_result->fetch_assoc()){
					echo "<td>".$grades_row['grade_letter']."</td>";
					$ga = $ga + $grades_row['grade_letter'];
					$h = $h + 1;
				}
			}
			$ga = number_format($ga/($h - 1),2);
				$comments = "SELECT * FROM student_mp_comments where student_id = $student_id and marking_period_id = $marking_period_id order by id DESC";
				$comments_result = $conn->query($comments);
				$comments_row = $comments_result->fetch_assoc();
				echo "<td>".$ga."</td><td>";
				//get averages start
				$ave_sql = "SELECT * FROM character_building_nursery1 where student_id = $student_id and marking_period_id = $marking_period_id and section_id = $section_id and school_id = $school_id";
		$ave_result = $conn->query($ave_sql);
		$ave_row = $ave_result->fetch_assoc();
		$C_ave = ( $ave_row['c_1'] + $ave_row['c_2'] ) / 2;
		$GM_ave = ( $ave_row['gm_1'] + $ave_row['gm_2'] ) / 2;
		$FM_ave = ( $ave_row['fm_1'] + $ave_row['fm_2'] ) / 2;
		$WS_ave = ( $ave_row['ws_1'] + $ave_row['ws_2'] ) / 2;
		$SPD_ave = ( $ave_row['spd_1'] + $ave_row['spd_2'] ) / 2;
		$SHS_ave = ( $ave_row['shs_1'] + $ave_row['shs_2'] ) / 2;
		$SP_ave = ( $ave_row['sp_1'] + $ave_row['sp_2'] ) / 2;
		//get averages end
		echo letter_grade($C_ave)."</td><td>".letter_grade($GM_ave)."</td><td>".letter_grade($FM_ave)."</td><td>".letter_grade($WS_ave)."</td><td>".letter_grade($SPD_ave)."</td><td>".letter_grade($SHS_ave)."</td><td>".letter_grade($SP_ave)."</td><td style='font-size:80%'>".$comments_row['comment']."</td></tr>";
		}
		
	}
		
}

$conn->close();
?>
</table>
</div>
</body>
</html>
