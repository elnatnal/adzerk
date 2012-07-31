</div>
	<footer id="footer" class="d-all">
	       <div class="wrapper">       
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
                            <form action="http://lfov.net/webrecorder/f" method="post" name="Subscribe to Blog">
                            <input type="hidden" name="formid" value="25efc106-0e17-4823-b436-8f703ea7b6af"/>
                            <input type="hidden" name="cid" value="LF_af4faade"/>
                            <p><label for="email">Enter your email</label><br /><input type="text" name="email" id="email" /></p>
                            <button class="submit"><input type="submit" name="Add Registration" value="Submit"></button>
                            </form>
                     </div>               
       
                    <hr>
                            
                     <ul>
                                   <?php wp_nav_menu( array('menu' => 'Footer Menu 4' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                     </ul>
                     
              </section>
                     
              <section class="bottom-logo d9">
                     <h2><a href="<?php bloginfo('name'); ?>">ADZERK</a></h2>
                     <p><a href="https://maps.google.com/maps?hl=en&safe=off&z=16&q=303+South+Roxboro+St+Suite+30+Durham,+NC+27701">303 South Roxboro St<br />
                            Suite 30<br />
                            Durham, NC 27701 </a><br />
                     </p>

              </section>
			
			<section class="copyright d-all">
			       <small>Copyright Adzerk Inc. <?php echo date("Y"); echo " " ?> &copy;<br />
			       <a href="#">Privacy Policy for Ad Serving</a>&ensp;|&ensp;<a href="#">Privacy Policy for Customers</a>
			       </small>
		</section>
       </div>
	</footer>

<div style='display:none'>
	<div id='inline_content' style='padding:10px; background:#fff;'>
              <h2>Looking for the Adzerk Logo</h2>

              <div>
                     <h4>Adzerk Logo (.eps)</h4>
                     <img src="http://placekitten.com/254/113/">
                     <button>
                            <a href="#">Download</a>
                     </button>
              </div>

              <div>
                     <h4>Adzerk Logo (.eps)</h4>
                     <img src="http://placekitten.com/254/113/">
                     <button>
                            <a href="#">Download</a>
                     </button>
              </div>
              <div>
                     <h4>Adzerk Logo (.eps)</h4>
                     <img src="http://placekitten.com/254/113/">
                     <button>
                            <a href="#">Download</a>
                     </button>
              </div>


	</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/flexie.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.colorbox.js"></script>

<script>

$(document).ready(function() {
    $('h1.logo a').bind('contextmenu',function(e) {
	// check if right button is clicked
	if(e.button === 2) {
		e.preventDefault();
	}
});

$(".iframe").colorbox({iframe:true, width:"1000px", height:"620px", style:"overflow:hidden;"});

</script>


<script>
$(document).ready(function(){

        $("#more-features-show").hide();
        $("#more-show").show();

    $("#more-show").click(function(){
    $("#more-features-show").slideToggle();
    });

});


</script>




<!-- END IF FOR -->


<?php
       global $post;

       if ( is_page('features')) { ?>
              <script type="text/javascript">
                  $(function() {
                      var offset = $("#sidebar-features").offset();
                      var topPadding = 15;
                      $(window).scroll(function() {
                          if ($(window).scrollTop() > offset.top) {
                              $("#sidebar-features").stop().animate({
                                  marginTop: $(window).scrollTop() - offset.top + topPadding
                              });
                          } else {
                              $("#sidebar-features").stop().animate({
                                  marginTop: 0
                              });
                          };
                      });
                  });
              </script>
              
              <script>
              $(document).ready(function() {
                 $('a[href*=#]').bind('click', function(e) {
              	e.preventDefault();

              	var target = $(this).attr("href");

              	$('html, body').stop().animate({ scrollTop: $(target).offset().top - 20 }, 400, function() {
              	     location.hash = target;
              	});

              	return false;
                 });
              });
       	</script>
       	
              
              <?php 
       } else {
       }
       ?>
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
<script src="http://get.gridsetapp.com/1013/overlay/"></script>	
</body>

</html>
