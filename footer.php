<footer class="site-footer outer">
    <div class="site-footer-content inner">
        <section class="copyright">Theme <a href="http://www.stayma.cn/">GitGhost</a> &copy; 2018 <a href=""><?php echo stayma('stayma_index_icp')?></a> 本站建立于:<?php echo stayma('stayma_info_time');?></section>
        <nav class="site-footer-nav">
            <a href="https://cn.wordpress.org/">WordPress</a>
        <?php if(stayma('social_weibo')):?>
            <a href="<?php echo stayma('social_weibo')?>" target="_blank" rel="noopener">WeiBo</a>
        <?php endif;?>
        <?php if(stayma('social_github')):?>
            <a href="<?php echo stayma('social_github')?>" target="_blank" rel="noopener">GitHub</a>
        <?php endif;?>
        <?php if(stayma('social_twitter')):?>
            <a href="<?php echo stayma('social_twitter')?>" target="_blank" rel="noopener">Twitter</a>
        <?php endif;?>
            <a href="https://www.stayma.cn/sitemap_baidu.xml" target="_blank" rel="noopener">Xml</a>
        </nav>
    </div>
    <!-- <div class="site-footer-content-two inner">
        <p></p>
    </div> -->
</footer>
</div>

<div class="back-to-top">
    <i class="iconfont icon-arrowup"></i>
    <span id="scroll-percent">0%</span>
</div>
<div id="subscribe" class="subscribe-overlay">
    <a class="subscribe-overlay-close" href="#"></a>
    <div class="subscribe-overlay-content">
        <span class="subscribe-overlay-logo"><?php echo stayma('stayma_info_title');?></span>
        <h1 class="subscribe-overlay-title">静下心来，寻找何物？</h1>
        <p class="subscribe-overlay-description">When you are lost, you should calm down and search for the deepest answer.</p>
        <form method="post" action="<?php echo home_url( '/' ); ?>" id="" class="searchform">
            <input class="confirm" type="hidden" name="confirm" /><input class="location" type="hidden" name="location" /><input class="referrer" type="hidden" name="referrer" />
            <div class="form-group">
                <input class="subscribe-email" type="search" name="s" placeholder="寻找内心深处的答案" />
            </div>
            <button id="" class="" type="submit"><span>Search</span></button>
        </form>
    </div>
</div>
<div class="blog-description flex">
    <font style="vertical-align: inherit;">
        <font style="vertical-align: inherit;">
            <?php echo stayma('stayma_left_text');?>
        </font>
    </font>
</div>
<div style="display:none;">
    <?php echo stayma('footer_diy');?>
</div>
</div>
<?php wp_footer();?>
</body>

</html>