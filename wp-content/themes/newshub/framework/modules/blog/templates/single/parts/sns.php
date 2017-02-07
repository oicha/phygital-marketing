<?php ?>
<div class="sns clearfix">
<div id="share">
<ul>
<!-- Twitter -->
<li class="share-twitter">
<a href="http://twitter.com/home?status=<?php echo urlencode(the_title_attribute('echo=0')); ?>%20<?php the_permalink(); ?>" target="_blank">Twitter</a>
</li>
<!-- Facebook -->	
<li class="share-facebook">
<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">Facebook</a>
</li>
<!-- Google+ -->
<li class="share-google">
<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank">Google+</a>
</li>
<!-- はてなブックマーク -->
<li class="share-hatena">
<a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>&title=<?php the_title();?>" target="_blank">はてブ</a>
</li>
<!-- Pocket -->
<li class="share-pocket">
<a href="http://getpocket.com/edit?url=<?php the_permalink(); ?>" target="_blank">Pocket</a>
</li>
<!-- LINE -->
<li class="share-line">
<a href="http://line.me/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>">LINE</a>
</li>
</ul>
</div>
    </div>
<?php ?>