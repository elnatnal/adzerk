<?php get_header(); ?>

	<?php if (have_posts()) : ?>
              <hgroup>
                     <h1 class="sassytext">
                        Looking for something?
                     </h1>
                     <h1>Search Results</h1>
              </hgroup>

              <div class="search-results d1-d9">
		<?php while (have_posts()) : the_post(); ?>

                     <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                            
				<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>

				<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>

				<div class="entry">

					<?php the_excerpt(); ?>

				</div>

			</article>

		<?php endwhile; ?>

		<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

	<?php else : ?>
              <hgroup>
                     <h1 class="sassytext">
                        Looking for something?
                     </h1>
                     <h1>Sorry, no results.</h1>
              </hgroup>
	
	       <article>
		       <h2 style="text-align:center;">Try looking at a through our blogs, you might find one that's useful</h2><br />
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
		       
		</article>

	<?php endif; ?>
       <?php dynamic_sidebar('pricing-sidebar'); ?>

</div> 

<?php get_footer(); ?>
