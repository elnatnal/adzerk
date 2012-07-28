<?php get_header(); ?>
<div class="blog-list-container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">


                     <div class="blog-left">
                            <div class="date-meta">
                                   <h5 class="date-top"><?php the_date('F, j'); ?></h5>
                                   <h5 class="date-bottom"><?php the_time('Y'); ?></h5>
                            </div>
                            
                            <div class="more-meta">
                                   <?php 
                                   if(has_post_thumbnail()) {
                                   	the_post_thumbnail();
                                   } else {
                                   	echo '<a href="'.get_permalink().'"><img src="'.get_bloginfo("template_url").'/imgs/img-default.png" /></a>';
                                   }
                                   ?>

                                   <div class="tags">
                                          <?php 
                                          if(has_tag()) {
                                                 echo '<h6>Tags</h6>'.the_tags('Tags:', ', ').'';
                                          } else {}
                                          ?>
                                   </div>
                                   
                                   <div class="author">
                                          <img src="<?php bloginfo('template_directory') ?>/imgs/authors/<?php the_author_meta('ID')?>.jpg" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" />
                                                 <?php the_author_meta('first_name' ); ?> 
                                                 <?php the_author_meta('last_name' ); ?>
                                   </div>
                                   
                                   <div class="article-source">
                                   <h6>Article Source</h6>
                                   <a href="<?php $article_source = get_post_meta($post->ID, 'article-source-url', true); echo "$article_source"; ?>"><?php $article_title = get_post_meta($post->ID, 'article-source-name', true); echo "$article_title"; ?></a>
                                   </div>
                                   
                     </div>
                     
                     <div class="blog-right">
			<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

			<?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>

			<div class="entry">
				<?php the_content(); ?>
			</div>

			<footer class="postmetadata">
				<?php the_tags('Tags: ', ', ', '<br />'); ?>
				Posted in <?php the_category(', ') ?> | 
				<?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
			</footer>

		</article>

	<?php endwhile; ?>

	<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

	<?php else : ?>

		<h2>Not Found</h2>

	<?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
