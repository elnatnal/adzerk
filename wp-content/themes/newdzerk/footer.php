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
                            <p><label for="email">Sign up for our Newsletter</label><br /><input type="text" name="email" id="email" /></p>
                            <button class="submit"><input type="submit" name="Add Registration" value="Submit"></button>
                            </form>
                     </div>               
                            
                     <ul>
                                   <?php wp_nav_menu( array('menu' => 'Footer Menu 4' , 'sort_column' => 'menu_order', 'container' => '', 'items_wrap' => '%3$s' )); ?>
                     </ul>
                     
              </section>
                     
              <section class="bottom-logo d9">
                     <h2><a href="<?php echo home_url(); ?>">ADZERK</a></h2>
                     <p><a href="https://maps.google.com/maps?hl=en&safe=off&z=16&q=303+South+Roxboro+St+Suite+30+Durham,+NC+27701">303 South Roxboro St<br />
                            Suite 30<br />
                            Durham, NC 27701 </a><br />
                     </p>

              </section>
			
			<section class="copyright d-all">
			       <small>Copyright Adzerk Inc. <?php echo date("Y"); echo " " ?> &copy;<br />
			       <a href="http://help.adzerk.com/questions/7745-Privacy-Policy-for-Ad-Serving">Privacy Policy for Ad Serving</a>&ensp;|&ensp;<a href="http://help.adzerk.com/questions/6562-Privacy-Policy-for-Customers">Privacy Policy for Customers</a>
			       </small>
		</section>
       </div>
	</footer>

<div style='display:none'>
	<div id='inline_content' style='padding:10px; background:#fff;'>
              <h2>Looking for the Adzerk Logo?</h2>

              <div class="pop-logo">
                     <h4>Adzerk Logo (.png)</h4>
                     <img src="http://adzerk-www.s3.amazonaws.com/resources/adzerk-logo.png">
                     <button>
                            <a href="#">Download</a>
                     </button>
              </div>

              <div class="pop-logo">
                     <h4>adOS Blue Logo (.png)</h4>
                     <img src="http://adzerk-www.s3.amazonaws.com/resources/adOs_logo_blue.png">
                     <button>
                            <a href="#">Download</a>
                     </button>
              </div>
              <div class="pop-logo">
                     <h4>adOS White Logo (.png)</h4>
                     <img src="http://adzerk-www.s3.amazonaws.com/resources/adOS_logo_white.png">
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

$(".iframe").colorbox({iframe:true, width:"1000px", height:"920px", style:"overflow:hidden;"});
$(".custom-theme").colorbox({rel:'custom-theme', transition:"none", width:"1000px", height:"920px", arrowKey:true, transition:"fade"});

$('.logo a').mousedown(function(e) {
    if (e.which === 3) {
			$(".inline").colorbox({inline:true, width:"auto"});
    }
});

</script>

<?php
wp_reset_query();
if ( is_page( array('for-networks', 'for-publishers') ) ) { ?>
       <script>
       $(document).ready(function(){
							$("a.for-networks").colorbox({rel:'for-networks'});
							$("a.for-publishers").colorbox({rel:'for-publishers'});
              $("#more-features-show").hide();
              $("#more-show").show();

              $("#more-show").click(function() {
              $("#more-features-show").animate({ opacity: 1.0 },475).slideToggle(500, function() {
              $("#more-show").text($(this).is(':visible') ? "Less Features" : "More Features");
                     });
              });
       });

</script>
<?php } ?>

<?php
       global $post;

       if ( is_front_page()) { ?>
              <script type="text/javascript">
                  var documentHeight = 0;
                  var topPadding = 65;
                  $(function() {
                      var offset = $("ol.timeline_nav").offset();
                      documentHeight = $(document).height();
                      $(window).scroll(function() {
                          var sideBarHeight = $("ol.timeline_nav").height();
                          if ($(window).scrollTop() > offset.top) {
                              var newPosition = ($(window).scrollTop() - offset.top) + topPadding;
                              var maxPosition = documentHeight - (sideBarHeight + 1515);
                              if (newPosition > maxPosition) {
                                  newPosition = maxPosition;
                              }
                              $("ol.timeline_nav").stop().animate({
                                  marginTop: newPosition
                              });
                          } else {
                              $("ol.timeline_nav").stop().animate({
                                  marginTop: 0
                              });
                          };
                      });
                  });
              </script>              
              <script>
              $(document).ready(function() {
								//tour on features page
								$("a.features").colorbox({rel:'features'});
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




<?php
       global $post;

       if ( is_page('features')) { ?>
              <script type="text/javascript">
                  var documentHeight = 0;
                  var topPadding = 15;
                  $(function() {
                      var offset = $("#sidebar-features").offset();
                      documentHeight = $(document).height();
                      $(window).scroll(function() {
                          var sideBarHeight = $("#sidebar-features").height();
                          if ($(window).scrollTop() > offset.top) {
                              var newPosition = ($(window).scrollTop() - offset.top) + topPadding;
                              var maxPosition = documentHeight - (sideBarHeight + 615);
                              if (newPosition > maxPosition) {
                                  newPosition = maxPosition;
                              }
                              $("#sidebar-features").stop().animate({
                                  marginTop: newPosition
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
								$('a.features').colorbox({rel:'features'});
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
