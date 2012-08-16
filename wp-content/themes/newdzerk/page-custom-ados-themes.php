<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>


<div class="custom-ados-themes-container">
       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/hotchalk.jpg" title="Hotchalk"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/hotchalk_sm.jpg"></a>
             <h4>Hotchalk</h4>
       </div>

       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/adbase.jpg" title="Adbase"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/adbase_sm.jpg"></a>
             <h4>Adbase</h4>
       </div>

       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/builtAds.jpg" title="Built Ads"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/builtAds_sm.jpg"></a>
             <h4>Built Ads</h4>
       </div>

       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/litbreaker.jpg" title="Litbreaker"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/litbreaker_sm.jpg"></a>
             <h4>Litbreaker</h4>
       </div>

       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/messageSpace.jpg" title="Message Space"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/messageSpace_sm.jpg"></a>
             <h4>Message Space</h4>
       </div>

       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/muslimAdNetwork.jpg" title="Muslim Ad Network"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/muslimAdNetwork_sm.jpg"></a>
             <h4>Muslim Ad Network</h4>
       </div>

       <div class="theme">
             <a class="custom-theme" href="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/netsportsMedia.jpg" title="Net Sports Media"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/custom-ados-themes/netsportsMedia_sm.jpg"></a>
             <h4>Net Sports Media</h4>
       </div>

</div>



<?php get_footer(); ?>
