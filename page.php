<?php 
    /*
    Template Name: about  
    */ 
    get_header();
?>
    <main id="site-main" class="site-main outer">
        <div class="inner">
			<?php if( have_posts() ){ the_post();?>
            <article class="post-full post page no-image">

                <header class="post-full-header">
                    <h1 class="post-full-title"><?php the_title(); ?></h1>
                </header>
                <section class="post-full-content">
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </section>
              <section class="subscribe-form">
                        <?php comments_template(); ?>
                    </section>
            </article>
			<?php };?>
        </div>
    </main>
    <style>
        @media (min-width: 900px){
            .home-template .site-nav {
                position: relative;
                top: 0px;
            }
        }
    </style>
<?php get_footer();
?>