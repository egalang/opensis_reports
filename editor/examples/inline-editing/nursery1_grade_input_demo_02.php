<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<title>Grading Sheet</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../../css/editor.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="../resources/syntax/shCore.css">
<link rel="stylesheet" type="text/css" href="../resources/demo.css">
<style type="text/css" class="init">
        
</style>
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/editor-demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	
	<?php
	if ( ! isset($_GET["mp"]) ) {
		$marking_period_id = 0;
	} else {
		$marking_period_id = $_GET["mp"];
	}

	if ( ! isset($_GET["id"]) ) {
		$section_id = 0;
	} else {
		$section_id = $_GET["id"];
	}
	
	$servername = "localhost";
	$username = "root";
	$password = "Q1w2e3r4";
	$dbname = "opensis";
	
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$students = "select students.student_id,students.last_name,students.first_name,students.middle_name,student_enrollment.section_id from students
				 left join student_enrollment on students.student_id = student_enrollment.student_id
				 where student_enrollment.section_id = $section_id ";
	$students_result = $conn->query($students);
	if ($students_result->num_rows > 0){
		while($students_row = $students_result->fetch_assoc()){
			$student_id = $students_row['student_id'];
			$sql = "INSERT INTO character_building_preschool (school_id,marking_period_id,section_id,student_id) values (1,$marking_period_id,$section_id,$student_id)";
			if ($conn->query($sql) === TRUE) {
				#echo "New record created successfully";
			} else {
				#echo "Error: " . $sql . "<br>" . $conn->error;
			}									
		}
	}
	
	?>

	var editor; // use a global for the submit and return data rendering in the examples

	$(document).ready(function() {
		editor = new $.fn.dataTable.Editor( {
			ajax: { 
					url: "../../controllers/grades_N1.php",
					type: "POST",
					data: {
						mp: "<?php echo $marking_period_id ?>",
						id:  "<?php echo $section_id ?>"
					}
				},
			//ajax: "../../controllers/grades.php",
			table: "#example",
			fields: [ {
					label: "Cognitive 1:",
					name: "character_building_nursery1.c_1"
				}, {
					label: "Cognitive 2:",
					name: "character_building_nursery1.c_2"
				}, {
					label: "Cognitive 3:",
					name: "character_building_nursery1.c_3"
				}, {
					label: "Cognitive 4:",
					name: "character_building_nursery1.c_4"
				}, {
					label: "Cognitive 5:",
					name: "character_building_nursery1.c_5"
				}, {
					label: "Cognitive 6:",
					name: "character_building_nursery1.c_6"
				}, {
					label: "Cognitive 7:",
					name: "character_building_nursery1.c_7"
				}, {
					label: "Cognitive 8:",
					name: "character_building_nursery1.c_8"
				}, {
					label: "Cognitive 9:",
					name: "character_building_nursery1.c_9"
				}, {
					label: "Cognitive 10:",
					name: "character_building_nursery1.c_10"
				}, {
					label: "Cognitive 11:",
					name: "character_building_nursery1.c_11"
				}, {
					label: "Cognitive 12:",
					name: "character_building_nursery1.c_12"
				}, {
					label: "Cognitive 13:",
					name: "character_building_nursery1.c_13"
				}, {
					label: "Gross motor 1:",
					name: "character_building_nursery1.gm_1"
				}, {
					label: "Gross motor 2:",
					name: "character_building_nursery1.gm_2"
				}, {
					label: "Gross motor 3:",
					name: "character_building_nursery1.gm_3"
				}, {
					label: "Gross motor 4:",
					name: "character_building_nursery1.gm_4"
				}, {
					label: "Fine motor 1:",
					name: "character_building_nursery1.fm_1"
				}, {
					label: "Fine motor 2:",
					name: "character_building_nursery1.fm_2"
				}, {
					label: "Fine motor 3:",
					name: "character_building_nursery1.fm_3"
				}, {
					label: "Fine motor 4:",
					name: "character_building_nursery1.fm_4"
				}, {
					label: "Fine motor 5:",
					name: "character_building_nursery1.fm_5"
				}, {
					label: "Writing Skills 1:",
					name: "character_building_nursery1.ws_1"
				}, {
					label: "Writing Skills 2:",
					name: "character_building_nursery1.ws_2"
				}, {
					label: "Writing Skills 3:",
					name: "character_building_nursery1.ws_3"
				}, {
					label: "Writing Skills 4:",
					name: "character_building_nursery1.ws_4"
				}, {
					label: "Social and Play Development 1:",
					name: "character_building_nursery1.spd_1"
				}, {
					label: "Social and Play Development 2:",
					name: "character_building_nursery1.spd_2"
				}, {
					label: "Social and Play Development 3:",
					name: "character_building_nursery1.spd_3"
				}, {
					label: "Social and Play Development 4:",
					name: "character_building_nursery1.spd_4"
				}, {
					label: "Social and Play Development 5:",
					name: "character_building_nursery1.spd_5"
				}, {
					label: "Social and Play Development 6:",
					name: "character_building_nursery1.spd_6"
				}, {
					label: "Social and Play Development 7:",
					name: "character_building_nursery1.spd_7"
				}, {
					label: "Social and Play Development 8:",
					name: "character_building_nursery1.spd_8"
				}, {
					label: "Social and Play Development 9:",
					name: "character_building_nursery1.spd_9"
				}, {
					label: "Self-Help Skills 1:",
					name: "character_building_nursery1.shs_1"
				}, {
					label: "Self-Help Skills 2:",
					name: "character_building_nursery1.shs_2"
				}, {
					label: "Self-Help Skills 3:",
					name: "character_building_nursery1.shs_3"
				}, {
					label: "Self-Help Skills 4:",
					name: "character_building_nursery1.shs_4"
				}, {
					label: "Self-Help Skills 5:",
					name: "character_building_nursery1.shs_5"
				}, {
					label: "Spiritual Progress 1:",
					name: "character_building_nursery1.sp_1"
				}, {
					label: "Spiritual Progress 2:",
					name: "character_building_nursery1.sp_2"
				}, {
					label: "Spiritual Progress 3:",
					name: "character_building_nursery1.sp_3"
				}, {
					label: "Spiritual Progress 4:",
					name: "character_building_nursery1.sp_4"
				}, {
					label: "Spiritual Progress 5:",
					name: "character_building_nursery1.sp_5"
				}, {
					label: "Spiritual Progress 6:",
					name: "character_building_nursery1.sp_6"
				}
			]
		} );

		// Activate an inline edit on click of a table cell
		$('#example').on( 'click', 'tbody td:not(:first-child)', function (e) {
			editor.inline( this, {
				onBlur: 'submit'
			} );
		} );

		$('#example').DataTable( {
			dom: "Bfrtip",
			ajax: { 
					url: "../../controllers/grades_N1.php",
					type: "POST",
					data: {
						mp: "<?php echo $marking_period_id ?>",
						id:  "<?php echo $section_id ?>"
					}
				},
			//ajax: {
			//	url: "../../controllers/grades.php",
			//	type: 'POST'
			//},
			columns: [
				//{
				//	data: null,
				//	defaultContent: '',
				//	className: 'select-checkbox',
				//	orderable: false
				//},
				{ data: null, render: function ( data, type, row, meta ) {
					return data.students.last_name + ', ' + data.students.first_name;
					}
				},
				{ data: "character_building_nursery1.c_1" },
				{ data: "character_building_nursery1.c_2" },
				{ data: "character_building_nursery1.c_3" },
				{ data: "character_building_nursery1.c_4" },
				{ data: "character_building_nursery1.c_5" },
				{ data: "character_building_nursery1.c_6" },
				{ data: "character_building_nursery1.c_7" },
				{ data: "character_building_nursery1.c_8" },
				{ data: "character_building_nursery1.c_9" },
				{ data: "character_building_nursery1.c_10" },
				{ data: "character_building_nursery1.c_11" },
				{ data: "character_building_nursery1.c_12" },
				{ data: "character_building_nursery1.c_13" },
				{ data: "character_building_nursery1.gm_1" },
				{ data: "character_building_nursery1.gm_2" },
				{ data: "character_building_nursery1.gm_3" },
				{ data: "character_building_nursery1.gm_4" },
				{ data: "character_building_nursery1.fm_1" },
				{ data: "character_building_nursery1.fm_2" },
				{ data: "character_building_nursery1.fm_3" },
				{ data: "character_building_nursery1.fm_4" },
				{ data: "character_building_nursery1.fm_5" },
				{ data: "character_building_nursery1.ws_1" },
				{ data: "character_building_nursery1.ws_2" },
				{ data: "character_building_nursery1.ws_3" },
				{ data: "character_building_nursery1.ws_4" },
				{ data: "character_building_nursery1.spd_1" },
				{ data: "character_building_nursery1.spd_2" },
				{ data: "character_building_nursery1.spd_3" },
				{ data: "character_building_nursery1.spd_4" },
				{ data: "character_building_nursery1.spd_5" },
				{ data: "character_building_nursery1.spd_6" },
				{ data: "character_building_nursery1.spd_7" },
				{ data: "character_building_nursery1.spd_8" },
				{ data: "character_building_nursery1.spd_9" },
				{ data: "character_building_nursery1.shs_1" },
				{ data: "character_building_nursery1.shs_2" },
				{ data: "character_building_nursery1.shs_3" },
				{ data: "character_building_nursery1.shs_4" },
				{ data: "character_building_nursery1.shs_5" },
				{ data: "character_building_nursery1.sp_1" },
				{ data: "character_building_nursery1.sp_2" },
				{ data: "character_building_nursery1.sp_3" },
				{ data: "character_building_nursery1.sp_4" },
				{ data: "character_building_nursery1.sp_5" },
				{ data: "character_building_nursery1.sp_6" }
			],
			order: [ 1, 'asc' ],
			ordering: false,
			paging: false,
			searching: false,
			select: {
				style:    'os',
				selector: 'td:first-child'
			},
			buttons: [
			//	{ extend: "create", editor: editor },
				{ extend: "edit",   editor: editor }
			//	{ extend: "remove", editor: editor }
			]
		} );
	} );



	</script>
