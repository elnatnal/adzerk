<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>

<div class="d1-d6">
       <section id="publishers">
              <h2>Pricing for Publishers</h2>
              <h4>Get Started free up to 100 million impressions</h4>
              <p class="gray">
                     Publisher packages start for free, but you can add-on features for as little as $50, including:
              </p>

              <div class="price-packages">
                     <div class="bronze-support">
                            <img src="http://adzerk-www.s3.amazonaws.com/ados/100x120_bronzesupport.jpg"> <br />
                            <h6>Bronze Support</h6>
                            <ul>
                                   <li>Robust Documentation</li>
                                   <li>Email</li>
                                   <li><i>Starts at $50/mo</i></li>
                            </ul>
                       </div>    
                     
                       <div class="white-label">
                              <img src="http://adzerk-www.s3.amazonaws.com/ados/100x120_whitelabel.jpg"> <br />
                              <h6>White Label</h6>
                              <ul>
                                     <li>100% Skinnable Interface</li>
                                     <li>CNAME-ing</li>
                                     <li>API</li>
                                   <li><i>Starts at $50</i></li>
                              </ul>
                       </div>
                     <div class="silver-support">
                            <img src="http://adzerk-www.s3.amazonaws.com/ados/100x120_silversupport.jpg"> <br />
                            <h6>Silver Support</h6>
                            <ul>
                                   <li>Robust Documentation</li>
                                   <li>Email</li>
                                   <li>Live Chat</li>
                                   <li><i>Starts at $100/mo</i></li>
                            </ul>
                       </div>   
											<div class="addons"><i>More add-ons are available in the adOS Marketplace</i></div>
              </div>
                            <a class="button get-started" href="http://new.adzerk.com/signup">Get Started Now</a>

       </section>

       <section id="networks">
              <h2>Pricing for Networks</h2>
              <h4>Get Started from $200/mo or 5 cents/CPM</h4>
              <p class="gray">
                     Network packages include adOS's great add-on Network features, including:
              </p>

              <div class="price-packages">
                     <div class="network-tools">
                            <img src="http://adzerk-www.s3.amazonaws.com/ados/100x120_network.jpg"> <br />
                            <h6>Network Tools</h6>
                            <ul>
                                   <li>Advertiser Portal</li>
                                   <li>Publisher Portal</li>
                                   <li>Site Payout Management</li>
                                   <li>Earnings Calculation</li>
                            </ul>
                       </div>

                     <div class="silver-support">
                            <img src="http://adzerk-www.s3.amazonaws.com/ados/100x120_silversupport.jpg"> <br />
                            <h6>Support</h6>
                            <ul>
                                   <li>Robust Documentation</li>
                                   <li>Live Chat</li>
                                   <li>Phone</li>
                                   <li>Email</li>
                            </ul>
                       </div>    
                     
                       <div class="white-label">
                              <img src="http://adzerk-www.s3.amazonaws.com/ados/100x120_whitelabel.jpg"> <br />
                              <h6>White Label</h6>
                              <ul>
                                     <li>100% Skinnable Interface</li>
                                     <li>CNAME-ing</li>
                                     <li>API</li>
                              </ul>
                         </div>
											<div class="addons"><i>More add-ons are available in the adOS Marketplace</i></div>
                  </div>

                     <a class="button get-started" href="http://new.adzerk.com/signup">Get Started Now</a>
       </section>
</div>

       <aside class="d8-d9 sidebar">
              <div>
              <h3>Enterprise Pricing</h3>
              <p> adOS's robust feature set was built to be scalable as well as affordable. Contact our sales team and we can tailor a package for your needs.</p>
              
              <ul class="blue">
                     <li><strong>For Networks</strong><br />
                            20 million impressions/month and up</li>
                    <!-- <li><strong>For Advertisers</strong><br />
                            100 million impressions/month and up</li> -->
                     <li><strong>For Publishers</strong><br />
                            100 million impressions/month and up</li>
              </ul>
              <h3>This is Ron.</h3>
              <img src="<?php bloginfo('template_directory'); ?>/imgs/this-is-ron.jpg" width="265" height="265" alt="This Is Ron">
              <p>He's super friendly, and he loves to talk to enterprise customers about all their needs. It's what he does all day everyday. Click on over to the <a href="/contact-sales">Contact Sales</a> page to get Enterprise Pricing.</p>
              <a class="button" href="/contact-sales">Get Enterprise Pricing</a>
              </div>
       </aside>
       
<?php dynamic_sidebar('pricing-sidebar'); ?>       
<?php get_footer(); ?>
