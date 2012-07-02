<h2>WPSearch Control Panel</h2>
<style type="text/css">
.shadow_column{
    background: #FFFFFF url(<?php echo WPSearch_Utility::getImageBaseURL(); ?>right-bg.gif) repeat-y scroll right center;
    padding-right: 8px;
}

.shadow_bottom{
    background: transparent url(<?php echo WPSearch_Utility::getImageBaseURL(); ?>bottom-bg.gif) no-repeat scroll right top;
    height: 8px;
}
</style>
<script type="text/javascript">
        var WPSEARCH = {
            "titleBoost" : <?php echo $title_boost; ?>,
            "contentBoost" : <?php echo $content_boost; ?>
        };
</script>
    <div id="main">
      <div class="left_column">
         <?php if($errors): ?>
             <div class="box">
                    <div class="shadow_column">
                        <div class="title" style="padding-left: 27px; background: #F1F1F1 url('<?php echo WPSearch_Utility::getImageBaseURL(); ?>info.png') no-repeat scroll 7px center;">
                            Alerts
                        </div>
                        <div class="content">
                            <p>
                                WPSearch has noticed some potential problems:
                            </p>
                            <ol>
                                <?php foreach($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                    <div class="shadow_bottom"></div>
             </div>
         <?php endif; ?>
        <div class="box">
            <div class="shadow_column">
                  <div class="title">WPSearch Search Index Status</div>
                  <div class="content">
                    <?php if($is_alive): ?>
                      <div id="status-box" style="display:<?php echo ($is_building ? 'none' : 'block') ?>;">
                            <?php if($last_reindex): ?>
                            <div class="good_info left">Index is fully built and live.</div>
                            <?php else: ?>
                            <div class="notice_info left">Almost there! Click below to build your site's index!</div>
                            <?php endif; ?>
                            <div id="loading-icon" class="right">
                                <img alt="" src="<?php echo WPSearch_Utility::getImageBaseURL(); ?>ajax-loader-rotate.gif" />
                            </div>
                            <div class="clearfix"></div>
                            <div class="information">
                                <div class="name">Total posts in the index</div>
                                <div class="value" id="indexed"><?php echo number_format($indexed_docs); ?></div>
                                <div class="smallbreak"></div>
                                <div class="name">Total posts in Wordpress</div>
                                <div class="value" id="total"><?php echo number_format($total_docs); ?></div>
                                <div class="smallbreak"></div>
                                <div class="name">Last full index build</div>
                                <div class="value"><?php echo ($last_reindex > 0 ? date('F j, Y. g:i a', $last_reindex) : 'Never'); ?></div>
                                <div class="smallbreak"></div>
                                <div class="name">Comment search enabled?</div>
                                <div class="value"><?php echo ($indexed_comments   ? 'Yes' : 'No') ?></div>
                                <div class="smallbreak"></div>
                                <div class="name">Category searching enabled?</div>
                                <div class="value"><?php echo ($indexed_categories ? 'Yes' : 'No') ?></div>
                            </div>
                            <div class="spacebox">
                                <input class="power_button" type="button" id="refresh_stats" value="Refresh" />
                                <div class="clearfix"></div>
                                
                            </div>
                      </div>
                      <div id="building-message" class="good_info" style="display:<?php echo ($is_building ? 'block' : 'none') ?>;">
                          <div class="good_info" style="font-size: 75%; padding-bottom: 12px;">Your index is currently building. You can leave this area and come back any time.</div>
                          <div style="vertical-align: middle;">
                            <span id="progress_message"></span>
                            <img alt="" src="<?php echo WPSearch_Utility::getImageBaseURL(); ?>ajax-loader-rotate.gif" />
                          </div>
                          
                          <div class="progress-container">
                               <span id="progress_text">Updating..</span>
                               <div  id="progress_bar" style="width: 0%"></div>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                    <?php else: ?>
                        <div class="bad_info">
                            <p>
                                There was an error: "<?php echo $error_message; ?>." Check that:
                            </p>
                            <ol>
                                <li>Your WPSearch installation is configured to use a supported driver</li>
                                <li>The driver configuration is correct</li>
                                <li>The driver is installed and responding</li>
                            </ol>
                        </div>
                    <?php endif; ?>
                  </div>
            </div>
            <div class="shadow_bottom"></div>
        </div>
        <?php if(!$is_building && $is_alive): ?>
          <div id="controls">
            <div class="box">
                <div class="shadow_column">
                    <div class="title">Search Controls</div>
                    <div class="content">
                        <div class="option">
                            <div class="slider-label">
                                <div class="name nomargin">
                                    Title Boost<span class="success" id="span-title-boost-success">Saved!</span>
                                </div>
                                <div class="desc nomargin">
                                    Boost the importance of titles in search results<br />
                                </div>
                            </div>
                            <div class="slider-container">
                                <div class="slider-description">Low</div>
                                <div id="title-slider" class="slider"></div>
                                <div class="slider-description">High</div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="break"></div>
                        <div class="option">
                            <div class="slider-label">
                                <div class="name nomargin">
                                    Content Boost<span class="success" id="span-content-boost-success">Saved!</span>
                                </div>
                                <div class="desc nomargin">
                                    Boost the importance of document content in search results<br />
                                </div>
                            </div>
                            <div class="slider-container">
                                <div class="slider-description">Low</div>
                                <div id="content-slider" class="slider"></div>
                                <div class="slider-description">High</div>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div class="break"></div>
                        <div class="option">
                            <div class="multisel-label">
                                <div class="name nomargin">
                                    Search Types<span class="success" id="span-search-types-success">Saved!</span>
                                </div>
                                <div class="desc nomargin">
                                    Decide which types of posts you would like to search
                                </div>
                            </div>
                            <div class="multisel-container">
                                <select id="search_post_types" name="search_post_types" multiple="multiple">
                                    <?php foreach($post_types as $type): ?>
                                        <option value="<?php echo $type; ?>" <?php if(in_array($type, $searched_types)) echo 'selected="selected"'; ?>>&nbsp;<?php echo ucwords(str_replace('_', ' ', $type)); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                    </div>
                </div>
                <div class="shadow_bottom"></div>
            </div>

            <div class="box">
                <div class="shadow_column">
                    <div class="title">Rebuild Control (Advanced)</div>
                    <div class="content">
                        <div class="option">
                            <div class="check">
                                <input type="checkbox" id="chk-index-comments" <?php echo ($index_comments ? 'checked="1"' : ''); ?>/>
                            </div>
                            <div class="name">Index & Search Comments<span class="success" id="span-index-comments-success">Saved!</span></div>
                            <div class="desc">
                                During a full rebuild, index the comments related
                                to each post. This is much more expensive in terms
                                of processing, but makes for a more complete search.
                                You will have to rebuild the index (below) to enable
                                or disable this.
                            </div>
                        </div>
                        <div class="break"></div>
                        <div class="option">
                            <div class="check">
                                <input type="checkbox" id="chk-index-categories" <?php echo ($index_categories ? 'checked="1"' : '') ?>/>
                            </div>
                            <div class="name">Index & Search Categories<span class="success" id="span-index-categories-success">Saved!</span></div>
                            <div class="desc">
                                During a full rebuild, index the categories related
                                to each post. Like indexing comments, this is expensive in terms
                                of processing (even more so than comments), but makes
                                for a more complete search. It also enables filtering
                                search results by category. You will have to rebuild the index (below) to enable
                                or disable this.
                            </div>
                        </div>
                        <div class="break"></div>
                        <div class="spacebox">
                            <input id="rebuild-index" class="power_button" type="button" value="Rebuild Index" />
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="shadow_bottom"></div>
            </div>
        </div>
        <?php endif; ?>
        <div class="about">
            <?php echo $about; ?>
        </div>
      </div>
      <div class="right_column">
          <a href="http://oconf.org" target="_blank">
            <img class="oconf_logo" src="<?php echo WPSearch_Utility::getImageBaseURL(); ?>oconf.jpg" alt="" />
          </a>
          <?php if(WPSearch_Config::get('driver') == 'phplucene'): ?>
          <?php
                if($message = WPSearch_Utility::getWPSearchMessage())
                {
                    echo $message;
                }
          ?>
          <h3>Your Search Can Be Even Better</h3>
          <p>
              <strong>
                  You're using WPSearch Free, the second-best Wordpress
                  search plugin of all time!
              </strong>
          </p>
          <p>
              When your site grows to the point where WPSearch Free starts to
              get a little winded, be sure to check out
              <a href="#">WPSearch Premium</a>, which will handle up to 500,000
              published posts with amazing speed. It's a must for any
              content-heavy sites. It specializes in <strong>News and E-Commerce</strong>!
          </p>
          <?php endif; ?>
          <h3>Have a bug report?</h3>
          <p>
              We like to keep our software on top, and fixing any issues is
              a big part of that. Be sure to give us as much detail as possible,
              such as the number of posts you have, any error messages that
              were given, and any behavior you've observed.
          </p>
          <p>
              Send all reports to <a href="mailto:ohcrap@oconf.org">ohcrap@oconf.org</a>. Thanks
              for using WPSearch!
          </p>
      </div>
    </div>
      <div class="clearfix"></div>
      <img src="http://report.wpsearch2.com/checkin/?s=<?php echo $service_tag.'&'.time(); ?>" alt="" />
    <?php if($is_building): ?>
       <script type="text/javascript">
           reloadOnBuildCompletion();
       </script>
    <?php endif; ?>