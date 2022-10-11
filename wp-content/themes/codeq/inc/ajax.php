<?php
// Add Ajax Actions
add_action('wp_ajax_category_filter', 'category_filter');
add_action('wp_ajax_nopriv_category_filter', 'category_filter');

// Front-page loop
function category_filter () {
  $currentCategory = $_POST[ 'cat' ];

  die();

}
