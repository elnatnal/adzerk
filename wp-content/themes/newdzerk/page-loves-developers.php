<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>
       <section class="developer-resources">
              <div class="full-api">
                     <img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/adzerker.png">
                     <h2>Full API</h2>
                     <p>You can build on top of and fully integrate with adOS's RESTful API. It's our pride and joy, and we take good care of it, including full documentation.
                            <ul>
                                   <li>– 100% functionality coverage</li>
                                   <li>– Open source libraries and tests (Ruby, C#, <em>PHP coming soon</em>)</li>
                            </ul>
                     </p>
                     
                     
                            <a class="button" href="documentation">Check out our documentation</a>
              </div>

              <div class="git-up-with-us">
                     <img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/octododger.png">
                     <h2>Git up with us on Github</h2>
                     <p>We're developers too! We're very sociable!</p>
                     
                            <a class="button" href="http://github.com/adzerk">Fork us on Github</a>

              </div>
       </section>

       <section id="built-for" class="developers d-all">
              <h2>Built by Developers, for Developers</h2>

              <ul>
                     <li class="skinnable-ui">
                            <h4>Skinnable UI</h4>
                            <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                            <br /><a href="#" class="arrow-after"><strong>Read More</strong></a></p>
                     </li>

                     <li class="site-payout-management">
                            <h4>Site Payout Management</h4>
                            <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                            <br /><a href="#" class="arrow-after"><strong>Read More</strong></a></p>
                     </li>

                     <li class="publisher-portal">
                            <h4>Publisher Portal</h4>
                            <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                            <br /><a href="#" class="arrow-after"><strong>Read More</strong></a></p>
                     </li>
              </ul>

                     <a class="button dev-features" href="features">More Features</a>
       </section>




       <?php dynamic_sidebar('jobs-sidebar'); ?>

<?php get_footer(); ?>
