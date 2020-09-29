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

$char_row_01_c = $char_row_02_c = 0;
$char_row_01_gm = $char_row_02_gm  = 0;
$char_row_01_fm = $char_row_02_fm  = 0;
$char_row_01_ws = $char_row_02_ws = 0;
$char_row_01_spd = $char_row_02_spd  = 0;
$char_row_01_shs = $char_row_02_shs  = 0;
$char_row_01_sp = $char_row_02_sp = 0;
$c_fr_ave = $gm_fr_ave=0;


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
    //echo "Cookie named '" . $cName . "' is not set!&nbsp;";
	//die("Log in first to continue: " . $conn->connect_error);
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
                         <tr>
                                    <td colspan="13"><center><b>LEGEND</b></center>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>O&nbsp;&nbsp;Outstanding&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>93-100&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>MS&nbsp;&nbsp;<i>Moderately Satisfactory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>75-80<br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>VS&nbsp;&nbsp;Very Satisfactory&nbsp;&nbsp;&nbsp;&nbsp;<b><i>87-92&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>NI&nbsp;&nbsp;&nbsp;&nbsp;<i>Needs Improvement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>Below 75<br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>S&nbsp;&nbsp;<b><i>Satisfactory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><i>81-86
									
									
									
									</td>
									</tr>
					
					</td>
					</tr>
					</table>
				
				
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
                                        <td style='height:50px'>First Semester:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_01['comment'] ?></td>
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
                                        <td style='height:50px'>Second Semester:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_02['comment'] ?></td>
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
                                        <td style='height:50px'>First Semester:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_01['comment'] ?></td>
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
                                        <td style='height:50px'>Second Semester:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_comment_02['comment'] ?></td>
                                </tr>
								
                        </table>
                        <table class="table table-bordered table-condensed" style="font-size:80%">
                               <?php
								$sql_log = "SELECT login_authentication.user_id, staff.staff_id, staff.first_name, staff.middle_name, staff.last_name FROM login_authentication left join staff on login_authentication.user_id = staff.staff_id 
								where username = '$_COOKIE[$cName]'";
								
								$result_log = $conn->query($sql_log);
                                $row_log = $result_log->fetch_assoc();
								?>
                                <tr>
                                        <td>Eligible for transfer and adminission to</td><td></td>
                                </tr>
                                <tr>
                                        <td align='left' style='height:20px'><center>EVANGELINE P. DIZON, Ed.D.</center></td><td><center><?php echo $row_log['first_name'] . SUBSTR($row_log['middle_name'], 0, 1) . "." . "&nbsp;" . $row_log['last_name'] ?></center></td>
                                </tr>
                                <tr>
                                        <td align='left'  style='height:20px'><center>Administrator/Principal</center></td><td><center>Class Adviser</center></td>
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
														<br><img src="ps_image.png" width="100"><br>
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
<table  style="width:100%">
	<tr>
		<td style="width:49%; vertical-align:top">	
			<table class='table table-bordered table-condensed' style='font-size:80%'>
			<tr><td><b><i>I. COGNITIVE</b></i></td><td>1st<br>Sem</td><td>2nd<br>Sem</td><td>Final<br>Rating</td></tr>
			<?php
			
				//cognitive data fetch
				$char_build_cog = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_cog = $conn->query($char_build_cog);	
				
				$char_build_01_c = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_c = $conn->query($char_build_01_c);	
			
				$char_build_02_c = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_c = $conn->query($char_build_02_c);			
						
				if ($char_result_01_c->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ($char_row_cog = $char_result_cog->fetch_assoc()) 
					{ 
						$char_row_01_c = $char_result_01_c->fetch_assoc();
						$char_row_02_c = $char_result_02_c->fetch_assoc();
								
					}
				}
				else{}
				
				$c_1a = $char_row_01_c['c_1'];
				$c_1b = $char_row_02_c['c_1'];
				
				
				$c_2a = $char_row_01_c['c_2'];
				$c_2b = $char_row_02_c['c_2'];
				
				
				$c_3a = $char_row_01_c['c_3'];
				$c_3b = $char_row_02_c['c_3'];
				
				
				$c_4a = $char_row_01_c['c_4'];
				$c_4b = $char_row_02_c['c_4'];
				
				$c_5a = $char_row_01_c['c_5'];
				$c_5b = $char_row_02_c['c_5'];
				
				
				$c_6a = $char_row_01_c['c_6'];
				$c_6b = $char_row_02_c['c_6'];
				
				
				$c_7a = $char_row_01_c['c_7'];
				$c_7b = $char_row_02_c['c_7'];
				
				
				$c_8a = $char_row_01_c['c_8'];
				$c_8b = $char_row_02_c['c_8'];
				
				$c_9a = $char_row_01_c['c_9'];
				$c_9b = $char_row_02_c['c_9'];
				
				$c_10a = $char_row_01_c['c_10'];
				$c_10b = $char_row_02_c['c_10'];
				
				
				$c_11a = $char_row_01_c['c_11'];
				$c_11b = $char_row_02_c['c_11'];
				
				
				$c_12a = $char_row_01_c['c_12'];
				$c_12b = $char_row_02_c['c_12'];
				
				
				$c_13a = $char_row_01_c['c_13'];
				$c_13b = $char_row_02_c['c_13'];
				
				
				
				if($c_1a>0 and $c_2a>0 and $c_3a>0 and $c_4a>0 and $c_5a>0 and $c_6a>0 and $c_7a>0 and $c_8a>0 and $c_9a>0 and $c_10a>0 and $c_11a>0 and $c_12a>0 and $c_13a>0 ){
					$c_ave_1 = ( $c_1a + $c_2a + $c_3a + $c_4a + $c_5a + $c_6a + $c_7a + $c_8a + $c_9a + $c_10a + $c_11a + $c_12a + $c_13a) / 13;
				}
				else{
					$c_ave_1 = "";
				}
				
				if($c_1b>0 and $c_2b>0 and $c_3b>0 and $c_4b>0 and $c_5b>0 and $c_6b>0 and $c_7b>0 and $c_8b>0 and $c_9b>0 and $c_10b>0 and $c_11b>0 and $c_12b>0 and $c_13b>0 ){
					$c_ave_2 = ( $c_1b + $c_2b + $c_3b + $c_4b + $c_5b + $c_6b + $c_7b + $c_8b + $c_9b + $c_10b + $c_11b + $c_12b + $c_13b) / 13;
				}
				else{
					$c_ave_2 = "";
				}
		
			
				if($c_1a>0 and $c_1b>0){
					$c_fr_1 = ( $c_1a + $c_1b )/2;
				}
				else{
					$c_fr_1 = "";
				}
					
				if($c_2a>0 and $c_2b>0){
					$c_fr_2 = ( $c_2a + $c_2b )/2;
				}
				else{
					$c_fr_2 = "";
				}
				
				if($c_3a>0 and $c_3b>0){
					$c_fr_3 = ( $c_3a + $c_3b )/2;
				}
				else{
					$c_fr_3 = "";
				}
					
				if($c_4a>0 and $c_4b>0){
					$c_fr_4 = ( $c_4a + $c_4b )/2;
				}
				else{
					$c_fr_4 = "";
				}
				
				if($c_5a>0 and $c_5b>0){
					$c_fr_5 = ( $c_5a + $c_5b )/2;
				}
				else{
					$c_fr_5 = "";
				}
					
				if($c_6a>0 and $c_6b>0){
					$c_fr_6 = ( $c_6a + $c_6b )/2;
				}
				else{
					$c_fr_6 = "";
				}
				
				if($c_7a>0 and $c_7b>0){
					$c_fr_7 = ( $c_7a + $c_7b )/2;
				}
				else{
					$c_fr_7 = "";
				}
					
				if($c_8a>0 and $c_8b>0){
					$c_fr_8 = ( $c_8a + $c_8b )/2;
				}
				else{
					$c_fr_8 = "";
				}
				
				if($c_9a>0 and $c_9b>0){
					$c_fr_9 = ( $c_9a + $c_9b )/2;
				}
				else{
					$c_fr_9 = "";
				}
				
				if($c_10a>0 and $c_10b>0){
					$c_fr_10 = ( $c_10a + $c_10b )/2;
				}
				else{
					$c_fr_10 = "";
				}
					
				if($c_11a>0 and $c_11b>0){
					$c_fr_11 = ( $c_11a + $c_11b )/2;
				}
				else{
					$c_fr_11 = "";
				}
				
				if($c_12a>0 and $c_12b>0){
					$c_fr_12 = ( $c_12a + $c_12b )/2;
				}
				else{
					$c_fr_12 = "";
				}
					
				if($c_13a>0 and $c_13b>0){
					$c_fr_13 = ( $c_13a + $c_13b )/2;
				}
				else{
					$c_fr_13 = "";
				}
				
				if($c_fr_1>0 and $c_fr_2>0 and $c_fr_3>0 and $c_fr_4>0 and $c_fr_5>0 and $c_fr_6>0 and $c_fr_7>0 and $c_fr_8>0 and $c_fr_9>0 and $c_fr_10>0 and $c_fr_11>0 and $c_fr_12>0 and $c_fr_13>0 )
				{
					$c_fr_ave = ( $c_fr_1 + $c_fr_2 + $c_fr_3 + $c_fr_4 + $c_fr_5 + $c_fr_6 + $c_fr_7 + $c_fr_8 + $c_fr_9 + $c_fr_10 + $c_fr_11 + $c_fr_12 + $c_fr_13 ) / 13;
				}
				else {
					$c_fr_ave = "";
				}
				echo 	"<tr>
								<td>Ask an increasing number of questions.</td><td align='center'>". letter_grade($c_1a)."</td><td align='center'>".letter_grade($c_1b)."</td><td align='center'>".letter_grade($c_fr_1)."</td>
							</tr> 
							<tr>
								<td>Pays attention and concentrates on a given task.</td><td align='center'>". letter_grade($c_2a)."</td><td align='center'>".letter_grade($c_2b)."</td><td align='center'>".letter_grade($c_fr_2)."</td>
							</tr>
							<tr>
								<td>Recalls simple information previously taught.</td><td align='center'>". letter_grade($c_3a)."</td><td align='center'>".letter_grade($c_3b)."</td><td align='center'>".letter_grade($c_fr_3)."</td>
							</tr>
							<tr>
								<td>See's likeness and differences in objects pictures and letters.</td><td align='center'>". letter_grade($c_4a)."</td><td align='center'>".letter_grade($c_4b)."</td><td align='center'>".letter_grade($c_fr_4)."</td>
							</tr> 
							<tr>
								<td>Recognizes letters.</td><td align='center'>". letter_grade($c_5a)."</td><td align='center'>".letter_grade($c_5b)."</td><td align='center'>".letter_grade($c_fr_5)."</td>
							</tr>
							<tr>
								<td>Identifies letter sounds.</td><td align='center'>". letter_grade($c_6a)."</td><td align='center'>".letter_grade($c_6b)."</td><td align='center'>".letter_grade($c_fr_6)."</td>
							</tr>
							<tr>
								<td>Listens to short story.</td><td align='center'>". letter_grade($c_7a)."</td><td align='center'>".letter_grade($c_7b)."</td><td align='center'>".letter_grade($c_fr_7)."</td>
							</tr>
							<tr>
								<td>Answer questions about short story.</td><td align='center'>". letter_grade($c_8a)."</td><td align='center'>".letter_grade($c_8b)."</td><td align='center'>".letter_grade($c_fr_8)."</td>
							</tr>
							<tr>
								<td>Recites short poems.</td><td align='center'>". letter_grade($c_9a)."</td><td align='center'>".letter_grade($c_9b)."</td><td align='center'>".letter_grade($c_fr_9)."</td>
							</tr>
							<tr>
								<td>Counts objects.</td><td align='center'>". letter_grade($c_10a)."</td><td align='center'>".letter_grade($c_10b)."</td><td align='center'>".letter_grade($c_fr_10)."</td>
							</tr><tr>
								<td>Recognizes and writes numbers from 1 - 10.</td><td align='center'>". letter_grade($c_11a)."</td><td align='center'>".letter_grade($c_11b)."</td><td align='center'>".letter_grade($c_fr_11)."</td>
							</tr>
							<tr>
								<td>Demonstrates the concept of numerals 1 - 10.</td><td align='center'>". letter_grade($c_12a)."</td><td align='center'>".letter_grade($c_12b)."</td><td align='center'>".letter_grade($c_fr_12)."</td>
							</tr>
								<tr>
								<td>Recognizes color and shapes.</td><td align='center'>". letter_grade($c_13a)."</td><td align='center'>".letter_grade($c_13b)."</td><td align='center'>".letter_grade($c_fr_13)."</td>
							</tr>
							<tr>
								<td>Average</td><td align='center'>". letter_grade($c_ave_1)."</td><td align='center'>".letter_grade($c_ave_2)."</td><td align='center'>".letter_grade($c_fr_ave)."</td>
							</tr>";							
			?>
			</tr>

			<tr><td colspan="13"><h5><b>II-A.GROSS MOTOR</b></td></tr>
			<?php
			
				//gross motor data fetch
				$char_build_01_gr = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_gr = $conn->query($char_build_01_gr);
					
				$char_build_01_gm = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_gm = $conn->query($char_build_01_gm);
			
				$char_build_02_gm = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_gm = $conn->query($char_build_02_gm);			
						
				if ($char_result_01_gm->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_gr = $char_result_01_gr->fetch_assoc()) 
					{ 
						$char_row_01_gm = $char_result_01_gm->fetch_assoc();
						$char_row_02_gm = $char_result_02_gm->fetch_assoc();
					}
				}
				else{}
				
				$gm_1a = $char_row_01_gm['gm_1'];
				$gm_1b = $char_row_02_gm['gm_1'];
				
				$gm_2a = $char_row_01_gm['gm_2'];
				$gm_2b = $char_row_02_gm['gm_2'];
				
				$gm_3a = $char_row_01_gm['gm_3'];
				$gm_3b = $char_row_02_gm['gm_3'];
				
				$gm_4a = $char_row_01_gm['gm_4'];
				$gm_4b = $char_row_02_gm['gm_4'];
				
				if($gm_1a>0 and $gm_2a>0 and $gm_3a>0 and $gm_4a>0 ){
					$gm_ave_1 = ( $gm_1a + $gm_2a +  $gm_3a + $gm_4a)/4;
				}
				else{
					$gm_ave_1 = "";
				}
				
				if($gm_1b>0 and $gm_2b>0 and $gm_3b>0 and $gm_4b>0 ){
					$gm_ave_2 = ( $gm_1b + $gm_2b +  $gm_3b + $gm_4b )/4;
				}
				else{
					$gm_ave_2 = "";
				}
			
			
				if($gm_1a>0 and $gm_1b>0 ){
					$gm_fr_1 = ( $gm_1a + $gm_1b )/2;
				}
				else{
					$gm_fr_1 = "";
				}
					
				if($gm_2a>0 and $gm_2b>0 ){
					$gm_fr_2 = ( $gm_2a + $gm_2b )/2;
				}
				else{
					$gm_fr_2 = "";
				}
				
				if($gm_3a>0 and $gm_3b>0 ){
					$gm_fr_3 = ( $gm_3a + $gm_3b )/2;
				}
				else{
					$gm_fr_3 = "";
				}
					
				if($gm_4a>0 and $gm_4b>0 ){
					$gm_fr_4 = ( $gm_4a + $gm_4b )/2;
				}
				else{
					$gm_fr_4 = "";
				}
				
				if($gm_fr_1>0 and $gm_fr_2>0 and $gm_fr_3>0 and $gm_fr_4>0 ){
					$gm_fr_ave = ( $gm_fr_1 + $gm_fr_2 + $gm_fr_3 + $gm_fr_4 )/4;
				}
				else{
					$gm_fr_ave ="";
				}
					echo 	"<tr>
								<td>Throws and catches a ball. </td><td align='center'>". letter_grade($gm_1a)."</td><td align='center'>". letter_grade($gm_1b)."</td><td align='center'>". letter_grade($gm_fr_1)."</td>
							</tr>
							<tr>
								<td>Jumps with both feet over a low object</td><td align='center'>". letter_grade($gm_2a)."</td><td align='center'>". letter_grade($gm_2b)."</td><td align='center'>". letter_grade($gm_fr_2)."</td>
							</tr>
							<tr>
								<td>Claps and marches in time with music.</td><td align='center'>". letter_grade($gm_3a)."</td><td align='center'>". letter_grade($gm_3b)."</td><td align='center'>". letter_grade($gm_fr_3)."</td>
							</tr>
							<tr>
								<td>Runs without falling.</td><td align='center'>". letter_grade($gm_4a)."</td><td align='center'>". letter_grade($gm_4b)."</td><td align='center'>". letter_grade($gm_fr_4)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($gm_ave_1)."</td><td align='center'>". letter_grade($gm_ave_2)."</td><td align='center'>". letter_grade($gm_fr_ave)."</td>
							</tr>";								
			?>
			</tr>
			<tr><td colspan="13"><h5><b>B.FINE MOTOR</b></td></tr>
			<?php
			
				//fine motor data fetch
				
				$char_build_01_fr = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_fr = $conn->query($char_build_01_fr);
					
				$char_build_01_fm = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_fm = $conn->query($char_build_01_fm);
			
				$char_build_02_fm = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_fm = $conn->query($char_build_02_fm);			
						
				if ($char_result_01_fm->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_fr = $char_result_01_fr->fetch_assoc()) 
					{ 
						$char_row_01_fm = $char_result_01_fm->fetch_assoc();
						$char_row_02_fm = $char_result_02_fm->fetch_assoc();
					}
				}
				else{}
				
				$fm_1a = $char_row_01_fm['fm_1'];
				$fm_1b = $char_row_02_fm['fm_1'];
				
				$fm_2a = $char_row_01_fm['fm_2'];
				$fm_2b = $char_row_02_fm['fm_2'];
								
				$fm_3a = $char_row_01_fm['fm_3'];
				$fm_3b = $char_row_02_fm['fm_3'];
			
				$fm_4a = $char_row_01_fm['fm_4'];
				$fm_4b = $char_row_02_fm['fm_4'];
				
				$fm_5a = $char_row_01_fm['fm_5'];
				$fm_5b = $char_row_02_fm['fm_5'];
				
				if($fm_1a>0 and $fm_2a>0 and $fm_3a>0 and $fm_4a>0 and $fm_5a>0 ){
					$fm_ave_1 = ( $fm_1a + $fm_2a +  $fm_3a + $fm_4a + $fm_5a )/5;
				}
				else{
					$fm_ave_1 = "";
				}
				
				if($fm_1b>0 and $fm_2b>0 and $fm_3b>0 and $fm_4b>0 and $fm_5b>0 ){
					$fm_ave_2 = ( $fm_1b + $fm_2b +  $fm_3b + $fm_4b + $fm_5b )/5;
				}
				else{
					$fm_ave_2 = "";
				}
			
			
				if($fm_1a>0 and $fm_1b>0 ){
					$fm_fr_1 = ( $fm_1a + $fm_1b  )/2;
				}
				else{
					$fm_fr_1 = "";
				}
					
				if($fm_2a>0 and $fm_2b>0 ){
					$fm_fr_2 = ( $fm_2a + $fm_2b  )/2;
				}
				else{
					$fm_fr_2 = "";
				}
								
				if($fm_3a>0 and $fm_3b>0 ){
					$fm_fr_3 = ( $fm_3a + $fm_3b  )/2;
				}
				else{
					$fm_fr_3 = "";
				}
					
				if($fm_4a>0 and $fm_4b>0 ){
					$fm_fr_4 = ( $fm_4a + $fm_4b  )/2;
				}
				else{
					$fm_fr_4 = "";
				}
				if($fm_5a>0 and $fm_5b>0 ){
					$fm_fr_5 = ( $fm_5a + $fm_5b  )/2;
				}
				else{
					$fm_fr_5 = "";
				}
				
				if($fm_fr_1>0 and $fm_fr_2>0 and $fm_fr_3>0 and $fm_fr_4>0  and $fm_fr_5>0 ){
					$fm_fr_ave = ( $fm_fr_1 + $fm_fr_2 + $fm_fr_3 + $fm_fr_4  + $fm_fr_5 )/5;
				}
				else{
					$fm_fr_ave ="";
				}
					echo 	"<tr>
								<td>Opens/closes his/her bag properly. </td><td align='center'>". letter_grade($fm_1a)."</td><td align='center'>". letter_grade($fm_1b)."</td><td align='center'>". letter_grade($fm_fr_1)."</td>
							</tr>
							<tr>
								<td>Paints with brush</td><td align='center'>". letter_grade($fm_2a)."</td><td align='center'>". letter_grade($fm_2b)."</td><td align='center'>". letter_grade($fm_fr_2)."</td>
							</tr>
							<tr>
								<td>Pastes artwork properly.</td><td align='center'>". letter_grade($fm_3a)."</td><td align='center'>". letter_grade($fm_3b)."</td><td align='center'>". letter_grade($fm_fr_3)."</td>
							</tr>
							<tr>
								<td>Colors within the line.</td><td align='center'>". letter_grade($fm_4a)."</td><td align='center'>". letter_grade($fm_4b)."</td><td align='center'>". letter_grade($fm_fr_4)."</td>
							</tr>
							<tr>
								<td>Zip/ties shoe lace.</td><td align='center'>". letter_grade($fm_5a)."</td><td align='center'>". letter_grade($fm_5b)."</td><td align='center'>". letter_grade($fm_fr_5)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($fm_ave_1)."</td><td align='center'>". letter_grade($fm_ave_2)."</td><td align='center'>". letter_grade($fm_fr_ave)."</td>
							</tr>";								
			?>
			</tr><tr><td colspan="13"><h5><b>C.WRITING SKILLS</b></td></tr>
			<?php
			
				//writing skills data fetch
				$char_build_01_wss = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_wss = $conn->query($char_build_01_wss);
					
				$char_build_01_ws = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_ws = $conn->query($char_build_01_ws);
			
				$char_build_02_ws = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_ws = $conn->query($char_build_02_ws);			
				if ($char_result_01_ws->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_wss = $char_result_01_wss->fetch_assoc()) 
					{ 
						$char_row_01_ws = $char_result_01_ws->fetch_assoc();
						$char_row_02_ws = $char_result_02_ws->fetch_assoc();
					}
				}
				else{}
				
				$ws_1a = $char_row_01_ws['ws_1'];
				$ws_1b = $char_row_02_ws['ws_1'];
				
				$ws_2a = $char_row_01_ws['ws_2'];
				$ws_2b = $char_row_02_ws['ws_2'];
				
				$ws_3a = $char_row_01_ws['ws_3'];
				$ws_3b = $char_row_02_ws['ws_3'];
				
				$ws_4a = $char_row_01_ws['ws_4'];
				$ws_4b = $char_row_02_ws['ws_4'];
				
				if($ws_1a>0 and $ws_2a>0 and $ws_3a>0 and $ws_4a>0 ){
					$ws_ave_1 = ( $ws_1a + $ws_2a + $ws_3a + $ws_4a )/4;
				}
				else{
					$ws_ave_1 = "";
				}
				
				if($ws_1b>0 and $ws_2b>0 and $ws_3b>0 and $ws_4b>0 ){
					$ws_ave_2 = ( $ws_1b + $ws_2b +  $ws_3b + $ws_4b  )/4;
				}
				else{
					$ws_ave_2 = "";
				}
			
				if($ws_1a>0 and $ws_1b>0 ){
					$ws_fr_1 = ( $ws_1a + $ws_1b )/2;
				}
				else{
					$ws_fr_1 = "";
				}
					
				if($ws_2a>0 and $ws_2b>0 ){
					$ws_fr_2 = ( $ws_2a + $ws_2b )/2;
				}
				else{
					$ws_fr_2 = "";
					
				}if($ws_3a>0 and $ws_3b>0 ){
					$ws_fr_3 = ( $ws_3a + $ws_3b )/2;
				}
				else{
					$ws_fr_3 = "";
					
				}if($ws_4a>0 and $ws_4b>0 ){
					$ws_fr_4 = ( $ws_4a + $ws_4b )/2;
				}
				else{
					$ws_fr_4 = "";
				}
				if($ws_fr_1>0 and $ws_fr_2>0 and $ws_fr_3>0 and $ws_fr_4>0 ){
					$ws_fr_ave = ( $ws_fr_1 + $ws_fr_2 + $ws_fr_3 + $ws_fr_4 )/4;
				}
				else{
					$ws_fr_ave ="";
				}
				
				
					echo 	"<tr>
								<td>Exhibits pencil/crayon grasp.</td><td align='center'>". letter_grade($ws_1a)."</td><td align='center'>". letter_grade($ws_1b)."</td><td align='center'>". letter_grade($ws_fr_1)."</td>
							</tr>
							";
							?>
			</tr></table>
			
		</td>
		<td style="width:2%">
            &nbsp;
        </td>	
		<td>		
		<table class='table table-bordered table-condensed' style='font-size:80%'>
		
			<?php
			
				//writing skills data fetch
				$char_build_01_wsf = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_wsf = $conn->query($char_build_01_wsf);
					
				$char_build_01_ws = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_ws = $conn->query($char_build_01_ws);
			
				$char_build_02_ws = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_ws = $conn->query($char_build_02_ws);			

				if ($char_result_01_ws->num_rows > 0 ) 
				{                                        										
					//fetch remarks							
					while  ( $char_row_01_wsf = $char_result_01_wsf->fetch_assoc()) 
					{ 
						$char_row_01_ws = $char_result_01_ws->fetch_assoc();
						$char_row_02_ws = $char_result_02_ws->fetch_assoc();
					}
				}
				else{}
			
				$ws_3a = $char_row_01_ws['ws_3'];
				$ws_3b = $char_row_02_ws['ws_3'];
				
				$ws_4a = $char_row_01_ws['ws_4'];
				$ws_4b = $char_row_02_ws['ws_4'];
				
				if($ws_1a>0 and $ws_2a>0 and $ws_3a>0 and $ws_4a>0 ){
					$ws_ave_1 = ( $ws_1a + $ws_2a + $ws_3a + $ws_4a )/4;
				}
				else{
					$ws_ave_1 = "";
				}
				
				if($ws_1b>0 and $ws_2b>0 and $ws_3b>0 and $ws_4b>0 ){
					$ws_ave_2 = ( $ws_1b + $ws_2b +  $ws_3b + $ws_4b  )/4;
				}
				else{
					$ws_ave_2 = "";
				}
			
				if($ws_3a>0 and $ws_3b>0 ){
					$ws_fr_3 = ( $ws_3a + $ws_3b )/2;
				}
				else{
					$ws_fr_3 = "";
					
				}if($ws_4a>0 and $ws_4b>0 ){
					$ws_fr_4 = ( $ws_4a + $ws_4b )/2;
				}
				else{
					$ws_fr_4 = "";
				}
				if($ws_fr_1>0 and $ws_fr_2>0 and $ws_fr_3>0 and $ws_fr_4>0 ){
					$ws_fr_ave = ( $ws_fr_1 + $ws_fr_2 + $ws_fr_3 + $ws_fr_4 )/4;
				}
				else{
					$ws_fr_ave ="";
				}
				
				
					echo 	"
					<tr>
							<td>Traces line, shapes, letters and numbers</td><td align='center'>". letter_grade($ws_2a)."</td><td align='center'>". letter_grade($ws_2b)."</td><td align='center'>". letter_grade($ws_fr_2)."</td>
							</tr>
					<tr>
								<td>Copies shapes, draws basic objects. </td><td align='center'>". letter_grade($ws_3a)."</td><td align='center'>". letter_grade($ws_3b)."</td><td align='center'>". letter_grade($ws_fr_3)."</td>
							</tr>
							<tr>
								<td>Copies letters. </td><td align='center'>". letter_grade($ws_4a)."</td><td align='center'>". letter_grade($ws_4b)."</td><td align='center'>". letter_grade($ws_fr_4)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($ws_ave_1)."</td><td align='center'>". letter_grade($ws_ave_2)."</td><td align='center'>". letter_grade($ws_fr_ave)."</td>
							</tr>";								
			?>
			</tr><tr><td colspan="13"><h5><b>III. SOCIAL AND PLAY DEVELOPMENT</b></td></tr>
			<?php
			
				//social play and development data fetch
				$char_build_01_spdd = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_spdd = $conn->query($char_build_01_spdd);
					
				$char_build_01_spd = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_spd = $conn->query($char_build_01_spd);
			
				$char_build_02_spd = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_spd = $conn->query($char_build_02_spd);			

				
				if ($char_result_01_spd->num_rows > 0 ) 
				{                                        										
					//fetch 
									
					while  ( $char_row_01_spdd = $char_result_01_spdd->fetch_assoc()) 
					{ 
						$char_row_01_spd = $char_result_01_spd->fetch_assoc();
						$char_row_02_spd = $char_result_02_spd->fetch_assoc();
					}					
				}	
				else{}
				
				$spd_1a = $char_row_01_spd['spd_1'];
				$spd_1b = $char_row_02_spd['spd_1'];
			
				$spd_2a = $char_row_01_spd['spd_2'];
				$spd_2b = $char_row_02_spd['spd_2'];
				
				$spd_3a = $char_row_01_spd['spd_3'];
				$spd_3b = $char_row_02_spd['spd_3'];
				
				$spd_4a = $char_row_01_spd['spd_4'];
				$spd_4b = $char_row_02_spd['spd_4'];
				
				$spd_5a = $char_row_01_spd['spd_5'];
				$spd_5b = $char_row_02_spd['spd_5'];
				
				$spd_6a = $char_row_01_spd['spd_6'];
				$spd_6b = $char_row_02_spd['spd_6'];
				
				$spd_7a = $char_row_01_spd['spd_7'];
				$spd_7b = $char_row_02_spd['spd_7'];
				
				$spd_8a = $char_row_01_spd['spd_8'];
				$spd_8b = $char_row_02_spd['spd_8'];
				
				$spd_9a = $char_row_01_spd['spd_9'];
				$spd_9b = $char_row_02_spd['spd_9'];
				
				if($spd_1a>0 and $spd_2a>0 and $spd_3a>0 and $spd_4a>0 and $spd_5a>0 and $spd_6a>0 and $spd_7a>0 and $spd_8a>0 and $spd_9a>0){
					$spd_ave_1 = ( $spd_1a + $spd_2a +  $spd_3a + $spd_4a + $spd_5a + $spd_6a +  $spd_7a + $spd_8a + $spd_9a )/9;
				}
				else{
					$spd_ave_1 = "";
				}
				if($spd_1b>0 and $spd_2b>0 and $spd_3b>0 and $spd_4b>0 and $spd_5b>0 and $spd_6b>0 and $spd_7b>0 and $spd_8b>0 and $spd_9b>0){
					$spd_ave_2 = ( $spd_1b + $spd_2b +  $spd_3b + $spd_4b + $spd_5b + $spd_6b +  $spd_7b + $spd_8b + $spd_9b )/9;
				}
				else{
					$spd_ave_2 = "";
				}
				
				if($spd_1a>0 and $spd_1b>0 ){
					$spd_fr_1 = ( $spd_1a + $spd_1b  )/2;
				}
				else{
					$spd_fr_1 = "";
				}
					
				if($spd_2a>0 and $spd_2b>0 ){
					$spd_fr_2 = ( $spd_2a + $spd_2b  )/2;
				}
				else{
					$spd_fr_2 = "";
				}
				if($spd_3a>0 and $spd_3b>0 ){
					$spd_fr_3 = ( $spd_3a + $spd_3b  )/2;
				}
				else{
					$spd_fr_3 = "";
				}
				if($spd_4a>0 and $spd_4b>0 ){
					$spd_fr_4 = ( $spd_4a + $spd_4b  )/2;
				}
				else{
					$spd_fr_4 = "";
				}
				if($spd_5a>0 and $spd_5b>0 ){
					$spd_fr_5 = ( $spd_5a + $spd_5b  )/2;
				}
				else{
					$spd_fr_5 = "";
				}
				if($spd_6a>0 and $spd_6b>0 ){
					$spd_fr_6 = ( $spd_6a + $spd_6b  )/2;
				}
				else{
					$spd_fr_6 = "";
				}
				if($spd_7a>0 and $spd_7b>0 ){
					$spd_fr_7 = ( $spd_7a + $spd_7b  )/2;
				}
				else{
					$spd_fr_7 = "";
				}
				if($spd_8a>0 and $spd_8b>0 ){
					$spd_fr_8 = ( $spd_8a + $spd_8b  )/2;
				}
				else{
					$spd_fr_8 = "";
				}
				if($spd_9a>0 and $spd_9b>0 ){
					$spd_fr_9 = ( $spd_9a + $spd_9b  )/2;
				}
				else{
					$spd_fr_9 = "";
				}
								
				if($spd_fr_1>0 and $spd_fr_2>0 and $spd_fr_3>0 and $spd_fr_4>0 and $spd_fr_5>0 and $spd_fr_6>0 and $spd_fr_7>0 and $spd_fr_8>0 and $spd_fr_9>0 ){
					$spd_fr_ave = ( $spd_fr_1 + $spd_fr_2 + $spd_fr_3 + $spd_fr_4 + $spd_fr_5 + $spd_fr_6 + $spd_fr_7 + $spd_fr_8 + $spd_fr_9 )/9;
				}
				else{
					$spd_fr_ave ="";
				}
				
					echo 	"<tr>
								<td>Plays well with others and a good sport. </td><td align='center'>".letter_grade($spd_1a)."</td><td align='center'>".letter_grade($spd_1b)."</td><td align='center'>". letter_grade($spd_fr_1)."</td>
							</tr>
							<tr>
								<td>Seeks other children to play with or will join when asked. </td><td align='center'>". letter_grade($spd_2a)."</td><td align='center'>". letter_grade($spd_2b)."</td><td align='center'>". letter_grade($spd_fr_2)."</td>
							</tr>
							<tr>
								<td>Knows how to share. </td><td align='center'>". letter_grade($spd_3a)."</td><td align='center'>". letter_grade($spd_3b)."</td><td align='center'>". letter_grade($spd_fr_3)."</td>
							</tr>
							<tr>
								<td>Accepts mistakes and corrections. </td><td align='center'>". letter_grade($spd_4a)."</td><td align='center'>". letter_grade($spd_4b)."</td><td align='center'>". letter_grade($spd_fr_4)."</td>
							</tr>
							<tr>
								<td>Waits for one's turn. </td><td align='center'>". letter_grade($spd_5a)."</td><td align='center'>". letter_grade($spd_5b)."</td><td align='center'>". letter_grade($spd_fr_5)."</td>
							</tr><tr>
								<td>Knows classmates by name. </td><td align='center'>". letter_grade($spd_6a)."</td><td align='center'>". letter_grade($spd_6b)."</td><td align='center'>". letter_grade($spd_fr_6)."</td>
							</tr><tr>
								<td>Can be away from parents for 2-3 hours without being upset. </td><td align='center'>". letter_grade($spd_7a)."</td><td align='center'>". letter_grade($spd_7b)."</td><td align='center'>". letter_grade($spd_fr_7)."</td>
							</tr>
							<tr>
								<td>Cares for own belongings. </td><td align='center'>". letter_grade($spd_8a)."</td><td align='center'>". letter_grade($spd_8b)."</td><td align='center'>". letter_grade($spd_fr_8)."</td>
							</tr><tr>
								<td>Demonstrates safety behavior when using toys and other classroom tools. </td><td align='center'>". letter_grade($spd_9a)."</td><td align='center'>". letter_grade($spd_9b)."</td><td align='center'>". letter_grade($spd_fr_9)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($spd_ave_1)."</td><td align='center'>". letter_grade($spd_ave_2)."</td><td align='center'>". letter_grade($spd_fr_ave)."</td>
							</tr>";									
			?>
			</tr><tr><td colspan="13"><h5><b>IV. SELF-HELP SKILLS</b></td></tr>
			<?php
			
				//social play and development data fetch
				$char_build_01_shss = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_shss = $conn->query($char_build_01_shss);
					
				$char_build_01_shs = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_shs = $conn->query($char_build_01_shs);
			
				$char_build_02_shs = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_shs = $conn->query($char_build_02_shs);			

				
				if ($char_result_01_shs->num_rows > 0 ) 
				{                                        										
					//fetch 
									
					while  ( $char_row_01_shss = $char_result_01_shss->fetch_assoc()) 
					{ 
						$char_row_01_shs = $char_result_01_shs->fetch_assoc();
						$char_row_02_shs = $char_result_02_shs->fetch_assoc();
					}					
				}	
				else{}
				
				$shs_1a = $char_row_01_shs['shs_1'];
				$shs_1b = $char_row_02_shs['shs_1'];
				
				$shs_2a = $char_row_01_shs['shs_2'];
				$shs_2b = $char_row_02_shs['shs_2'];
				
				$shs_3a = $char_row_01_shs['shs_3'];
				$shs_3b = $char_row_02_shs['shs_3'];
				
				$shs_4a = $char_row_01_shs['shs_4'];
				$shs_4b = $char_row_02_shs['shs_4'];
				
				$shs_5a = $char_row_01_shs['shs_5'];
				$shs_5b = $char_row_02_shs['shs_5'];
			
				
				if($shs_1a>0 and $shs_2a>0 and $shs_3a>0 and $shs_4a>0 and $shs_5a>0){
					$shs_ave_1 = ( $shs_1a + $shs_2a +  $shs_3a + $shs_4a + $shs_5a )/5;
				}
				else{
					$shs_ave_1 = "";
				}
				if($shs_1b>0 and $shs_2b>0 and $shs_3b>0 and $shs_4b>0 and $shs_5b>0){
					$shs_ave_2 = ( $shs_1b + $shs_2b +  $shs_3b + $shs_4b + $shs_5b )/5;
				}
				else{
					$shs_ave_2 = "";
				}
				
				
				if($shs_1a>0 and $shs_1b>0  ){
					$shs_fr_1 = ( $shs_1a + $shs_1b  )/2;
				}
				else{
					$shs_fr_1 = "";
				}
					
				if($shs_2a>0 and $shs_2b>0  ){
					$shs_fr_2 = ( $shs_2a + $shs_2b  )/2;
				}
				else{
					$shs_fr_2 = "";
				}
				
				if($shs_3a>0 and $shs_3b>0  ){
					$shs_fr_3 = ( $shs_3a + $shs_3b  )/2;
				}
				else{
					$shs_fr_3 = "";
				}
				
				if($shs_4a>0 and $shs_4b>0  ){
					$shs_fr_4 = ( $shs_4a + $shs_4b  )/2;
				}
				else{
					$shs_fr_4 = "";
				}
				
				if($shs_5a>0 and $shs_5b>0  ){
					$shs_fr_5 = ( $shs_5a + $shs_5b  )/2;
				}
				else{
					$shs_fr_5 = "";
				}				
				
				if($shs_fr_1>0 and $shs_fr_2>0 and $shs_fr_3>0 and $shs_fr_4>0 and $shs_fr_5>0){
					$shs_fr_ave = ( $shs_fr_1 + $shs_fr_2 + $shs_fr_3 + $shs_fr_4 + $shs_fr_5 )/5;
				}
				else{
					$shs_fr_ave ="";
				}
				
					echo 	"<tr>
								<td>Sets the table and feed self independently. </td><td align='center'>".letter_grade($shs_1a)."</td><td align='center'>".letter_grade($shs_1b)."</td><td align='center'>". letter_grade($shs_fr_1)."</td>
							</tr>
							<tr>
								<td>Dresses/undresses without assistance. </td><td align='center'>". letter_grade($shs_2a)."</td><td align='center'>". letter_grade($shs_2b)."</td><td align='center'>". letter_grade($shs_fr_2)."</td>
							</tr>
							<tr>
								<td>Works independently. </td><td align='center'>". letter_grade($shs_3a)."</td><td align='center'>". letter_grade($shs_3b)."</td><td align='center'>". letter_grade($shs_fr_3)."</td>
							</tr>
							<tr>
								<td>Indicates toilet needs and uses it independently. </td><td align='center'>". letter_grade($shs_4a)."</td><td align='center'>". letter_grade($shs_4b)."</td><td align='center'>". letter_grade($shs_fr_4)."</td>
							</tr>
							<tr>
								<td>Enjoys coming to school promptly. </td><td align='center'>". letter_grade($shs_5a)."</td><td align='center'>". letter_grade($shs_5b)."</td><td align='center'>". letter_grade($shs_fr_5)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($shs_ave_1)."</td><td align='center'>". letter_grade($shs_ave_2)."</td><td align='center'>". letter_grade($shs_fr_ave)."</td>
							</tr>";									
			?>
			</tr><tr><td colspan="13"><h5><b>V. SPIRITUAL PROGRESS</b></td></tr>
			<?php
			
				//social play and development data fetch
				$char_build_01_spp = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_spp = $conn->query($char_build_01_spp);
					
				$char_build_01_sp = "SELECT * from character_building_nursery1 where marking_period_id = 16 and student_id = $student_id ";			
					$char_result_01_sp = $conn->query($char_build_01_sp);
			
				$char_build_02_sp = "SELECT * from character_building_nursery1 where marking_period_id = 18 and student_id = $student_id ";			
					$char_result_02_sp = $conn->query($char_build_02_sp);			
				
				if ($char_result_01_sp->num_rows > 0 ) 
				{                                        										
					//fetch 
									
					while  ( $char_row_01_spp = $char_result_01_spp->fetch_assoc()) 
					{ 
						$char_row_01_sp = $char_result_01_sp->fetch_assoc();
						$char_row_02_sp = $char_result_02_sp->fetch_assoc();
						
					}					
				}	
				else{}
				
				$sp_1a = $char_row_01_sp['sp_1'];
				$sp_1b = $char_row_02_sp['sp_1'];
							
				$sp_2a = $char_row_01_sp['sp_2'];
				$sp_2b = $char_row_02_sp['sp_2'];
			
				$sp_3a = $char_row_01_sp['sp_3'];
				$sp_3b = $char_row_02_sp['sp_3'];
				
				$sp_4a = $char_row_01_sp['sp_4'];
				$sp_4b = $char_row_02_sp['sp_4'];
				
				$sp_5a = $char_row_01_sp['sp_5'];
				$sp_5b = $char_row_02_sp['sp_5'];
				
				$sp_6a = $char_row_01_sp['sp_6'];
				$sp_6b = $char_row_02_sp['sp_6'];
				
				if($sp_1a>0 and $sp_2a>0 and $sp_3a>0 and $sp_4a>0 and $sp_5a>0 and $sp_6a>0){
					$sp_ave_1 = ( $sp_1a + $sp_2a +  $sp_3a + $sp_4a +  $sp_5a + $sp_6a )/6;
				}
				else{
					$sp_ave_1 = "";
				}
				if($sp_1b>0 and $sp_2b>0 and $sp_3b>0 and $sp_4b>0 and $sp_5b>0 and $sp_6b>0){
					$sp_ave_2 = ( $sp_1b + $sp_2b +  $sp_3b + $sp_4b + $sp_5b + $sp_6b )/6;
				}
				else{
					$sp_ave_2 = "";
				}				
				
				if($sp_1a>0 and $sp_1b>0 ){
					$sp_fr_1 = ( $sp_1a + $sp_1b)/2;
				}
				else{
					$sp_fr_1 = "";
				}
					
				if($sp_2a>0 and $sp_2b>0 ){
					$sp_fr_2 = ( $sp_2a + $sp_2b)/2;
				}
				else{
					$sp_fr_2 = "";
				}
				if($sp_3a>0 and $sp_3b>0 ){
					$sp_fr_3 = ( $sp_3a + $sp_3b)/2;
				}
				else{
					$sp_fr_3 = "";
				}
				if($sp_4a>0 and $sp_4b>0 ){
					$sp_fr_4 = ( $sp_4a + $sp_4b)/2;
				}
				else{
					$sp_fr_4 = "";
				}
				if($sp_5a>0 and $sp_5b>0 ){
					$sp_fr_5 = ( $sp_5a + $sp_5b)/2;
				}
				else{
					$sp_fr_5 = "";
				}
				if($sp_6a>0 and $sp_6b>0 ){
					$sp_fr_6 = ( $sp_6a + $sp_6b)/2;
				}
				else{
					$sp_fr_6 = "";
				}
				
				if($sp_fr_1>0 and $sp_fr_2>0 and $sp_fr_3>0 and $sp_fr_4>0 and $sp_fr_5>0 and $sp_fr_6>0){
					$sp_fr_ave = ( $sp_fr_1 + $sp_fr_2 + $sp_fr_3 + $sp_fr_4 + $sp_fr_5 + $sp_fr_6 )/6;
				}
				else{
					$sp_fr_ave ="";
				}
				
					echo 	"<tr>
								<td>Enjoys singing praise and worship songs. </td><td align='center'>".letter_grade($sp_1a)."</td><td align='center'>".letter_grade($sp_1b)."</td><td align='center'>". letter_grade($sp_fr_1)."</td>
							</tr>
							<tr>
								<td>Takes active part in praying. </td><td align='center'>". letter_grade($sp_2a)."</td><td align='center'>". letter_grade($sp_2b)."</td><td align='center'>". letter_grade($sp_fr_2)."</td>
							</tr>
							<tr>
								<td>Recalls and retells Bible stories. </td><td align='center'>". letter_grade($sp_3a)."</td><td align='center'>". letter_grade($sp_3b)."</td><td align='center'>". letter_grade($sp_fr_3)."</td>
							</tr>
							<tr>
								<td>Memorizes simple Bible verses. </td><td align='center'>". letter_grade($sp_4a)."</td><td align='center'>". letter_grade($sp_4b)."</td><td align='center'>". letter_grade($sp_fr_4)."</td>
							</tr>
							<tr>
								<td>Behaves properly during Chapel Service. </td><td align='center'>". letter_grade($sp_5a)."</td><td align='center'>". letter_grade($sp_5b)."</td><td align='center'>". letter_grade($sp_fr_5)."</td>
							</tr>
							<tr>
								<td>Appreciates and shows enthusiasm with Bible stories. </td><td align='center'>". letter_grade($sp_6a)."</td><td align='center'>". letter_grade($sp_6b)."</td><td align='center'>". letter_grade($sp_fr_6)."</td>
							</tr>
							<tr>
								<td>AVERAGE</td><td align='center'>". letter_grade($sp_ave_1)."</td><td align='center'>". letter_grade($sp_ave_2)."</td><td align='center'>". letter_grade($sp_fr_ave)."</td>
							</tr>";									
			?>
			</tr></table>
		</td>	   	
	</td>
  </tr>
</table>

<?php
$conn->close();
?>

</div>
</body>
</html>
