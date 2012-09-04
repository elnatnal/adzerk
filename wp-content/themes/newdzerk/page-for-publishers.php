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
              <h4><em>adOS is the best solution for managing your site's ads.</em></h4>
              <p>adOS is your ad management platform. You'll have an advertiser portal to share logins with your advertisers, and adOS will even help you calculate earnings. Give advertisers the ability to upload creatives for you to approve. Our super easy <strong>three step process</strong> will have you serving ads in minutes.</p>
              
                     <a class="button" href="#world-class-ad-serving">See Plans and Pricing</a>
       </div>
</section>


<section id="built-for" class="d-all">
       <h2>Built for Publishers <span class="subtext">&emsp;adOS is your all&ndash;in&ndash;one network management platform</h2>

       <ul>
<!--							<li class="skinnable-ui">
                     <h4>Skinnable UI</h4>
                     <p>With the White Label app, you can upload any custom CSS, JavaScript, and footer markup to make your adOS look like you own website. 
                     <br /><a href="http://www.adzerk.com/tour/index.html#1" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="site-payout-management">
                     <h4>Site Payout Management</h4>
                     <p>Calculate earnings, make adjustments, and mark sent payments for your Network's sites, all in one place.
                     <br /><a href="http://www.adzerk.com/tour/index.html#2" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>


              <li class="publisher-portal">
                     <h4>Forecasting Reports</h4>
                     <p>Forecast earnings based on impression trends. 
                     <br /><a href="http://www.adzerk.com/tour/index.html#3" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>
-->
              <li class="advertiser-portal">
                     <h4>Advertiser Portal</h4> 
										 <p>Give Advertiser customers the ability to login, run reports, and upload Creatives to be used in Campaigns (with the Advertiser Creative Management app). 
                     <br /><a href="http://www.adzerk.com/tour/index.html#4" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="robust-targeting-options">
                     <h4>Robust Targeting Options</h4>
                     <p>Target ads by physical location including Continent, Country, Region, City/Metro code, and zip code. Also target by keyword, referrer, IP address, and more. 
                     <br /><a href="http://www.adzerk.com/tour/index.html#5" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>

              <li class="fast-accurate-reporting">
                     <h4>Fast &amp; Accurate Reporting</h4>
                     <p>You can run preconfigured reports like Advertiser, Site, Channel, and Impression Forecasting reports, as well as Custom reports, and export as CSV, or get an Email notification when big reports are done generating. 
                     <br /><a href="http://www.adzerk.com/tour/index.html#6" class="arrow-after iframe"><strong>Read More</strong></a></p>
              </li>
       </ul>
<!-- hide this until we have more features for pubs
<div class="morefeaturesdiv">
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
</div>-->
</section>

<section id="customers" class="d-all">
       <aside id="powered-by-ados">
              <h2>Publishers powered by adOS</h2>
              <ul>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/stackexchange_color_lg.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/campingusa_color_sm.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/digicreative.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/planapple.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/radiox_color_sm.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/reversemortgagedaily.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/sno_color_sm.png"></li>
                     <li><img src="http://adzerk-www.s3.amazonaws.com/resources/statsheet_color_lg.png"></li>
              </ul>
       </aside>

       <h2>What our customers are saying</h2>
       <div id="cust-testimonials">
       <?php query_posts('post_type=testimonial&category_name=for_publishers&posts_per_page=3&order=ASC'); ?>
       <?php
       add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );

       function remove_thumbnail_dimensions( $html ) {
           $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
           return $html;
       }
       ?>
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
              <h4>Get Started for FREE up to 100 million impressions</h4>
              <p class="gray">
                     Publisher packages include adOS's great features, including:
              </p>

              <div class="price-packages">
                     <div class="network-tools">
                            <h6>Network Tools</h6>
                            <ul>
                                   <li>Advertiser Portal</li>
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

                     <a class="button get-started" href="http://new.adzerk.com/signup"><strong>Get Started Now</strong></a>
       </div>
       
       <aside class="enterprise sidebar d7-d9">
              <h4>Enterprise Pricing</h4>
              <p>20 million impressions/month and up</p>
              
              <blockquote>
                     adOS's robust feature set was built to be scalable as well as affordable. Contact our sales team and we can tailor a package for your needs.
              </blockquote>
              <p class="ron"><img src="<?php bloginfo('stylesheet_directory'); ?>/imgs/this-is-ron-sm.jpg" alt="This Is Ron">
              This is Ron. He's friendly, and he loves to talk to enterprise customers about all their needs. It's what he does all day every day. Shoot him an email, he'd love to hear from you.</p>
              
              <a class="button" href="mailto:ron@adzerk.com">Get Enterprise Pricing</a>
              
       </aside>

</section>


<?php get_footer(); ?>
