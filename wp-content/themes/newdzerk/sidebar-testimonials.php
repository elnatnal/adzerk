<aside class="testimonials sidebar d8-d9">
<?php query_posts('post_type=testimonial&category_name=sidebar'); ?>

<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>    
                     <div class="side-testy">
                            <h3><?php the_title(); ?></h3>
                            <h4><?php the_meta(); ?></h4>
                            <?php the_content(); ?>
                     </div>
               <?php endwhile; ?>
     <?php endif; ?>
</aside>