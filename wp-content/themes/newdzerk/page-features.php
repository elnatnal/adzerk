<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>
<aside id="sidebar-features" class="features d1">
       <ul>
              <li><a href="#fastest-ad-code">Fastest Ad Code in the World</a></li>
              <li><a href="#for-networks">For Networks</a></li>
              <li>
                     <ul>
                            <li><a href="#skinnable-interface">Skinnable Interface</a></li>
                            <li><a href="#site-payout-management">Site Payout Management</a></li>
                            <li><a href="#publisher-portal">Publisher Portal</a></li>
                            <li><a href="#advertiser-portal">Advertiser Portal</a></li>
                     </ul>
              </li>
              <li><a href="#for-publishers">For Publishers</a></li>
              <li><a href="#campaign-trafficking">Campaign Trafficking</a></li>
                     <li>
                            <ul>
                                   <li><a href="#robust-targeting-options">Robust Targeting Options</a></li>
                                   <li><a href="#tracking-options">Tracking Options</a></li>
                                   <li><a href="#flight-delivery-options">Flight Delivery Options</a></li>
                                   <!--<li><a href="#passbacks">Passbacks</a></li>-->
                            </ul>
                     </li>
              <li><a href="#reporting">Reporting</a></li>
              <li><a href="#worry-free">Worry Free</a></li>
              <li><a href="#differences">Differences</a></li>
                     <li>
                            <ul>
                                   <li><a href="#full-api">Full API</a></li>
                                   <li><a href="#fast-easy-interface">Fast &amp; Easy Interface</a></li>
                                   <li><a href="#ad-tech-marketplace">Ad Tech Marketplace</a></li>
                                   <li><a href="#other-features">Other Features</a></li>
                            </ul>
                     </li>
       </ul>
</aside>


<div class="features-main d2-d9">

<section id="fastest-ad-code">
       <h2>Fastest Ad Code in the World <span class="subtext">&emsp;No, seriously, <a href="<?php echo home_url(); ?>/product-blog/new-feature-the-fastest-ad-code-in-the-world">we've clocked it.</a></span></h2>
       <a class="features" href="http://adzerk.com/tour/img/fast.png" title="The Fastest Ad Code in the World"><img src="http://adzerk-www.s3.amazonaws.com/marketing_site/fastest.jpg" alt="Ad request sizes are less than 25% of OpenX ad requests" /></a>
       <div>
              <h4>Our ad code is flexible and fast. We can serve:</h4>
              <ul>
                     <li>Rich media including HTML5, HTML/CSS/JS</li>
                     <li>Flash</li>
                     <li>Images</li>
                     <li>Email ads</li>
                     <li>Mobile ads</li>
                     <li>Asynchronous or Synchronous ad calls</li>
              </ul>
       </div>
</section>       


