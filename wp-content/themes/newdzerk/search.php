<?php get_header(); ?>

	<?php if (have_posts()) : ?>
              <hgroup>
                     <h1 class="sassytext">
                        Looking for something?
                     </h1>
                     <h1>Search Results</h1>
              </hgroup>

              <div class="search-results d1-d6">
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

		<h2>No posts found.</h2>

	<?php endif; ?>
</div> 
       <?php get_sidebar('globalblogsidebar'); ?>

<?php get_footer(); ?>
