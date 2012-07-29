<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       
       <h1><?php wp_title(''); ?></h1>
</hgroup>       

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="post" id="post-<?php the_ID(); ?>" class="d1-d6">

			<div class="entry">

				<?php the_content(); ?>
			</div>
		</article>
		
		<?php endwhile; endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
