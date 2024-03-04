<?php get_header(); ?>
<style>

.blogitem-category {
    font-size: 20px;
}

div.article-date a {
  color: #0723EA!important;
}

</style>


<?php if (have_posts()): while (have_posts()) : the_post(); ?>


<?php
	$authors = '';
	$authorImage = ['url' => ''];
	$multipleAuthors = false;

	while( have_rows('authors') ) {
		the_row();
		$authors .= get_sub_field('a-name');
		$authors .= ', ';
		$authorImage = $multipleAuthors ? $authorImage : get_sub_field('a-image');
		$multipleAuthors = true;
	}

	$authors = trim($authors, ', ');
?>

<section id="blogbanner">
  <img src="<?php the_field('bannerLg'); ?>" alt="<?php the_field('bannerAlt'); ?>" />
</section>
<div class="hero-bottom-line"></div>
<div class="basic">
  <div class="article-top">
    <div class="article-date">
      <a href="/resources/">RESOURCES</a> | <?php the_time('M j, Y'); ?>
    </div>
    <h1><?php the_title();?></h1>
    <div class="article-metarow">
      <div class="article-meta am-author">
        <div class="meta-label">AUTHOR<?= is_array(get_field('authors')) && count(get_field('authors')) > 1 ? "S" : ""?></div>
        <div class="meta-pic">
          <?php if(!empty($authorImage['url'])): ?>
          <img src="<?= $authorImage['url'] ?>" alt="<?= $authorImage['alt'] ?>">
          <?php else: ?>
          <?= get_avatar( get_the_author_meta( 'ID' )); ?>
          <?php endif; ?>
        </div>
        <div class="meta-name">
          <?php if($authors !== ''): ?>
          <?= $authors ?>
          <?php else: ?>
          <?= get_the_author_meta( 'display_name' ); ?>
          <?php endif; ?>
        </div>
      </div>
      <div class="article-meta am-cat">
        <div class="meta-label">CATEGORY</div>
        <?php
            $terms = get_the_terms(get_the_ID(), 'resources');
if ($terms && !is_wp_error($terms)) {
    $term_links = array();
    foreach ($terms as $term) {
        if (isset($custom_links[$term->slug])) {
            $term_url = $custom_links[$term->slug];
        } else {
            $term_url = '/resources/#resource_type=' . $term->slug;
        }
        $term_links[] = '<a href="' . esc_url($term_url) . '">' . esc_html($term->name) . '</a>';
    }
    $term_list = join(', ', $term_links);
    echo '<div class="meta-name pb-2">' . $term_list . '</div>';
}
					?>

      </div>
         </div>
  </div>
  <section id="article-main">
    <div class="article">
      <div class="article-sm">
        <div class="asm-content">
          <div class="asm-title">SHARE</div>
          <ul class="asm-list">
            <li>
              <a class="share" data-network="linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title();?>&source=CloudBlue">
                <img src="<?php echo get_template_directory_uri(); ?>/img/share-linkedin.png" alt="LinkedIn" />
              </a>
            </li>
            <li>
              <a class="share" data-network="twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink();?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/share-twitter.png" alt="Twitter" />
              </a>
            </li>
            <li>
              <a target="_blank" href="mailto:?subject=CloudBlue: <?php the_title();?>&body=<?php the_permalink();?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/share-email.png" alt="Email" />
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="article-copy">
        <?php the_content();?>
        <div class="article-msm">
          <div class="asm-title">SHARE</div>
          <ul class="asm-list">
            <li>
              <a class="share" data-network="linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title();?>&source=CloudBlue">
                <img src="<?php echo get_template_directory_uri(); ?>/img/share-linkedin.png" alt="LinkedIn" />
              </a>
            </li>
            <li>
              <a class="share" data-network="twitter" target="_blank" href="https://twitter.com/home?status=<?php the_permalink();?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/share-twitter.png" alt="Twitter" />
              </a>
            </li>
            <li>
              <a target="_blank" href="mailto:?subject=CloudBlue: <?php the_title();?>&body=<?php the_permalink();?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/share-email.png" alt="Email" />
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="article-sidebar">
      <div class="as-inner">
      <?= get_field("html-raw") ?>
        <?php
    $terms = get_the_terms(get_the_ID(), 'resources');
    if ($terms && !is_wp_error($terms)) {
        $term_ids = array();
        foreach ($terms as $term) {
            $term_ids[] = $term->term_id;
        }
        $args = array(
            'post_type' => 'resources-docs',
            'tax_query' => array(
                array(
                    'taxonomy' => 'resources',
                    'field' => 'term_id',
                    'terms' => $term_ids
                )
            ),
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 3
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
?>
            <div class="related-posts pt-5">
                <h3 class="related-title">Related Resources</h3>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <a class="fpost" href="<?php the_permalink(); ?>">
                        <div class="fpost-img">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </div>
                        <div class="fpost-title"><?php the_title(); ?></div>
                        <div class="cbcard-more">
            READ MORE
            <img class="cbcard-arrow" src="/assets/images/arrowthick-blue.png" alt /></div>
                      </a>
                <?php endwhile; ?>
            </div>
<?php
        else:
?>
            <p>No related resources found.</p>
<?php
        endif;
        wp_reset_postdata();
    }
?>



      </div>
    </div>

    <!-- nuevo -->
    


  </section>

</div>

<?php endwhile; endif; ?>
<!-- <div class="default-bottom-line"></div> -->
<?php get_footer();  ?>
