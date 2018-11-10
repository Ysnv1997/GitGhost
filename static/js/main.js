$(window).ready(function(){
var ajaxhome = document.domain;
var ajaxcontent = 'ajax-content';
var ajaxsearch_class = 'searchform';
var ajaxignore_string = new String('#, /wp-, .pdf, .zip, .rar, /goto');
var ajaxignore = ajaxignore_string.split(', ');
var ajaxloading_code = '<div id="default-loading" class="all-aboard"></div>';
var ajaxloading_error_code = 'error';
var ajaxreloadDocumentReady = false;
var ajaxtrack_analytics = false;
var ajaxscroll_top = true;
var ajaxisLoad = false;
var ajaxstarted = false;
var ajaxsearchPath = null;
var ajaxua = jQuery.browser;
jQuery(document).ready(function() {
    ajaxloadPageInit("");
});
window.onpopstate = function(event) {
    if (ajaxstarted === true && ajaxcheck_ignore(document.location.toString()) == true) {
        ajaxloadPage(document.location.toString(), 1);
    }
};

function ajaxloadPageInit(scope) {
    jQuery(scope + "a").click(function(event) {
        if (this.href.indexOf(ajaxhome) >= 0 && ajaxcheck_ignore(this.href) == true) {
            event.preventDefault();
            this.blur();
            var caption = this.title || this.name || "";
            var group = this.rel || false;
            try {
                ajaxclick_code(this);
            } catch (err) {
                console.log(err)
            }
            ajaxloadPage(this.href);
        }
    });
    jQuery('.' + ajaxsearch_class).each(function(index) {
        if (jQuery(this).attr("action")) {
            ajaxsearchPath = jQuery(this).attr("action");;
            jQuery(this).submit(function() {
                submitSearch(jQuery(this).serialize());
                return false;
            });
        }
    });
    if (jQuery('.' + ajaxsearch_class).attr("action")) {} else {}
}

function ajaxloadPage(url, push, getData) {
    if (!ajaxisLoad) {
        if (ajaxscroll_top == true) {
            jQuery('html,body').animate({ scrollTop: 0 }, 500);
        }
        ajaxisLoad = true;
        ajaxstarted = true;
        nohttp = url.replace("http://", "").replace("https://", "");
        firstsla = nohttp.indexOf("/");
        pathpos = url.indexOf(nohttp);
        path = url.substring(pathpos + firstsla);
        if (push != 1) {
            if (typeof window.history.pushState == "function") {
                var stateObj = { foo: 1000 + Math.random() * 1001 };
                history.pushState(stateObj, "ajax page loaded...", path);
            } else {}
        }
        if (!jQuery('#' + ajaxcontent)) {}
        jQuery('#' + ajaxcontent).append(ajaxloading_code);
        jQuery('#' + ajaxcontent).fadeTo("slow", 0.4, function() {
            jQuery('#' + ajaxcontent).fadeIn("slow", function() {
                jQuery.ajax({
                    type: "GET",
                    url: url,
                    data: getData,
                    cache: false,
                    dataType: "html",
                    success: function(data) {
                        ajaxisLoad = false;
                        datax = data.split('<title>');
                        titlesx = data.split('</title>');
                        if (datax.length == 2 || titlesx.length == 2) {
                            data = data.split('<title>')[1];
                            titles = data.split('</title>')[0];
                            jQuery(document).attr('title', (jQuery("<div/>").html(titles).text()));
                        } else {}
                        if (ajaxtrack_analytics == true) {
                            if (typeof _gaq != "undefined") {
                                if (typeof getData == "undefined") {
                                    getData = "";
                                } else {
                                    getData = "?" + getData;
                                }
                                _gaq.push(['_trackPageview', path + getData]);
                            }
                        }
                        data = data.split('id="' + ajaxcontent + '"')[1];
                        data = data.substring(data.indexOf('>') + 1);
                        var depth = 1;
                        var output = '';
                        while (depth > 0) {
                            temp = data.split('</div>')[0];
                            i = 0;
                            pos = temp.indexOf("<div");
                            while (pos != -1) {
                                i++;
                                pos = temp.indexOf("<div", pos + 1);
                            }
                            depth = depth + i - 1;
                            output = output + data.split('</div>')[0] + '</div>';
                            data = data.substring(data.indexOf('</div>') + 6);
                        }
                        document.getElementById(ajaxcontent).innerHTML = output;
                        jQuery('#' + ajaxcontent).css("position", "absolute");
                        jQuery('#' + ajaxcontent).css("left", "20000px");
                        jQuery('#' + ajaxcontent).show();
                        ajaxloadPageInit("#" + ajaxcontent + " ");
                        if (ajaxreloadDocumentReady == true) {
                            jQuery(document).trigger("ready");
                        }
                        try {
                            ajaxreload_code();
                        } catch (err) {}
                        jQuery('#' + ajaxcontent).hide();
                        jQuery('#' + ajaxcontent).css("position", "");
                        jQuery('#' + ajaxcontent).css("left", "");
                        jQuery('#' + ajaxcontent).fadeTo("slow", 1, function() {});
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        ajaxisLoad = false;
                        document.title = "Error loading requested page!";
                        document.getElementById(ajaxcontent).innerHTML = ajaxloading_error_code;
                    }
                });
            });
        });
    }
}

function submitSearch(param) {
    if (!ajaxisLoad) {
        ajaxloadPage(ajaxsearchPath, 0, param);
    }
}

function ajaxcheck_ignore(url) {
    for (var i in ajaxignore) {
        if (url.indexOf(ajaxignore[i]) >= 0) {
            return false;
        }
    }
    return true;
}

function ajaxreload_code() {
    lody()
}

function ajaxclick_code(thiss) {
    jQuery('ul.nav li').each(function() {
        jQuery(this).removeClass('current-menu-item');
    });
    jQuery(thiss).parents('li').addClass('current-menu-item');
}


function lody() {

    // FancyBox
    $(document).ready(function() {
        $(".fancybox").fancybox();
        POWERMODE.colorful = true; // make power mode colorful
        POWERMODE.shake = false; // turn off shake
        document.body.addEventListener('input', POWERMODE);
        $('pre code').each(function(i, block) {
            hljs.highlightBlock(block);
        });
        $(window).scroll(function() {
            var height = $(window).height();
            var scrollTop = $(window).scrollTop();
            var scrollPercent = Math.round((scrollTop) / ($(document).height() - height) * 100);
            $("#scroll-percent").text(scrollPercent + "%");
            if (scrollTop > height) {
                $(".back-to-top").addClass("back-to-top-on");
            } else {
                $(".back-to-top").removeClass("back-to-top-on");
            }

        });


        $('.back-to-top').click(function() {
            $('body,html').animate({
                scrollTop: '0px'
            }, 1000);
        });

    });

    $(function() {
        // // ajax翻页
        // $('.section-load-more > a').on('click', function() {
        //     let this_url = this.href
        //     $.ajax({
        //         type: "GET",
        //         url: this_url,
        //         dataType: "html",
        //         success: function(response) {
        //             let new_post = $(response).find('.post-card'),
        //                 new_next_url = $(response).find('.section-load-more > a').attr('href');
        //             $('.post-feed').append(new_post.fadeIn(3000));
        //             if (new_next_url != undefined) {
        //                 $('.section-load-more > a').attr('href', new_next_url);
        //             } else {
        //                 $('.section-load-more > a').hide();
        //             }
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     });
        //     return false
        // })


        // 评论框收缩
        if ($('#toggle-comment-author-info').length) {
            $('#comment-author-info').hide();
        }
        $('#toggle-comment-author-info').on('click', function() {
            var changeMsg = "<i>[ 资料修改 ]</i>";
            var closeMsg = "<i>[ 收起来 ]</i>";
            $('#comment-author-info').slideToggle('slow', function() {
                if ($('#comment-author-info').css('display') == 'none') {
                    $('#toggle-comment-author-info').html(changeMsg);
                } else {
                    $('#toggle-comment-author-info').html(closeMsg);
                }
            });
            return false
        })

        // Enter 监听
        $(document).keypress(function(e) {
            if (e.ctrlKey && e.which == 13 || e.which == 10) {
                $("#submit").click();
                document.body.focus();
            } else if (e.shiftKey && e.which == 13 || e.which == 10) {
                $("#submit").click();
            }
        })
        // ajax评论分页
        comAjax()

        function comAjax() {
            var com_nav = $('#comments-navi'),
                com_nav_but = $('#comments-navi > a'),
                com_list = $('.commentlist'),
                loading = $('#loading-comments');
            com_nav_but.on('click', function() {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'GET',
                    dataType: 'html',
                    beforeSend: function() {
                        loading.show();
                        com_list.fadeOut(300);
                        com_nav.remove();
                    },
                    success: function(data) {
                        loading.hide();
                        var new_list = $(data).find('.commentlist'),
                            new_nav = $(data).find('#comments-navi');
                        loading.after(new_list.fadeIn(300));
                        new_list.after(new_nav.fadeIn(300));
                        comAjax();
                        $(document).scrollTop($('.comment-box').offset().top)
                    }
                })

                return false;
            })
        }
    })



    // ajax评论

    var $commentform = jQuery('#commentform'),
        $comments = jQuery('#comments-title'),
        $cancel = jQuery('#cancel-comment-reply-link'),
        cancel_text = "取消回复";
    jQuery('#comment').after('<div id="comment_message" style="display:none;"></div>');
    jQuery('#commentform').on("submit", function(e) {
        jQuery('#comment_message').slideDown().html("<p>评论提交中....</p>");
        jQuery('#submit').addClass("disabled").val("发表评论").attr("disabled", "disabled");
        jQuery.ajax({
            url: stayma_url.url_ajax,
            data: jQuery(this).serialize() + "&action=ajax_comment",
            type: jQuery(this).attr('method'),
            error: function(request) {
                jQuery('#comment_message').addClass('comt-error').html(request.responseText);
                setTimeout("jQuery('#submit').removeClass('disabled').val('发表评论').attr('disabled',false)", 2000);
                setTimeout("jQuery('#comment_message').slideUp()", 2000);
                setTimeout("jQuery('#comment_message').removeClass('comt-error')", 3000);
            },
            success: function(data) {
                jQuery('textarea').each(function() {
                    this.value = ''
                });
                var t = addComment,
                    cancel = t.I('cancel-comment-reply-link'),
                    temp = t.I('wp-temp-form-div'),
                    respond = t.I(t.respondId),
                    post = t.I('comment_post_ID').value,
                    parent = t.I('comment_parent').value;
                if (parent != '0') {
                    jQuery('#respond').before('<ul class="children">' + data + '</ul>');
                } else if (jQuery('.commentlist').length != '0') {
                    jQuery('.commentlist').append(data);
                    //jQuery('#respond').before('<ol class="commentlist">' + data + '</ol>');//comment-list is your comments wrapper,check your container ul or ol
                } else {
                    jQuery('.commentlist').append(data); // your comments wrapper
                }

                jQuery('#comment_message').html("<p>评论提交成功</p>");
                setTimeout("jQuery('#submit').removeClass('disabled').val('发表评论').attr('disabled',false)", 2000);
                setTimeout("jQuery('#comment_message').slideUp()", 2000);
                cancel.style.display = 'none';
                cancel.onclick = null;
                t.I('comment_parent').value = '0';
                if (temp && respond) {
                    temp.parentNode.insertBefore(respond, temp);
                    temp.parentNode.removeChild(temp)
                }
            }
        });
        return false;
    });
    addComment = {
        moveForm: function(commId, parentId, respondId) {
            var t = this,
                div,
                comm = t.I(commId),
                respond = t.I(respondId),
                cancel = t.I('cancel-comment-reply-link'),
                parent = t.I('comment_parent'),
                post = t.I('comment_post_ID');
            $cancel.text(cancel_text);
            t.respondId = respondId;
            if (!t.I('wp-temp-form-div')) {
                div = document.createElement('div');
                div.id = 'wp-temp-form-div';
                div.style.display = 'none';
                respond.parentNode.insertBefore(div, respond)
            }!comm ? (temp = t.I('wp-temp-form-div'), t.I('comment_parent').value = '0', temp.parentNode.insertBefore(respond, temp), temp.parentNode.removeChild(temp)) : comm.parentNode.insertBefore(respond, comm.nextSibling);
            jQuery("body").animate({
                    scrollTop: jQuery('#respond').offset().top - 180
                },
                400);
            parent.value = parentId;
            cancel.style.display = '';
            cancel.onclick = function() {
                var t = addComment,
                    temp = t.I('wp-temp-form-div'),
                    respond = t.I(t.respondId);
                t.I('comment_parent').value = '0';
                if (temp && respond) {
                    temp.parentNode.insertBefore(respond, temp);
                    temp.parentNode.removeChild(temp);
                }
                this.style.display = 'none';
                this.onclick = null;
                return false;
            };
            try {
                t.I('comment').focus();
            } catch (e) {}
            return false;
        },
        I: function(e) {
            return document.getElementById(e);
        }
    };

    if ($('.post-full-title').length != 0) {
        // Start fitVids
        var $postContent = $(".post-full-content");
        $postContent.fitVids();
        // End fitVids

        var progressBar = document.querySelector('#reading-progress');
        var header = document.querySelector('.floating-header');
        var title = document.querySelector('.post-full-title');

        var lastScrollY = window.scrollY;
        var lastWindowHeight = window.innerHeight;
        var lastDocumentHeight = $(document).height();
        var ticking = false;

        function onScroll() {
            lastScrollY = window.scrollY;
            requestTick();
        }

        function onResize() {
            lastWindowHeight = window.innerHeight;
            lastDocumentHeight = $(document).height();
            requestTick();
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(update);
            }
            ticking = true;
        }

        function update() {
            var trigger = title.getBoundingClientRect().top + window.scrollY;
            var triggerOffset = title.offsetHeight + 35;
            var progressMax = lastDocumentHeight - lastWindowHeight;

            // show/hide floating header
            if (lastScrollY >= trigger + triggerOffset) {
                header.classList.add('floating-active');
            } else {
                header.classList.remove('floating-active');
            }

            progressBar.setAttribute('max', progressMax);
            progressBar.setAttribute('value', lastScrollY);

            ticking = false;
        }

        window.addEventListener('scroll', onScroll, {
            passive: true
        });
        window.addEventListener('resize', onResize, false);

        update();

    }

}

lody();
console.log("%c 本主题来源于: %c stayma.cn %c STAYMA 博客", "color:red","","color:orange;font-weight:bold")


})