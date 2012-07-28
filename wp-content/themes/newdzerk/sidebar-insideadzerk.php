<aside class="blog inside-adzerk sidebar d8-d9">

<div class="from-the-team-blog">
       <h4>From the Team Blog</h4>
<?php query_posts('category_name=sidebar&posts_per_page=3'); ?>
<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>    
                     <div class="side-testy">
                            <h3><?php the_title(); ?></h3>
                            <h4><?php the_meta(); ?></h4>
                            <p><?php echo substr(strip_tags($post->post_content), 0, 150);?>...<a href="<?php the_permalink(); ?>">Read more</a></p>
                     </div>
               <?php endwhile; ?>
     <?php endif; ?>
     <button>
            <a href="/team-blog">Read More team posts</a>
     </button>
</div>

<div class="from-run-of-network">
       <h4>From Run of Network</h4>
              <?php
              if(function_exists('fetch_feed')) {
                     $rss = fetch_feed('http://feeds.feedburner.com/runofnetwork');
                     if(!is_wp_error($rss)) :
                            $maxitems = $rss->get_item_quantity(3);
                            $rss_items = $rss->get_items(0,$maxitems);
                     endif; ?>
                     
                     <h3><?php echo $rss->get_title(); ?></h3>
                     <d1>
                            <?php if($maxitems == 0) echo '<dt>Feed not available.</dt>';
                            else foreach ($rss_items as $item) : ?>
                            <dt>
                                   <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo $item->get_date('j F & @ g:i a'); ?>">
                                          <?php echo $item->get_title(); ?>
                                          </a>
                            </dt>
                            <dd><?php echo $item->get_description(); ?></dd>
                            <?php endforeach; ?>
                     </dl>
              <?php } ?>
     <button>
            <a href="/team-blog">Read More team posts</a>
     </button>
</div>

<div class="from-the-team-blog">
       <h4>From the Team Blog</h4>
<?php query_posts('category_name=sidebar&posts_per_page=3'); ?>
<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>    
                     <div class="side-testy">
                            <h3><?php the_title(); ?></h3>
                            <h4><?php the_meta(); ?></h4>
                            <p><?php echo substr(strip_tags($post->post_content), 0, 150);?>...<a href="<?php the_permalink(); ?>">Read more</a></p>
                     </div>
               <?php endwhile; ?>
     <?php endif; ?>
     <button>
            <a href="/team-blog">Read More team posts</a>
     </button>
</div>



</aside>