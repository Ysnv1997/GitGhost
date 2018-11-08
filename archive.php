<?php get_header();?>


        <main id="site-main" class="site-main outer">
            <div class="inner">

                <div class="post-feed">



                <?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
                    <article class="post-card post tag-getting-started" id="post-id-<?php the_ID(); ?>">
                        <a class="post-card-image-link" href="<?php the_permalink(); ?>">
                            <div class="post-card-image" style="background-image: url(<?php post_thumbnail_src(); ?>)"></div>
                        </a>
                        <div class="post-card-content">
                            <a class="post-card-content-link" href="<?php the_permalink() ?>">
                                <header class="post-card-header">
                                <span class="post-card-tags">
                                    <?php
                                        $category = get_the_category();
                                        echo $category[0]->cat_name;
                                    ?>        
                                </span>
                                    <h2 class="post-card-title"><?php the_title(); ?></h2>
                                </header>
                                <section class="post-card-excerpt">
                                    <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 120,"..."); ?></p>
                                </section>
                            </a>
                            <footer class="post-card-meta">

                                <ul class="author-list">
                                    <li class="author-list-item">

                                        <div class="author-name-tooltip">
                                           <?php the_author(); ?>
                                        </div>

                                        <a href="<?php the_permalink() ?>" class="static-avatar">
                                            <?php echo get_avatar( get_the_author_email(), '30' );?>
                                        </a>
                                    </li>
                                </ul>

                                <span class="reading-time"><?php post_views(); ?> min read</span>

                            </footer>
                        </div>
                    </article>
                    <?php endwhile; ?>   
                    <?php else : ?>   
                        <p class="single_post_list">暂无内容，请阅读其他版块</p>  
                    <?php endif; ?>

                </div>
                <div class="section-load-more">
                <?php next_posts_link(__('<div class="load-more" style="display: inline-block;"> </div>')) ?>
                    </div>
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
    <?php get_footer();?>