<aside class="blog inside-adzerk sidebar d8-d9">

<div class="from-the-team-blog">
       <h4 class="blue2">From the Team Blog</h4>
<?php query_posts('posts_per_page=3&cat=11'); ?>
<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>    
                     <div class="article-side">
                            <h3><a href="<?php get_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo substr(strip_tags($post->post_content), 0, 200);?>...<a href="<?php get_permalink(); ?>">Read more</a></p>
                     </div>
               <?php endwhile; ?>
     <?php endif; ?>
            <a class="button" href="team-blog">Read more Team Blogs</a>
</div>

<div class="from-run-of-network">
       <h4 class="orange">From Run of Network</h4>
              <?php
              if(function_exists('fetch_feed')) {
                     $rss = fetch_feed('http://feeds.feedburner.com/runofnetwork');
                     if(!is_wp_error($rss)) :
                            $maxitems = $rss->get_item_quantity(3);
                            $rss_items = $rss->get_items(0,$maxitems);
                     endif; ?>
                            <?php if($maxitems == 0) echo '<dt>Feed not available.</dt>';
                            else foreach ($rss_items as $item) : ?>
                            <div class="article-side">
                            <h3> <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_date('j F & @ g:i a'); ?>">
                                          <?php echo $item->get_title(); ?>
                                          </a>
                            </h3>
                            <p><?php echo $item->get_description(); ?> <a href="<?php echo $item->get_permalink(); ?>">Read More</a></p>
                            </div>
                            <?php endforeach; ?>
              <?php } ?>
            <a class="button" href="http://runofnetwork.adzerk.com">More Run of Network</a>
</div>



</aside>