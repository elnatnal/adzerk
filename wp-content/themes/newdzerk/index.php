<?php get_header(); ?>
<?php

if ( is_category( 'product-blog' )){ ?>    
           <hgroup>
                  <h1 class="sassytext">
                     Well, isn't that nifty and new
                  </h1>
                  <h1>Product Blog</h1>
           </hgroup>
    
<?php } elseif ( is_category( 'news-and-announcements' ) ) { ?>	
       <hgroup>
              <h1 class='sassytext'>
                 A horrible death to die
              </h1>
              <h1>News &amp; Announcements</h1>
       </hgroup>

<?php } elseif ( is_category( 'team-blog' )) { ?>
       <hgroup>
              <h1 class='sassytext'>
                 We can write
              </h1>
              <h1>Team Blog</h1>
       </hgroup>
<?php } elseif ( is_category( 'press-and-media' ) ) { ?>
       <hgroup>
              <h1 class='sassytext'>
                 People be talkin'
              </h1>
              <h1>Press &amp; Media</h1>
       </hgroup>
<?php } else { ?>
       <hgroup>
              <h1 class="sassytext">
                 Check out our blogs
              </h1>
              <h1>Inside Adzerk</h1>
       </hgroup>
       
       <div class="inside-adzerk-blog-summary">
              <div class="blog-summary blue3">
                    <h4>News and Announcements</h4>
                    <p>Here are the latest postings about us and what we are doing around the office and world community.&emsp;<a href="news-and-announcements">Read Posts</a></p> 
              </div>
              
              <div class="blog-summary blue1">
                    <h4>Product Blog</h4>
                    <p>We roll out new features like every day here. Look at what's being implemented right now!&emsp;<a href="product-blog">Read More</a></p> 
              </div>
              
              <div class="blog-summary blue2">
                    <h4>Team Blog</h4>
                    <p>Here's where we rant, rave and talk about random opportunities we have at work. It's cool. Check it.&emsp;<a href="team-blog">Read Posts</a></p> 
              </div>
              
              <div class="blog-summary orange">
                    <h4>Run of Network</h4>
                    <p>Just how do you run an ad network? Check out tips, tricks and wisdom about the ad tech and ad industry.&emsp;<a href="http://runofnetwork.adzerk.com/">Read Posts</a></p> 
              </div>
       </div>
       
       
       
       
<?php } ?>

