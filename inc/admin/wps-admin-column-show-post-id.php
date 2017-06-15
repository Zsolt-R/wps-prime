<?php
/**
 * Add post id to post list admin column
 *
 * @package wps_prime
 */

function wps_posts_column_id($columns) {
    $columns['colID'] = __('ID','wps-prime');
    return $columns;
}
add_filter( 'manage_posts_columns', 'wps_posts_column_id' );
function wps_posts_column_id_row($columnName, $columnID){
    if($columnName == 'colID'){
       echo $columnID;
    }
}
add_filter( 'manage_posts_custom_column', 'wps_posts_column_id_row', 10, 2 );