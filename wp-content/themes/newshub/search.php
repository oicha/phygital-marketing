<?php $newshub_sidebar = newshub_mikado_sidebar_layout(); ?>
<?php get_header(); ?>
<?php
$newshub_blog_page_range = newshub_mikado_get_blog_page_range();
$newshub_max_number_of_pages = newshub_mikado_get_max_number_of_pages();
$newshub_custom_thumb_image_width = 139;
$newshub_custom_thumb_image_height = 118;

if ( get_query_var('paged') ) { $newshub_paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $newshub_paged = get_query_var('page'); }
else { $newshub_paged = 1; }

$newshub_enable_search_page_sidebar = true;
if(newshub_mikado_options()->getOptionValue('enable_search_page_sidebar') === "no"){
	$newshub_enable_search_page_sidebar = false;
}
?>
<?php newshub_mikado_get_title(); ?>
	<div class="mkd-container">
		<?php do_action('newshub_mikado_after_container_open'); ?>
		<div class="mkd-container-inner clearfix">
			<div class="mkd-container">
				<?php do_action('newshub_mikado_after_container_open'); ?>
				<div class="mkd-container-inner">
					<?php if($newshub_enable_search_page_sidebar) { ?>
					<div class="mkd-two-columns-66-33 mkd-content-has-sidebar clearfix">
						<div class="mkd-column1 mkd-content-left-from-sidebar">
							<div class="mkd-column-inner">
                                <h1 class="mkd-search-results-holder">
                                    <?php if (get_search_query() != '') { ?>
                                        <span>
                                        <?php echo get_search_query() . " - " . esc_html__('検索結果', 'newshub') ?>
                                    </span>
                                        <?php } else {
                                        echo esc_html__('検索結果', 'newshub');
                                    }   ?>

                                </h1>
                                <form action="<?php echo esc_url(home_url('/')); ?>" class="mkd-search-page-form" method="get">
                                    <div class="mkd-column-left">
                                        <input type="text"  name="s" class="mkd-search-field" autocomplete="off" />
                                    </div>
                                    <div class="mkd-column-right">
                                        <button class="mkd-search-submit" type="submit" value="Search"><?php esc_html_e('Search', 'newshub') ?></button>
                                    </div>

                                </form>
                                <div class="mkd-search-label-holder">
                                    <span class="mkd-search-label"><?php esc_html_e("", 'newshub'); ?></span>
                                </div>
					<?php } ?>
                                <div class="mkd-search-page-holder">

                                    <div class="mkd-layout-title-holder"><div class="mkd-section-title-holder clearfix">
                                            <h5 class="mkd-title-line-head">
                                                <?php esc_html_e('検索結果', 'newshub') ?></h5>
                                            <div class="mkd-title-line-body"></div>
                                        </div>
                                    </div>

                                    <?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>

                                    <article class="mkd-post-item mkd-pt-two-item">
                                        <div class="mkd-post-item-inner">

                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="mkd-pt-image-holder">
                                                    <div class="mkd-pt-image-holder-inner">
                                                        <a itemprop="url" class="mkd-pt-image-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self" style="width:<?php echo newshub_mikado_filter_px($newshub_custom_thumb_image_width)?>px">
                                                            <?php echo newshub_mikado_generate_thumbnail(get_post_thumbnail_id(get_the_ID()), null, $newshub_custom_thumb_image_width, $newshub_custom_thumb_image_height); ?>
                                                        </a>
                                                    </div><!-- .mkd-pt-image-holder-inner -->
                                                </div><!-- .mkd-pt-image-holder -->
                                            <?php } ?>


                                            <div class="mkd-pt-content-holder">
                                                <?php
                                                newshub_mikado_post_info_category(array(
                                                    'category' => 'no'
                                                )); ?>

                                                <h6 class="mkd-pt-title">
                                                    <a itemprop="url" class="mkd-pt-title-link" href="<?php echo esc_url(get_permalink()); ?>" target="_self">
                                                        <?php echo newshub_mikado_get_title_substring(get_the_title(), 60) ?>
                                                    </a>
                                                </h6>

                                                <?php
                                                $my_excerpt = get_the_excerpt();

                                                if ($my_excerpt != '') {

                                                    if ($my_excerpt != '') {
                                                        $my_excerpt = rtrim(substr($my_excerpt, 0, 150));
                                                    }
                                                    ?>
                                                <div itemprop="description" class="mkd-pt-excerpt">
                                                    <p itemprop="description" class="mkd-post-excerpt"><?php echo esc_html($my_excerpt); ?>...</p>
                                                </div>
                                                <?php }
                                                ?>

                                                <div class="mkd-pt-meta-section clearfix">
                                                    <?php newshub_mikado_post_info_date(array(
                                                        'date' => 'yes',
                                                        'date_format' => 'F d'
                                                    )) ?>
                                                </div><!-- .mkd-pt-meta-section -->

                                            </div><!-- .mkd-pt-contnet-holder -->

                                        </div><!-- .mkd-post-item-inner -->
                                    </article><!-- .mkd-post-item -->

                                    <?php endwhile; ?>
                                    <?php
                                        if(newshub_mikado_options()->getOptionValue('pagination') == 'yes') {
                                            newshub_mikado_pagination($newshub_max_number_of_pages, $newshub_blog_page_range, $newshub_paged);
                                        }
                                    ?>
                                    <?php else: ?>
                                    <div class="entry">
                                        <p><?php esc_html_e('記事が見つかりませんでした。.', 'newshub'); ?></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <?php do_action('newshub_mikado_page_after_content'); ?>
                            <?php if($newshub_enable_search_page_sidebar) { ?>
                            </div>
						</div>
						<div class="mkd-column2">
							<?php get_sidebar(); ?>
						</div>
					</div>
					<?php } ?>
				<?php do_action('newshub_mikado_before_container_close'); ?>
				</div>
			</div>
		</div>
		<?php do_action('newshub_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>