<section id="for-networks">
       <h2>For Networks</h2>
       <div id="skinnable-interface">
              <a class="features" href="http://adzerk.com/tour/img/skin.png" title="100% Skinnable UI"><img src="http://adzerk-www.s3.amazonaws.com/marketing_site/skinnable.jpg" alt="adOs' user interface is completely customizeable" /></a>
              <h4>Skinnable Interface</h4>
              <p>adOS's user interface is completely customizable. You can upload your own CSS, Javascript, and HTML files to make any and every part of the app match your own site's look and feel. Better yet, you can have us do it for you! Check out our gallery of themes to see some examples. The typical turnaround time is about 3 days.</p>
       </div>

       <div id="site-payout-management">
              <a class="features" href="http://adzerk.com/tour/img/payouts.png" title="Site Payout Management"><img src="http://adzerk-www.s3.amazonaws.com/marketing_site/network_payouts.jpg" alt="Bring sanity to your workflow. Manage all your financials in one place." /></a>
              <h4>Site Payout Management</h4>
              <p>Site Payout Management allows you to manage paying out your sites using campaign data and delivery information from adOS. Download payment history as Excel or Paypal mass pay files.</p>
       </div>

       <div id="publisher-portal">
              <a class="features" href="http://www.adzerk.com/tour/img/publisherPortal.png" title="Publisher Portal"><img src="http://adzerk-www.s3.amazonaws.com/marketing_site/publisher_portal.jpg" alt="Give Publishers their own login and access to reports and earnings." /></a>
              <h4>Publisher Portal</h4>
              <p>The Publisher Portal allows networks to give their publishers a separate login, with access to site overview data, ad code options (currently include synchronous versus asynchronous, static/email, and third–party ad server), zone management, customizable site reporting data, and remainder creative management.</p>
       </div>

       <div id="advertiser-portal">
              <a class="features" href="http://adzerk.com/tour/img/advertiserPortal.png" title="Advertiser Portal"><img src="http://adzerk-www.s3.amazonaws.com/marketing_site/advertiser_portal.jpg" alt="Advertiser Portal" /></a>
              <h4>Advertiser Portal</h4>
              <p>The Advertiser Portal allows networks to give their advertisers a separate login, with access to configurable self-service reporting data, the ability to upload and manage their own creatives (subject to approval by a Network Admin via adOS's build-in notification system!), and manage their own portal account. The Advertiser Portal makes adOS a one-stop location for all interactions between Networks or Publishers and their Advertisers.</p>
       </div>
</section>       

<section id="campaign-trafficking">
       <h2>Campaign Trafficking</h2>
       <div id="robust-targeting-options" class="d2-d5">
              <h4><a class="features" href="http://adzerk.com/tour/img/targeting.png" title="Targeting Options including Location, Site/Zone, Keyword, Referrer, User Agent, and IP range.">Robust Targeting Options</a></h4>
              <ul>
                     <li>
                            <p>
                                   <strong>Geo-Targeting</strong><br />
                                   You can target your flights and campaigns by Country, Region/State, or Metro Code.
                            </p>
                     </li>

                     <li>
                            <p>
                                   <strong>Site/Zone Targeting</strong><br />
                                   You can specify zones on particular sites, and target flights and campaigns to them.
                            </p>
                     </li>

                     <li>
                            <p>
                                   <strong>User Targeting</strong><br />
                                   User targeting allows you to specify what campaigns and flights are shown based on the viewer's operating system or browser type. For example, show Mac users one flight and PC users another!
                            </p>
                     </li>

                     <li>
                            <p>
                                   <strong>Keyword Targeting</strong><br />
                                   You can target based on keywords. Add keywords on the same line separated by a comma to search for both or on separate lines to search for separately. "Dodge, truck" would target request with both the "dodge" and "truck" keywords, "dodge" and "truck" on separate lines would target requests for either "truck" or "dodge."
                            </p>
                     </li>

                     <li>
                            <p>
                                   <strong>Referrer Targeting</strong><br />
                                   Referrer targeting allows you to target viewers based on what sites they came from.
                            </p>
                     </li>

                     <li>
                            <p>
                                   <strong>IP Targeting</strong><br />
                                   You can target users based on a single IP address, a range, or excluding an IP address or range.
                            </p>
                     </li>
              </ul>
       </div>
       
       <div class="d6-d9">
       <div id="flight-delivery-options">
              <h4><a class="features" href="http://adzerk.com/tour/img/flight.png" title="Flight Delivery Options">Flight Delivery Options</a></h4>
                     <ul>
                            <li>Day Parting</li>
                            <li>Frequency Capping</li>
                            <li>Distribution</li>
                            <li>Start and end flights by time</li>
                     </ul>
       </div>
      <!-- 
       <div id="passbacks">
              <h4>Passbacks</h4>
                     <p>You can target your flights and campaigns by Country, Region/State, or Metro Code.<br /> <strong>Daisy chain ad servers from the client side.</strong></p>
       </div>
       -->
       <div id="tracking-options">
              <h4>Tracking Options</h4>
                     <p><strong>Track by Actions</strong></p>
       </div>
       </div>
</section>       
<section id="reporting">
	<div class="fast-accurate-reporting">
        	<h2>Fast &amp; Accurate Reporting</h2>
                	<p>You can run preconfigured reports like Advertiser, Site, Channel, and Impression Forecasting reports, as well as Custom reports, and export as CSV, or get an Email notification when big reports are done generating.
        </div>
</section>

<section id="worry-free">
       <h2>Worry Free</h2>
       <div id="always-up">
              <h4>adOS is <span class="orange">always up.</orange></h4>
              <p>You'll never have to worry about Campaigns not delivering on time because your ad server was down.</p>
       </div>

       <div id="scalable">
              <h4>adOS is <span class="orange">scalable.</orange></h4>
              <p>adOS lives in the cloud. It can grow with your business seamlessly and effortlessly.</p>
       </div>

       <div id="technical-support">
              <h4>adOS has <span class="orange">technical support.</orange></h4>
              <p>Our team provides robust documentation, live chat, phone support, and real&ndash;time in&ndash;app communication about product and service updates. We make sure that you know what you need to know and that you can get your ads up and running.</p>
       </div>
       
       
       <div id="ad-ops-support">
              <h4>adOS has <span class="orange">Ad Ops support.</orange></h4>
              <p>Ad serving can be complicated. We provide full support for the entire process &ndash; from migrating your current ad server to serving your first ad, to making sure your campaigns are performing as expected.</p>
       </div>
</section>

<section id="differences">
       <h2>Differences</h2>
       <div id="full-api">
              <h4>Full API</h4>
              <p>Currently available as a Ruby gem. <em>Coming soon: iOS and Android SDKs</em></p>
       </div>
       
       <div id="flight-delivery-options">
              <h4>Flight Delivery Options</h4>
                     <ul>
                            <li>Day Parting</li>
                            <li>Frequency Capping</li>
                            <li>Distribution</li>
                            <li>Start and end flights by time</li>
                     </ul>
       </div>

       <div id="ad-tech-marketplace">
              <h4>Ad Tech Marketplace</h4>
              <p>Includes apps for networks, publishers, and advertisers. Apps for extra adOS functionality like:
                     <ul>
                            <li>White Label</li>
                            <li>Advertiser Mode</li>
                            <li>Advertiser Creative Management</li>
                            <li>Advanced Forecasting</li>
                            <li>Network Tools</li>
                            <li>Custom Themes</li>
                            <li><a href="#">and more...</a></li>
                     </ul>
              </p>
       </div>
       
       
       <div id="passbacks">
              <h4>Passbacks</h4>
                     <p>You can target your flights and campaigns by Country, Region/State, or Metro Code. <strong>Daisy chain ad servers from the client side.</strong></p>
       </div>
       
       <div id="tracking-options">
              <h4>Tracking Options</h4>
                     <p><strong>Track by Actions</strong></p>
       </div>

</section>       

</div>
</div>
<?php get_footer(); ?>
