<!DOCTYPE html>
<?php

$servername = "localhost";
$username = "root";
$password = "Q1w2e3r4";
$dbname = "opensis";

$ga_01 = $ga_02 = $ga_03 = $ga_04 = 0;
$fg_a[] = $rem_a[] = $_fg_counter_a = $_rem_counter_a = 0;
$_quar_01a = $_quar_02a = $_quar_03a = $_quar_04a = 0;
$_quar_01b = $_quar_02b = $_quar_03b = $_quar_04b = 0;
$days_school[] = $_days_counter_a = $days_school_total = 0;
$m_pres_total = $m_jan_pres = $m_feb_pres = $m_mar_pres = $m_apr_pres = $m_jun_pres = $m_jul_pres = $m_aug_pres = $m_sep_pres = $m_oct_pres = $m_nov_pres = $m_dec_pres = 0;
$m_abs_total = $m_jan_abs = $m_feb_abs = $m_mar_abs = $m_apr_abs = $m_jun_abs = $m_jul_abs = $m_aug_abs = $m_sep_abs = $m_oct_abs = $m_nov_abs = $m_dec_abs = 0;
$m_tar_total = $m_jan_tar = $m_feb_tar = $m_mar_tar = $m_apr_tar = $m_jun_tar = $m_jul_tar = $m_aug_tar = $m_sep_tar = $m_oct_tar = $m_nov_tar = $m_dec_tar = 0;
$m_abs = $m_pres = $m_tar = "";

$char_row_01_w = $char_row_02_w = $char_row_03_w = $char_row_04_w = 0;
$char_row_01_ss = $char_row_02_ss = $char_row_03_ss = $char_row_04_ss = 0;
$char_row_01_ms = $char_row_02_ms = $char_row_03_ms = $char_row_04_ms = 0;
$char_row_01_sp = $char_row_02_sp = $char_row_03_sp = $char_row_04_sp = 0;


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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$cName='remember_me_name';
if(!isset($_COOKIE[$cName])) {
    echo "Cookie named '" . $cName . "' is not set!&nbsp;";
	die("Log in with remember me option enabled." . $conn->connect_error);
} else {}

?>


<html lang="en">
<head>
<style> 
input[type=text] 
 {
  outline: none;
  border: none;  
 }
 
table, th, td 
 {
 border-collapse: collapse;
 }