<div class="blog-list-container d-all from-news-and-announcements">
              <h4 class="blue3">From News and Announcements</h4>
              <?php query_posts('posts_per_page=4&cat=21'); ?>
              <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

       		<article <?php post_class('clear') ?> id="post-<?php the_ID(); ?>">


                            <div class="blog-left">
                                   <div class="date-meta">
                                          <h5 class="date-top"><?php the_date('F, j'); ?></h5>
                                          <h5 class="date-bottom"><?php the_time('Y'); ?></h5>
                                   </div>

                                   <div class="more-meta">
                                          <?php 
                                          if(has_post_thumbnail()) {
                                          	the_post_thumbnail();
                                          } else {
                                          	echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo("template_url").'/imgs/img-default.png" /></a>';
                                          }
                                          ?>

                                          <div class="tags">
                                                 <?php 
                                                 if(has_tag()) { ?>
                                                        <h6 class="side-meta-caps">Tags</h6>
                                                        <?php the_tags(''); ?>
                                                 <?php } else {}
                                                 ?>
                                          </div>

                                          <div class="author">
                                                 <h6 class="side-meta-caps">Posted by</h6></h6>
                                                 <img src="<?php bloginfo('template_directory') ?>/imgs/authors/<?php the_author_meta('ID')?>.jpg" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" />
                                                        <p><?php the_author_meta('first_name' ); ?><br /> 
                                                        <?php the_author_meta('last_name' ); ?></p>
                                          </div>



                                          <?php 
                                               $article_source = get_post_meta($post->ID, "article-source-url", true);
                                               $article_title = get_post_meta($post->ID, "article-source-name", true); ?>


                                                 <?php if ($article_title) : ?>
                                                        <div class="article-source">
                                                               <h6 class="side-meta-caps">Article Source</h6>
                                                               <a href="<?php echo $article_source; ?>"><?php echo $article_title; ?></a></h3>
                                                        </div>
                                                 <?php endif; ?>
                                   </div>
                            </div>
                            <div class="blog-right">
       			       <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

       			       <div class="entry">
                                          <?php echo substr(strip_tags($post->post_content), 0, 700);?>...
                                          <button>
                                                 <a href="<?php the_permalink();?>">Read More</a>
                                          </button>			
                            </div>
       		</article>

       	<?php endwhile; ?>

              <button class="see-more">
                     <a href="news-and-announcements">See More posts from News and Announcements</a>
              </button>

       	<?php else : ?>

       		<h2>Not Found</h2>

       	<?php endif; ?>
       </div>


       <?php if ( is_category( 'press-and-media' )){ ?>    
              <?php get_sidebar('press-and-media'); ?>    
       <?php } else { ?>
              <?php get_sidebar('insideadzerk'); ?>    
       <?php } ?>




       <div class="blog-list-container d-all from-the-product-blog">
                     <h4 class="blue1">From the Product Blog</h4>
                     <?php query_posts('posts_per_page=4&cat=22'); ?>
                     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

              		<article <?php post_class('clear') ?> id="post-<?php the_ID(); ?>">


                                   <div class="blog-left">
                                          <div class="date-meta">
                                                 <h5 class="date-top"><?php the_date('F, j'); ?></h5>
                                                 <h5 class="date-bottom"><?php the_time('Y'); ?></h5>
                                          </div>

                                          <div class="more-meta">
                                                 <?php 
                                                 if(has_post_thumbnail()) {
                                                 	the_post_thumbnail();
                                                 } else {
                                                 	echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo("template_url").'/imgs/img-default.png" /></a>';
                                                 }
                                                 ?>

                                                 <div class="tags">
                                                        <?php 
                                                        if(has_tag()) {
                                                               echo '<h6 class="side-meta-caps">Tags</h6>'.the_tags('Tags:', ', ').'';
                                                        } else {}
                                                        ?>
                                                 </div>

                                                 <div class="author">
                                                        <h6 class="side-meta-caps">Posted by</h6></h6>
                                                        <img src="<?php bloginfo('template_directory') ?>/imgs/authors/<?php the_author_meta('ID')?>.jpg" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" />
                                                               <p><?php the_author_meta('first_name' ); ?><br /> 
                                                               <?php the_author_meta('last_name' ); ?></p>
                                                 </div>



                                                 <?php 
                                                      $article_source = get_post_meta($post->ID, "article-source-url", true);
                                                      $article_title = get_post_meta($post->ID, "article-source-name", true); ?>


                                                        <?php if ($article_title) : ?>
                                                               <div class="article-source">
                                                                      <h6 class="side-meta-caps">Article Source</h6>
                                                                      <a href="<?php echo $article_source; ?>"><?php echo $article_title; ?></a></h3>
                                                               </div>
                                                        <?php endif; ?>
                                          </div>
                                   </div>
                                   <div class="blog-right">
              			       <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

              			       <div class="entry">
                                                 <?php echo substr(strip_tags($post->post_content), 0, 700);?>...
                                                 <button>
                                                        <a href="<?php the_permalink();?>">Read More</a>
                                                 </button>			
                                   </div>
              		</article>
       		<hr />
              	<?php endwhile; ?>

                     <button class="see-more">
                            <a href="product-blog">See More posts from the Product Blog</a>
                     </button>

              	<?php else : ?>

              		<h2>Not Found</h2>

              	<?php endif; ?>
              </div>




<?php get_footer(); ?>
