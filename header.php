<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?php if (is_home()) {
          bloginfo('name');
          echo " - ";
          bloginfo('description');
        } elseif (is_category()) {
          single_cat_title();
          echo " - ";
          bloginfo('name').'';
        } elseif (is_single() || is_page()) {
          single_post_title();
          echo " - ";
          bloginfo('name');
        } elseif (is_404()) {
          echo '页面未找到!';
          echo " - ";
          bloginfo('name');
        } else {
          wp_title('', true);
          echo " - ";
          bloginfo('name');
        }?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri() ); ?>/static/images/favicon.ico" type="image/png" />
  
    <meta name="description" content="<?php echo stayma('stayma_info_description');?>">
  
    <meta name="keywords" content="<?php echo stayma('stayma_info_keywords');?>">
    <?php wp_head(); ?>
</head>

<body class="home-template">

<div id="ajax-content">

    <div class="site-wrapper">


        <header class="site-header outer " style="background-image: url(<?php echo stayma('stayma_index_img');?>)">
            <div class="inner">


              <?php if(is_category()): ?>
                <nav class="site-nav">
                    <div class="site-nav-left">
                        <!-- 主导航菜单 -->
                        <ul class="nav" role="menu">
                          <a href="<?php bloginfo('url') ?>" class="site-nav-logo"><?php bloginfo('name') ?></a>
                            <?php
                            if ( has_nav_menu( 'top' ) ) :
                                wp_nav_menu( array(
                                'theme_location' => 'top',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                    'walker' => new description_walker(),
                                    'depth' => 0, ) );
                            endif;?>
                        </ul>

                    </div>
                    
                    <!-- 社交导航菜单 -->
                    <div class="site-nav-right">
                        <div class="social-links">
                        <a class="social-link social-link-fb" href="<?php if(is_home()||is_category()):?>https://www.facebook.com/sharer/sharer.php?u=<?php bloginfo('url')?> <?php else:?>https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();endif; ?>" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                            <path d="M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z" /></svg>
                        </a>

                            <a class="social-link social-link-tw" href="<?php if(is_home()||is_category()):?>https://twitter.com/share?text=<?php bloginfo('name')?>&url=<?php bloginfo('url')?> <?php else:?>https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink();endif; ?>" target="_blank" rel="noopener">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <path d="M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z" /></svg>
                            </a>
                        </div>
                        <a class="subscribe-button" href="#subscribe">Search</a>
                    </div>
                </nav>
              <?php endif; ?>


                <?php if( !is_single() && !is_page() ):?>
                <div class="site-header-content">
                    <h1 class="site-title">
                      <?php if(!is_category()): ?>
                        <?php echo stayma('stayma_info_title');?>
                      <?php else:?>
                        <?php single_cat_title(); ?>
                      <?php endif; ?>
                    </h1>
                    <h2 class="site-description">
                      <?php if(!is_category()): ?>
                        <?php echo stayma('stayma_info_text');?>
                      <?php else:?>
                        <?php echo category_description(); ?>
                      <?php endif; ?>
                        
                      </h2>
                </div>
                <?php endif;?>

                <?php if(!is_category()): ?>
                <nav class="site-nav">
                    <div class="site-nav-left">
                        <!-- 主导航菜单 -->
                        <ul class="nav" role="menu">
                            <?php
                            if ( has_nav_menu( 'top' ) ) :
                                wp_nav_menu( array(
                                'theme_location' => 'top',
                                    'container' => false,
                                    'items_wrap' => '%3$s',
                                    'walker' => new description_walker(),
                                    'depth' => 0, ) );
                            endif;?>
                        </ul>

                    </div>
                    
                    <!-- 社交导航菜单 -->
                    <div class="site-nav-right">
                        <div class="social-links">
                        <a class="social-link social-link-fb" href="<?php if(is_home()):?>https://www.facebook.com/sharer/sharer.php?u=<?php bloginfo('url')?> <?php else:?>https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();endif; ?>" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                            <path d="M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z" /></svg>
                        </a>

                            <a class="social-link social-link-tw" href="<?php if(is_home()):?>https://twitter.com/share?text=<?php bloginfo('name')?>&url=<?php bloginfo('url')?> <?php else:?>https://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink();endif; ?>" target="_blank" rel="noopener">
                              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32">
                                    <path d="M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z" /></svg>
                            </a>
                        </div>
                        <a class="subscribe-button" href="#subscribe">Search</a>
                    </div>
                </nav>
                <?php endif; ?>



            </div>
        </header>