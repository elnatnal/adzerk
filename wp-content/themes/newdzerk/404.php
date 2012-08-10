<?php get_header(); ?>

<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php _e('Onward to pages that exist because','html5reset'); ?>
       </h1>
       <h1>You've found the 404</h1>
</hgroup>

<section class="fourohfour">
       <h3 class="d3-d9 blue3">Aha! Snooping around somewhere that doesn't exist.</h3>
       <p class="d3-d8">
              You can stare longingly at the magnificent body that is our berzerker, but that doesn't do much good. We're not entirely sure what you're looking for, but here are a few possibilities:<p>
              <ul class="d3-d8">
                     <li><a href="<?php bloginfo('home_url'); ?>">All our blogs</a></li>
                     <li><a href="<?php bloginfo('home_url'); ?>/news-and-announcements">News and Announcements</a></li>
                     <li><a href="<?php bloginfo('home_url'); ?>/product-blog">Product Blog</a></li>
                     <li><a href="<?php bloginfo('home_url'); ?>/team-blog">Team Blog</a></li>
                     <li><a href="<?php bloginfo('home_url'); ?>/press-and-media">Press Page</a></li>                                              
              </ul>
                     <p class="d3-d8"><em>Hope that helps in some way. If not, get on your boat and go back <a href="<?php bloginfo('home_url'); ?>">home.</a> Safe travels on your journey.</em></p>

</section>


<?php dynamic_sidebar('pricing-sidebar'); ?>

<?php get_footer(); ?>