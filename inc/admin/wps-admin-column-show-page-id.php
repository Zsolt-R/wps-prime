<?php
/**
 * Add post id to page list admin column
 *
 * @package wps_prime
 */

function wps_pages_column_id($columns) {
    $columns['colID'] = __('ID','wps-prime');
    return $columns;
}
add_filter( 'manage_pages_columns', 'wps_pages_column_id' );
function wps_pages_column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_pages_custom_column', 'wps_pages_column_id_row', 10, 2 );