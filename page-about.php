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
                <figure class="post-full-image" style="background-image: url(https://images.unsplash.com/photo-1537861290372-4ba9b55bd782?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=1080&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjExNzczfQ&amp;s=d1b434404d13d045f300821857478eaf)">
                </figure>
				
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
                top: -70px;
            }
        }
    </style>

<?php get_footer();?>