<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>

<div class="d1-d6">



<?php query_posts('post_type=testimonial&category_name=important&posts_per_page=10'); ?>
<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>    

 		<?php the_title(); ?>

		<?php echo get_the_post_thumbnail( $post_id, $size, $attr ); ?>

		 <?php the_excerpt(); ?> 

 		<?php the_content(); ?> 

               <?php endwhile; ?>
     <?php endif; ?>


</div>
<?php get_footer(); ?>
