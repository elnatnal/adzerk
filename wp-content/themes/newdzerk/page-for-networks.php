<?php get_header(); ?>
<h1 class="sassytext">Adzerk is for</h1>
<h1>Networks</h1>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="post" id="post-<?php the_ID(); ?>" class="d1-d6">

			<h2><?php the_title(); ?></h2>

			<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		</article>
		
		<?php comments_template(); ?>

		<?php endwhile; endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
