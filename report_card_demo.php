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

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<html lang="en">
<head>
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
                                <tr>
                                        <td>First Grading:<br><br><br><br></td>
                                </tr>
                                <tr>
                                        <td>Second Grading:<br><br><br><br></td>
                                </tr>
                                <tr>
                                        <td>Third Grading:<br><br><br><br></td>
                                </tr>
                                <tr>
                                        <td>Fourth Grading:<br><br><br><br></td>
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
                                <tr><td colspan='2' width='50%'><center>EVANGELINE P. DIZON, Ed.D.</center></td><td colspan='2'><center>JULIETA O. REMENTILLA</center></td></tr>
                                <tr><td colspan='2'><center>School Administrator</center></td><td colspan='2'><center>Teacher</center></td></tr>
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
										if ( $_quar_01b > 0) {
										$mapeh_01 = $mapeh_01/$_quar_01b; 
										$_quar_01a++; 
										} else {}
										if ( $mapeh_02 > 0 && $_quar_02b > 0) {
										$mapeh_02 = $mapeh_02/$_quar_02b; 
										$_quar_02a++;
										} else {}
										if ( $_quar_03b > 0) {
										$mapeh_03 = $mapeh_03/$_quar_03b;
										$_quar_03a++;
										} else {}
										if ( $mapeh_04 > 0 && $_quar_04b > 0) {
										$mapeh_04 = $mapeh_04/$_quar_04b;
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
								
								<?php 
									$sql_c = "select date_format(school_date, '%b') as months, count(school_date) as days from attendance_calendar group by months";
									$result_c = $conn->query($sql_c);
								
									if ($result_c->num_rows > 0) 
									{                                    
										while($row_c = $result_c->fetch_assoc()) 
										{										
											$days_school[$_days_counter_a] = $row_c["days"];
											$days_school_total = $days_school_total + $days_school[$_days_counter_a];
											$_days_counter_a++;
										}									
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
                            <tr>
                                    <td>Days of School</td><td><?php echo $days_school[6] ?></td><td><?php echo $days_school[5] ?></td><td><?php echo $days_school[1] ?></td><td><?php echo $days_school[10] ?></td><td><?php echo $days_school[9] ?></td><td><?php echo $days_school[8] ?></td><td><?php echo $days_school[2] ?></td><td><?php echo $days_school[4] ?></td><td><?php echo $days_school[3] ?></td><td><?php echo $days_school[7] ?></td><td><?php echo $days_school[0] ?></td><td><?php echo $days_school_total ?></td>
                            </tr>

                            <tr>
                                    <td>Days Present</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                            </tr>
                            <tr>
                                    <td>Days Absent</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                            </tr>
                            <tr>
                                    <td>Days Tardy</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
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
                                        <td rowspan="2">1. Maka-Diyos</td><td>Expresses one's spiritual beliefs while respecting the spiritual beliefs of others.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>Shows adherence to ethical principles by upholding truth.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td rowspan="2">2. Makatao</td><td>Is sensitive to individual, social, and cultural differences.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>Demonstrates contributions toward solidarity.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td style="width:100px">3. Makakalikasan</td><td>Cares for the environment and utilizes resources wisely, judiciously, and economically. </td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td rowspan="2">4. Makabansa</td><td>Demonstrates pride in being a Filipino; exercises the rights and responsibilities of a Filipino citizen.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
                                </tr>
                                <tr>
                                        <td>Demonstrates appropriate behavior in carrying out activities in the school, community, and country.</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
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