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
				 where student_enrollment.section_id = $section_id";
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
					url: "../../controllers/grades.php",
					type: "POST",
					data: {
						mp: "<?php echo $marking_period_id ?>",
						id:  "<?php echo $section_id ?>"
					}
				},
			//ajax: "../../controllers/grades.php",
			table: "#example",
			fields: [ {
					label: "Work and Study Habits 1:",
					name: "character_building_preschool.wash_1"
				}, {
					label: "Work and Study Habits 2:",
					name: "character_building_preschool.wash_2"
				}, {
					label: "Work and Study Habits 3:",
					name: "character_building_preschool.wash_3"
				}, {
					label: "Work and Study Habits 4:",
					name: "character_building_preschool.wash_4"
				}, {
					label: "Social Skills 1:",
					name: "character_building_preschool.ss_1"
				}, {
					label: "Social Skills 2:",
					name: "character_building_preschool.ss_2"
				}, {
					label: "Social Skills 3:",
					name: "character_building_preschool.ss_3"
				}, {
					label: "Social Skills 4:",
					name: "character_building_preschool.ss_4"
				}, {
					label: "Social Skills 5:",
					name: "character_building_preschool.ss_5"
				}, {
					label: "Motor Skills 1:",
					name: "character_building_preschool.ms_1"
				}, {
					label: "Motor Skills 2:",
					name: "character_building_preschool.ms_2"
				}, {
					label: "Motor Skills 3:",
					name: "character_building_preschool.ms_3"
				}, {
					label: "Motor Skills 4:",
					name: "character_building_preschool.ms_4"
				}, {
					label: "Motor Skills 5:",
					name: "character_building_preschool.ms_5"
				}, {
					label: "Motor Skills 6:",
					name: "character_building_preschool.ms_6"
				}, {
					label: "Motor Skills 7:",
					name: "character_building_preschool.ms_7"
				}, {
					label: "Motor Skills 8:",
					name: "character_building_preschool.ms_8"
				}, {
					label: "Spiritual Skills 1:",
					name: "character_building_preschool.sp_1"
				}, {
					label: "Spiritual Skills 2:",
					name: "character_building_preschool.sp_2"
				}, {
					label: "Spiritual Skills 3:",
					name: "character_building_preschool.sp_3"
				}, {
					label: "Spiritual Skills 4:",
					name: "character_building_preschool.sp_4"
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
					url: "../../controllers/grades.php",
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
				{ data: "character_building_preschool.wash_1" },
				{ data: "character_building_preschool.wash_2" },
				{ data: "character_building_preschool.wash_3" },
				{ data: "character_building_preschool.wash_4" },
				{ data: "character_building_preschool.ss_1" },
				{ data: "character_building_preschool.ss_2" },
				{ data: "character_building_preschool.ss_3" },
				{ data: "character_building_preschool.ss_4" },
				{ data: "character_building_preschool.ss_5" },
				{ data: "character_building_preschool.ms_1" },
				{ data: "character_building_preschool.ms_2" },
				{ data: "character_building_preschool.ms_3" },
				{ data: "character_building_preschool.ms_4" },
				{ data: "character_building_preschool.ms_5" },
				{ data: "character_building_preschool.ms_6" },
				{ data: "character_building_preschool.ms_7" },
				{ data: "character_building_preschool.ms_8" },
				{ data: "character_building_preschool.sp_1" },
				{ data: "character_building_preschool.sp_2" },
				{ data: "character_building_preschool.sp_3" },
				{ data: "character_building_preschool.sp_4" }
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
			$id_sql = "select marking_period_id,title from marking_periods where marking_period_id IN ( 15,16,17,18 ) ";
			$id_result = $conn->query($id_sql);
			if ($id_result->num_rows > 0) {
				while($id_row = $id_result->fetch_assoc()) {
					echo "<option value='".$id_row["marking_period_id"]."'>".$id_row["title"]."</option>";
				}
			}
			echo "</select>&nbsp;";
			echo "<select name='id' style='font-size:80%'>";
			echo "<option value=0>Select a section</option>";
			$id_sql = "select id,name from school_gradelevel_sections where sort_order <6 and sort_order >1 order by sort_order asc";
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
						<th colspan=4>Work and Study Habits</th>
						<th colspan=5>Social Skills</th>
						<th colspan=8>Motor Skills</th>
						<th colspan=4>Spiritual Skills</th>
					</tr>
					<tr>
						<th>Name</th>
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
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
					</tr>
				</thead>
			</table>
		</section>
	</div>
</body>
</html>