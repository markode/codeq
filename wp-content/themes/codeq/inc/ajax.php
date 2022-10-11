<?php
// Add Ajax Actions
add_action('wp_ajax_persons_list', 'persons_list');
add_action('wp_ajax_nopriv_persons_list', 'persons_list');

// Front-page loop
function persons_list () {
  $pageID = $_POST[ 'pageID' ];
  if (have_rows('persons', $pageID)) : ?>
    <?php while (have_rows('persons', $pageID)) : the_row();
        $img = get_sub_field('img');
        $name = get_sub_field('name');
    ?>
        <div class="single__person">
            <div class="img">
                <?php
                if (!empty($img)) { ?>
                    <img src="<?php echo $img['url'] ?>" alt="<?php echo $img['alt'] ?>">
                <?php }
                ?>
            </div>
            <div class="name">
                <?php echo $name ?>
            </div>
        </div>
    <?php endwhile; ?>
<?php endif; 
  die();

}
