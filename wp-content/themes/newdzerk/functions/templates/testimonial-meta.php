<?php $testimonial_position = get_post_meta($post->ID, '_position', true); ?>

<b>Enter the position of this testifier:</b>
<input style="margin-top: 5px" type="text" name="_position" value="<?php echo $testimonial_position ?>" />