<article>
    <header class="entry-header text-center">
        <h1 class="entry-title ">
            <?php the_title(); ?>
        </h1>
        <div class="entry-term">
            <?php $term_list = wp_get_post_terms(get_the_id(), 'category'); ?>
            <?php foreach ($term_list as $term): ?>
            <a href="<?php echo get_term_link($term->term_id, 'category'); ?>"><?php echo $term->name; ?></a>
            <?php endforeach; ?>
        </div>
        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
        <span class="entry-date"> <?php _e('Opublikowano', 'go'); ?><b> <?php the_date(); ?></b></span>
        <?php the_post_thumbnail('large', array('alt' => get_the_title(), 'title' => get_the_title()));
        ?>

    </header>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>

</article>