</head>
<body class="dt-example php">
	<div class="container" style="max-width:fit-content">
		<section>
			<?php

			echo "<br><form method='GET' action=''>";
			echo "<select name='mp' style='font-size:80%'>";
			echo "<option value=0>Select a marking period</option>";
			$id_sql = "select marking_period_id,title from marking_periods where marking_period_id IN (16,18)";
			$id_result = $conn->query($id_sql);
			if ($id_result->num_rows > 0) {
				while($id_row = $id_result->fetch_assoc()) {
					echo "<option value='".$id_row["marking_period_id"]."'>".$id_row["title"]."</option>";
				}
			}
			echo "</select>&nbsp;";
			echo "<select name='id' style='font-size:80%'>";
			echo "<option value=0>Select a section</option>";
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

			$mp_sql = "select syear,title from marking_periods where marking_period_id = $marking_period_id";
			$mp_result = $conn->query($mp_sql);
			$mp_row = $mp_result->fetch_assoc();
			$syear = $mp_row['syear'];
			$mp_title = $mp_row['title'];
			
			$sec_sql = "select id,name from school_gradelevel_sections where id = $section_id";
			$sec_result = $conn->query($sec_sql);
			$sec_row = $sec_result->fetch_assoc();
			$sec_title = $sec_row['name'];

			?>

			<h1><?php echo $sec_title ?> <span><?php echo $mp_title ?></span></h1>
			<div class="demo-html"></div>
			<!--<table id="example" class="display" cellspacing="0" width="100%" style='font-size:80%'>-->
			<table border=1 id="example" class="display responsive nowrap" style="width:100%">

				<thead>
					<tr>
						<th >&nbsp;</th>
						<th colspan=13>I. Cognitive</th>
						<th colspan=4>II. A. Gross Motor</th>
						<th colspan=5>II. B.Fine Motor</th>
						<th colspan=4>II. C.Writing Skills</th>
						<th colspan=9>III. Social and Play Development</th>
						<th colspan=5>IV. Self-Help Skills</th>
						<th colspan=6>V. Spiritual Progress</th>
						
					</tr>
					<tr>
						<th>Name</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
					</tr>
				</thead>
			</table>
		</section>
	</div>
</body>
</html>
