<!DOCTYPE html>
<?php

$servername = "localhost";
$username = "root";
$password = "Q1w2e3r4";
$dbname = "opensis";

$ga_01 = $ga_02 = $ga_03 = $ga_04 = 0;
$fg_a[] = $rem_a[] = $_fg_counter_a = $_rem_counter_a = 0;
$mapeh = $mapeh_01 = $mapeh_02 = $mapeh_03 = $mapeh_04 = $mapeh_fg = $mapeh_rem = 0;
$_quar_01a = $_quar_02a = $_quar_03a = $_quar_04a = 0;
$_quar_01b = $_quar_02b = $_quar_03b = $_quar_04b = 0;
$days_school[] = $_days_counter_a = $days_school_total = 0;
$m_pres_total = $m_jan_pres = $m_feb_pres = $m_mar_pres = $m_apr_pres = $m_jun_pres = $m_jul_pres = $m_aug_pres = $m_sep_pres = $m_oct_pres = $m_nov_pres = $m_dec_pres = 0;
$m_abs_total = $m_jan_abs = $m_feb_abs = $m_mar_abs = $m_apr_abs = $m_jun_abs = $m_jul_abs = $m_aug_abs = $m_sep_abs = $m_oct_abs = $m_nov_abs = $m_dec_abs = 0;
$m_tar_total = $m_jan_tar = $m_feb_tar = $m_mar_tar = $m_apr_tar = $m_jun_tar = $m_jul_tar = $m_aug_tar = $m_sep_tar = $m_oct_tar = $m_nov_tar = $m_dec_tar = 0;
$m_abs = $m_pres = $m_tar = "";


