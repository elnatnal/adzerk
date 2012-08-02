<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>



<section id="intro">
       
       <iframe class="isfor-video" src="http://player.vimeo.com/video/14510432" width="393" height="217" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
       
       <div>
              <h4><em>adOS is the best solution for running your network.</em></h4>
              <p>adOS is your ad network management platform. You'll have a publisher portal to share logins with your publishers and adOS will even help you calculate payouts to your publishers and generate the Paypal mass pay file. Our super easy <strong>three step process</strong> will have you serving ads in minutes.</p>
              
              <button>
                     <a href="#">See Plans and Pricing</a>
              </button>
       </div>
</section>


<section id="built-for" class="d-all">
       <h2>Built for Networks <span class="subtext">&emsp;adOS is your all&ndash;in&ndash;one network management platform</h2>

       <ul>
              <li class="skinnable-ui">
                     <h4>Skinnable UI</h4>
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                     <br /><a href="http://jonathanstephens.us/adzerk-iframes/#0" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="site-payout-management">
                     <h4>Site Payout Management</h4>
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                     <br /><a href="http://jonathanstephens.us/adzerk-iframes/#1" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="publisher-portal">
                     <h4>Publisher Portal</h4>
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                     <br /><a href="http://jonathanstephens.us/adzerk-iframes/#2" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="advertiser-portal">
                     <h4>Advertiser Portal</h4> 
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                     <br /><a href="http://jonathanstephens.us/adzerk-iframes/#3" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="robust-targeting-options">
                     <h4>Robust Targeting Options</h4>
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                     <br /><a href="http://jonathanstephens.us/adzerk-iframes/#4" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="fast-accurate-reporting">
                     <h4>Fast &amp; Accurate Reporting</h4>
                     <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                     <br /><a href="http://jonathanstephens.us/adzerk-iframes/#5" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>
       </ul>

<div>
       <ul id="more-features-show">
                     <li class="advertiser-portal">
                            <h4>Advertiser Portal</h4> 
                            <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                            <br /><a href="http://jonathanstephens.us/adzerk-iframes/#3" class="arrow-after iframe"><strong>Read More</strong></a></p>
                     </li>

                     <li class="robust-targeting-options">
                            <h4>Robust Targeting Options</h4>
                            <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                            <br /><a href="http://jonathanstephens.us/adzerk-iframes/#4" class="arrow-after iframe"><strong>Read More</strong></a></p>
                     </li>

                     <li class="fast-accurate-reporting">
                            <h4>Fast &amp; Accurate Reporting</h4>
                            <p>Here's the information that you want the user to get an inkling, a taste of. Entice them to click this little button here. 
                            <br /><a href="http://jonathanstephens.us/adzerk-iframes/#5" class="arrow-after iframe"><strong>Read More</strong></a></p>
                     </li>
              </ul>

              <button id="more-show">
                     More Features
              </button>
</div>



</section>

<section id="customers" class="d-all">
       <aside id="powered-by-ados">
              <h2>Networks powered by adOS</h2>
              <ul>
                     <li><img src="http://placekitten.com/178/35"></li>
                     <li><img src="http://placekitten.com/178/45"></li>
                     <li><img src="http://placekitten.com/178/80"></li>
                     <li><img src="http://placekitten.com/178/25"></li>
                     <li><img src="http://placekitten.com/178/45"></li>
                     <li><img src="http://placekitten.com/178/65"></li>
                     <li><img src="http://placekitten.com/178/42"></li>
              </ul>
       </aside>

       <h2>What our customers are saying</h2>
       <div id="cust-testimonials">
       <?php query_posts('post_type=testimonial&category_name=for_networks&posts_per_page=3&order=ASC'); ?>
       <?php if (have_posts()) : ?>
                      <?php while (have_posts()) : the_post(); ?>    

                      
                      <div class="testimonial <?php the_slug();?> d1-d8">
                             <div class="testy-info">
                                    <?php echo get_the_post_thumbnail(); ?> <br />
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
                      <?php endwhile; ?>
            <?php endif; ?>
            </div>
    
</section>



<section id="world-class-ad-serving" class="d-all">
       <h2>World Class Ad Serving for All <span class="subtext">&emsp;Whether you're serving in the millions or billions, we have pricing to match &amp; scale.</span></h2>
       
       <div class="for-blank-pricing d1-d5">
              <h4>Get Started from $150/mo or 5 cents/CPM</h4>
              <p class="gray">
                     Network packages include adOS's great Network features, including:
              </p>

              <div class="price-packages">
                     <div class="network-tools">
                            <h6>Network Tools</h6>
                            <ul>
                                   <li>Advertiser Portal</li>
                                   <li>Publisher Portal</li>
                                   <li>Site Payout Management</li>
                                   <li>Earnings Calculation</li>
                            </ul>
                       </div>

                     <div class="silver-support">
                            <h6>Support</h6>
                            <ul>
                                   <li>Robust Documentation</li>
                                   <li>Live Chat</li>
                                   <li>Phone</li>
                                   <li>Email</li>
                            </ul>
                       </div>    
                     
                       <div class="white-label">
                              <h6>White Label</h6>
                              <ul>
                                     <li>100% Skinnable Interface</li>
                                     <li>CNAME-ing</li>
                                     <li>API</li>
                              </ul>
                         </div>
                  </div>

                  <button class="get-started">
                     <a href="#"><strong>Get Started Now</strong> <br />
                                   with our super easy wizard!
                     </a>
                  </button>
       </div>
       
       <aside class="enterprise sidebar d7-d9">
              <h4>Enterprise Pricing</h4>
              <p>20 million impressions/month and up</p>
              
              <blockquote>
                     adOS's robust feature set was built to be scalable as well as affordable. Contact our sales team and we can tailor a package for your needs.
              </blockquote>
              <p class="ron"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/this-is-ron-sm.jpg" alt="This Is Ron">
              This is Ron. He's friendly, and he loves to talk to enterprise customers about all their needs. It's what he does all day every day. Shoot him an email, he'd love to hear from you.</p>
              
              <button><a href="mailto:ron@adzerk.com">Get Enterprise Pricing</a></button>
              
       </aside>

</section>


<?php get_footer(); ?>