</style>

  <title>Report Card</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  <script>
        $(document).ready(function(){

          // Initialize select2
          $("#selUser").select2();

          // Read selected option
          $('#but_read').click(function(){
                var username = $('#selUser option:selected').text();
                var userid = $('#selUser').val();

                $('#result').html("id : " + userid + ", name : " + username);

          });
        });
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
		
		function saveToDatabase(editableObj,column,id) {
			$(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
			$.ajax({
				url: "saveedit.php",
				type: "POST",
				data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
				success: function(data){
					$(editableObj).css("background","#FDFDFD");
				}        
		   });
		}
  </script>
</head>
<body>
<div class="container">

<?php
if((!isset($_GET["student"])) or ($_GET["student"]=='')){
        $conn->close();
        exit;
}
$student_id = $_GET["student"];;

?>
<br><table style="width:100%">
        <tr>
                <td style="width:49%; vertical-align:top">
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td><center>Teachers Comment</center></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 15";
										
                                        $result_comment_01 = $conn->query($sql);
                                        $row_comment_01 = $result_comment_01->fetch_assoc();
                                ?>
                                <tr>
                                        <td style='height:50px'>First Grading:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_01['comment'] ?></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 16";
										
                                        $result_comment_02 = $conn->query($sql);
                                        $row_comment_02 = $result_comment_02->fetch_assoc();
                                ?>
                                <tr>
                                        <td style='height:50px'>Second Grading:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_02['comment'] ?></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 17";
										
                                        $result_comment_03 = $conn->query($sql);
                                        $row_comment_03 = $result_comment_03->fetch_assoc();
                                ?>
                                <tr>
                                <tr>
                                        <td style='height:50px'>Third Grading::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_03['comment'] ?></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 18";
										
                                        $result_comment_04 = $conn->query($sql);
                                        $row_comment_04 = $result_comment_04->fetch_assoc();
                                ?>
                                <tr>
                                        <td style='height:50px'>Fourth Grading::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_04['comment'] ?></td>
                                </tr>
                        </table>
						<table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td><center>Parents Comment</center></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 15";
										
                                        $result_comment_01 = $conn->query($sql);
                                        $row_comment_01 = $result_comment_01->fetch_assoc();
                                ?>
                                <tr>
                                        <td style='height:50px'>First Grading:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_01['comment'] ?></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 16";
										
                                        $result_comment_02 = $conn->query($sql);
                                        $row_comment_02 = $result_comment_02->fetch_assoc();
                                ?>
                                <tr>
                                        <td style='height:50px'>Second Grading:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_02['comment'] ?></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 17";
										
                                        $result_comment_03 = $conn->query($sql);
                                        $row_comment_03 = $result_comment_03->fetch_assoc();
                                ?>
                                <tr>
                                <tr>
                                        <td style='height:50px'>Third Grading::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_03['comment'] ?></td>
                                </tr>
								<?php
                                        $sql = "SELECT student_id, marking_period_id, comment 
										FROM `student_mp_comments` 
										where student_id = $student_id 
										and marking_period_id = 18";
										
                                        $result_comment_04 = $conn->query($sql);
                                        $row_comment_04 = $result_comment_04->fetch_assoc();
                                ?>
                                <tr>
                                        <td style='height:50px'>Fourth Grading::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_04['comment'] ?></td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                               
                                <tr>
                                        <td>Eligible for transfer and adminission to</td><td width='200'>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td><td align='center' colspan='2' style='height:20px'>EVANGELINE P. DIZON, Ed.D.</td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td><td align='center' colspan='2' style='height:20px'>Administrator/Principal</td>
                                </tr>
                        </table>
                        
                        
                       
					</td>
					<td style="width:2%">
                        &nbsp;
					</td>
				<?php
                                        $sql = "select TIMESTAMPDIFF(YEAR, students.birthdate, CURDATE()) AS age, students.student_id,
                                                        students.last_name, students.first_name, students.middle_name, students.gender,
                                                        school_gradelevels.title, school_gradelevel_sections.name
                                                        from students
                                                        left join student_enrollment on students.student_id = student_enrollment.student_id
                                                        left join school_gradelevels on student_enrollment.grade_id = school_gradelevels.id
                                                        left join school_gradelevel_sections on student_enrollment.section_id = school_gradelevel_sections.id
                                                        where students.student_id = $student_id";
                                        $result = $conn->query($sql);
                                        $row = $result->fetch_assoc();
                                ?>
					<td style="vertical-align:top">
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td colspan="6">
                                                <center>
                                                        <h4>LORD'S JEWELS CHRISTIAN SCHOOL INC.<h4>
														<h5>Venus St. San Isidro, Taytay, Rizal<h5>
                                                        <h4>PROGRESS REPORT CARD<h4>
														<h5>School Year 2019 - 2020<h5>
														<br><img src="ps_image.png" width="250"><br>
														<h5><?php echo $row['title']?> Level<h5>
														<h5>LRN:&nbsp;&nbsp; <?php echo $student_id ?><h5>
                                                        <br>
                                                </center>
                                        </td>
                                </tr>	
							
                                <tr><td colspan='3'>Name:&nbsp;&nbsp;<?php echo strtoupper($row['last_name'].", ".$row['first_name']." ".$row['middle_name']) ?></td><td>Sex:&nbsp;&nbsp; <?php echo $row['gender'] ?></td></tr>
                                <tr><td colspan='2'>Grade:&nbsp;&nbsp;<?php echo $row['title']?></td><td>Section:&nbsp;&nbsp;<?php echo $row['name'] ?></td><td>Age:&nbsp;&nbsp; <?php echo $row['age'] ?></td></tr>
							
							<tr>
                                        <td colspan='4'>
                                                
                                                <br><i>&nbsp;&nbsp;Dear Parent, </i><br>
                                            <br><p align = "justify"><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This report card shows the ability and the progress your child has made based on the inside list of goals for achievement desired by the end of the year regarding his/her total personality. However,there is no way for this report to replace parent-teachers conference to arrive at a more complete assessment of your child's progress</i></p><br>
                                            <br><br>
                                        </td>
                                </tr>
								
								<?php
								$sql_log = "SELECT login_authentication.user_id, staff.staff_id, staff.first_name, staff.middle_name, staff.last_name FROM login_authentication left join staff on login_authentication.user_id = staff.staff_id 
								where username = '$_COOKIE[$cName]'";
								
								$result_log = $conn->query($sql_log);
                                $row_log = $result_log->fetch_assoc();
								?>
								
                                <tr><td colspan='2' width='50%'><center>EVANGELINE P. DIZON, Ed.D.</center></td><td colspan='2'><center><?php echo $row_log['first_name'] . SUBSTR($row_log['middle_name'], 0, 1) . "." . "&nbsp;" . $row_log['last_name'] ?></center></td></tr>
                                <tr><td colspan='2'><center>Administrator/Principal</center></td><td colspan='2'><center>Teacher</center></td></tr>
                        </table>
                </td>
        </tr>
</table>
		
		
<?php
													//- - Second Page start here - -
?>	


<br>
<table  style="width:100%"><br><br>
	<tr>
		<td style="width:49%; vertical-align:top">
			<b><i>I. ACADEMIC PROGRESS</i></b>
            <table class="table table-bordered table-condensed" style="font-size:80%">                       
                <tr>
                    <td style="width:50%">Subjects</td><td width='36'>1st</td><td width='36'>2nd</td><td width='36'>3rd</td><td width='36'>4th</td><td align="center">Final Rating</td>
                </tr>
								
					<?php
						$sql_a = "select DISTINCT student_report_card_grades.student_id, student_report_card_grades.course_title, courses.subject_id from student_report_card_grades left join students on student_report_card_grades.student_id = students.student_id left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id left join courses on course_periods.course_id = courses.course_id where student_report_card_grades.student_id = $student_id and student_report_card_grades.marking_period_id IN (15,16,17,18) and (courses.subject_id < 17 or courses.subject_id > 20) order by FIELD(subject_id,1,2,6,3,4,5)";
						
						$result_a = $conn->query($sql_a);
                                
						//first quarter query
						$sql_01a = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                            student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                            from student_report_card_grades
                                            left join students on student_report_card_grades.student_id = students.student_id
                                            left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                            left join courses on course_periods.course_id = courses.course_id
                                            where student_report_card_grades.student_id = $student_id	
											and student_report_card_grades.marking_period_id = 15
                                            and (courses.subject_id < 17 or courses.subject_id > 20)
											order by FIELD(subject_id,8,6,1,15,2,3,4,7,11,5,12,13,16,10,21,17,18,19,14,20,9)";		
											
						$result_01a = $conn->query($sql_01a);								
								
						//second quarter query
						$sql_02a = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                            student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                            from student_report_card_grades
                                            left join students on student_report_card_grades.student_id = students.student_id
                                            left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                            left join courses on course_periods.course_id = courses.course_id
                                            where student_report_card_grades.student_id = $student_id	
											and student_report_card_grades.marking_period_id = 16
                                            and (courses.subject_id < 17 or courses.subject_id > 20)
											order by FIELD(subject_id,8,6,1,15,2,3,4,7,11,5,12,13,16,10,21,17,18,19,14,20,9)";							
						$result_02a = $conn->query($sql_02a);
								
						//third quarter query
						$sql_03a = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                            student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                            from student_report_card_grades
                                            left join students on student_report_card_grades.student_id = students.student_id
                                            left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                            left join courses on course_periods.course_id = courses.course_id
                                            where student_report_card_grades.student_id = $student_id	
											and student_report_card_grades.marking_period_id = 17
                                            and (courses.subject_id < 17 or courses.subject_id > 20)
											order by FIELD(subject_id,8,6,1,15,2,3,4,7,11,5,12,13,16,10,21,17,18,19,14,20,9)";									
						$result_03a = $conn->query($sql_03a);
								
						//fourth quarter query
						$sql_04a = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                            student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                            from student_report_card_grades
                                            left join students on student_report_card_grades.student_id = students.student_id
                                            left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                            left join courses on course_periods.course_id = courses.course_id
                                            where student_report_card_grades.student_id = 536
											and student_report_card_grades.marking_period_id = 18
                                            and (courses.subject_id < 17 or courses.subject_id > 20)
											order by FIELD(subject_id,8,6,1,15,2,3,4,7,11,5,12,13,16,10,21,17,18,19,14,20,9)";	
											
						$result_04a = $conn->query($sql_04a);
														
						if ($result_a->num_rows > 0 ) 
						{                                        										
                            //main subjects fetch								
							while  ( $row_a = $result_a->fetch_assoc()) 
							{ 
								$row_01a = $result_01a->fetch_assoc();
								$row_02a = $result_02a->fetch_assoc();
								$row_03a = $result_03a->fetch_assoc();
								$row_04a = $result_04a->fetch_assoc();
									
								//subjects final grade and remarks filter, displays blank if no data 
								if ( $row_01a > 0 && $row_02a > 0 && $row_03a > 0 && $row_04a > 0 )
								{
									$fg_a[$_fg_counter_a] = round(( $row_01a['grade_letter'] + $row_02a['grade_letter'] + $row_03a['grade_letter'] + $row_04a['grade_letter'])/4);																					
								}	
								else
								{
									$fg_a[$_fg_counter_a] = null;																			
								}										
											
								//display subjects and grades
								echo "<tr>											
										<td>".$row_a['course_title']."</td>
										<td>".$row_01a['grade_letter']."</td>										
										<td>".$row_02a['grade_letter']."</td>
							            <td>".$row_03a['grade_letter']."</td>											 
									    <td>".$row_04a['grade_letter']."</td>
 								        <td>".$fg_a[$_fg_counter_a]."</td> 												
									  </tr>";
										
								//get gen ave total
												
								if ( $row_01a['grade_letter'] > 0 ) 
								{													
								$ga_01 = $ga_01 + $row_01a['grade_letter'];
								$_quar_01a++;
								}
								else{}
												
								if 
								( 
								$row_02a['grade_letter'] > 0 
								) 
								{												
								$ga_02 = $ga_02 + $row_02a['grade_letter'];
								$_quar_02a++;
								}
								else{}
												
								if 
								( 
								$row_03a['grade_letter'] > 0 
								) 
								{
								$ga_03 = $ga_03 + $row_03a['grade_letter'];
								$_quar_03a++;
								}
								else{}
												
								if ( $row_04a['grade_letter'] > 0 ) 
								{
								$ga_04 = $ga_04 + $row_04a['grade_letter'];	
								$_quar_04a++;
								}
								else{}
								$_fg_counter_a++; 
							}									
						}		
						else {}																	   
									
						// get Final Average 
								if ($_quar_01b > 0)
								{			
								$ga_01 = $ga_01/$_quar_01a ;
								}
								elseif( $_quar_01a> 0 ) 
								{ 
								$ga_01 = $ga_01/$_quar_01a;
								} 
								else 
								{ 
								$ga_01 = 0;
								}
										
								if 
								( 
								$_quar_02b > 0 
								)
								{
								$ga_02 = $ga_02 /$_quar_02a ;	
								}
								elseif( $_quar_02a> 0 ) 
								{ 
								$ga_02 = $ga_02/$_quar_02a;
								}	
								else 
								{ 
								$ga_02 = 0;
								}	
										
								if ( $_quar_03b > 0 )
								{							
					   			$ga_03 = $ga_03 /$_quar_03a ;
								}
								elseif( $_quar_03a> 0 ) 
								{ 
								$ga_03 = $ga_03/$_quar_03a;
								}	
								else 
								{ 
								$ga_03 = 0;
								}
										
								if ( $_quar_04b > 0 )
								{
								$ga_04 = $ga_04/$_quar_04a ;
								}
								elseif( $_quar_04a> 0 ) 
								{ 
								$ga_04 = $ga_04/$_quar_04a;
								}	
								else
								{ 
								$ga_04 = 0;
								}						
					?>							                          							
				<tr>
                    <td>General Average</td><td><?php echo number_format($ga_01,2) ?></td><td><?php echo number_format($ga_02,2) ?></td><td><?php echo number_format($ga_03,2) ?></td><td><?php echo number_format($ga_04,2) ?></td><td>&nbsp;</td>
                </tr>
            </table>
			
			
			<table class='table table-bordered table-condensed' style='font-size:80%'><b><i>II. WORK AND STUDY HABITS</b></i>
			<?php
			
				//WORK AND STUDY HABITS data fetch
				$char_build_01_w = "SELECT * from character_building_preschool where marking_period_id = 15 and student_id = $student_id ";			
					$char_result_01_w = $conn->query($char_build_01_w);
			
				$char_build_02_w = "SELECT * from character_building_preschool where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_02_w = $conn->query($char_build_02_w);			

				$char_build_03_w = "SELECT * from character_building_preschool where marking_period_id = 17 and student_id = $student_id ";		
					$char_result_03_w = $conn->query($char_build_03_w);
			
				$char_build_04_w = "SELECT * from character_building_preschool where marking_period_id = 18 and student_id = $student_id ";		
					$char_result_04_w = $conn->query($char_build_04_w);
			
				
			
				if ($char_result_01_w->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_w = $char_result_01_w->fetch_assoc()) 
					{ 
						$char_row_02_w = $char_result_02_w->fetch_assoc();
						$char_row_03_w = $char_result_03_w->fetch_assoc();
						$char_row_04_w = $char_result_04_w->fetch_assoc();			
					}
				}
				else{}
				
				$w_1a = $char_row_01_w['wash_1'];
				$w_1b = $char_row_02_w['wash_1'];
				$w_1c = $char_row_03_w['wash_1'];
				$w_1d = $char_row_04_w['wash_1'];
				
				$w_2a = $char_row_01_w['wash_2'];
				$w_2b = $char_row_02_w['wash_2'];
				$w_2c = $char_row_03_w['wash_2'];
				$w_2d = $char_row_04_w['wash_2'];
				
				$w_3a = $char_row_01_w['wash_3'];
				$w_3b = $char_row_02_w['wash_3'];
				$w_3c = $char_row_03_w['wash_3'];
				$w_3d = $char_row_04_w['wash_3'];
				
				$w_4a = $char_row_01_w['wash_4'];
				$w_4b = $char_row_02_w['wash_4'];
				$w_4c = $char_row_03_w['wash_4'];
				$w_4d = $char_row_04_w['wash_4'];
				
				
				if($w_1a>0 and $w_2a>0 and $w_3a>0 and $w_4a>0 ){
					$w_ave_1 = ( $w_1a + $w_2a +  $w_3a + $w_4a )/4;
				}
				else{
					$w_ave_1 = "";
				}
				
				if($w_1b>0 and $w_2b>0 and $w_3b>0 and $w_4b>0 ){
					$w_ave_2 = ( $w_1b + $w_2b +  $w_3b + $w_4b )/4;
				}
				else{
					$w_ave_2 = "";
				}
			
				if($w_1c>0 and $w_2c>0 and $w_3c>0 and $w_4c>0 ){
					$w_ave_3 = ( $w_1c + $w_2c +  $w_3c + $w_4c )/4;
				}
				else{
					$w_ave_3 = "";
				}
				
				if($w_1d>0 and $w_2d>0 and $w_3d>0 and $w_4d>0 ){
					$w_ave_4 = ( $w_1d + $w_2d + $w_3d + $w_4d)/4;
				}
				else{
					$w_ave_4 = "";
				}
			
			
			
			
				if($w_1a>0 and $w_1b>0 and $w_1c>0 and $w_1d>0 ){
					$w_fr_1 = ( $w_1a + $w_1b +  $w_1c + $w_1d )/4;
				}
				else{
					$w_fr_1 = "";
				}
					
				if($w_2a>0 and $w_2b>0 and $w_2c>0 and $w_2d>0 ){
					$w_fr_2 = ( $w_2a + $w_2b +  $w_2c + $w_2d )/4;
				}
				else{
					$w_fr_2 = "";
				}
				
				if($w_3a>0 and $w_3b>0 and $w_3c>0 and $w_3d>0 ){
					$w_fr_3 = ( $w_3a + $w_3b +  $w_3c + $w_3d )/4;
				}
				else{
					$w_fr_3 = "";
				}
				
				if($w_4a>0 and $w_4b>0 and $w_4c>0 and $w_4d>0 ){
					$w_fr_4 = ( $w_4a + $w_4b +  $w_4c + $w_4d )/4;
				}
				else{					
					$w_fr_4 = "";
				}
				
				if($w_fr_1>0 and $w_fr_2>0 and $w_fr_3>0 and $w_fr_4>0){
					$w_fr_ave = ( $w_fr_1 + $w_fr_2 + $w_fr_3 + $w_fr_4 )/4;
				}
				else{
					$w_fr_ave ="";
				}
				
				echo 	"<tr>
								<td>Follows direction carefully</td><td align='center' width='30'>". letter_grade($w_1a)."</td><td align='center' width='30'>".letter_grade($w_1b)."</td><td align='center' width='30'>". letter_grade($w_1c)."</td><td align='center' width='30'>". letter_grade($w_1d)."</td><td align='center' width='30'>". letter_grade($w_fr_1)."</td>
							</tr> 
							<tr>
								<td>Completes assigned task accurately and independently</td><td align='center'>". letter_grade($w_2a)."</td><td align='center'>".letter_grade($w_2b)."</td><td align='center'>". letter_grade($w_2c)."</td><td align='center'>". letter_grade($w_2d)."</td><td align='center'>". letter_grade($w_fr_2)."</td>
							</tr>
							<tr>
								<td>Works well alone</td><td align='center'>". letter_grade($w_3a)."</td><td align='center'>".letter_grade($w_3b)."</td><td align='center'>". letter_grade($w_3c)."</td><td align='center'>". letter_grade($w_3d)."</td><td align='center'>". letter_grade($w_fr_3)."</td>
							</tr>
							<tr>
								<td>Demonstrates proper attitude towards work</td><td align='center'>". letter_grade($w_4a)."</td><td align='center'>".letter_grade($w_4b)."</td><td align='center'>". letter_grade($w_4c)."</td><td align='center'>". letter_grade($w_4d)."</td><td align='center'>". letter_grade($w_fr_4)."</td>
							</tr> 	
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($w_ave_1)."</td><td align='center'>".letter_grade($w_ave_2)."</td><td align='center'>". letter_grade($w_ave_3)."</td><td align='center'>". letter_grade($w_ave_4)."</td><td align='center'>". letter_grade($w_fr_ave)."</td>
							</tr>";							
			?>
			</tr></table>
		
			<table class='table table-bordered table-condensed' style='font-size:80%'><b><i>III. SOCIAL SKILLS</b></i>
			<?php
			
				//social skills data fetch
				$char_build_01_ss = "SELECT * from character_building_preschool where marking_period_id = 15 and student_id = $student_id ";			
					$char_result_01_ss = $conn->query($char_build_01_ss);
			
				$char_build_02_ss = "SELECT * from character_building_preschool where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_02_ss = $conn->query($char_build_02_ss);			

				$char_build_03_ss = "SELECT * from character_building_preschool where marking_period_id = 17 and student_id = $student_id ";		
					$char_result_03_ss = $conn->query($char_build_03_ss);
			
				$char_build_04_ss = "SELECT * from character_building_preschool where marking_period_id = 18 and student_id = $student_id ";		
					$char_result_04_ss = $conn->query($char_build_04_ss);
			
				
				if ($char_result_01_ss->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_ss = $char_result_01_ss->fetch_assoc()) 
					{ 
						$char_row_02_ss = $char_result_02_ss->fetch_assoc();
						$char_row_03_ss = $char_result_03_ss->fetch_assoc();
						$char_row_04_ss = $char_result_04_ss->fetch_assoc();	
					}
				}
				else{}
				
				$ss_1a = $char_row_01_ss['ss_1'];
				$ss_1b = $char_row_02_ss['ss_1'];
				$ss_1c = $char_row_03_ss['ss_1'];
				$ss_1d = $char_row_04_ss['ss_1'];
				
				$ss_2a = $char_row_01_ss['ss_2'];
				$ss_2b = $char_row_02_ss['ss_2'];
				$ss_2c = $char_row_03_ss['ss_2'];
				$ss_2d = $char_row_04_ss['ss_2'];
				
				$ss_3a = $char_row_01_ss['ss_3'];
				$ss_3b = $char_row_02_ss['ss_3'];
				$ss_3c = $char_row_03_ss['ss_3'];
				$ss_3d = $char_row_04_ss['ss_3'];
				
				$ss_4a = $char_row_01_ss['ss_4'];
				$ss_4b = $char_row_02_ss['ss_4'];
				$ss_4c = $char_row_03_ss['ss_4'];
				$ss_4d = $char_row_04_ss['ss_4'];
				
				$ss_5a = $char_row_01_ss['ss_5'];
				$ss_5b = $char_row_02_ss['ss_5'];
				$ss_5c = $char_row_03_ss['ss_5'];
				$ss_5d = $char_row_04_ss['ss_5'];
				
				if($ss_1a>0 and $ss_2a>0 and $ss_3a>0 and $ss_4a>0 and $ss_5a>0 ){
					$ss_ave_1 = ( $ss_1a + $ss_2a +  $ss_3a + $char_row_01_ss['ss_4'] + $ss_5a )/5;
				}
				else{
					$ss_ave_1 = "";
				}
				
				if($ss_1b>0 and $ss_2b>0 and $ss_3b>0 and $ss_4b>0 and $ss_5b>0 ){
					$ss_ave_2 = ( $ss_1b + $ss_2b +  $ss_3b + $ss_4b + $ss_5b )/5;
				}
				else{
					$ss_ave_2 = "";
				}
			
				if($ss_1c>0 and $ss_2c>0 and $ss_3c>0 and $ss_4c>0  and $ss_5c>0 ){
					$ss_ave_3 = ( $ss_1c + $ss_2c +  $ss_3c + $ss_4c + $ss_5c )/5;
				}
				else{
					$ss_ave_3 = "";
				}
				
				if($ss_1d>0 and $ss_2d>0 and $ss_3d>0 and $ss_4d>0 and $ss_5d>0 ){
					$ss_ave_4 = ( $ss_1d + $ss_2d +  $ss_3d + $ss_4d + $ss_5d )/5;
				}
				else{
					$ss_ave_4 = "";
				}
			
			
			
			
				if($ss_1a>0 and $ss_1b>0 and $ss_1c>0 and $ss_1d>0 ){
					$ss_fr_1 = ( $ss_1a + $ss_1b +  $ss_1c + $ss_1d )/4;
				}
				else{
					$ss_fr_1 = "";
				}
					
				if($ss_2a>0 and $ss_2b>0 and $ss_2c>0 and $ss_2d>0 ){
					$ss_fr_2 = ( $ss_2a + $ss_2b +  $ss_2c + $ss_2d )/4;
				}
				else{
					$ss_fr_2 = "";
				}
				
				if($ss_3a>0 and $ss_3b>0 and $ss_3c>0 and $ss_3d>0 ){
					$ss_fr_3 = ( $ss_3a + $ss_3b +  $ss_3c + $ss_3d )/4;
				}
				else{
					$ss_fr_3 = "";
				}
				
				if($ss_4a>0 and $ss_4b>0 and $ss_4c>0 and $ss_4d>0 ){
					$ss_fr_4 = ( $ss_4a + $ss_4b +  $ss_4c + $ss_4d )/4;
				}
				else{					
					$ss_fr_4 = "";
				}
				if($ss_5a>0 and $ss_5b>0 and $ss_5c>0 and $ss_5d>0 ){
					$ss_fr_5 = ( $ss_5a + $ss_5b +  $ss_5c + $ss_5d )/4;
				}
				else{					
					$ss_fr_5 = "";
				}
				
				if($ss_fr_1>0 and $ss_fr_2>0 and $ss_fr_3>0 and $ss_fr_4>0  and $ss_fr_5>0 ){
					$ss_fr_ave = ( $ss_fr_1 + $ss_fr_2 + $ss_fr_3 + $ss_fr_4  + $ss_fr_5 )/5;
				}
				else{
					$ss_fr_ave ="";
				}
					echo 	"<tr>
								<td>Shows respect for property and rights of others</td><td align='center' width='30'>". letter_grade($ss_1a)."</td><td align='center' width='30'>". letter_grade($ss_1b)."</td><td align='center' width='30'>". letter_grade($ss_1c)."</td><td align='center' width='30'>". letter_grade($ss_1d)."</td><td align='center' width='30'>". letter_grade($ss_fr_1)."</td>
							</tr>
							<tr>
								<td>Shares talent and resources generously with others</td><td align='center'>". letter_grade($ss_2a)."</td><td align='center'>". letter_grade($ss_2b)."</td><td align='center'>". letter_grade($ss_2c)."</td><td align='center'>". letter_grade($ss_2d)."</td><td align='center'>". letter_grade($ss_fr_2)."</td>
							</tr>
							<tr>
								<td>Practices honesty</td><td align='center'>". letter_grade($ss_3a)."</td><td align='center'>". letter_grade($ss_3b)."</td><td align='center'>". letter_grade($ss_3c)."</td><td align='center'>". letter_grade($ss_3d)."</td><td align='center'>". letter_grade($ss_fr_3)."</td>
							</tr>
							<tr>
								<td>Demonstrates responsible obidience and courtesy</td><td align='center'>". letter_grade($ss_4a)."</td><td align='center'>". letter_grade($ss_4b)."</td><td align='center'>". letter_grade($ss_4c)."</td><td align='center'>". letter_grade($ss_4d)."</td><td align='center'>". letter_grade($ss_fr_4)."</td>
							</tr>
							<tr>
								<td>Works and plays well with others</td><td align='center'>". letter_grade($ss_5a)."</td><td align='center'>". letter_grade($ss_5b)."</td><td align='center'>". letter_grade($ss_5c)."</td><td align='center'>". letter_grade($ss_5d)."</td><td align='center'>". letter_grade($ss_fr_5)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($ss_ave_1)."</td><td align='center'>". letter_grade($ss_ave_2)."</td><td align='center'>". letter_grade($ss_ave_3)."</td><td align='center'>". letter_grade($ss_ave_4)."</td><td align='center'>". letter_grade($ss_fr_ave)."</td>
							</tr>";								
			?>
			</tr></table>
			
					<table class="table table-bordered table-condensed" style="font-size:80%">
					<tr>
					<td colspan='6'><b>LEGEND</td>
					</tr>
					<tr>
					<td><b><i>O</td><td><i>Outstanding</td><td><b><i>93-100</td><td><b><i>MS</td><td><i>Moderately Satisfactory</td><td><b><i>75-80</td>
					</tr>
					<tr>
					<td><b><i>VS</td><td><i>Very Satisfactory</td><td><b><i>87-92</td><td><b><i>NI</td><td><i>Needs Improvement</td><td><b><i>Below 75</td>
					</tr>
					<tr>
					<td><b><i>S</td><td><i>Satisfactory</td><td><b><i>81-86</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
					</tr>
					</table>
		</td>
		<td style="width:2%">
            &nbsp;
        </td>	
		<td style='vertical-align:top'>		
		<table class='table table-bordered table-condensed' style='font-size:80%'><b><i>IV. MOTOR SKILLS</b></i>
			<?php
			
				//motor skills data fetch
				$char_build_01_ms = "SELECT * from character_building_preschool where marking_period_id = 15 and student_id = $student_id ";			
					$char_result_01_ms = $conn->query($char_build_01_ms);
			
				$char_build_02_ms = "SELECT * from character_building_preschool where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_02_ms = $conn->query($char_build_02_ms);			

				$char_build_03_ms = "SELECT * from character_building_preschool where marking_period_id = 17 and student_id = $student_id ";		
					$char_result_03_ms = $conn->query($char_build_03_ms);
			
				$char_build_04_ms = "SELECT * from character_building_preschool where marking_period_id = 18 and student_id = $student_id ";		
					$char_result_04_ms = $conn->query($char_build_04_ms);
			
				if ($char_result_01_ms->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_ms = $char_result_01_ms->fetch_assoc()) 
					{ 
						$char_row_02_ms = $char_result_02_ms->fetch_assoc();
						$char_row_03_ms = $char_result_03_ms->fetch_assoc();
						$char_row_04_ms = $char_result_04_ms->fetch_assoc();
					}
				}
				else{}
				
				$ms_1a = $char_row_01_ms['ms_1'];
				$ms_1b = $char_row_02_ms['ms_1'];
				$ms_1c = $char_row_03_ms['ms_1'];
				$ms_1d = $char_row_04_ms['ms_1'];
				
				$ms_2a = $char_row_01_ms['ms_2'];
				$ms_2b = $char_row_02_ms['ms_2'];
				$ms_2c = $char_row_03_ms['ms_2'];
				$ms_2d = $char_row_04_ms['ms_2'];
				
				$ms_3a = $char_row_01_ms['ms_3'];
				$ms_3b = $char_row_02_ms['ms_3'];
				$ms_3c = $char_row_03_ms['ms_3'];
				$ms_3d = $char_row_04_ms['ms_3'];
				
				$ms_4a = $char_row_01_ms['ms_4'];
				$ms_4b = $char_row_02_ms['ms_4'];
				$ms_4c = $char_row_03_ms['ms_4'];
				$ms_4d = $char_row_04_ms['ms_4'];
				
				$ms_5a = $char_row_01_ms['ms_5'];
				$ms_5b = $char_row_02_ms['ms_5'];
				$ms_5c = $char_row_03_ms['ms_5'];
				$ms_5d = $char_row_04_ms['ms_5'];
				
				$ms_6a = $char_row_01_ms['ms_6'];
				$ms_6b = $char_row_02_ms['ms_6'];
				$ms_6c = $char_row_03_ms['ms_6'];
				$ms_6d = $char_row_04_ms['ms_6'];
				
				$ms_7a = $char_row_01_ms['ms_7'];
				$ms_7b = $char_row_02_ms['ms_7'];
				$ms_7c = $char_row_03_ms['ms_7'];
				$ms_7d = $char_row_04_ms['ms_7'];
				
				$ms_8a = $char_row_01_ms['ms_8'];
				$ms_8b = $char_row_02_ms['ms_8'];
				$ms_8c = $char_row_03_ms['ms_8'];
				$ms_8d = $char_row_04_ms['ms_8'];
				
				if($ms_1a>0 and $ms_2a>0 and $ms_3a>0 and $ms_4a>0 and $ms_5a>0  and $ms_6a>0 and $ms_7a>0 and $ms_8a>0 ){
					$ms_ave_1 = ( $ms_1a + $ms_2a + $ms_3a + $ms_4a + $ms_5a  +  $ms_6a + $ms_7a + $ms_8a )/8;
				}
				else{
					$ms_ave_1 = "";
				}
				
				if($ms_1b>0 and $ms_2b>0 and $ms_3b>0 and $ms_4b>0 and $ms_5b>0  and $ms_6b>0 and $ms_7b>0 and $ms_8b>0 ){
					$ms_ave_2 = ( $ms_1b + $ms_2b +  $ms_3b + $ms_4b + $ms_5b  +  $ms_6b + $ms_7b + $ms_8b )/8;
				}
				else{
					$ms_ave_2 = "";
				}
			
				if($ms_1c>0 and $ms_2c>0 and $ms_3c>0 and $ms_4c>0 and $ms_5c>0  and $ms_6c>0 and $ms_7c>0 and $ms_8c>0 ){
					$ms_ave_3 = ( $ms_1c + $ms_2c + $ms_3c + $ms_4c + $ms_5c  + $ms_6c + $ms_7c + $ms_8c )/8;
				}
				else{
					$ms_ave_3 = "";
				}
				
				if($ms_1d>0 and $ms_2d>0 and $ms_3d>0 and $ms_4d>0 and $ms_5d>0  and $ms_6d>0 and $ms_7d>0 and $ms_8d>0 ){
					$ms_ave_4 = ( $ms_1d + $ms_2d +  $ms_3d + $ms_4d + $ms_5d  +  $ms_6d + $ms_7d + $ms_8d )/8;
				}
				else{
					$ms_ave_4 = "";
				}
			
			
			
			
				if($ms_1a>0 and $ms_1b>0 and $ms_1c>0 and $ms_1d>0 ){
					$ms_fr_1 = ( $ms_1a + $ms_1b +  $ms_1c + $ms_1d )/4;
				}
				else{
					$ms_fr_1 = "";
				}
					
				if($ms_2a>0 and $ms_2b>0 and $ms_2c>0 and $ms_2d>0 ){
					$ms_fr_2 = ( $ms_2a + $ms_2b +  $ms_2c + $ms_2d )/4;
				}
				else{
					$ms_fr_2 = "";
				}
				
				if($ms_3a>0 and $ms_3b>0 and $ms_3c>0 and $ms_3d>0 ){
					$ms_fr_3 = ( $ms_3a + $ms_3b +  $ms_3c + $ms_3d )/4;
				}
				else{
					$ms_fr_3 = "";
				}
				
				if($ms_4a>0 and ms_4b>0 and $ms_4c>0 and $ms_4d>0 ){
					$ms_fr_4 = ( $ms_4a + ms_4b +  $ms_4c + $ms_4d )/4;
				}
				else{					
					$ms_fr_4 = "";
				}
				if($ms_5a>0 and $ms_5b>0 and $ms_5c>0 and $ms_5d>0 ){
					$ms_fr_5 = ( $ms_5a + $ms_5b +  $ms_5c + $ms_5d )/4;
				}
				else{					
					$ms_fr_5 = "";
				}
				if($ms_6a>0 and $ms_6b>0 and $ms_6c>0 and $ms_6d>0 ){
					$ms_fr_6 = ( $ms_6a + $ms_6b +  $ms_6c + $ms_6d )/4;
				}
				else{					
					$ms_fr_6 = "";
				}if($ms_7a>0 and $ms_7b>0 and $ms_7c>0 and $ms_7d>0 ){
					$ms_fr_7 = ( $ms_7a + $ms_7b +  $ms_7c + $ms_7d )/4;
				}
				else{					
					$ms_fr_7 = "";
				}if($ms_8a>0 and $ms_8b>0 and $ms_8c>0 and $ms_8d>0 ){
					$ms_fr_8 = ( $ms_8a + $ms_8b +  $ms_8c + $ms_8d )/4;
				}
				else{					
					$ms_fr_8 = "";
				}
				
				
				if($ms_fr_1>0 and $ms_fr_2>0 and $ms_fr_3>0 and $ms_fr_4>0  and $ms_fr_5>0 and $ms_fr_6>0 and $ms_fr_7>0  and $ms_fr_8>0){
					$ms_fr_ave = ( $ms_fr_1 + $ms_fr_2 + $ms_fr_3 + $ms_fr_4 + $ms_fr_5 + $ms_fr_6 + $ms_fr_7  + $ms_fr_8 )/8;
				}
				else{
					$ms_fr_ave ="";
				}
				
				
					echo 	"<tr>
								<td>Writes letters of the alphabet in manuscript form</td><td align='center' width='30'>". letter_grade($ms_1a)."</td><td align='center' width='30'>". letter_grade($ms_1b)."</td><td align='center' width='30'>". letter_grade($ms_1c)."</td><td align='center' width='30'>". letter_grade($ms_1d)."</td><td align='center' width='30'>". letter_grade($ms_fr_1)."</td>
							</tr>
							<tr>
								<td>Copies simple words, phrases and sentences</td><td align='center'>". letter_grade($ms_2a)."</td><td align='center'>". letter_grade($ms_2b)."</td><td align='center'>". letter_grade($ms_2c)."</td><td align='center'>". letter_grade($ms_2d)."</td><td align='center'>". letter_grade($ms_fr_2)."</td>
							</tr>
							<tr>
								<td>Colors within the lines</td><td align='center'>". letter_grade($ms_3a)."</td><td align='center'>". letter_grade($ms_3b)."</td><td align='center'>". letter_grade($ms_3c)."</td><td align='center'>". letter_grade($ms_3d)."</td><td align='center'>". letter_grade($ms_fr_3)."</td>
							</tr>
							<tr>
								<td>Handles art materials correctly and properly</td><td align='center'>". letter_grade($ms_4a)."</td><td align='center'>". letter_grade($ms_4b)."</td><td align='center'>". letter_grade($ms_4c)."</td><td align='center'>". letter_grade($ms_4d)."</td><td align='center'>". letter_grade($ms_fr_4)."</td>
							</tr>
							<tr>
								<td>Handles scissors well</td><td align='center'>". letter_grade($ms_5a)."</td><td align='center'>". letter_grade($ms_5b)."</td><td align='center'>". letter_grade($ms_5c)."</td><td align='center'>". letter_grade($ms_5d)."</td><td align='center'>". letter_grade($ms_fr_5)."</td>
							</tr>
							<tr>
								<td>Claps and marches in time with music</td><td align='center'>". letter_grade($ms_6a)."</td><td align='center'>". letter_grade($ms_6b)."</td><td align='center'>". letter_grade($ms_6c)."</td><td align='center'>". letter_grade($ms_6d)."</td><td align='center'>". letter_grade($ms_fr_6)."</td>
							</tr><tr>
								<td>Able to run, jump, hop and skip</td><td align='center'>". letter_grade($ms_7a)."</td><td align='center'>". letter_grade($ms_7b)."</td><td align='center'>". letter_grade($ms_7c)."</td><td align='center'>". letter_grade($ms_7d)."</td><td align='center'>". letter_grade($ms_fr_7)."</td>
							</tr><tr>
								<td>Able to throw and catch a ball</td><td align='center'>". letter_grade($ms_8a)."</td><td align='center'>". letter_grade($ms_8b)."</td><td align='center'>". letter_grade($ms_8c)."</td><td align='center'>". letter_grade($ms_8d)."</td><td align='center'>". letter_grade($ms_fr_8)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($ms_ave_1)."</td><td align='center'>". letter_grade($ms_ave_2)."</td><td align='center'>". letter_grade($ms_ave_3)."</td><td align='center'>". letter_grade($ms_ave_4)."</td><td align='center'>". letter_grade($ms_fr_ave)."</td>
							</tr>";								
			?>
			</tr></table>
		<table class='table table-bordered table-condensed' style='font-size:80%'><b><i>V. SPIRITUAL PERFORMANCE</b></i>
			<?php
			
				//spiritual performance data fetch
				$char_build_01_sp = "SELECT * from character_building_preschool where marking_period_id = 15 and student_id = $student_id ";			
					$char_result_01_sp = $conn->query($char_build_01_sp);
			
				$char_build_02_sp = "SELECT * from character_building_preschool where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_02_sp = $conn->query($char_build_02_sp);			

				$char_build_03_sp = "SELECT * from character_building_preschool where marking_period_id = 17 and student_id = $student_id ";		
					$char_result_03_sp = $conn->query($char_build_03_sp);
			
				$char_build_04_sp = "SELECT * from character_building_preschool where marking_period_id = 18 and student_id = $student_id ";		
					$char_result_04_sp = $conn->query($char_build_04_sp);
			
				$char_build_05_sp = "SELECT * from character_building_preschool where marking_period_id = 18 and student_id = $student_id ";	
					$char_result_05_sp = $conn->query($char_build_05_sp);
				
				if ($char_result_01_sp->num_rows > 0 ) 
				{                                        										
					//fetch 
									
					while  ( $char_row_01_sp = $char_result_01_sp->fetch_assoc()) 
					{ 
						$char_row_02_sp = $char_result_02_sp->fetch_assoc();
						$char_row_03_sp = $char_result_03_sp->fetch_assoc();
						$char_row_04_sp = $char_result_04_sp->fetch_assoc();
					}					
				}	
				else{}
				
				$sp_1a = $char_row_01_sp['sp_1'];
				$sp_1b = $char_row_02_sp['sp_1'];
				$sp_1c = $char_row_03_sp['sp_1'];
				$sp_1d = $char_row_04_sp['sp_1'];
				
				$sp_2a = $char_row_01_sp['sp_2'];
				$sp_2b = $char_row_02_sp['sp_2'];
				$sp_2c = $char_row_03_sp['sp_2'];
				$sp_2d = $char_row_04_sp['sp_2'];
				
				$sp_3a = $char_row_01_sp['sp_3'];
				$sp_3b = $char_row_02_sp['sp_3'];
				$sp_3c = $char_row_03_sp['sp_3'];
				$sp_3d = $char_row_04_sp['sp_3'];
				
				$sp_4a = $char_row_01_sp['sp_4'];
				$sp_4b = $char_row_02_sp['sp_4'];
				$sp_4c = $char_row_03_sp['sp_4'];
				$sp_4d = $char_row_04_sp['sp_4'];
				
				if($sp_1a>0 and $sp_2a>0 and $sp_3a>0 and $sp_4a>0){
					$sp_ave_1 = ( $sp_1a + $sp_2a +  $sp_3a + $sp_4a )/4;
				}
				else{
					$sp_ave_1 = "";
				}
				if($sp_1b>0 and $sp_2b>0 and $sp_3b>0 and $sp_4b>0){
					$sp_ave_2 = ( $sp_1b + $sp_2b +  $sp_3b + $sp_4b )/4;
				}
				else{
					$sp_ave_2 = "";
				}
				if($sp_1c>0 and $sp_2c>0 and $sp_3c>0 and $sp_4c>0){
					$sp_ave_3 = ( $sp_1c + $sp_2c +  $sp_3c + $sp_4c )/4;
				}
				else{
					$sp_ave_3 = "";
				}
				if($sp_1d>0 and $sp_2d>0 and $sp_3d>0 and $sp_4d>0){
					$sp_ave_4 = ( $sp_1d + $sp_2d +  $sp_3d + $sp_4d )/4;
				}
				else{
					$sp_ave_4 = "";
				}
				
				if($sp_1a>0 and $sp_1b>0 and $sp_1c>0 and $sp_1d>0 ){
					$sp_fr_1 = ( $sp_1a + $sp_1b +  $sp_1c + $sp_1d )/4;
				}
				else{
					$sp_fr_1 = "";
				}
					
				if($sp_2a>0 and $sp_2b>0 and $sp_2c>0 and $sp_2d>0 ){
					$sp_fr_2 = ( $sp_2a + $sp_2b +  $sp_2c + $sp_2d )/4;
				}
				else{
					$sp_fr_2 = "";
				}
				
				if($sp_3a>0 and $sp_3b>0 and $sp_3c>0 and $sp_3d>0 ){
					$sp_fr_3 = ( $sp_3a + $sp_3b +  $sp_3c + $sp_3d )/4;
				}
				else{
					$sp_fr_3 = "";
				}
				
				if($sp_4a>0 and $sp_4b>0 and $sp_4c>0 and $sp_4d>0 ){
					$sp_fr_4 = ( $sp_4a + $sp_4b +  $sp_4c + $sp_4d )/4;
				}
				else{					
					$sp_fr_4 = "";
				}
				
				if($sp_fr_1>0 and $sp_fr_2>0 and $sp_fr_3>0 and $sp_fr_4>0){
					$sp_fr_ave = ( $sp_fr_1 + $sp_fr_2 + $sp_fr_3 + $sp_fr_4 )/4;
				}
				else{
					$sp_fr_ave ="";
				}
				
					echo 	"<tr>
								<td>Able to sing praises to God</td><td align='center' width='30'>".letter_grade($sp_1a)."</td><td align='center' width='30'>".letter_grade($sp_1b)."</td><td align='center' width='30'>". letter_grade($sp_1c)."</td><td align='center' width='30'>". letter_grade($sp_1d)."</td><td align='center' width='30'>". letter_grade($sp_fr_1)."</td>
							</tr>
							<tr>
								<td>Says simple prayers</td><td align='center'>". letter_grade($sp_2a)."</td><td align='center'>". letter_grade($sp_2b)."</td><td align='center'>". letter_grade($sp_2c)."</td><td align='center'>". letter_grade($sp_2d)."</td><td align='center'>". letter_grade($sp_fr_2)."</td>
							</tr>
							<tr>
								<td>Recalls and understands some bible stories</td><td align='center'>". letter_grade($sp_3a)."</td><td align='center'>". letter_grade($sp_3b)."</td><td align='center'>". letter_grade($sp_3c)."</td><td align='center'>". letter_grade($sp_3d)."</td><td align='center'>". letter_grade($sp_fr_3)."</td>
							</tr>
							<tr>
								<td>Recites memory verses</td><td align='center'>". letter_grade($sp_4a)."</td><td align='center'>". letter_grade($sp_4b)."</td><td align='center'>". letter_grade($sp_4c)."</td><td align='center'>". letter_grade($sp_4d)."</td><td align='center'>". letter_grade($sp_fr_4)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($sp_ave_1)."</td><td align='center'>". letter_grade($sp_ave_2)."</td><td align='center'>". letter_grade($sp_ave_3)."</td><td align='center'>". letter_grade($sp_ave_4)."</td><td align='center'>". letter_grade($sp_fr_ave)."</td>
							</tr>";									
			?>
			</tr></table>
			
			<table class="table table-bordered table-condensed" style="font-size:80%">
                            <tr>
                                    <td colspan="13"><center><b>ATTENDANCE RECORD</b></center></td>
                            </tr>
                            <tr>
                                    <td>Month</td><td>J</td><td>J</td><td>A</td><td>S</td><td>O</td><td>N</td><td>D</td><td>J</td><td>F</td><td>M</td><td>A</td><td>Total</td>
                            </tr>
								<?php 
									$sql_c = "select date_format(school_date, '%b') as months, count(school_date) as days from attendance_calendar group by months";
									$result_c = $conn->query($sql_c);
								
									if ($result_c->num_rows > 0) 
									{                                    
										while($row_c = $result_c->fetch_assoc()) 
										{										
											$days_school[$_days_counter_a] = $row_c['days'];
											$days_school_total = $days_school_total + $days_school[$_days_counter_a];
											$_days_counter_a++;
										}									
									}								
								?>							
                            <tr>
                                    <td>Days of School</td><td><?php echo $days_school[6] ?></td><td><?php echo $days_school[5] ?></td><td><?php echo $days_school[1] ?></td><td><?php echo $days_school[10] ?></td><td><?php echo $days_school[9] ?></td><td><?php echo $days_school[8] ?></td><td><?php echo $days_school[2] ?></td><td><?php echo $days_school[4] ?></td><td><?php echo $days_school[3] ?></td><td><?php echo $days_school[7] ?></td><td><?php echo $days_school[0] ?></td><td><?php echo $days_school_total ?></td>
                            </tr>								
                            <?php 
									$sql_d = "select date_format(school_date, '%b') as months, count(school_date) as days FROM attendance_day where student_id = $student_id and state_value = 1 GROUP BY months";
									$result_d = $conn->query($sql_d);
								
									if ($result_d->num_rows > 0) 
									{                                    
										while($row_d = $result_d->fetch_assoc()) 
										{
											$m_pres = $row_d['months'];
											
											switch ( $m_pres ){
													case "Jan":													
													$m_jan_pres = $m_jan_pres + $row_d['days'];														
													break;
													case "Feb":
													$m_feb_pres = $m_feb_pres + $row_d['days'];
													break;
													case "Mar":
													$m_mar_pres = $m_mar_pres + $row_d['days'];
													break;
													case "Apr":
													$m_apr_pres = $m_apr_pres + $row_d['days'];
													break;
													case "Jun":
													$m_jun_pres = $m_jun_pres + $row_d['days'];
													break;
													case "Jul":
													$m_jul_pres = $m_jul_pres + $row_d['days'];
													break;
													case "Aug":
													$m_aug_pres = $m_aug_pres + $row_d['days'];
													break;
													case "Sep":
													$m_sep_pres = $m_sep_pres + $row_d['days'];
													break;
													case "Oct":
													$m_oct_pres = $m_oct_pres + $row_d['days'];
													break;
													case "Nov":
													$m_nov_pres = $m_nov_pres + $row_d['days'];
													break;
													case "Dec":
													$month_dec_pres = $month_dec_pres + $row_d['days'];
													break;
													default:
													break;
											}										
										}
								}		

								$m_pres_total = $m_jan_pres + $m_feb_pres + $m_mar_pres + $m_apr_pres + $m_jun_pres + $m_jul_pres + $m_aug_pres + $m_sep_pres + $m_oct_pres + $m_nov_pres + $m_dec_pres;
								?>	
                            <tr>
                                    <td>Days Present</td><td><?php echo $m_jun_pres; ?></td><td><?php echo $m_jul_pres; ?></td><td><?php echo $m_aug_pres; ?></td><td><?php echo $m_sep_pres; ?></td><td><?php echo $m_oct_pres; ?></td><td><?php echo $m_nov_pres; ?></td><td><?php echo $m_dec_pres; ?></td><td><?php echo $m_jan_pres; ?></td><td><?php echo $m_feb_pres; ?></td><td><?php echo $m_mar_pres; ?></td><td><?php echo $m_apr_pres; ?></td><td><?php echo $m_pres_total; ?></td>
                            </tr>
							<?php 
									$sql_e = "select date_format(school_date, '%b') as months, count(school_date) as days FROM attendance_day where student_id = $student_id and state_value = 0 GROUP BY months";
									$result_e = $conn->query($sql_e);
								
									if ($result_e->num_rows > 0) 
									{                                    
										while($row_e = $result_e->fetch_assoc()) 
										{
											$m_abs = $row_e['months'];
											
											switch ( $m_abs ){
													case "Jan":													
													$m_jan_abs = $m_jan_abs + $row_e['days'];														
													break;
													case "Feb":
													$m_feb_abs = $m_feb_abs + $row_e['days'];
													break;
													case "Mar":
													$m_mar_abs = $m_mar_abs + $row_e['days'];
													break;
													case "Apr":
													$m_apr_abs = $m_apr_abs + $row_e['days'];
													break;
													case "Jun":
													$m_jun_abs = $m_jun_abs + $row_e['days'];
													break;
													case "Jul":
													$m_jul_abs = $m_jul_abs + $row_e['days'];
													break;
													case "Aug":
													$m_aug_abs = $m_aug_abs + $row_e['days'];
													break;
													case "Sep":
													$m_sep_abs = $m_sep_abs + $row_e['days'];
													break;
													case "Oct":
													$m_oct_abs = $m_oct_abs + $row_e['days'];
													break;
													case "Nov":
													$m_nov_abs = $m_nov_abs + $row_e['days'];
													break;
													case "Dec":
													$month_dec_abs = $month_dec_abs + $row_e['days'];
													break;
													default:
													break;
											}
									}
								}		

								$m_abs_total = $m_jan_abs + $m_feb_abs + $m_mar_abs + $m_apr_abs + $m_jun_abs + $m_jul_abs + $m_aug_abs + $m_sep_abs + $m_oct_abs + $m_nov_abs + $m_dec_abs;
								?>	
                            <tr>
                                    <td>Days Absent</td><td><?php echo $m_jun_abs; ?></td><td><?php echo $m_jul_abs; ?></td><td><?php echo $m_aug_abs; ?></td><td><?php echo $m_sep_abs; ?></td><td><?php echo $m_oct_abs; ?></td><td><?php echo $m_nov_abs; ?></td><td><?php echo $m_dec_abs; ?></td><td><?php echo $m_jan_abs; ?></td><td><?php echo $m_feb_abs; ?></td><td><?php echo $m_mar_abs; ?></td><td><?php echo $m_apr_abs; ?></td><td><?php echo $m_abs_total; ?></td>
                            </tr>
							<?php 
									$sql_f = "select date_format(school_date, '%b') as months, count(school_date) as days from attendance_period where student_id = $student_id and attendance_code = 4 GROUP BY months";
									$result_f = $conn->query($sql_f);
								
									if ($result_f->num_rows > 0) 
									{                                    
										while($row_f = $result_f->fetch_assoc()) 
										{
											$m_tar = $row_f['months'];
											
											switch ( $m_tar ){
													case "Jan":													
													$m_jan_tar = $m_jan_tar + $row_f['days'];														
													break;
													case "Feb":
													$m_feb_tar = $m_feb_tar + $row_f['days'];
													break;
													case "Mar":
													$m_mar_tar = $m_mar_tar + $row_f['days'];
													break;
													case "Apr":
													$m_apr_tar = $m_apr_tar + $row_f['days'];
													break;
													case "Jun":
													$m_jun_tar = $m_jun_tar + $row_f['days'];
													break;
													case "Jul":
													$m_jul_tar = $m_jul_tar + $row_f['days'];
													break;
													case "Aug":
													$m_aug_tar = $m_aug_tar + $row_f['days'];
													break;
													case "Sep":
													$m_sep_tar = $m_sep_tar + $row_f['days'];
													break;
													case "Oct":
													$m_oct_tar = $m_oct_tar + $row_f['days'];
													break;
													case "Nov":
													$m_nov_tar = $m_nov_tar + $row_f['days'];
													break;
													case "Dec":
													$m_dec_tar = $m_dec_tar + $row_f['days'];
													break;
													default:
													break;
											}
									}
								}		

								$m_tar_total = $m_jan_tar + $m_feb_tar + $m_mar_tar + $m_apr_tar + $m_jun_tar + $m_jul_tar + $m_aug_tar + $m_sep_tar + $m_oct_tar + $m_nov_tar + $m_dec_tar;
								?>	
                            <tr>
                                    <td>Days Tardy</td><td><?php echo $m_jun_tar; ?></td><td><?php echo $m_jul_tar; ?></td><td><?php echo $m_aug_tar; ?></td><td><?php echo $m_sep_tar; ?></td><td><?php echo $m_oct_tar; ?></td><td><?php echo $m_nov_tar; ?></td><td><?php echo $m_dec_tar; ?></td><td><?php echo $m_jan_tar; ?></td><td><?php echo $m_feb_tar; ?></td><td><?php echo $m_mar_tar; ?></td><td><?php echo $m_apr_tar; ?></td><td><?php echo $m_tar_total; ?></td>
                            </tr>
                        </table>
				</td>
			</tr>
		</table>
<?php
$conn->close();
?>

</div>
</body>
</html>
