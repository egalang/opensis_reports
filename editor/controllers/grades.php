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
Editor::inst( $db, 'character_building_preschool' )
	->where( 'marking_period_id', $mp )
	->where( 'section_id', $id )
	->field( 
		Field::inst( 'character_building_preschool.student_id' ),
		Field::inst( 'students.last_name' ),
		Field::inst( 'students.first_name' ),
		Field::inst( 'students.middle_name' ),
		Field::inst( 'character_building_preschool.wash_1' ),
		Field::inst( 'character_building_preschool.wash_2' ),
		Field::inst( 'character_building_preschool.wash_3' ),
		Field::inst( 'character_building_preschool.wash_4' ),
		Field::inst( 'character_building_preschool.ss_1' ),
		Field::inst( 'character_building_preschool.ss_2' ),
		Field::inst( 'character_building_preschool.ss_3' ),
		Field::inst( 'character_building_preschool.ss_4' ),
		Field::inst( 'character_building_preschool.ss_5' ),
		Field::inst( 'character_building_preschool.ms_1' ),
		Field::inst( 'character_building_preschool.ms_2' ),
		Field::inst( 'character_building_preschool.ms_3' ),
		Field::inst( 'character_building_preschool.ms_4' ),
		Field::inst( 'character_building_preschool.ms_5' ),
		Field::inst( 'character_building_preschool.ms_6' ),
		Field::inst( 'character_building_preschool.ms_7' ),
		Field::inst( 'character_building_preschool.ms_8' ),
		Field::inst( 'character_building_preschool.sp_1' ),
		Field::inst( 'character_building_preschool.sp_2' ),
		Field::inst( 'character_building_preschool.sp_3' ),
		Field::inst( 'character_building_preschool.sp_4' )
	)
	->leftJoin( 'students', 'character_building_preschool.student_id', '=', 'students.student_id' )
	->process($_POST)
	->json();
}
