(function($) {
    "use strict";


    var blog = {};
    mkd.modules.blog = blog;

    blog.mkdInitAudioPlayer = mkdInitAudioPlayer;
    blog.mkdInitBlogMasonry = mkdInitBlogMasonry;
    blog.mkdInitBlogLoadMore = mkdInitBlogLoadMore;
    blog.mkdInitFadeInLayouts = mkdInitFadeInLayouts;

    blog.mkdOnDocumentReady = mkdOnDocumentReady;
    blog.mkdOnWindowLoad = mkdOnWindowLoad;
    blog.mkdOnWindowResize = mkdOnWindowResize;
    blog.mkdOnWindowScroll = mkdOnWindowScroll;

    $(document).ready(mkdOnDocumentReady);
    $(window).load(mkdOnWindowLoad);
    $(window).resize(mkdOnWindowResize);
    $(window).scroll(mkdOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdOnDocumentReady() {
        mkdInitAudioPlayer();
        mkdInitBlogLoadMore();
        mkdPostRatings().init();
        mkdInitFadeInLayouts();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdOnWindowLoad() {
        mkdInitBlogMasonry();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdOnWindowResize() {

    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdOnWindowScroll() {

    }



    function mkdInitAudioPlayer() {

        var players = $('audio.mkd-blog-audio');

        players.mediaelementplayer({
            audioWidth: '100%'
        });
    }


    function mkdInitBlogMasonry() {

        if($('.mkd-blog-holder.mkd-blog-type-masonry').length) {

            var container = $('.mkd-blog-holder.mkd-blog-type-masonry');

            container.waitForImages(function() {
                container.isotope({
                    layoutMode: 'packery',
                    itemSelector: 'article',
                    resizable: false,
                    packery: {
                        columnWidth: '.mkd-blog-masonry-grid-sizer',
                        gutter: '.mkd-blog-masonry-grid-gutter'
                    }
                });
                container.addClass('mkd-appeared');
            });

            var filters = $('.mkd-filter-blog-holder');
            $('.mkd-filter').click(function() {
                var filter = $(this);
                var selector = filter.attr('data-filter');
                filters.find('.mkd-active').removeClass('mkd-active');
                filter.addClass('mkd-active');
                container.isotope({filter: selector});
                return false;
            });
        }
    }

    function mkdInitBlogLoadMore(){
        var blogHolder = $('.mkd-blog-holder.mkd-blog-load-more');

        if(blogHolder.length){
            blogHolder.each(function(){
                var thisBlogHolder = $(this);
                var nextPage;
                var maxNumPages;

                var loadMoreButton = thisBlogHolder.find('.mkd-load-more-ajax-pagination .mkd-btn');
                if(blogHolder.hasClass('mkd-blog-type-masonry') || blogHolder.hasClass('mkd-blog-type-masonry-gallery') ){
                    loadMoreButton = blogHolder.next().find('.mkd-btn');
                }
                maxNumPages =  thisBlogHolder.data('max-pages');

                loadMoreButton.on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    var loadMoreDatta = getBlogLoadMoreData(thisBlogHolder);
                    nextPage = loadMoreDatta.nextPage;

                    if(nextPage <= maxNumPages){
                        var ajaxData = setBlogLoadMoreAjaxData(loadMoreDatta);
                        $.ajax({
                            type: 'POST',
                            data: ajaxData,
                            url: MikadoAjaxUrl,
                            success: function (data) {
                                nextPage++;
                                thisBlogHolder.data('next-page', nextPage);
                                var response = $.parseJSON(data);
                                var responseHtml =  response.html;
                                thisBlogHolder.waitForImages(function(){

                                    if(thisBlogHolder.hasClass('mkd-blog-type-masonry')){

                                        thisBlogHolder.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                                        mkdInitBlogMasonry();

                                    }
                                    else if(thisBlogHolder.hasClass('mkd-blog-type-masonry-gallery')){

                                        thisBlogHolder.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});

                                        mkdInitBlogMasonryGallery();
                                        mkdInitBlogMasonryGalleryContentPosition();

                                    }
                                    else{
                                        thisBlogHolder.find('article:last').after(responseHtml); // Append the new content
                                    }

                                    setTimeout(function() {
                                        mkd.modules.blog.mkdInitAudioPlayer();
                                        mkd.modules.common.mkdOwlSlider();
                                        mkd.modules.common.mkdFluidVideo();
                                        mkdInitFadeInLayouts();
                                    },400);


                                });
                            }
                        });
                    }

                    if(nextPage === maxNumPages){
                        loadMoreButton.hide();
                    }

                });
            });
        }
    }
    function getBlogLoadMoreData(container){

        var returnValue = {};

        returnValue.nextPage = '';
        returnValue.number = '';
        returnValue.category = '';
        returnValue.blogType = '';
        returnValue.archiveCategory = '';
        returnValue.archiveAuthor = '';
        returnValue.archiveTag = '';
        returnValue.archiveDay = '';
        returnValue.archiveMonth = '';
        returnValue.archiveYear = '';

        if (typeof container.data('next-page') !== 'undefined' && container.data('next-page') !== false) {
            returnValue.nextPage = container.data('next-page');
        }
        if (typeof container.data('post-number') !== 'undefined' && container.data('post-number') !== false) {
            returnValue.number = container.data('post-number');
        }
        if (typeof container.data('category') !== 'undefined' && container.data('category') !== false) {
            returnValue.category = container.data('category');
        }
        if (typeof container.data('blog-type') !== 'undefined' && container.data('blog-type') !== false) {
            returnValue.blogType = container.data('blog-type');
        }
        if (typeof container.data('archive-category') !== 'undefined' && container.data('archive-category') !== false) {
            returnValue.archiveCategory = container.data('archive-category');
        }
        if (typeof container.data('archive-author') !== 'undefined' && container.data('archive-author') !== false) {
            returnValue.archiveAuthor = container.data('archive-author');
        }
        if (typeof container.data('archive-tag') !== 'undefined' && container.data('archive-tag') !== false) {
            returnValue.archiveTag = container.data('archive-tag');
        }
        if (typeof container.data('archive-day') !== 'undefined' && container.data('archive-day') !== false) {
            returnValue.archiveDay = container.data('archive-day');
        }
        if (typeof container.data('archive-month') !== 'undefined' && container.data('archive-month') !== false) {
            returnValue.archiveMonth = container.data('archive-month');
        }
        if (typeof container.data('archive-year') !== 'undefined' && container.data('archive-year') !== false) {
            returnValue.archiveYear = container.data('archive-year');
        }

        return returnValue;

    }

    function setBlogLoadMoreAjaxData(container){

        var returnValue = {
            action: 'newshub_mikado_blog_load_more',
            nextPage: container.nextPage,
            number: container.number,
            category: container.category,
            blogType: container.blogType,
            archiveCategory: container.archiveCategory,
            archiveAuthor: container.archiveAuthor,
            archiveTag: container.archiveTag,
            archiveDay: container.archiveDay,
            archiveMonth: container.archiveMonth,
            archiveYear: container.archiveYear
        };

        return returnValue;
    }

    /**
     * Object that sets ratings for blog single
     * @returns {{init: Function}} function that initializes blog single ratings functionality
     */
    var mkdPostRatings = mkd.modules.blog.mkdPostRatings = function(){

        // get all stars for rating
        var ratings = $('.mkd-ratings-stars-inner'),
            messageHolder = $('.mkd-ratings-message-holder'),
            ratingsMessage = messageHolder.children('.mkd-rating-message'),
            ratingsValue = messageHolder.children('.mkd-rating-value'),
            thisPost = $('.single-post article'),
            ratingId,
            thisPostId,
            postData;

        thisPostId = (thisPost.length)? thisPost.attr('id').match(/\d+/)[0] : '';

        /**
         * Function that triggers set ratings functionality
         */
        var mkdPostRatingsEvent = function () {
            ratings.children().hover(
                function () {
                    if(!ratings.hasClass('mkd-ratings-rated')) {
                        ratingId = ($(this).attr('id').match(/\d+/)[0]);
                        ratings.children().each(function () {
                            if ($(this).attr('id').match(/\d+/)[0] <= ratingId) {
                                $(this).addClass('mkd-hover-rating-star');
                            } else {
                                $(this).removeClass('mkd-hover-rating-star');
                            }
                        });
                    }
                },
                function () {
                    if(!ratings.hasClass('mkd-ratings-rated')) {
                        ratings.children().each(function () {
                            $(this).removeClass('mkd-hover-rating-star');
                        });
                    }
                });

            ratings.children().click(function(){
                if(!ratings.hasClass('mkd-ratings-rated')) {

                    ratingId = ($(this).attr('id').match(/\d+/)[0]);

                    ratings.children().each(function () {
                        if ($(this).attr('id').match(/\d+/)[0] <= ratingId) {
                            $(this).addClass('mkd-active-rating-star');
                        } else {
                            $(this).removeClass('mkd-active-rating-star');
                        }
                    });
                    ratings.addClass('mkd-ratings-rated');

                    postData = {
                        action: 'newshub_mikado_post_rating_ajax_function',
                        postID: thisPostId,
                        value: ratingId
                    };

                    $.ajax({
                        type: 'POST',
                        data: postData,
                        url: mkdGlobalVars.vars.mkdAjaxUrl,
                        success: function (data) {
                            var response = $.parseJSON(data);
                            ratingsMessage.html(response.rateAnswer);
                            ratingsMessage.fadeIn();
                            ratingsValue.html("Current rate is: " + (0.05 * response.newCount));
                            ratingsValue.fadeIn();
                        }
                    });
                }
            });
        };

        return {
            init : function() {
                if (ratings.length) {
                    ratings.each(function () {
                        mkdPostRatingsEvent();
                    });
                }
            }
        };
    };


    /*
    * Fade In effect for articles and post layout elements
    */
    function mkdInitFadeInLayouts() {
        if (!$('html').hasClass('touch')) {
            var featuredImgs = $('.mkd-post-item:not(.slick-slide) .mkd-pt-image-holder, .mkd-post-item:not(.slick-slide) .mkd-vertical-shader, .mkd-post-image');

            if(featuredImgs.length) {
                featuredImgs.appear(function(){
                    var featuredImg = $(this);

                    setTimeout(function(){
                        featuredImg.addClass('mkd-appeared');
                    },100);
                }, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            }
        }
    }

})(jQuery);