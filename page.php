<?php
get_header();
?>
<?php
while (have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" class="hentry page">
    <?php get_template_part('templates-parts/header/header', 'title'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
</article>

<?php endwhile;

get_footer();