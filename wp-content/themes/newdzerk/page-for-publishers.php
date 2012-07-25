<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>



<section id="intro d-all">
       <div class="left">
              <h3><em>adOS is the best solution for running your network.</em></h3>
              <p>adOS is your ad network management platform. You'll have a publisher portal to share logins with your publishers and adOS will even help you calculate payouts to your publishers and generate the Paypal mass pay file. Our super easy <strong>three step process</strong> will have you serving ads in minutes.</p>
              
              <button>
                     <a href="#">See Plans and Pricing</a>
              </button>
       </div>

       
       <iframe class="isfor-video d6-d9" src="http://player.vimeo.com/video/14510432" width="393" height="217" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>

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


       <?php query_posts('post_type=testimonial&category_name=important&posts_per_page=3$p=70,71,69'); ?>
       <?php if (have_posts()) : ?>
                      <?php while (have_posts()) : the_post(); ?>    
                      <section class="customers-are-saying">
                      
                      <div class="<?php the_slug();?> testimonial">
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
                      </div>
                     </section>
                      <?php endwhile; ?>
            <?php endif; ?>


</section>

<aside id="powered-by-ados">
       <ul>
              <li><img src="#"></li>
              <li><img src="#"></li>
              <li><img src="#"></li>
              <li><img src="#"></li>
              <li><img src="#"></li>
              <li><img src="#"></li>
              <li><img src="#"></li>
       </ul>
</aside>

<section id="world-class-ad-serving">
       <h2>World Class Ad Serving for All <span class="subtext">&emsp;Whether you're serving impressions in the millions or billions, we have pricing to match &amp; scale.</span></h2>
       
       <div class="d1-d5">
              <h4>Get Started from $150/mo or 5 cents/CPM</h4>
              <p>Network packages include all of adOS's great Network features, including:</p>
              
              <ul>
                     <li><strong>Network Tools</strong></li>
                     <li>Advertiser Portal</li>       
                     <li>Publisher Portal</li>       
                     <li>Site Payout Management</li>       
                     <li>Earnings Calculation</li>       
              </ul>

              <ul>
                     <li><strong>Support</strong></li>
                     <li>Robust Documentation</li>       
                     <li>Live Chat</li>       
                     <li>Phone</li>       
                     <li>Email</li>       
              </ul>

              <ul>
                     <li><strong>White Label</strong></li>
                     <li>100% Skinnable Interface</li>       
                     <li>CNAME-ing</li>       
                     <li>API</li>       
              </ul>


              <button class="get-started">
                     <a href="#"><strong>Get Started Now</strong> <br />
                            with our super easy wizard!
                            </a>
              </button>
       </div>
       
       <aside class="enterprise d7-d9">
              <h2>Enterprise Pricing</h2>
              <p>20 million impressions/month and up</p>
              
              <blockquote>
                     adOS's robust feature set was built to be scalable as well as affordable. Contact our sales team and we can tailor a package for your needs.
              </blockquote>
              <img src="<?php get_template_directory_uri(); ?>/imgs/this-is-ron.jpg" width="66.25" height="66.25" alt="This Is Ron">
              <p class="ron">This is Ron. He's super friendly, and he loves to talk to enterprise customers about all their needs. It's what he does all day every day. Shoot him an email, he'd love to hear from you.</p>
              
              <button><a href="mailto:ron@adzerk.com">Get Enterprise Pricing</a></button>
              
       </aside>

</section>


<?php get_footer(); ?>
