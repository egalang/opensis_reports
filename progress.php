<!DOCTYPE html>
<html lang="en">
<head>
  <title>Progress Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php

$servername = "localhost";
$username = "root";
$password = "Q1w2e3r4";
$dbname = "opensis";
$report_card_grade_id = '';
$quarterly_grade = '';
$period_id = '';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

echo "<br><form method='GET' action=''>";
echo "<select name='mp' style='font-size:80%'>";
echo "<option value=''>Select a marking period</option>";
$id_sql = "select marking_period_id,title from marking_periods";
$id_result = $conn->query($id_sql);
if ($id_result->num_rows > 0) {
	while($id_row = $id_result->fetch_assoc()) {
		echo "<option value='".$id_row["marking_period_id"]."'>".$id_row["title"]."</option>";
	}
}
echo "</select>&nbsp;";
echo "<select name='id' style='font-size:80%'>";
echo "<option value=''>Select a course period</option>";
$id_sql = "select distinct gradebook_grades.course_period_id, course_periods.title from gradebook_grades left join course_periods on gradebook_grades.course_period_id = course_periods.course_period_id order by course_periods.title";
$id_result = $conn->query($id_sql);
if ($id_result->num_rows > 0) {
	while($id_row = $id_result->fetch_assoc()) {
		echo "<option value='".$id_row["course_period_id"]."'>".$id_row["title"]."</option>";
	}
}
echo "</select>";
echo "&nbsp;&nbsp;<button type='submit' class='btn btn-xs btn-default'>Submit</button>";
echo "</form>";

if((!isset($_GET["id"])) or ($_GET["id"]=='')){
	$conn->close();
	exit;
}
$subject_id = $_GET["id"];;
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

$subject_sql = "select distinct gradebook_grades.course_period_id, courses.title, course_periods.title as code, course_periods.teacher_id as teacher from gradebook_grades left join course_periods on gradebook_grades.course_period_id = course_periods.course_period_id left join courses on course_periods.course_id = courses.course_id
                where gradebook_grades.course_period_id = $subject_id";
