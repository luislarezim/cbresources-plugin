<!-- <?php  get_header();  ?> -->

<div class="main" role="main">
  <?php /* require_once(dirname(__FILE__).'/components/Navbar/index.php');*/?>
  <?php require_once(dirname(__FILE__).'/components/Header/index.php'); headerRender(); ?>
  <div class="main-content">

    <?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <?php the_content(); ?>

    <?php
			if(trim($_SERVER['REQUEST_URI'], '/') === 'partnerships') {
				require_once(dirname(__FILE__).'/components/BecomePartnerForm.php');
			}
		?>

    <?php endwhile; ?>

    <?php else: ?>

    <!-- article -->
    <article>

      <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

    </article>
    <!-- /article -->

    <?php endif; ?>


  </div>

  <!-- <div class="default-bottom-line"></div> -->

  <?php /* include_once(dirname(__FILE__)."/components/Footer.php"); */?>
</div>
<?php /* get_footer();  */?>
