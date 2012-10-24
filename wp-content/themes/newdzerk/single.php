<?php get_header(); ?>
<?php

if ( in_category( 'product-blog' )){ ?>    
           <hgroup>
                  <h1 class="sassytext">
                     Well, isn't that nifty and new
                  </h1>
                  <h1>Product Blog</h1>
           </hgroup>
    
<?php } elseif ( in_category( 'news-and-announcements' ) ) { ?>	
       <hgroup>
              <h1 class='sassytext'>
                 Sweet Sassy Molassey
              </h1>
              <h1>News &amp; Announcements</h1>
       </hgroup>

<?php } elseif ( in_category( 'team-blog' )) { ?>
       <hgroup>
              <h1 class='sassytext'>
								Cool story, bro.
              </h1>
              <h1>Team Blog</h1>
       </hgroup>
<?php } elseif ( in_category( 'press-and-media' ) ) { ?>
       <hgroup>
              <h1 class='sassytext'>
                 People be talkin'
              </h1>
              <h1>Press &amp; Media</h1>
       </hgroup>
<?php } elseif ( in_category( 'new-feature' )) { ?>
              <hgroup>
                     <h1 class='sassytext'>
                        Well, isn't that nifty and new
                     </h1>
                     <h1>New Feature</h1>
              </hgroup>
<?php } elseif ( in_category( 'product-release' ) ) { ?>
  <hgroup>
         <h1 class='sassytext'>
            Well, isn't that nifty and new
         </h1>
         <h1>Product Release</h1>
  </hgroup>
<?php } elseif ( in_category( 'product-release' ) ) { ?>
    <hgroup>
           <h1 class='sassytext'>
              We're going to be down for a bit
           </h1>
           <h1>Scheduled Maintenance</h1>
    </hgroup>

<?php } else { ?>
       <hgroup>
              <h1 class="sassytext">
                 Lookie here
              </h1>
              <h1>You found a unsassed category</h1>
       </hgroup>

<?php } ?>

<div class="blog-post-container d1-d6">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<div class="date-meta">
                            <h5 class="date-top"><?php the_date('F, j'); ?></h5>
                            <h5 class="date-bottom"><?php the_time('Y'); ?></h5>
                     </div>
                     

			<div class="entry-content">
       			<h2 class="entry-title"><?php the_title(); ?></h2>
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
				
				<?php the_tags( 'Tags: ', ', ', ''); ?>
			
                            <div class="post-meta">
                                   <div class="author">
                                          <h6 class="side-meta-caps">Posted by</h6></h6>
                                          <img src="<?php bloginfo('template_directory') ?>/imgs/authors/<?php the_author_meta('ID')?>.jpg" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" />
                                                 <p><?php the_author_meta('first_name' ); ?><br /> 
                                                 <?php the_author_meta('last_name' ); ?></p>
                                   </div>

                                   <div class="tags">
                                          <?php 
                                          if(has_tag()) { ?>
                                                 <h6 class="side-meta-caps">Tags</h6>
                                                 <?php the_tags(''); ?>
                                          <?php } else {}
                                          ?>
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

                                   <div class="twitter-button"><a href="https://twitter.com/share" class="twitter-share-button" data-via="adzerk" data-lang="en">Tweet</a>
                                   <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                                   </div>


                                   <?php

                                   if ( in_category( 'product-blog' )){ ?>    
                                                 <a class="button back-to-parent" href="product-blog">Back to All Posts</a>

                                   <?php } elseif ( in_category( 'news-and-announcements' ) ) { ?>	
                                                 <a class="button back-to-parent" href="news-and-announcements">Back to All Posts</a>

                                   <?php } elseif ( in_category( 'team-blog' )) { ?>
                                                 <a class="button back-to-parent" href="team-blog">Back to All Posts</a>

                                   <?php } elseif ( in_category( 'press-and-media' ) ) { ?>
                                                 <a class="button back-to-parent" href="press-and-media">Back to All Posts</a>

                                   <?php } else { ?>
                                                 <a class="button back-to-parent" href="inside-adzerk">Back to All Posts</a>

                                   <?php } ?>

                                   </div>
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                            </div>

			</div>
		</article>

	<?php endwhile; endif; ?>
<?php get_sidebar('globalblogsidebar'); ?>
</div>


<?php get_footer(); ?>