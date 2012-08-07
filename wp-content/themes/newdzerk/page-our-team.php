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
                                   $bloginfo = get_bloginfo( 'stylesheet_directory' );
                                    if (empty ($teammate_twitter)) {
                                           echo " ";
                                    } else {
                                           echo 
                                           "<img src='". $bloginfo ."/imgs/twitter-logo.gif' alt='Twitter Logo' class='tweet-logo'><a href='http://twitter.com/" . $teammate_twitter . "'>@"
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
                      <h4>Recent Posts</h4>
                      <?php $author_id = get_post_meta($post->ID, 'author-id', true); ?>
                      <?php echo do_shortcode('[latestbyauthor author="'.$author_id.'" show="5"]'); ?>
        </aside>
</div>
 <?php endwhile; ?>

 <?php endif; ?>


     <div class="directoradvisor">
            <h2>Board of Directors and Advisors</h2>
     <?php query_posts('post_type=team&category_name=directors-and-advisors'); ?>
     <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>    

             <div class="<?php the_slug();?> dirad">
                           <?php echo get_the_post_thumbnail( $post->ID, '322',true ); ?> <br />

     		        <div class="diradvis-content">
                                  <h4><?php the_title(); ?></h4>
                                  <?php $diradvis_position = get_post_meta($post->ID, 'teammmate-position-meta-text', true);
                                          if (empty ($diradvis_position)) {
                                                 echo " ";
                                          } else {
                                                 echo 
                                                 "<h5>" . $diradvis_position . "</h5>";
                                         }
                                          ?>
                                  <?php the_content(); ?> 
                     </div>
             </div>
                    <?php endwhile; ?>
          <?php endif; ?>
      </div>


</div>





<?php get_footer(); ?>
