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
               <section class="<?php the_slug();?> testimonial">
                      <div class="testy-info">
                             <?php echo get_the_post_thumbnail( $post_id, $size, $attr ); ?> <br />
 		               <h4><?php the_title(); ?></h4>
		               <h5><?php the_meta(); ?></h5>
		        </div>

		        <div class="testy-content">
                             <?php if ($post->post_excerpt!==''): ?>
                                   <blockquote>
                                          <?php the_excerpt(); ?>
                                   </blockquote>
                             <?php endif; ?>
                             
                             <?php the_content(); ?> 
                      </div>
               </section>
               <?php endwhile; ?>
     <?php endif; ?>

</div>

<?php get_sidebar('testimonials'); ?>
<?php dynamic_sidebar('pricing-sidebar'); ?>
<?php get_footer(); ?>
