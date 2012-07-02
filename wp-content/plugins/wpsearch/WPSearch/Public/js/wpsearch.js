/**
 * When the DOM is ready, register these listeners
 */
jQuery(document).ready(function(){

    /**
     * When the 'refresh' button is clicked, update the appropriate elements
     *  with the index size and blog size
     */
    jQuery('#refresh_stats').click(function(){

        jQuery('#total').html('...');
        jQuery('#indexed').html('...');
        jQuery('#loading-icon').show();

        jQuery.post(ajaxurl, {action: 'get_stats'}, function(response) {

            r = eval('(' + response + ')');
            jQuery('#total').html(numberFormat(r.total));
            jQuery('#indexed').html(numberFormat(r.current));
            jQuery('#loading-icon').hide();
        });
    });

    /**
     * When the 'index comments' checkbox is clicked, save the state via ajax
     *  and mark it as saved.
     */
    jQuery('#chk-index-comments').change(function(){
        chkValue = jQuery('#chk-index-comments:checked').val() == 'on';
        jQuery.post(ajaxurl, {action: 'save_index_comments', value: chkValue}, function(response) {
            if(isSuccessful(response))
                markSaved('#span-index-comments-success');
        });
    });

    /**
     * When the 'index categories' checkbox is clicked, save the state via ajax
     *  and mark it as saved.
     */
    jQuery('#chk-index-categories').change(function(){
        chkValue = jQuery('#chk-index-categories:checked').val() == 'on';
        jQuery.post(ajaxurl, {action: 'save_index_categories', value: chkValue}, function(response) {
            if(isSuccessful(response))
                markSaved('#span-index-categories-success');
        });
    });

    /**
     * When the 'rebuild index' button is clicked, make the call to kick off the
     *  build process, and then kick off the progress tracker.
     */
    jQuery('#rebuild-index').click(rebuildIndex);

    /**
     * An alternate place to click for the above
     */
    jQuery('#link-rebuild').click(rebuildIndex);

    jQuery("#title-slider").slider({"width": "100px", 
                                    "animate": true,
                                    "step" : 10,
                                    "value": WPSEARCH.titleBoost,
                                    "change" : function() {
                                        var titleBoost = jQuery('#title-slider').slider('value');
                                        jQuery.post(ajaxurl, {action: 'save_title_boost', value: titleBoost}, function(response) {
                                            if(isSuccessful(response))
                                                markSaved('#span-title-boost-success');
                                        });
                                    }});

    /*
     * Handle the context boost slider
     */
    jQuery("#content-slider").slider({"width": "100px",
                                      "animate": true,
                                      "step": 10,
                                      "value": WPSEARCH.contentBoost,
                                      "change": function() {
                                        var contentBoost = jQuery('#content-slider').slider('value');
                                        jQuery.post(ajaxurl, {action: 'save_content_boost', value: contentBoost}, function(response) {
                                            if(isSuccessful(response))
                                                markSaved('#span-content-boost-success');
                                        });
                                    }});

    /*
     * Handle the multi-select of post types to search over
     */
    jQuery("#search_post_types").multiselect({
       "selectedText": "# of # selected",
       "minWidth": "150",
       "header": false,
       "classes": "wpsearch",
       "height": "125",
       "close": function () {
           var types = jQuery('#search_post_types').val();
           if(types == null) types = [];
           jQuery.post(ajaxurl, {action: 'save_search_types', value: types}, function(response) {
               if(isSuccessful(response))
                   markSaved('#span-search-types-success');
           });
       }
    });
});

function showBoostPercentage(value, id)
{
    var msg = '';
    if(value <= 100) msg = 'High';
    if(value <= 60)  msg = 'Medium';
    if(value <= 30)  msg = 'Low';
    jQuery(id).html(value);
}

/**
 * Kick off the index rebuilding process
 */
function rebuildIndex()
{
    jQuery('#status-box').hide();
    jQuery('#controls').hide();
    jQuery('#progress_message').html('Gathering post data ..');
    jQuery('#building-message').show();
    jQuery('body').scrollTop();
    jQuery('html').animate({scrollTop: 0}, "slow");

    jQuery.post(ajaxurl, {action: 'rebuild_index'}, function(response)
    {
        if(!isSuccessful(response))
        {
            alert('The index build failed to start. Check the driver configuration and index status if possible.');
            location.reload();
        }
    });
    
    reloadOnBuildCompletion();
}

/**
 * Check a response fromt he server to see if the call was successful (uses
 *  success flag, not HTTP error codes)
 */
function isSuccessful(raw_json)
{
    o = eval('(' + raw_json + ')');
    return o.success == true;
}

/**
 * Show and fade away a 'saved' message next to a checkbox with the given id
 */
function markSaved(span_id)
{
    jQuery(span_id).show().delay(500).fadeOut();
}

/**
 * Check the status of the index build every so often. Update the progress bar
 *  and reload the page if the build is no longer taking place.
 */
function reloadOnBuildCompletion()
{
    /* Then do it every 1 seconds or so */
    jQuery(document).everyTime(1000, function() {
        updateStatsOrReload();
    }, 0);
    
}

/**
 * Update the progess bar with the current index build progress and reload if
 *  if it's complete.
 */
function updateStatsOrReload()
{
    jQuery.post(ajaxurl, {action: 'get_stats'}, function(response) {
        r = eval('(' + response + ')');
        if(r.reindexing == false)
            location.reload();

        var progress = Math.round(r.current/r.total * 100);

        if(progress > 0)
            jQuery('#progress_message').html('Rebuilding index ..');

        if(progress == 100)
            jQuery('#progress_message').html('Completing ..');

        jQuery('#progress_text').html(progress + '%');
        jQuery('#progress_bar').width(progress + '%');
    });
}

/**
 * Format a number with commas if needed
 */
function numberFormat(nStr,prefix)
{
    var prefix = prefix || '';
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1))
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    return prefix + x1 + x2;
}