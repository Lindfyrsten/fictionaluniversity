<?php get_header();
while (have_posts()) {
    the_post();
    pageBanner();
}
?>

<div class="container container--narrow page-section">
    <div class="metabox metabox--position-up metabox--with-home-link">
        <p>
            <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true">

                </i>All programs</a> <span class="metabox__main"><?php the_title(); ?></span>
        </p>
    </div>
    <div class="generic-content"> <?php the_field('main_body_content') ?></div>
    <?php

    $professors = new WP_Query(array(
        'post_type' => 'professor',
        'posts_per_page' => '-1',
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'related_program',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
        )
    ));

    if ($professors->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">' . get_the_title() . ' Professors</h2>';
        echo '<ul class="professor-cards">';
        while ($professors->have_posts()) {
            $professors->the_post(); ?>
            <li class="professor-card__list-item">
                <a class="professor-card" href="<?php the_permalink(); ?>">
                    <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
                    <span class="professor-card__name"><?php the_title(); ?></span>
                </a>
            </li>
    <?php }
        echo '</ul>';
    }

    wp_reset_postdata();
    $today = date('Ymd');
    $events = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => '2',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_date',
                'compare' => '>=',
                'value' => $today,
                'type' => 'numeric'
            ),
            array(
                'key' => 'related_program',
                'compare' => 'LIKE',
                'value' => '"' . get_the_ID() . '"'
            )
        )
    ));

    if ($events->have_posts()) {
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">Upcoming ' . get_the_title() . ' Events</h2>';
        while ($events->have_posts()) {
            $events->the_post();
            get_template_part('template-parts/content-event');
        }
    }

    wp_reset_postdata();
    $relatedCampus = get_field('related_campus');

    if ($relatedCampus){
        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium">' . get_the_title() . ' is available at these campuses:</h2>';
        echo '<ul class="min-list link-list">';
        foreach($relatedCampus as $campus){
            ?> <li><a href="<?php get_the_permalink($campus); ?>"><?php echo get_the_title($campus); ?></a></li> <?php
        }
        echo '</ul>';
    }


    ?>
</div>
<?php get_footer(); ?>