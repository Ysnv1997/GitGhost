<?php get_header();?>

        <main id="site-main" class="site-main outer">
            <?php if( have_posts() ){ the_post();?> 
            <div class="inner">
                <article class="post-full post tag-getting-started ">
                    <header class="post-full-header">
                        <section class="post-full-meta">
                            <time class="post-full-meta-date" datetime="<?php the_time('Y-n-j') ?>"><?php the_time('Y-n-j') ?></time>
                            <span class="date-divider">/</span> <?php the_category(',') ?>
                        </section>
                        <h1 class="post-full-title"><?php the_title(); ?></h1>
                    </header>

                    <figure class="post-full-image" style="background-image: url(<?php post_thumbnail_src(); ?>)">
                    </figure>

                    <section class="post-full-content">
                        <div class="post-content">
                            <?php the_content(); ?>
                            <strong style="margin-top:30px;">--EOF--</strong>
                        </div>
                    </section>


                    <footer class="post-full-footer">

                        <section class="author-card">
                            <?php echo get_avatar( get_the_author_email(), '60' );?>
                            <section class="author-card-content">
                                <h4 class="author-card-name"><a href="https://github.com/ysnv1997/"><?php the_author(); ?></a></h4>
                                <p><?php echo stayma('stayma_info_text');?></p>
                            </section>
                        </section>
                        <div class="post-full-footer-right">
                            <a class="author-card-button" href="<?php bloginfo('url') ?>">Read More</a>
                        </div>

                    </footer>

                    <section class="subscribe-form">
                        <?php comments_template(); ?>
                    </section>

                </article>
            <?php } ?>
            </div>
        </main>

        <aside class="read-next outer">
            <div class="inner">
                <div class="read-next-feed">
                    <article class="read-next-card" style="background-image: url(<?php echo esc_url( get_template_directory_uri() ); ?>/static/images/blog-cover.jpg)">
                        <header class="read-next-card-header">
                            <small class="read-next-card-header-sitetitle"><?php the_author(); ?></small>
                            <h3 class="read-next-card-header-title"><?php the_category(',') ?></h3>
                        </header>
                        <div class="read-next-divider"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 14.5s2 3 5 3 5.5-2.463 5.5-5.5S21 6.5 18 6.5c-5 0-7 11-12 11C2.962 17.5.5 15.037.5 12S3 6.5 6 6.5s4.5 3.5 4.5 3.5"/></svg>
                        </div>
                        <div class="read-next-card-content">
                            <ul>
                                <?php
                                    $category = get_the_category();
                                    $cat_ID = get_cat_ID($category[0]->cat_name);
                                    $args=array(
                                        'cat' => $cat_ID,   // 分类ID
                                        'posts_per_page' => 4, // 显示篇数
                                    );
                                    query_posts($args);
                                    if(have_posts()) : while (have_posts()) : the_post();
                                ?>
                                <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                                <?php  endwhile; endif; wp_reset_query(); ?>
                            </ul>
                        </div>
                        <footer class="read-next-card-footer">
                            <a href="<?php echo get_category_link($cat_ID); ?>">See all <?php echo get_category($cat_ID)->count;?> posts →</a>
                        </footer>
                    </article>


                <?php 
                    $args=array(
                        'orderby' => 'rand',   // 分类ID
                        'posts_per_page' => 2, // 显示篇数
                    );
                    query_posts($args);
                    if(have_posts()) : while (have_posts()) : the_post();
                ?>
                    <article class="post-card post tag-getting-started">
                        <a class="post-card-image-link" href="<?php the_permalink(); ?>">
                            <div class="post-card-image" style="background-image: url(<?php post_thumbnail_src(); ?>)"></div>
                        </a>
                        <div class="post-card-content">
                            <a class="post-card-content-link" href="<?php the_permalink(); ?>">
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
                                    <p><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 190,"..."); ?></p>
                                </section>
                            </a>
                            <footer class="post-card-meta">

                                <ul class="author-list">
                                    <li class="author-list-item">

                                        <div class="author-name-tooltip">
                                            <?php the_author(); ?>
                                        </div>

                                        <a href="https://github.com/ysnv1997/" class="static-avatar"><?php echo get_avatar( get_the_author_email(), '30' );?></a>
                                    </li>
                                </ul>

                                <span class="reading-time"><?php post_views(); ?> min read</span>

                            </footer>
                        </div>
                    </article>

                <?php  endwhile; endif; wp_reset_query(); ?>


                </div>
            </div>
        </aside>

        <div class="floating-header">
            <div class="floating-header-logo">
                <a href="<?php bloginfo('url'); ?>">
                    <span><?php bloginfo('name'); ?></span>
                </a>
            </div>
            <span class="floating-header-divider">&mdash;</span>
            <div class="floating-header-title"><?php the_title(); ?></div>
            <div class="floating-header-share">
                <div class="floating-header-share-label">Share this <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M7.5 15.5V4a1.5 1.5 0 1 1 3 0v4.5h2a1 1 0 0 1 1 1h2a1 1 0 0 1 1 1H18a1.5 1.5 0 0 1 1.5 1.5v3.099c0 .929-.13 1.854-.385 2.748L17.5 23.5h-9c-1.5-2-5.417-8.673-5.417-8.673a1.2 1.2 0 0 1 1.76-1.605L7.5 15.5zm6-6v2m-3-3.5v3.5m6-1v2"/>
                </svg>
                </div>
                <a class="floating-header-share-tw" href="https://twitter.com/share?text=Writing%20posts%20with%20Ghost%20%E2%9C%8D%EF%B8%8F&amp;url=https://demo.ghost.io/the-editor/" onclick="window.open(this.href, 'share-twitter', 'width=550,height=235');return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z"/></svg>
                </a>
                <a class="floating-header-share-fb" href="https://www.facebook.com/sharer/sharer.php?u=https://demo.ghost.io/the-editor/" onclick="window.open(this.href, 'share-facebook','width=580,height=296');return false;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z"/></svg>
                </a>
            </div>
            <progress id="reading-progress" class="progress" value="0">
        <div class="progress-container">
            <span class="progress-bar"></span>
        </div>
    </progress>
        </div>
    <style>
        @media (min-width:900px) {
            .home-template .site-nav {
                position: relative;
                top: 0;
            }
        }
    </style>
<?php get_footer();?>