$subject_result = $conn->query($subject_sql);
if ($subject_result->num_rows > 0) {
	while($subject_row = $subject_result->fetch_assoc()) {
		$subject = $subject_row["course_period_id"];
		$teacher = $subject_row["teacher"];
		$course_title = $subject_row["title"];
		echo "<br><table width='100%'><tr><td><table class='table table-bordered table-condensed table-striped table-hover' style='width:33%'><tr style='font-size:80%'><td>".$course_title." - ".$mp_title." SY".$syear."</td></tr>";
		echo "<tr style='font-size:80%'><td>".$subject_row["code"]."</td></tr></table>";
		echo "<table class='table table-bordered table-condensed table-striped table-hover' style='font-size:80%'>";
		
		$types_sql = "select gradebook_grades.period_id, gradebook_assignment_types.title, gradebook_assignment_types.final_grade_percent as percent, count(distinct(gradebook_grades.assignment_id)) as columns from gradebook_grades left join gradebook_assignments on gradebook_grades.assignment_id = gradebook_assignments.assignment_id left join gradebook_assignment_types on gradebook_assignments.assignment_type_id = gradebook_assignment_types.assignment_type_id where gradebook_assignments.course_period_id = $subject and gradebook_assignments.marking_period_id = $marking_period_id group by gradebook_assignment_types.assignment_type_id";
		$types_result = $conn->query($types_sql);
		if ($types_result->num_rows > 0) {
			$i = 0;
			while($types_row = $types_result->fetch_assoc()) {
				$period_id = $types_row["period_id"];
				$cols[$i] = $types_row["columns"];
				$title[$i] = $types_row["title"];
				$percent[$i] = $types_row["percent"];
				$i = $i + 1;
			}
		
			echo "<tr><td>&nbsp;</td><td colspan=".($cols[0]+3)."><center>".$title[0]." (".number_format($percent[0]*100,0)."%)</center></td><td colspan=".($cols[1]+3)."><center>".$title[1]." (".number_format($percent[1]*100,0)."%)</center></td><td colspan=".($cols[2]+3)."><center>".$title[2]." (".number_format($percent[2]*100,0)."%)</center></td><td colspan=2>&nbsp;</td></tr>";
			echo "<tr><td>&nbsp;</td><td colspan=".$cols[0].">&nbsp;</td><td><center>Total</center></td><td><center>PS</center></td><td><center>WS</center></td><td colspan=".$cols[1].">&nbsp;</td><td><center>Total</center></td><td><center>PS</center></td><td><center>WS</center></td><td colspan=".$cols[2].">&nbsp;</td><td><center>Total</center></td><td><center>PS</center></td><td><center>WS</center></td><td><center>IG</center></td><td><center><b>QG</b></center></td></tr>";
			
			$student_sql = "select distinct gradebook_grades.student_id, students.last_name, students.first_name, students.middle_name, gradebook_grades.period_id from gradebook_grades left join students on gradebook_grades.student_id = students.student_id where gradebook_grades.course_period_id = $subject and gradebook_grades.period_id = $period_id";
			$student_result = $conn->query($student_sql);
			if ($student_result->num_rows > 0) {
				while($student_row = $student_result->fetch_assoc()) {
					$student = $student_row["student_id"];
					//$period_id = $student_row["period_id"];
					echo "<tr><td>".$student_row["last_name"].", ".$student_row["first_name"]."</td>";
					$initial_grade = 0;
				
					$weight_sql = "select distinct gradebook_assignment_types.assignment_type_id, gradebook_assignment_types.final_grade_percent as weight from gradebook_grades left join gradebook_assignments on gradebook_grades.assignment_id = gradebook_assignments.assignment_id left join gradebook_assignment_types on gradebook_assignments.assignment_type_id = gradebook_assignment_types.assignment_type_id
								   where gradebook_assignments.course_period_id = $subject and gradebook_grades.student_id = $student and gradebook_assignments.marking_period_id = $marking_period_id order by gradebook_assignment_types.assignment_type_id";
					$weight_result = $conn->query($weight_sql);
					if ($weight_result->num_rows > 0) {
						while($weight_row = $weight_result->fetch_assoc()) {
							$assignment_type_id = $weight_row["assignment_type_id"];
							$weight = $weight_row["weight"];
							$total_score = 0;
							$total_items = 0;
							
							$sql = "select students.last_name, students.first_name, students.middle_name, course_periods.title as subject, gradebook_assignments.title as assignment, gradebook_grades.points as score, gradebook_assignments.points as items, gradebook_assignment_types.final_grade_percent as weight from gradebook_grades left join students on gradebook_grades.student_id = students.student_id left join course_periods on gradebook_grades.course_period_id = course_periods.course_period_id left join gradebook_assignments on gradebook_grades.assignment_id = gradebook_assignments.assignment_id left join gradebook_assignment_types on gradebook_assignments.assignment_type_id = gradebook_assignment_types.assignment_type_id
									where gradebook_grades.course_period_id = $subject and gradebook_grades.student_id = $student and gradebook_assignment_types.assignment_type_id = $assignment_type_id and gradebook_assignments.marking_period_id = $marking_period_id";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								while($row = $result->fetch_assoc()) {
									echo "<td>".number_format($row["score"],0)."/".$row["items"]."</td>";
									$total_score = $total_score + $row["score"];
									$total_items = $total_items + $row["items"];
								}
								echo "<td>".$total_score."/".$total_items."</td>";
								echo "<td>".number_format((($total_score/$total_items)*100),2)."</td>";
								echo "<td>".number_format(((($total_score/$total_items)*100)*$weight),2)."</td>";
							}
							$initial_grade = round($initial_grade + ((($total_score/$total_items)*100)*$weight),2);
						}
						echo "<td>".number_format($initial_grade,2)."</td>";
						$trans_sql = "SELECT * FROM `report_card_grades` WHERE grade_scale_id = 1 ORDER BY `report_card_grades`.`break_off` ASC";
						$trans_result = $conn->query($trans_sql);
						if ($trans_result->num_rows > 0) {
							while($trans_row = $trans_result->fetch_assoc()) {
								if( $trans_row["break_off"] <= $initial_grade ) {
									$quarterly_grade = $trans_row["title"];
									$report_card_grade_id = $trans_row["id"];
								}
							}
						}
						echo "<td><b>".$quarterly_grade."</b></td>";
					}
					echo "</tr>";
					//put data in student_report_card_grades - start
					$check_grade_sql = "SELECT * FROM student_report_card_grades where course_period_id = $subject and student_id = $student and marking_period_id = $marking_period_id";
					$check_grade_result = $conn->query($check_grade_sql);
					if ($check_grade_result->num_rows > 0) {
						$card_grade_sql = "update student_report_card_grades set report_card_grade_id = $report_card_grade_id, grade_percent = $initial_grade, grade_letter = '$quarterly_grade' where course_period_id = $subject and student_id = $student and marking_period_id = $marking_period_id";
					} else {
						$card_grade_sql = "insert into student_report_card_grades (syear,school_id,student_id,course_period_id,report_card_grade_id,grade_percent,marking_period_id,grade_letter,unweighted_gp,gp_scale,credit_earned,course_title) values (2019,1,$student,$subject,$report_card_grade_id,$initial_grade,$marking_period_id,'$quarterly_grade',0,4,0,'$course_title')";
					}
					$conn->query($card_grade_sql);
					//put data in student_report_card_grades - end
				}
			}
		}
		echo "</table></td></tr></table>";
		//put data in grades_completed - start
		$grade_complete_sql = "insert into grades_completed (staff_id,marking_period_id,period_id) values ($teacher,$marking_period_id,$period_id)";
		$conn->query($grade_complete_sql);
		//put data in grades_completed - end
	}
}

$conn->close();
?>
</div>
</body>
</html>