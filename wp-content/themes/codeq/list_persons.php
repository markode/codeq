<?php
/* Template name: Lista pracowników */
?>
<?php get_header();
$currentPage = get_the_ID();
?>
<main>
    <?php
    $title_hero = get_field('title_hero');
    ?>
    <section class="hero">
        <div class="container">
            <div class="content">
                <h1><?php echo get_the_title() ?></h1>
                <?php if (has_excerpt($post->ID)) { ?>
                    <p><?php echo the_excerpt(); ?></p>
                <?php } else {
                }
                ?>
            </div>
        </div>
    </section>
    <section class="persons__list" pageId="<?php echo $currentPage ?>">
        <div class="container">
            <div class="button__container">
                <button>Wyświetl wszystkie osoby</button>
            </div>
            <div class="grid__persons" id="ajax_persons">

            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>