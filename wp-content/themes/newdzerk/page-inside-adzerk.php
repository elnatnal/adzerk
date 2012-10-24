<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>

<section id="inside-adzerk-intro d-all">
       <div id="news-and-announcements">
              <h3>News and Announcements</h3>
              <p>Here are the latest postings about us and what we are doing around the office and world community. <a href="#">Read Posts</a></p>
       </div>
       
       <div id="product-blog">
              <h3>Product Blog</h3>
              <p>We roll out new features like every day here. We're just chalk full of'em. Look at what's being implemented now! <a href="#">Read Posts</a></p>
       </div>

       <div id="team-blog">
              <h3>Team Blog</h3>
              <p>Here's where we rant, rave and talk about random opportunities. It's cool. Warning: sometimes we curse.<a href="#">Read Posts</a></p>
       </div>
       
       <div id="run-of-network">
              <h3>Run of Network</h3>
              <p>Just how do you run an ad network? Check out tips, tricks and wisdom about ad tech and the ad industry.<a href="#">Read Posts</a></p>
       </div>


</section>


<section id="built-for" class="d-all">
       <h2>Built for Networks <span>adOS is your all$ndash;in$ndash;one network management platform</h2>

       <ul>
              <li>
                     <img src="icon"><h4>Skinnable UI</h4> <br />
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. <a href="#"><strong>Read More <span>arrow</span></p>
              </li>

              <li>
                     <img src="icon"><h4>Site Payout Management</h4> <br />
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. <a href="#"><strong>Read More <span>arrow</span></p>
              </li>

              <li>
                     <img src="icon"><h4>Publisher Portal</h4> <br />
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. <a href="#"><strong>Read More <span>arrow</span></p>
              </li>

              <li>
                     <img src="icon"><h4>Advertiser Portal</h4> <br />
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. <a href="#"><strong>Read More <span>arrow</span></p>
              </li>

              <li>
                     <img src="icon"><h4>Robust Targeting Options</h4> <br />
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. <a href="#"><strong>Read More <span>arrow</span></p>
              </li>

              <li>
                     <img src="icon"><h4>Fast &amp; Accurate Reporting</h4> <br />
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. <a href="#"><strong>Read More <span>arrow</span></p>
              </li>
       </ul>

       <button>
              <a href="#">More Features</a>
       </button>

</section>


<section id="customers-are-saying">


</section>

<aside id="powered-by-ados">
       
</aside>

<section id="world-class-ad-serving">
       
       
</section>


<?php get_footer(); ?>
