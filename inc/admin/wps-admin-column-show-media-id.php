<?php
/**
 * Media Library media ID admin column
 *
 * @package wps_prime
 */

function wps_column_id($columns) {
    $columns['colID'] = __('ID','wps-prime');
    return $columns;
}
add_filter( 'manage_media_columns', 'wps_column_id' );
function wps_column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_media_custom_column', 'wps_column_id_row', 10, 2 );