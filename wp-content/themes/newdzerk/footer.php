		<footer id="footer" class="d-all">
	              
	              <section class="d1">
	                     <h3>Learn More</h3>
	                     <ul>
                                   <?php wp_nav_menu( array('menu' => 'Footer Menu 1' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="d2-d4">
                            <h3>Help &amp; Support</h3>
                            <ul>
                                   <?php wp_nav_menu( array('menu' => 'Footer Menu 2' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="d5">
                            <h3>About Us</h3>
                            <ul>
                                   <?php wp_nav_menu( array('menu' => 'Footer Menu 3' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="social d6-d8">
                            <h3>Connect with Us</h3>
                            <div class="newsletter-sign-up">
                                   <form></form>
                                   <button>Sign Up</button>
                            </div>

                            <hr>
                            <ul>
                                   <?php wp_nav_menu( array('menu' => 'Footer Menu 4' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="bottom-logo d9">
                            <h2>ADZERK</h2>
                            <p>406 Blackwell St. <br />
                                   Suite B034 <br />
                                   Durham, NC 27701 <br />
                            </p>

                     </section>
			
			<section class="copyright d-all">
			       <small>Copyright Adzerk Inc. <?php echo date("Y"); echo " " ?> &copy;<br />
			       <a href="#">Privacy Policy for Ad Serving</a>&ensp;|&ensp;<a href="#">Privacy Policy for Customers</a>
			       </small>
			</sction>
		</footer>

	</div>

<!-- here comes the javascript -->

<!-- jQuery is called via the Wordpress-friendly way via functions.php -->

<!-- this is where we put our custom functions -->
<script src="<?php bloginfo('template_directory'); ?>/_/js/functions.js"></script>

<!-- Asynchronous google analytics; this is the official snippet.
	 Replace UA-XXXXXX-XX with your site's ID and uncomment to enable.
	 
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-XXXXXX-XX']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
-->

<script src="http://get.gridsetapp.com/1013/overlay/"></script>	
</body>

</html>
