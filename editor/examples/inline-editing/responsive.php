<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/ico" href="http://www.datatables.net/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<title>Editor example - Responsive integration</title>
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
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
	<script type="text/javascript" language="javascript" src="../../js/dataTables.editor.min.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/syntax/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/editor-demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
	


var editor; // use a global for the submit and return data rendering in the examples

$(document).ready(function() {
	editor = new $.fn.dataTable.Editor( {
		ajax: "../../controllers/grades.php",
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
				label: "Work and Study Habits Ave.:",
				name: "character_building_preschool.wash_ave"
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
				label: "Social Skills Ave.:",
				name: "character_building_preschool.ss_ave"
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
				label: "Motor Skills Ave.:",
				name: "character_building_preschool.ms_ave"
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
			}, {
				label: "Spiritual Skills Ave.:",
				name: "character_building_preschool.sp_ave"
			}
		]
	} );

	// Activate an inline edit on click of a table cell
	// or a DataTables Responsive data cell
	$('#example').on( 'click', 'tbody td:not(.child), tbody span.dtr-data', function (e) {
		// Ignore the Responsive control and checkbox columns
		if ( $(this).hasClass( 'control' ) || $(this).hasClass('select-checkbox') ) {
			return;
		}

		editor.inline( this );
	} );

	$('#example').DataTable( {
		responsive: true,
		dom: "Bfrtip",
		ajax: "../../controllers/grades.php",
		columns: [
			{   // Responsive control column
				data: null,
				defaultContent: '',
				className: 'control',
				orderable: false
			},
			{   // Checkbox select column
				data: null,
				defaultContent: '',
				className: 'select-checkbox',
				orderable: false
			},
			{ data: null, render: function ( data, type, row, meta ) {
				return data.students.last_name + ', ' + data.students.first_name;
				}
			},
			{ data: "character_building_preschool.wash_1" },
			{ data: "character_building_preschool.wash_2" },
			{ data: "character_building_preschool.wash_3" },
			{ data: "character_building_preschool.wash_4" },
			{ data: "character_building_preschool.wash_ave" },
			{ data: "character_building_preschool.ss_1" },
			{ data: "character_building_preschool.ss_2" },
			{ data: "character_building_preschool.ss_3" },
			{ data: "character_building_preschool.ss_4" },
			{ data: "character_building_preschool.ss_5" },
			{ data: "character_building_preschool.ss_ave" },
			{ data: "character_building_preschool.ms_1" },
			{ data: "character_building_preschool.ms_2" },
			{ data: "character_building_preschool.ms_3" },
			{ data: "character_building_preschool.ms_4" },
			{ data: "character_building_preschool.ms_5" },
			{ data: "character_building_preschool.ms_6" },
			{ data: "character_building_preschool.ms_7" },
			{ data: "character_building_preschool.ms_8" },
			{ data: "character_building_preschool.ms_ave" },
		],
		order: [ 2, 'asc' ],
		select: {
			style:    'os',
			selector: 'td.select-checkbox'
		},
		buttons: [
			{ extend: "create", editor: editor },
			{ extend: "edit",   editor: editor },
			{ extend: "remove", editor: editor }
		]
	} );
} );



	</script>
</head>
<body class="dt-example php">
	<div class="container">
		<section>
			<h1>Editor example <span>Responsive integration</span></h1>
			<div class="demo-html"></div>
			<table id="example" class="display nowrap" cellspacing="0" width="100%">
				<!--<thead>
					<tr>
						<th></th>
						<th></th>
						<th>First name</th>
						<th>Last name</th>
						<th>Position</th>
						<th>Office</th>
						<th width="18%">Start date</th>
						<th>Salary</th>
					</tr>
				</thead>-->
				<thead>
					<!--<tr>
						<th>&nbsp;</th>
						<th colspan=5>Work and Study Habits</th>
						<th colspan=6>Social Skills</th>
						<th colspan=9>Motor Skills</th>
						<th colspan=5>Spiritual Skills</th>
					</tr>-->
					<tr>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
						<th>Name</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>AVE</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>AVE</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>AVE</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>AVE</th>
					</tr>
				</thead>
			</table>
		</section>
	</div>
</body>
</html>