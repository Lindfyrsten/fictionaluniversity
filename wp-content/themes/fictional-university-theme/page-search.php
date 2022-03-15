<?php get_header();

while (have_posts()){
    the_post();
    pageBanner();
}
?>

<div class="container container--narrow page-section">
    <?php
    $parentid = wp_get_post_parent_id();
    if ($parentid) { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_permalink($parentid); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($parentid); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
            </p>
        </div>
    <?php }
    ?>

    <?php
    $testArray = get_pages(array(
        "child_of" => get_the_ID()
    ));

    if ($parentid or $testArray) { ?>
        <div class="page-links">
            <h2 class="page-links__title"><a href="<?php echo get_permalink($parentid) ?>"><?php echo get_the_title($parentid); ?></a></h2>
            <ul class="min-list">
                <?php
                if ($parentid) {
                    $findChildrenOf = $parentid;
                } else {
                    $findChildrenOf = get_the_ID();
                }
                wp_list_pages(array(
                    "title_li" => NULL,
                    "child_of" => $findChildrenOf,
                    "sort_column" => "menu_order"
                ));
                ?>
            </ul>
        </div>
    <?php } ?>

    <div class="generic-content">
        <?php get_search_form(); ?>
    </div>
</div>
<?php get_footer(); ?>