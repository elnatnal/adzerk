<?php get_header(); ?>
    <hgroup>
           <h1 class="sassytext">
              People be talkin'
           </h1>
           <h1>Press and Media</h1>
    </hgroup>


<?php query_posts( 'cat=23'.'&paged='.$paged );?>
       <div class="blog-list-container d-all">
       	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

       		<article <?php post_class('clear') ?> id="post-<?php the_ID(); ?>">


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
                                                 if(has_tag()) { ?>
                                                        <h6 class="side-meta-caps">Tags</h6>
                                                        <?php the_tags(''); ?>
                                                 <?php } else {}
                                                 ?>
                                          </div>

                                          <div class="author">
                                                 <h6 class="side-meta-caps">Posted by</h6></h6>
                                                 <img src="<?php bloginfo('template_directory') ?>/imgs/authors/<?php the_author_meta('ID')?>.jpg" alt="<?php the_author(); ?>" title="<?php the_author(); ?>" />
                                                        <p><?php the_author_meta('first_name' ); ?><br /> 
                                                        <?php the_author_meta('last_name' ); ?></p>
                                          </div>



                                          <?php 
                                               $article_source = get_post_meta($post->ID, "article-source-url", true);
                                               $article_title = get_post_meta($post->ID, "article-source-name", true); ?>


                                                 <?php if ($article_title) : ?>
                                                        <div class="article-source">
                                                               <h6 class="side-meta-caps">Article Source</h6>
                                                               <a href="<?php echo $article_source; ?>"><?php echo $article_title; ?></a></h3>
                                                        </div>
                                                 <?php endif; ?>
                                   </div>
                            </div>
                            <div class="blog-right">
       			       <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

       			       <div class="entry">
                                          <?php echo substr(strip_tags($post->post_content), 0, 700);?>...
                                                 <a class="button read-more" href="<?php the_permalink();?>">Read More</a>
                                   </div>
                            </div>
       		</article>
		<hr />
       	<?php endwhile; ?>

       	<?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

       	<?php else : ?>

       		<h2>Not Found</h2>

       	<?php endif; ?>
       </div>


<?php if ( is_category( 'press-and-media' )){ ?>    
       <?php get_sidebar('press-and-media'); ?>    
<?php } else { ?>
       <?php get_sidebar('insideadzerk'); ?>    
<?php } ?>




<?php get_footer(); ?>
