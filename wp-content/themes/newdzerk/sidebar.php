<aside class="blog sidebar d8-d9">
    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('global-blog-sidebar')) : else : ?>

                  <div class="newsletter">
                         <h4>Sign up for our newsletter</h4>
                         <form action="http://lfov.net/webrecorder/f" method="post" name="Subscribe to Blog">
                         <input type="hidden" name="formid" value="25efc106-0e17-4823-b436-8f703ea7b6af"/>
                         <input type="hidden" name="cid" value="LF_af4faade"/>
                         <p><label for="email">Email:</label><input type="text" name="email" id="email" /></p>
                         <p><label for="last_name">Last Name:</label><input type="text" name="last_name" id="last_name" /></p>
                         <p><label for="first_name">First Name:</label><input type="text" name="first_name" id="first_name" /></p>
                         <p class="submit"><input type="submit" name="Add Registration" value="Submit"></p>
                         </form>
                  </div>
           </aside>