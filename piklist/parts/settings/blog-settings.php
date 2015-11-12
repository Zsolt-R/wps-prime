<?php

/*
*
*   Theme Settings
*
*/
/*
Title: Blog Settings
Setting: wps_prime_settings
Tab: Blog Settings
*/
piklist('field', array(
'type' => 'select'
,'scope' => 'post_meta' // Not used for settings sections
,'field' => 'archive_article_display_mode'
,'value' => 'show_excerpt' // Sets default to Option 2
,'label' => 'Archive article display mode'
,'description' => 'Set article display type on archive pages (Blog / Archives)'
,'attributes' => array(
  'class' => 'text'
)
,'choices' => array(
  'show_full' => 'Full'
  ,'show_excerpt' => 'Excerpt'
)
));

piklist('field', array(
'type' => 'select'
,'scope' => 'post_meta' // Not used for settings sections
,'field' => 'archive_article_feat_img'
,'value' => 'show' // Sets default to Option 1
,'label' => 'Archive article featured image'
,'description' => 'Set article featured image display on archive pages ( Blog / Archives)'
,'attributes' => array(
  'class' => 'text'
)
,'choices' => array(
  'show' => 'Show'
  ,'hide' => 'Hide'
)
));


piklist('field', array(
'type' => 'checkbox'
,'scope' => 'post_meta' // Not used for settings sections
,'field' => 'archive_article_feat_img'
,'value' => '' // Sets default to none
,'label' => 'Archive article featured image'
,'description' => 'Set article featured image display on archive pages ( Blog / Archives) - default - \'none\''
,'attributes' => array(
  'class' => 'text'
)
,'choices' => array(
  'show' => 'Show',
)
));

piklist('field', array(
'type' => 'checkbox'
,'scope' => 'post_meta' // Not used for settings sections
,'field' => 'article_meta_visibility'
,'value' => '' // Sets default to none
,'label' => 'Article meta visibility settings'
,'description' => 'Set Article meta data visibility (ex. Posted on... / Posted in ...) show/hide. Default\'show\''
,'attributes' => array(
  'class' => 'text'
)
,'choices' => array(
  'hide' => 'Hide',
)
));