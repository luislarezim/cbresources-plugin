<?php
get_header();


?>
<style>
a.blogitem {
  display: block;
  margin-bottom: 20px;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  text-decoration: none;
}

.blogitem-imgwrap {
  overflow: hidden;
  border-radius: 5px 5px 0 0;
  height: 160px;
}

.blogitem-img {
  position: relative;
   height: 100%; 
  width: auto;
  left: 50%;
  transform: translateX(-50%);
  transition: all 0.25s linear;
}

a.blogitem:hover .blogitem-img {
  transform: translateX(-50%) scale(1.25);
}

img.cbcard-arrow {
  position: absolute;
  right: 0;
  top: 1px;
  width: 12px;
}

.blogitem-body {
  padding: 24px;
}

.blogitem-meta {
  line-height: 1;
  font-size: 1.2rem;
  letter-spacing: 0.1em;
  font-weight: 700;
  margin-bottom: 8px;
  color: #BEBEBE;
  text-transform: uppercase;
}

.blogitem-title {
  color: #000;
  min-height: 110px;
}

.blog-pagination {
  padding-top: 24px;
  font-size: 0;
  text-align: center;
}

.blog-pagination a,
.blog-pagination span {
  display: inline-block;
  vertical-align: top;
  width: 22px;
  line-height: 20px;
  color: #0723EA;
  text-align: center;
  font-weight: 700;
  font-size: 1.1rem;
  border: 1px solid #0723EA;
  border-radius: 50%;
  margin: 0 4px 8px;
}

.blog-pagination a.olderposts {
  margin-right: 0;
}

.blog-pagination a.pagearrow,
.blog-pagination a.next {
  /* border: 0;
  border-radius: 0;
  background: url(img/pagearrow.png) no-repeat center center;
  background-size: 18px; */
  height: 34px!important;
}

.blog-pagination a.pagearrow.newerposts,
.blog-pagination a.prev {
  /* border: 0;
  border-radius: 0;
  background: url(img/pagearrow-prev.png) no-repeat center center;
  background-size: 18px;
  margin-left: 0; */
  height: 34px!important;
} 

.blog-pagination span.current {
  color: #fff;
  background: #0723EA;
}

.cat-heading {
  font-size: 2.8rem;
  margin: 0 0 30px;
  line-height: 1.2;
}

.blog-toprow {
  margin-bottom: 30px;
}

.cfw-inner {
  width: 80%;
  max-width: 420px;
}

.catfilter-wrap p {
  font-size: 1.2rem;
  line-height: 1;
  letter-spacing: 0.2rem;
  margin-bottom: 20px;
}

select {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  font-family: pragmatica, sans-serif;
  font-size: 1.6rem;
  font-weight: 300;
  line-height: 48px;
  height: 50px;
  padding: 0 12px;
  border: 1px solid #BCBEC0;
  border-radius: 5px;
  width: 100%;
  /* background: #fff url(img/dropdown-arrow.png) no-repeat 95% center; */
  background-size: 12px;
}
@media only screen and (min-width: 768px) {

  .basic-blog {
    padding-top: 72px;
    padding-bottom: 72px;
  }

  #ajax-results-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }

  a.blogitem {
    margin-bottom: 40px;
    width: 49%;
  }

  .blogitem-imgwrap {
    height: 200px;
  }

  /* .blogitem-img {
    height: 200px;
  } */

  .blog-pagination {
    padding-top: 40px;
  }

  .blog-pagination a,
  .blog-pagination span {
    width: 34px;
    line-height: 32px;
    font-size: 1.2rem;
    margin: 0 10px 12px;
    text-decoration: none;
  }

 .blog-pagination a.pagearrow,
  .blog-pagination a.next {
   /*  background: url(img/pagearrow.png) no-repeat center center;
    background-size: 26px; */
    height: 34px;
  }

  .blog-pagination a.pagearrow.newerposts,
  .blog-pagination a.prev {
    /* background: url(img/pagearrow-prev.png) no-repeat center center;
    background-size: 26px; */
    height: 34px;
  } 

}

@media only screen and (min-width: 1024px) {

  .basic-blog {
    padding-top: 96px;
    padding-bottom: 96px;
  }

  .blogitem-body {
    padding: 30px 40px 48px;
  }

  .blogitem-meta {
    margin-bottom: 16px;
  }

  .blogitem-title {
    min-height: 148px;
    font-size: 1.8rem;
    line-height: 1.33333;
  }

  .cat-heading {
    font-size: 4rem;
    margin: 0 0 48px;
  }

}

@media only screen and (min-width: 1025px) {

  a.blogitem {
    width: 32%;
  }

  img.cbcard-arrow {
    transform: translateX(-24px);
    opacity: 0;
    transition: all 0.25s linear;
  }

  a.blogitem:hover img.cbcard-arrow,
  a.fpost:hover img.cbcard-arrow {
    transform: translateX(0);
    opacity: 1;
  }

}

@media only screen and (min-width: 1280px) {

  .basic-blog {
    padding-top: 20px;
    padding-bottom: 120px;
  }

  a.blogitem {
    width: 24%;
  }

  .blog-toprow {
    display: flex;
    margin-bottom: 40px;
  }

  .featuredpost-wrap {
    display: block;
    width: 49.35%;
  }

  .catfilter-wrap {
    width: 50.65%;
    margin-top: 0;
  }

  .featuredpost-wrap .bmp-info p {
    margin-bottom: 12px;
  }

  .featuredpost-wrap .bmp-preview {
    margin-bottom: 20px;
  }

  .featuredpost-wrap .bmp-info {
    width: 64%;
    padding: 24px 30px;
  }

  .featuredpost-wrap .bmp-imgwrap {
    width: 36%;
  }

  .cfw-inner {
    max-width: 460px;
  }

}

#ajax-results-container div.blog-pagination{
  width: 100%!important;
}

#primary > div.blog-pagination {
  display:none!important;
}


</style>
<section id="blogbanner">
    <div class="banner-content">
        <div class="bc-inner">
            <h1 class="bc-heading" style="margin:0;">
                Resources
            </h1>
            <p>
            Journey into multi-tier marketplaces, subscription & billing management, and cloud expansion with CloudBlue's ebooks, white papers, infographics, podcasts, and more.</p>
        </div>
    </div>
    <img src="/wp-content/uploads/2023/04/cloudblue-resources.jpg" alt="Cloudblue Resources" />
</section>
<section>
    <?php echo do_shortcode('[cb-resources]'); ?>
</section>



<?php get_footer(); ?>