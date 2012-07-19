<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>

<?php query_posts('post_type=team&category_name=team'); ?>
<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>    

<div class="teammate">
        <div class="d1-d6 mate-left">
               <section class="<?php the_slug();?> mate">
                      <div class="team-info d1">
                             <?php echo get_the_post_thumbnail( $post->ID, '170',true ); ?> <br />
                             <?php $teammate_twitter = get_post_meta($post->ID, 'teammmate-twitter-meta-text', true);
                                    if (empty ($teammate_twitter)) {
                                           echo " ";
                                    } else {
                                           echo 
                                           "<img src='wp-content/themes/newdzerk/imgs/twitter-logo.gif' alt='Twitter Logo' class='tweet-logo'><a href='http://twitter.com/" . $teammate_twitter . "'>@"
                                                                   . $teammate_twitter . "</a>";
                                   }
                                    ?>                                           
		        </div>
		        <div class="mate-content d2-d6">
                             <h2><?php the_title(); ?></h2>
                             <h4><?php $teammate_position = get_post_meta($post->ID, 'teammmate-position-meta-text', true); echo "$teammate_position";?></h4>
                             
                             <?php the_content(); ?> 
                      </div>
               </section>
        </div>

        <aside class="d8-d9">
                     <h4>Recent Post</h4>
               <?php echo do_shortcode('[latestbyauthor author="admin" show="1"]'); ?>
       </aside>
</div>
               <?php endwhile; ?>
     <?php endif; ?>

<?php get_footer(); ?>
