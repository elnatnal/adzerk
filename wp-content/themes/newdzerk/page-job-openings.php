<?php get_header(); ?>
<hgroup>
       <?php $sassy = get_post_meta($post->ID, "adzerk-sassy-text", true); ?>
       <h1 class="sassytext">
          <?php echo $sassy; ?>
       </h1>
       <h1><?php the_title(); ?></h1>
</hgroup>
<div class="d1-d6">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article class="post" id="post-<?php the_ID(); ?>" class="d1-d6">
			<div class="entry">

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

			</div>

			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

		</article>
		
		<?php endwhile; endif; ?>
</div>

<div class="d7">&emsp;</div>

       <aside class="d8-d9 sidebar job-openings">
              <div>
              <h3>We're growing. Fast.</h3>
              <p> Adzerk is a Durham, NC startup that’s helping content publishers make more money from their ad inventory by building a revolutionary ad serving platform. We are looking for individuals who love working in a fast paced environment that focuses on continuous learning and personal responsibility.</p>
              
              <strong>Some reasons why you want to work here:</strong>
              <ul>
                     <li>Adzerk believes employees have rights. We have a <a href="Employee bill of rights post">Bill of Rights</a>, in fact.</li>
                     <li>We put our <a href="Adzerk and Amendment One post">money where our convictions are</a>.</li>
                     <li>We have a great location in glamorous Durham NC.</li>
                     <li>You'll get your own Macbook Pro and Thunderbolt display, with all the peripherals.</li>
                     <li>Excellent benefits for you and your family.</li>
                     <li>Unlimited paid vacation. Because we're all grownups here.</li>
                     <li>Flexible work hours, and work from home 2 days a week. (Seriously, half our code gets written after midnight.)</li>
                     <li>Free coffee, snacks, and beer. And we get the <a href="http://www.larrysbeans.com/">good stuff</a>.</li>
                     <li>And that's just a few!</li>
              </ul>
       </div>
       </aside>

<?php get_footer(); ?>
