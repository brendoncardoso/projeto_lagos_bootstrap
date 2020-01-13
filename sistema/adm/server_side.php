<?php
include('../includes/conecte.php');
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'curriculos as A';
$join = " INNER JOIN cargos AS B ON (A.cargo = B.id_cargo)";
// Table's primary key
$primaryKey = 'id_curriculo';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
	array( 'db' => 'id_curriculo', 'dt' => 0 ),
	array( 'db' => 'nome',  'dt' => 1 ),
	array( 'db' => 'B.cargo',   'dt' => 2 ),
	array( 'db' => 'telefone',     'dt' => 3 ),
	array( 'db' => 'email',     'dt' => 4 ),
	array(
		'db'        => 'data_reg',
		'dt'        => 5,
		'formatter' => function( $d, $row ) {
			return date( 'd/M/Y', strtotime($d));
		}
	)
);




/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

require( 'ssp.class.php' );
echo json_encode( SSP::juntar( $_POST, $sql_details, $table, $primaryKey, $columns, $join ));
/*echo json_encode(
	SSP::juntar( $_POST, $sql_details, $table, $primaryKey, $columns, $join )
);*/


