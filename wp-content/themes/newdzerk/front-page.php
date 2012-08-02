<?php get_header(); ?>

<img src="<?php bloginfo('template_directory'); ?>/imgs/adzerk-infographic-ii.jpg" width="1034" height="420" alt="Adzerk Infographic" class="home-infographic">

<hr />
<section class="frontpage-descriptions d-all">
       <div class="d1-d2">
              <h2>For Publishers</h2>
              <p>Publishers use adOS to manage all of their ad inventory from direct sales to networks to house ads.</p>
              <button>
                     <a href="#">
                            Find out more
                     </a>
              </button<>
       </div>

       <div class="d4-d6">
              <h2>For Networks</h2>
              <p>Ad networks use adOS to manage their business from delivery to publishers to payout.</p>
              <button>
                     <a href="#">
                            Find out more
                     </a>
              </button<>
       </div>

       <div class="d8-d9">
              <h2>Adzerk loves Developers </h2>
              <p>Did we mention our full API? Execute on your idea without rewriting an ad server from the ground up.</p>
              <button>
                     <a href="#">
                            Find out more
                     </a>
              </button<>
       </div>
</section>

<hr />



<section id="timeline" class="d-all">
       <h2>About Adzerk <span class="subtext">&emsp;We're a startup in Durham, NC and we're into a little bit of everything. Here's what we've been doing lately:</span></h2>


<?php echo $mf_timeline->get_timeline(); ?>
</section>






<?php get_footer(); ?>
