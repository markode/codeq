<?php
$leimro_products_line = get_field( 'leimro_products_line', pll_current_language('slug') );
$elematic_powered_precast_concrete_technology = get_field( 'elematic_powered_precast_concrete_technology', pll_current_language('slug') );


$menu_name = 'primary-menu';
$locations = get_nav_menu_locations();
$menus = wp_get_nav_menu_object( $locations[ $menu_name ] );
$array_menu = wp_get_nav_menu_items( $menus->term_id, array( 'order' => 'DESC' ) );
$menu = array();
$thumb_place = get_field( 'thumb_place', 'options' );
$count_parent = 0;
foreach ($array_menu as $m) {
if (empty($m->menu_item_parent)) {
    $count_parent++;
    $menu[$m->ID] = array();
    $menu[$m->ID]['ID'] = $m->object_id;
    $menu[$m->ID]['title'] = $m->title;
    $menu[$m->ID]['url'] = $m->url;
    $menu[$m->ID]['count'] = $count_parent;
    $menu[$m->ID]['children'] = array();
}
}
$submenu = array();
foreach ($array_menu as $m) {
if ($m->menu_item_parent) {

    $image = wp_get_attachment_image_src( get_post_thumbnail_id($m->object_id), 'full' );
    if( !empty( $image ) ) {
      $imageSrc = $image[0];
    } else {
      // $imageSrc = $thumb_place['url'];
      $imageSrc = '';
    }
    $submenu[$m->ID] = array();
    $submenu[$m->ID]['ID'] = $m->object_id;
    $submenu[$m->ID]['title'] = $m->title;
    $submenu[$m->ID]['description'] = $m->description;
    $submenu[$m->ID]['image'] = $imageSrc;
    $submenu[$m->ID]['url'] = $m->url;
    $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
}
}
?>
<div class="navigation">
    <ul class="main-nav">
        <?php foreach( $menu as $parent ) {
            $active = '';
            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                if($parent['url'] == $actual_link)
                {
                     $active = 'active';
                }
                else
                {
                    $active = '';
                }
                if( count($parent['children']) > 0 ) {
                    $haveChildren = 'haveChildren';
                } else {
                    $haveChildren = '';
                }
                $activeParent = '';
                foreach( $parent['children'] as $children ) {
                    if($children['url'] == $actual_link)
                    {
                         $activeParent = 'activeParent';
                    }
                }
                if( $parent['count'] == 1  ) {
                  $classMegaMenu = 'megaMenuParent';
                } else {
                  $classMegaMenu = '';
                }
            ?>
            <li class="<?php echo $active ?> <?php echo $activeParent ?> <?php echo $haveChildren ?> <?php echo $classMegaMenu ?>">
                <a href="<?php echo $parent['url']?>"><?php echo $parent['title']?></a>
                <?php if( count($parent['children']) > 0 ) {
                  if( $parent['count'] == 1  ) { ?>
                    <ul class="megaMenu_container sub-menu page_<?php echo $parent['ID']?>">
                      <div class="product_container ">
                        <div class="megaMenu">
                          <div class="close">
                              <img  src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/zamknij@2.png" />
                          </div>

                          <div class="singel_col">
                            <?php
                            $countCat = 0;
                            $catParent = '';
                            $terms = get_terms( 'kategorie', array(
                                'hide_empty' => false,
                                'orderby' => 'meta_value_num',
                                'order' => 'ASC',
                            ) );

                            foreach ( $terms as $term ) {
                              $countCat++;
                              if( $countCat == 1) {
                                $catActive = 'hoverStyle';
                                $catParent = $term->term_id;
                              } else {
                                $catActive = '';
                              }
                              ?>
                                <a href="<?php echo get_term_link( $term->term_id )?>" catID="<?php echo $term->term_id  ?>" class="title_cat <?php echo $catActive ?>"><?php echo $term->name ?></a>
                            <?php }
                            ?>
                          </div>
                          <div class="singel_col_cat">
                            <?php
                            $terms = get_terms( 'kategorie', array(
                                'hide_empty' => false,
                            ) );
                            foreach ( $terms as $term ) {
                              ?>
                                <?php
                                $args = array(
                                   'post_type'      => 'produkt',
                                   'posts_per_page' => -1,
                                   'tax_query' => array(
                                      array(
                                          'taxonomy' => 'kategorie',   // taxonomy name
                                          'field' => 'term_id',           // term_id, slug or name
                                          'terms' =>  $term->term_id,                  // term id, term slug or term name
                                      )
                                  )
                                 );
                                $parent = new WP_Query( $args );
                                if ( $parent->have_posts() ) : ?>
                                   <?php while ( $parent->have_posts() ) : $parent->the_post();
                                   if( $catParent == $term->term_id  ) {
                                     $showCat = 'show';
                                   } else {
                                     $showCat = '';
                                   }
                                    ?>
                                       <a  class="<?php echo $term->term_id ?> <?php echo $showCat ?>" href="<?php echo get_the_permalink()?>" productID="product_<?php echo get_the_ID()?>"><?php echo the_title(); ?></a>

                                   <?php endwhile; ?>
                                <?php endif; wp_reset_query(); ?>
                            <?php }
                            ?>
                          </div>
                          <div class="single_col_product">
                            <?php
                            $args = array(
                               'post_type'      => 'produkt',
                               'posts_per_page' => -1,
                               'order'          => 'ASC',
                               'orderby'        => 'menu_order'
                             );
                            $parent = new WP_Query( $args );
                            if ( $parent->have_posts() ) : ?>
                               <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
                                   <?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
                                     $small_desc = get_field( 'small_desc' );
                                     $longer_title = get_field( 'longer_title' );
                                   ?>

                                   <div class="single_product_menu product_<?php echo get_the_ID()?>">
                                     <a class="link" href="<?Php echo get_the_permalink()?>">
                                       <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/strzalka13@2.png" />
                                    </a>
                                     <div class="thumb">
                                       <?php
                                       if( !empty( $thumb ) ) { ?>
                                         <img src="<?php echo $thumb['0']; ?>" alt="">
                                       <?php }
                                       ?>
                                     </div>
                                     <div class="content">
                                       <div class="title">
                                         <a href="<?Php echo get_the_permalink()?>">
                                           <?php
                                           if( !empty( $longer_title )) { ?>
                                             <h3><?php echo $longer_title ?></h3>
                                           <?php } else { ?>
                                             <h3 ><?php echo the_title(); ?></h3>
                                           <?php }
                                           ?>

                                         </a>
                                       </div>
                                       <div class="excerpt">
                                         <?php echo $small_desc ?>
                                       </div>
                                       <div class="detail">
                                         <?php
                                         $product_detail_1 = get_field('product_detail_1');
                                         if( $product_detail_1 ): ?>
                                         <div class="single_detail">
                                           <p class="detail_title"><?php echo pll_e( 'Średnica' )?>:</p>
                                           <div class="chart">
                                             <p class="title_left"><?php echo $product_detail_1['value_from']?> mm</p>

                                             <div class="line"
                                             from="<?php echo $product_detail_1['value_from']?>"
                                             to="<?php echo $product_detail_1['value_to']?>"
                                             fromCurrent="<?php echo $product_detail_1['value_from_current']?>"
                                             toCurrent="<?php echo $product_detail_1['value_to_current']?>"
                                             >
                                               <div class="current">

                                               </div>
                                             </div>
                                             <p class="title_right"><?php echo $product_detail_1['value_to']?> mm</p>
                                           </div>
                                         </div>
                                         <?php endif; ?>
                                         <?php
                                         $product_detail_2 = get_field('product_detail_2');
                                         if( $product_detail_2 ): ?>
                                         <div class="single_detail">
                                           <p class="detail_title"><?php echo pll_e( 'Wydajność' )?>:</p>
                                           <div class="chart">
                                             <p class="title_left"> <?php echo $product_detail_2['value_from']?> m<sup>3</sup>/h</p>

                                             <div class="line"
                                             from="<?php echo $product_detail_2['value_from']?>"
                                             to="<?php echo $product_detail_2['value_to']?>"
                                             fromCurrent="<?php echo $product_detail_2['value_from_current']?>"
                                             toCurrent="<?php echo $product_detail_2['value_to_current']?>"
                                             >
                                               <div class="current">

                                               </div>
                                             </div>
                                             <p class="title_right"><?php echo $product_detail_2['value_to']?> m<sup>3</sup>/h</p>
                                           </div>
                                         </div>
                                         <?php endif; ?>
                                         <?php
                                         $product_detail_3 = get_field('product_detail_3');
                                         if( $product_detail_3 ): ?>
                                         <div class="single_detail">
                                           <p class="detail_title"><?php echo pll_e( 'Ciśnienie' )?>:</p>
                                           <div class="chart">
                                             <p class="title_left"><?php echo $product_detail_3['value_from']?> Pa</p>

                                             <div class="line"
                                             from="<?php echo $product_detail_3['value_from']?>"
                                             to="<?php echo $product_detail_3['value_to']?>"
                                             fromCurrent="<?php echo $product_detail_3['value_from_current']?>"
                                             toCurrent="<?php echo $product_detail_3['value_to_current']?>"
                                             >
                                               <div class="current">

                                               </div>
                                             </div>
                                             <p class="title_right"><?php echo $product_detail_3['value_to']?> Pa</p>
                                           </div>
                                         </div>
                                         <?php endif; ?>
                                       </div>
                                     </div>
                                   </div>
                               <?php endwhile; ?>
                            <?php endif; wp_reset_query(); ?>
                          </div>
                        </div>
                      </div>
                    </ul>
                <?php   } else { ?>
                  <ul class="sub-menu page_<?php echo $parent['ID']?>">
                    <?php
                    foreach( $parent['children'] as $children ) { ?>
                        <li class="item  sub-menu--item">
                            <a href="<?php echo $children['url']; ?>" class="title">
                            <?php echo $children['title'] ?>
                            </a>
                        </li>
                    <?php }
                    ?>
                  </ul>
                  <?php }
                  ?>

                <?php } else {
                }?>
            </li>
        <?php } ?>
    </ul>
</div>
