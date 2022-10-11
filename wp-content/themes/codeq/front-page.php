<?php
/* Template name: Front-page */
?>
<?php get_header(); ?>
<main>
  <?php
  $title_hero = get_field('title_hero');
  ?>
  <section class="hero">
    <div class="container">
      <div class="content">
        <?php echo $title_hero ?>
      </div>
    </div>
  </section>
  <section class="section__line">
    <div class="container">
      <?php if (have_rows('line_repeater')) : $line_repeaterCount = 0; ?>
        <?php while (have_rows('line_repeater')) : the_row();
          $desc = get_sub_field('desc');
          $color = get_sub_field('color');
          $line_repeaterCount++;
        ?>
          <div class="single">
            <div class="line__skew" style="background-color: <?php echo $color ?>"></div>
            <div class="desc">
              <?php echo $desc ?>
            </div>
            <div class="number">
              <p><?php echo $line_repeaterCount ?></p>
            </div>
            <div class="line">
              <div class="line__line" style="background-color: <?php echo $color ?>">

              </div>
              <div class="line__circle" style="background-color: <?php echo $color ?>">

              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
  </section>
</main>
<?php get_footer(); ?>