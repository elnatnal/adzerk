<?php get_header(); ?>
<?php

if ( is_category( 'product-blog' )){ ?>    
           <hgroup>
                  <h1 class="sassytext">
                     Well, isn't that nifty and new
                  </h1>
                  <h1>Product Blog</h1>
           </hgroup>
    
<?php } elseif ( in_category( 'news-and-announcements' ) ) { ?>	
       <hgroup>
              <h1 class='sassytext'>
                 A horrible death to die
              </h1>
              <h1>News &amp; Announcements</h1>
       </hgroup>

<?php } elseif ( in_category( 'team-blog' )) { ?>
       <hgroup>
              <h1 class='sassytext'>
                 We can write
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
                     
			<h2 class="entry-title"><?php the_title(); ?></h2>

			<div class="entry-content">
				
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
				
				<?php the_tags( 'Tags: ', ', ', ''); ?>
			
				<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>

			</div>
			
			<?php edit_post_link('Edit this entry','','.'); ?>
			
		</article>

	<?php comments_template(); ?>

	<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>