$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
$cName='remember_me_name';
if(!isset($_COOKIE[$cName])) {
    echo "Cookie named '" . $cName . "' is not set!&nbsp;";
	die("Log in first to continue: " . $conn->connect_error);
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
  </script>
</head>
<body>
<div class="container">
<!-- Dropdown -->
<br><form method='GET' action='' style='font-size:80%'>
<select name='student' id='selUser'>
  <option value='0'>Select Student</option>
  <?php
  $id_sql = "select student_id, last_name, first_name, middle_name from students order by `students`.`last_name` asc";
  $id_result = $conn->query($id_sql);
  if ($id_result->num_rows > 0) {
    while($id_row = $id_result->fetch_assoc()) {
      echo "<option value='".$id_row["student_id"]."'>".$id_row["last_name"].", ".$id_row["first_name"]." ".$id_row["middle_name"]."</option>";
    }
  }

  ?>
  <!--
  <option value='1'>Yogesh singh</option>
  <option value='2'>Sonarika Bhadoria</option>
  <option value='3'>Anil Singh</option>
  <option value='4'>Vishal Sahu</option>
  <option value='5'>Mayank Patidar</option>
  <option value='6'>Vijay Mourya</option>
  <option value='7'>Rakesh sahu</option>
  -->
</select>
<input type='submit' value='Submit' class='btn btn-sm btn-default'>
</form>

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
                                        <td><center>NARRATIVE REPORT</center></td>
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
                                        <td>First Grading:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_01['comment'] ?><br><br><br></td>
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
                                        <td>Second Grading:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_02['comment'] ?><br><br><br></td>
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
                                        <td>Third Grading::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_03['comment'] ?><br><br><br></td>
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
                                        <td>Fourth Grading::&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_04['comment'] ?><br><br><br></td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td colspan='3'><center>CERTIFICATE OF TRANSFER</center></td>
                                </tr>
                                <tr>
                                        <td align='right' colspan='2'>Date:</td><td width='100'>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>Eligible for adminission to</td><td width='200'>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td><td align='center' colspan='2'><br>EVANGELINE P. DIZON, Ed.D.</td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td><td align='center' colspan='2'>Principal</td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td colspan='3'><center>CANCELLATION OF TRANSFER ELIGIBILITY</center></td>
                                </tr>
                                <tr>
                                        <td align='right' colspan='2'>Date:</td><td width='100'>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>Has been admitted to</td><td width='200'>&nbsp;</td><td>school.</td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td><td align='center' colspan='2'><br>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>&nbsp;</td><td align='center' colspan='2'>Principal</td>
                                </tr>
                        </table>
                </td>
                <td style="width:2%">
                        &nbsp;
                </td>
                <td style="vertical-align:top">
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td colspan="6">
                                                <center>
                                                        <h4>LORD'S JEWELS CHRISTIAN SCHOOL INC.<h4>
                                                        <img src="ljcs_logo.jpg" width="100"><br>
                                                        <h5>Division of Rizal<h5>
                                                        <h5>District of Taytay<h5>
                                                        <h4>PROGRESS REPORT<h4>
                                                        <br>
                                                </center>
                                        </td>
                                </tr>
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
                                <tr><td>Name</td><td colspan='3'><?php echo strtoupper($row['last_name'].", ".$row['first_name']." ".$row['middle_name']) ?></td></tr>
                                <tr><td>Age</td><td><?php echo $row['age'] ?></td><td>Sex</td><td><?php echo $row['gender'] ?></td></tr>
                                <tr><td>LRN</td><td><?php echo $student_id ?></td><td>Grade & Section</td><td><?php echo $row['title']." - ".$row['name'] ?></td></tr>
                                <tr><td colspan='2'>School Year</td><td colspan='2'>2019-2020</td></tr>
                                <tr>
                                        <td colspan='4'>
                                                <br>
                                                <br>Dear Parent, <br>
                                                <br>This report card shows the ability and the progress your child has made in the different learning areas as well as his/her progress in character development.<br>
                                                <br>Your cooperation is desired in our effort to develop his/her potentials and form him/her into a committed Christian.  We would appreciate very much your coming to this school to talk things over with us regarding his/her progress in school.<br>
                                                <br><br><br>
                                        </td>
                                </tr>
								
								<?php
								$sql_log = "SELECT login_authentication.user_id, staff.staff_id, staff.first_name, staff.middle_name, staff.last_name FROM login_authentication left join staff on login_authentication.user_id = staff.staff_id 
								where username = '$_COOKIE[$cName]'";
								
								$result_log = $conn->query($sql_log);
                                $row_log = $result_log->fetch_assoc();
								?>
								
                                <tr><td colspan='2' width='50%'><center>EVANGELINE P. DIZON, Ed.D.</center></td><td colspan='2'><center><?php echo $row_log['first_name'] . SUBSTR($row_log['middle_name'], 0, 1) . "." . "&nbsp;" . $row_log['last_name'] ?></center></td></tr>
                                <tr><td colspan='2'><center>School Administrator</center></td><td colspan='2'><center>Adviser</center></td></tr>
                        </table>
                </td>
        </tr>
</table>
<table style="width:100%">
        <tr>
                <td style="width:49%; vertical-align:top">
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                            <tr>
                                    <td colspan="7"><center>PERIODIC RATING</center></td>
                            </tr>
                            <tr>
                                    <td>Learning Areas</td><td width='36'>1</td><td width='36'>2</td><td width='36'>3</td><td width='36'>4</td><td>Final Rating</td><td>Remarks</td>
                            </tr>
								
								<?php
									$sql_a = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                            student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                            from student_report_card_grades
                                            left join students on student_report_card_grades.student_id = students.student_id
                                            left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                            left join courses on course_periods.course_id = courses.course_id
                                            where student_report_card_grades.student_id = $student_id	
											and student_report_card_grades.marking_period_id = 15
                                            and (courses.subject_id < 17 or courses.subject_id > 20)
											order by courses.subject_id";
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
											order by courses.subject_id";		
											
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
											order by courses.subject_id";							
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
											order by courses.subject_id";									
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
											order by courses.subject_id";	
											
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
											if ( $fg_a[$_fg_counter_a] >= 75 )
											{
											$rem_a[$_rem_counter_a] = "Passed"; 
											}										
											else
											{ 
											$rem_a[$_rem_counter_a] = "Failed";
											}												
											}	
											else
											{
											$fg_a[$_fg_counter_a] = null;
											$rem_a[$_rem_counter_a] = null;										
											}	
										
									
											//display subjects and grades
											echo "<tr><td>".$row_a['course_title']."</td>
												  <td>".$row_01a['grade_letter']."</td>										
										          <td>".$row_02a['grade_letter']."</td>
												  <td>".$row_03a['grade_letter']."</td>											 
												  <td>".$row_04a['grade_letter']."</td>
 											      <td>".$fg_a[$_fg_counter_a]."</td> 												
												  <td>".$rem_a[$_rem_counter_a]."</td>
												  </tr>";
										
												//get gen ave total
												
												if ( $row_01a['grade_letter'] > 0 ) {													
												$ga_01 = $ga_01 + $row_01a['grade_letter'];
												$_quar_01a++;
												}
												else{}
												
												if ( $row_02a['grade_letter'] > 0 ) {												
												$ga_02 = $ga_02 + $row_02a['grade_letter'];
												$_quar_02a++;
												}
												else{}
												
												if ( $row_03a['grade_letter'] > 0 ) {
												$ga_03 = $ga_03 + $row_03a['grade_letter'];
												$_quar_03a++;
												}
												else{}
												
												if ( $row_04a['grade_letter'] > 0 ) {
												$ga_04 = $ga_04 + $row_04a['grade_letter'];	
												$_quar_04a++;
												}
												else{}

												
												$_fg_counter_a++; $_rem_counter_a++;
										}									
									}		
									else {}																	   
									
									//mapeh data
									$sql_b = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                                student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                                from student_report_card_grades
                                                left join students on student_report_card_grades.student_id = students.student_id
                                                left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                                left join courses on course_periods.course_id = courses.course_id												
                                                where student_report_card_grades.student_id = $student_id
												and student_report_card_grades.marking_period_id = 15
                                                and (courses.subject_id between 17 and 20)
												order by courses.subject_id";
									$result_b = $conn->query($sql_b);
									//first quarter query
									$sql_01b = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                                student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                                from student_report_card_grades
                                                left join students on student_report_card_grades.student_id = students.student_id
                                                left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                                left join courses on course_periods.course_id = courses.course_id												
                                                where student_report_card_grades.student_id = $student_id
												and student_report_card_grades.marking_period_id = 15
                                                and (courses.subject_id between 17 and 20)
												order by courses.subject_id";
								
									$result_01b = $conn->query($sql_01b);
								
									//second quarter query
									$sql_02b = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                                student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                                from student_report_card_grades
                                                left join students on student_report_card_grades.student_id = students.student_id
                                                left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                                left join courses on course_periods.course_id = courses.course_id												
                                                where student_report_card_grades.student_id = $student_id
												and student_report_card_grades.marking_period_id = 16
                                                and (courses.subject_id between 17 and 20)
												order by courses.subject_id";
								
									$result_02b = $conn->query($sql_02b);
								
									//third quarter query
									$sql_03b = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                                student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                                from student_report_card_grades
                                                left join students on student_report_card_grades.student_id = students.student_id
                                                left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                                left join courses on course_periods.course_id = courses.course_id												
                                                where student_report_card_grades.student_id = $student_id
												and student_report_card_grades.marking_period_id = 17
                                                and (courses.subject_id between 17 and 20)
												order by courses.subject_id";
									
									$result_03b = $conn->query($sql_03b);	
								
									//fourth quarter
									$sql_04b = "select student_report_card_grades.student_id, students.last_name, students.first_name,
                                                student_report_card_grades.course_title, student_report_card_grades.grade_letter, courses.subject_id
                                                from student_report_card_grades
                                                left join students on student_report_card_grades.student_id = students.student_id
                                                left join course_periods on student_report_card_grades.course_period_id = course_periods.course_period_id
                                                left join courses on course_periods.course_id = courses.course_id												
                                                where student_report_card_grades.student_id = $student_id
												and student_report_card_grades.marking_period_id = 18
                                                and (courses.subject_id between 17 and 20)
												order by courses.subject_id";
								
									$result_04b = $conn->query($sql_04b);
									
									//mapeh subjects fetch
									if ($result_b->num_rows > 0) {                                    
										while($row_b = $result_b->fetch_assoc()) 
										{
											$row_01b = $result_01b->fetch_assoc();
											$row_02b = $result_02b->fetch_assoc();
											$row_03b = $result_03b->fetch_assoc();
											$row_04b = $result_04b->fetch_assoc();
											
											 
										
											//display mapeh subjects									  
											echo "<tr><td style='font-size:80%'>&nbsp;&nbsp;&nbsp;".$row_b['course_title']."</td>												  
											  <td>".$row_01b['grade_letter']."</td>
										      <td>".$row_02b['grade_letter']."</td>
										      <td>".$row_03b['grade_letter']."</td>
											  <td>".$row_04b['grade_letter']."</td>
											  <td>&nbsp;</td>
											  <td>&nbsp;</td>
											  </tr>";
										  
											  //get mapeh total if row not empty											 
										  	  if ($row_01b['grade_letter'] > 0 ) {
										      $mapeh_01 = $mapeh_01 + $row_01b['grade_letter'];											
											  $_quar_01b++;											  
											  }
											  else {}

											  if ($row_02b['grade_letter'] > 0) {
											  $mapeh_02 = $mapeh_02 + $row_02b['grade_letter'];
											  $_quar_02b++;
											  }
											  else {}
											  
											   if ($row_03b['grade_letter'] > 0) {
											  $mapeh_03 = $mapeh_03 + $row_03b['grade_letter'];
											  $_quar_03b++;
											  }
											  else {}
											  
											  if ($row_04b['grade_letter'] > 0) {
											  $mapeh_04 = $mapeh_04 + $row_04b['grade_letter'];
											  $_quar_04b++;
											  }
											 else {}
										}
										
										//get mapeh ave 
										if ( $_quar_01b > 0) 
										{
										$mapeh_01 = round( $mapeh_01/$_quar_01b ); 
										$_quar_01a++; 
										} else {}
										
										if ( $mapeh_02 > 0 && $_quar_02b > 0) 
										{
										$mapeh_02 = round( $mapeh_02/$_quar_02b ); 
										$_quar_02a++;
										} else {}
										
										if ( $_quar_03b > 0) 
										{
										$mapeh_03 = round( $mapeh_03/$_quar_03b );
										$_quar_03a++;
										} else {}
										
										if ( $mapeh_04 > 0 && $_quar_04b > 0) 
										{
										$mapeh_04 = round( $mapeh_04/$_quar_04b );
										$_quar_04a++;
										} else {}
										
										  
									}

										// get Grand Average 
										if ($_quar_01b > 0){			
										$ga_01 = ( ($ga_01 + $mapeh_01)/$_quar_01a );
										}
										elseif( $_quar_01a> 0 ) { 
											$ga_01 = $ga_01/$_quar_01a;
										} 
										else 
										{ 
										$ga_01 = 0;
										}
										
										if ( $_quar_02b > 0 )
										{
										$ga_02 = ( ($ga_02 + $mapeh_02)/$_quar_02a );	
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
					   				    $ga_03 = ( ($ga_03 + $mapeh_03)/$_quar_03a );
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
										$ga_04 = ( ($ga_04 + $mapeh_04)/$_quar_04a );
										}
										elseif( $_quar_04a> 0 ) 
										{ 
										$ga_04 = $ga_04/$_quar_04a;
										}	
										else
										{ 
										$ga_04 = 0;
										}
									
									//mapeh final grade and remarks filter, displays blank if no data
									if	( $mapeh_01 > 0 && $mapeh_02 > 0 && $mapeh_03  > 0 && $mapeh_04 > 0 ) 
									{										
										$mapeh_fg = (( $mapeh_01 + $mapeh_02 + $mapeh_03 + $mapeh_04 ) / 4 );
										if ( $mapeh_fg >= 75 ) 
										{
											$mapeh_rem = "Passed"; 
											$mapeh_fg = round($mapeh_fg);
										}										
										else 
										{ 
											$mapeh_rem = "Failed"; 
										}																					
									}
									else 
									{
										$mapeh_fg = null;
										$mapeh_rem = null;
									}			
															
                                ?>							
								
								
								
                            <tr>
                                    <td>MAPEH</td><td><?php echo $mapeh_01 ?></td><td><?php echo $mapeh_02 ?></td><td><?php echo $mapeh_03 ?></td><td><?php echo $mapeh_04 ?></td><td><?php echo $mapeh_fg ?></td><td><?php echo $mapeh_rem ?></td>
                            </tr>
                            <tr>
                                    <td>ECA</td><td colspan="2">&nbsp;</td><td colspan="2">&nbsp;</td><td>&nbsp;</td><td>&nbsp; </td>
                            </tr>
                            <tr>
                                    <td>General Average</td><td><?php echo number_format($ga_01,2) ?></td><td><?php echo number_format($ga_02,2) ?></td><td><?php echo number_format($ga_03,2) ?></td><td><?php echo number_format($ga_04,2) ?></td><td>&nbsp;</td><td>&nbsp;</td>
                            </tr>
                        </table>						
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                            <tr>
                                    <td colspan="13"><center>ATTENDANCE RECORD</center></td>
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
                <td style="width:2%">
                        &nbsp; 
                </td>
                <td style="vertical-align:top">
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td colspan="6"><center>CHARACTER BUILDING</center></td>
                                </tr>
                                <tr>
                                        <td>Core Values</td><td>Behavior Statement</td><td width='36'>1</td><td width='36'>2</td><td width='36'>3</td><td width='36'>4</td>
                                </tr>
                                <tr>
                                        <td rowspan="2">1. Maka-Diyos</td><td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others.</td>
										
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                                <tr>
                                        <td>Shows adherence to ethical principles by upholding truth.</td>
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                                <tr>
                                        <td rowspan="2">2. Makatao</td><td>Is sensitive to individual, social, and cultural differences.</td>
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                                <tr>
                                        <td>Demonstrates contributions toward solidarity.</td>
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                                <tr>
                                        <td style="width:100px">3. Makakalikasan</td><td>Cares for the environment and utilizes resources wisely, judiciously, and economically. </td>
										
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                                <tr>
                                        <td rowspan="2">4. Makabansa</td><td>Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen.</td>
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                                <tr>
                                        <td>Demonstrates appropriate behavior in carrying out activities in the school, community, and country.</td>
										<form>
										<td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td><td><input size = "2" type="text"></td>
										</form>
                                </tr>
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td colspan="3"><center>GUIDELINES FOR RATING</center></td><td><center>Marking</center></td><td><center>Non-Numerical Rating</center></td>
                                </tr>
                                <tr>
                                        <td>Descriptors</td><td>Grading Scale</td><td>Remarks</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>Outstanding</td><td>90-100</td><td>Passed</td><td>AO</td><td>Always Observed</td>
                                </tr>
                                <tr>
                                        <td>Very Satisfactory</td><td>85-89</td><td>Passed</td><td>SO</td><td>Sometimes Observed</td>
                                </tr>
                                <tr>
                                        <td>Satisfactory</td><td>80-84</td><td>Passed</td><td>RO</td><td>Rarely Observed</td>
                                </tr>
                                <tr>
                                        <td>Fairly Satisfactory</td><td>75-79</td><td>Passed</td><td>NO</td><td>Not Observed</td>
                                </tr>
                                <tr>
                                        <td>Do Not Meet Expectations</td><td>Below 75</td><td>Failed</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                                <tr>
                                        <td>Reading Level:</td><td>English</td><td>&nbsp;</td><td>Filipino</td><td>&nbsp;</td>
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