<?php

// DataTables PHP library
include( "../lib/DataTables.php" );

// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Options,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate,
	DataTables\Editor\ValidateOptions;


/*
 * Example PHP implementation used for the join.html example
 */
if ( ( ! isset($_POST['id']) ) and ( ! isset($_POST['mp']) ) ) {
    echo json_encode( [ "data" => [] ] );
} else {
$mp = $_POST["mp"];
$id = $_POST["id"];
Editor::inst( $db, 'character_building_nursery1' )
	->where( 'marking_period_id', $mp )
	->where( 'section_id', $id )
	->field( 
		Field::inst( 'character_building_nursery1.student_id' ),
		Field::inst( 'students.last_name' ),
		Field::inst( 'students.first_name' ),
		Field::inst( 'students.middle_name' ),
		Field::inst( 'character_building_nursery1.c_1' ),
		Field::inst( 'character_building_nursery1.c_2' ),
		Field::inst( 'character_building_nursery1.c_3' ),
		Field::inst( 'character_building_nursery1.c_4' ),
		Field::inst( 'character_building_nursery1.c_5' ),
		Field::inst( 'character_building_nursery1.c_6' ),
		Field::inst( 'character_building_nursery1.c_7' ),
		Field::inst( 'character_building_nursery1.c_8' ),
		Field::inst( 'character_building_nursery1.c_9' ),
		Field::inst( 'character_building_nursery1.c_10' ),
		Field::inst( 'character_building_nursery1.c_11' ),
		Field::inst( 'character_building_nursery1.c_12' ),
		Field::inst( 'character_building_nursery1.c_13' ),
		Field::inst( 'character_building_nursery1.gm_1' ),
		Field::inst( 'character_building_nursery1.gm_2' ),
		Field::inst( 'character_building_nursery1.gm_3' ),
		Field::inst( 'character_building_nursery1.gm_4' ),
		Field::inst( 'character_building_nursery1.fm_1' ),
		Field::inst( 'character_building_nursery1.fm_2' ),
		Field::inst( 'character_building_nursery1.fm_3' ),
		Field::inst( 'character_building_nursery1.fm_4' ),
		Field::inst( 'character_building_nursery1.fm_5' ),
		Field::inst( 'character_building_nursery1.ws_1' ),
		Field::inst( 'character_building_nursery1.ws_2' ),
		Field::inst( 'character_building_nursery1.ws_3' ),
		Field::inst( 'character_building_nursery1.ws_4' ),
		Field::inst( 'character_building_nursery1.spd_1' ),
		Field::inst( 'character_building_nursery1.spd_2' ),
		Field::inst( 'character_building_nursery1.spd_3' ),
		Field::inst( 'character_building_nursery1.spd_4' ),
		Field::inst( 'character_building_nursery1.spd_5' ),
		Field::inst( 'character_building_nursery1.spd_6' ),
		Field::inst( 'character_building_nursery1.spd_7' ),
		Field::inst( 'character_building_nursery1.spd_8' ),
		Field::inst( 'character_building_nursery1.spd_9' ),
		Field::inst( 'character_building_nursery1.shs_1' ),
		Field::inst( 'character_building_nursery1.shs_2' ),
		Field::inst( 'character_building_nursery1.shs_3' ),
		Field::inst( 'character_building_nursery1.shs_4' ),
		Field::inst( 'character_building_nursery1.shs_5' ),
		Field::inst( 'character_building_nursery1.sp_1' ),
		Field::inst( 'character_building_nursery1.sp_2' ),
		Field::inst( 'character_building_nursery1.sp_3' ),
		Field::inst( 'character_building_nursery1.sp_4' ),
		Field::inst( 'character_building_nursery1.sp_5' ),
		Field::inst( 'character_building_nursery1.sp_6' )
	)
	->leftJoin( 'students', 'character_building_nursery1.student_id', '=', 'students.student_id' )
	->process($_POST)
	->json();
}
