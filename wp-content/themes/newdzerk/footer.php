		<footer id="footer">
	              
	              <section class="d1">
	                     <ul>
                                   <?php wp_nav_menu( array('menu' => 'Header Menu' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="d2-d4">
                            <ul>
                                   <?php wp_nav_menu( array('menu' => 'Header Menu' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="d5">
                            <ul>
                                   <?php wp_nav_menu( array('menu' => 'Header Menu' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="d6-d8">
                            <ul>
                                   <?php wp_nav_menu( array('menu' => 'Header Menu' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                            </ul>
                     </section>
                     
                     <section class="d9">
                     <ul>
                            <?php wp_nav_menu( array('menu' => 'Header Menu' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                     </ul>
                     
			
			<section class="copyright">
			       <small>Copyright Adzerk Inc. <?php echo date("Y"); echo " " ?> &copy;<br />
			       <a href="#">Privacy Policy for Ad Serving</a>&ensp;|&ensp;<a href="#">Privacy Policy for Customers</a>
			       </small>
			</sction>
		</footer>

	</div>

	<?php wp_footer(); ?>


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
