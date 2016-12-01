<?php if(have_posts()):?>
     <p id="post-syokai">関連記事はこちら</p>
     <div class="related-post" style="text-align:center">
     <?php while(have_posts()) : the_post(); ?>
          <?php if(has_post_thumbnail()):?>
               <div class="related-entry"><a href="<?php the_permalink() ?>"rel="bookmark"title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail("thumbnail"); ?><?php the_title(); ?></a></div>
          <?php endif; ?>
     <?php endwhile; ?>
     </div>
<?php else: ?>

<?php endif; ?>