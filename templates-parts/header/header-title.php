<?php
$disable_title = get_post_meta(get_the_ID(), '_disable_title', true);
?>
<?php if (!$disable_title) { ?>
    <header class="entry-header">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="entry-title big-title">
                        <?php if (is_category()) :
                            single_cat_title();
                        elseif (is_tax()) :
                            single_tag_title();
                        elseif (is_404()) :
                            _e('404', 'go');
                        elseif (is_search()) :
                            _e('Wyniki wyszukiwania', 'go');
                        elseif (is_page()) :
                            the_title();
                        elseif (is_tag()) :
                            single_tag_title();

                        elseif (is_author()) :
                            the_post();
                            printf(__('%s', 'go'), get_the_author());
                            rewind_posts();
                        elseif (is_day()) :
                            printf(__('Dzień: %s', 'go'), '<span>' . get_the_date() . '</span>');
                        elseif (is_month()) :
                            printf(__('Miesiąc: %s', 'go'), '<span>' . get_the_date('F Y') . '</span>');
                        elseif (is_year()) :
                            printf(__('Rok: %s', 'go'), '<span>' . get_the_date('Y') . '</span>');
                        elseif (is_tax('post_format', 'post-format-aside')) :
                            _e('Asides', 'go');
                        elseif (is_tax('post_format', 'post-format-image')) :
                            _e('Images', 'go');
                        elseif (is_tax('post_format', 'post-format-video')) :
                            _e('Videos', 'go');
                        elseif (is_tax('post_format', 'post-format-quote')) :
                            _e('Quotes', 'go');
                        elseif (is_tax('post_format', 'post-format-link')) :
                            _e('Links', 'go');
                        else :
                            _e('Aktualności', 'go');
                        endif; ?>
                    </h1>
                    <?php if (is_category()) : ?>
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                        <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
<?php } else { ?>
    <div class="h-spacer"></div>
<?php } ?>