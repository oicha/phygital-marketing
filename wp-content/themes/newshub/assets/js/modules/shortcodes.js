(function ($) {
    'use strict';

    var shortcodes = {};

    mkd.modules.shortcodes = shortcodes;

    shortcodes.mkdSliderEasing = 'cubic-bezier(0.25, 0.1, 0.11, .99)';

    shortcodes.mkdInitTabs = mkdInitTabs;
    shortcodes.mkdCustomFontResize = mkdCustomFontResize;
    shortcodes.mkdBlockReveal = mkdBlockReveal;
    shortcodes.mkdBreakingNews = mkdBreakingNews;
    shortcodes.mkdInitStickyWidget = mkdInitStickyWidget;
    shortcodes.mkdShowGoogleMap = mkdShowGoogleMap;
    shortcodes.mkdInitSliderPostOne = mkdInitSliderPostOne;
    shortcodes.mkdInitSliderPostTwo = mkdInitSliderPostTwo;
    shortcodes.mkdInitSliderPostThree = mkdInitSliderPostThree;
    shortcodes.mkdInitPostLayoutWidget = mkdInitPostLayoutWidget;

    $(document).ready(function () {
        mkdIcon().init();
        mkdInitTabs();
        mkdButton().init();
        mkdCustomFontResize();
        mkdBlockReveal();
        mkdBreakingNews();
        mkdSocialIconWidget().init();
        mkdPostPagination().init();
        mkdRecentCommentsHover();
        mkdShowGoogleMap();
        mkdInitSliderPostOne();
        mkdInitSliderPostTwo();
        mkdInitSliderPostThree();
        mkdInitShowcaseSlider();
    });

    $(window).resize(function () {
        mkdCustomFontResize();
        mkdInitStickyWidget();
        mkdInitSliderPostOne('reinit');
        mkdInitSliderPostTwo('reinit');
    });

    $(window).load(function () {
        mkdPostLayoutTabWidget().init();
        mkdInitStickyWidget();
        mkd.modules.common.mkdInitParallax();
        mkdInitPostLayoutWidget();
    });

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdIcon = mkd.modules.shortcodes.mkdIcon = function () {
        //get all icons on page
        var icons = $('.mkd-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function (icon) {
            if (icon.hasClass('mkd-icon-animation')) {
                icon.appear(function () {
                    icon.parent('.mkd-icon-animation-holder').addClass('mkd-icon-animation-show');
                }, {accX: 0, accY: mkdGlobalVars.vars.mkdElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkd-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function (icon) {
            if (typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function (event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if (hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function (icon) {
            if (typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function (event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if (hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdSocialIconWidget = mkd.modules.shortcodes.mkdSocialIconWidget = function () {
        //get all social icons on page
        var icons = $('.mkd-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function (icon) {
            if (typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function (event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if (hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function () {
                if (icons.length) {
                    icons.each(function () {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /*
     * init showcase slider
     */
    function mkdInitShowcaseSlider() {
        var showcaseSlider = $('.mkd-showcase-slider');

        if (showcaseSlider.length) {
            showcaseSlider.each(function () {

                var currentSlider = $(this),
                    autoplaySpeed = 2500,
                    slideTransition = 800;

                currentSlider.on('init', function () {

                    // change default opacity on init
                    currentSlider.css({'opacity': '1'});

                    //blink fix
                    var slide = currentSlider.find('.mkd-showcase-slide'),
                        navBtn = currentSlider.find('button'),
                        slideTransitionInterval = slideTransition,
                        toggleTimeout,
                        buttonTriggered = false,
                        cycle = slide.not('.slick-cloned').length,
                        delay = 0;

                    var toggleActive = function () {
                        slide.each(function () {
                            var currentSlide = $(this),
                                currentSlideOffsetLeft = currentSlide.offset().left,
                                currentSlideWidth = currentSlide.outerWidth();

                            if (currentSlideOffsetLeft < 0 || currentSlideOffsetLeft + currentSlideWidth > mkd.windowWidth) {
                                currentSlide.addClass('mkd-darken');
                            }
                        });
                    }

                    toggleActive();

                    navBtn.on('click', function () {
                        buttonTriggered = true;
                        slide.removeClass('mkd-darken');
                        clearTimeout(toggleTimeout);
                        toggleTimeout = setTimeout(function () {
                            toggleActive();
                            buttonTriggered = false;
                        }, slideTransitionInterval);
                    });

                    currentSlider.on('beforeChange', function (e, slick, currentSlide) {
                        setTimeout(function () {
                            if (!buttonTriggered) {
                                if (currentSlide == cycle - 1) {
                                    delay = 400;
                                } else {
                                    delay = 0;
                                }

                                slide.removeClass('mkd-darken');
                                setTimeout(function () {
                                    toggleActive();
                                }, slideTransitionInterval + delay);
                            }
                        }, 100); //check for buttonTriggered flag
                    });

                }).slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplaySpeed: autoplaySpeed,
                    speed: slideTransition,
                    autoplay: true,
                    pauseOnHover: true,
                    arrows: false,
                    dots: true,
                    centerMode: true,
                    centerPadding: '150px',
                    responsive: [
                        {
                            breakpoint: 1025,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 1,
                                autoplay: true,
                                pauseOnHover: true,
                                arrows: false,
                                dots: true,
                                centerMode: true,
                                centerPadding: '50px',
                            }
                        },
                        {
                            breakpoint: 769,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                autoplay: true,
                                pauseOnHover: true,
                                arrows: false,
                                dots: true,
                                centerMode: true,
                                centerPadding: '0',
                            }
                        },
                    ]
                })
                ;
            });
        }
    };

    /*
     **	Init tabs shortcode
     */
    function mkdInitTabs() {

        var tabs = $('.mkd-tabs');
        if (tabs.length) {
            tabs.each(function () {
                var thisTabs = $(this);

                if (!thisTabs.hasClass('mkd-ptw-holder')) {
                    thisTabs.children('.mkd-tab-container').each(function (index) {
                        index = index + 1;

                        var that = $(this),
                            link = that.attr('id');

                        var navItem = -1;
                        if (that.parent().find('.mkd-tabs-nav li').hasClass('mkd-tabs-title-holder')) {
                            index = index + 1;

                            if (that.parent().find('.mkd-tabs-nav li.mkd-tabs-title-holder .mkd-tabs-title-image').length) {
                                that.parent().find('.mkd-tabs-nav li.mkd-tabs-title-holder').children('.mkd-tabs-title-image:first-child').addClass('mkd-active-tab-image');
                            }
                        }
                        navItem = that.parent().find('.mkd-tabs-nav li:nth-child(' + index + ') a');

                        var navLink = navItem.attr('href');

                        link = '#' + link;

                        if (link.indexOf(navLink) > -1) {
                            navItem.attr('href', link);
                        }
                    });
                }

                thisTabs.tabs({
                    activate: function () {
                        thisTabs.find('.mkd-tabs-nav li').each(function () {
                            var thisTab = $(this);

                            if (thisTab.hasClass('ui-tabs-active')) {
                                var activeTab = thisTab.index();

                                if (thisTab.parent().find('.mkd-tabs-title-image').length) {
                                    thisTab.parent().find('.mkd-tabs-title-image').removeClass('mkd-active-tab-image');
                                    thisTab.parent().find('.mkd-tabs-title-image:nth-child(' + activeTab + ')').addClass('mkd-active-tab-image');
                                }
                            }
                        });
                    }
                });
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdButton = mkd.modules.shortcodes.mkdButton = function () {
        //all buttons on the page
        var buttons = $('.mkd-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function (button) {
            if (typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function (event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
                button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
            }
        };


        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function (button) {
            if (typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function (event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
                button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
            }
        };

        /**
         * Initializes button icon hover background color
         * @param button current button
         */
        var buttonIconHoverBgColor = function (button) {
            if (!button.hasClass('mkd-btn-outline') && (typeof button.data('icon-hover-bg-color') !== 'undefined' || typeof button.data('icon-hover-bg-color') !== 'undefined')) {
                if (typeof button.data('icon-bg-color') !== 'undefined') {
                    button.children('.mkd-btn-icon-element').css('background-color', button.data('icon-bg-color'));
                }

                var changeButtonIconBg = function (event) {
                    event.data.button.children('.mkd-btn-icon-element').css('background-color', event.data.color);
                };

                var originalIconBgColor = (typeof button.data('icon-bg-color') !== 'undefined') ? button.data('icon-bg-color') : 'transparent';
                var hoverIconBgColor = (typeof button.data('icon-hover-bg-color') !== 'undefined') ? button.data('icon-hover-bg-color') : 'transparent';

                button.on('mouseenter', {button: button, color: hoverIconBgColor}, changeButtonIconBg);
                button.on('mouseleave', {button: button, color: originalIconBgColor}, changeButtonIconBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function (button) {
            if (typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function (event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('border-color');
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
                button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
            }
        };

        return {
            init: function () {
                if (buttons.length) {
                    buttons.each(function () {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                        buttonIconHoverBgColor($(this));
                    });
                }
            }
        };
    };

    /*
     **	Custom Font resizing
     */
    function mkdCustomFontResize() {
        var customFont = $('.mkd-custom-font-holder');
        if (customFont.length) {
            customFont.each(function () {
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if (mkd.windowWidth < 1200) {
                    coef1 = 0.8;
                }

                if (mkd.windowWidth < 1024) {
                    coef1 = 0.7;
                }

                if (mkd.windowWidth < 768) {
                    coef1 = 0.6;
                    coef2 = 0.7;
                }

                if (mkd.windowWidth < 600) {
                    coef1 = 0.5;
                    coef2 = 0.6;
                }

                if (mkd.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                if (typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                    fontSize = parseInt(thisCustomFont.data('font-size'));

                    if (fontSize > 70) {
                        fontSize = Math.round(fontSize * coef1);
                    }
                    else if (fontSize > 35) {
                        fontSize = Math.round(fontSize * coef2);
                    }

                    thisCustomFont.css('font-size', fontSize + 'px');
                }

                if (typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
                    lineHeight = parseInt(thisCustomFont.data('line-height'));

                    if (lineHeight > 70 && mkd.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    }
                    else if (lineHeight > 35 && mkd.windowWidth < 768) {
                        lineHeight = '1.2em';
                    }
                    else {
                        lineHeight += 'px';
                    }

                    thisCustomFont.css('line-height', lineHeight);
                }
            });
        }
    }

    /*
     **  Init block revealing
     */
    function mkdBlockReveal() {

        var blockHolder = $('.mkd-block-revealing .mkd-bnl-inner');

        if (blockHolder.length) {
            blockHolder.each(function () {
                var thisBlockHolder = $(this);
                var thisBlockNonFeaturedHolder = thisBlockHolder.find('.mkd-pbr-non-featured');
                var thisBlockFeaturedHolder = thisBlockHolder.find('.mkd-pbr-featured');
                var currentItemPosition = 1;
                var activeItemClass = 'mkd-block-reveal-active-item';

                var thisFeaturedBlocks = thisBlockFeaturedHolder.find('.mkd-post-block-part-inner');

                thisFeaturedBlocks.each(function (e) {
                    var thisFeatured = $(this);

                    if (thisFeatured.hasClass('mkd-block-reveal-active-item')) {
                        currentItemPosition = e + 1;
                    }
                });

                thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
                thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child(' + currentItemPosition + ')').fadeIn(150);

                thisBlockNonFeaturedHolder.find('a').click(function (e) {
                    e.preventDefault();

                    currentItemPosition = $(this).parents('.mkd-pbr-non-featured > .mkd-pbr-non-featured-inner > .mkd-post-item-outer > .mkd-post-item').index() + 1; // +1 is because index start from 0 and list from 1

                    thisBlockFeaturedHolder.children('.mkd-post-block-part-inner').fadeOut(150);
                    thisBlockFeaturedHolder.children('.mkd-post-block-part-inner').removeClass(activeItemClass);


                    thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);

                    setTimeout(function () {
                        thisBlockFeaturedHolder.children('.mkd-post-block-part-inner:nth-child(' + currentItemPosition + ')').fadeIn(150);
                    }, 160);
                });

                mkd.modules.common.mkdInitParallax();
            });
        }
    }


    /*
     **  Init breaking news
     */
    function mkdBreakingNews() {

        var bnHolder = $('.mkd-bn-holder');

        if (bnHolder.length) {
            bnHolder.each(function () {
                var thisBnHolder = $(this);

                thisBnHolder.css('display', 'inline-block');

                var slideshowSpeed = (thisBnHolder.data('slideshowSpeed') !== '' && thisBnHolder.data('slideshowSpeed') !== undefined) ? thisBnHolder.data('slideshowSpeed') : 3000;
                var animationSpeed = (thisBnHolder.data('animationSpeed') !== '' && thisBnHolder.data('animationSpeed') !== undefined) ? thisBnHolder.data('animationSpeed') : 400;

                thisBnHolder.flexslider({
                    selector: ".mkd-bn-text",
                    animation: "fade",
                    controlNav: false,
                    directionNav: false,
                    maxItems: 1,
                    allowOneSlide: true,
                    slideshowSpeed: slideshowSpeed,
                    animationSpeed: animationSpeed
                });
            });
        }
    }


    /*
     **  Init sticky sidebar widget
     */
    function mkdInitStickyWidget() {

        var stickyHeader = $('.mkd-sticky-header'),
            mobileHeader = $('.mkd-mobile-header'),
            stickyWidgets = $('.mkd-widget-sticky-sidebar');
        if (stickyWidgets.length && mkd.windowWidth > 1024) {

            stickyWidgets.each(function () {
                var widget = $(this),
                    parent = '.mkd-full-section-inner, .mkd-section-inner, .mkd-two-columns-75-25, .mkd-two-columns-25-75, .mkd-two-columns-66-33, .mkd-two-columns-33-66',
                    stickyHeight = 0,
                    widgetOffset = widget.offset().top,
                    sidebar;


                if (widget.parent('.mkd-sidebar').length) {
                    sidebar = widget.parents('.mkd-sidebar');
                } else if (widget.parents('.wpb_widgetised_column').length) {
                    sidebar = widget.parents('.wpb_widgetised_column');
                    widget.closest('.wpb_column').css('position', 'static');
                }

                var sidebarOffset = sidebar.offset().top;
                if (mkd.body.hasClass('mkd-sticky-header-on-scroll-down-up')) {
                    stickyHeight = mkdGlobalVars.vars.mkdStickyHeaderHeight;
                } else {
                    stickyHeight = 0;
                }
                var offset = -(widgetOffset - sidebarOffset - stickyHeight - 10); //10 is to push down from browser top edge


                sidebar.stick_in_parent({
                    parent: parent,
                    sticky_class: 'mkd-sticky-sidebar',
                    inner_scrolling: false,
                    offset_top: offset,
                }).on("sticky_kit:bottom", function () { //check if sticky sidebar have hit the bottom and use that class for pull it down when sticky header appears
                    sidebar.addClass('mkd-sticky-sidebar-on-bottom');
                }).on("sticky_kit:unbottom", function () {
                    sidebar.removeClass('mkd-sticky-sidebar-on-bottom');
                });

                $(window).scroll(function () {
                    if (mkd.windowWidth >= 1024) {
                        if (stickyHeader.hasClass('header-appear') && mkd.body.hasClass('mkd-sticky-header-on-scroll-up') && sidebar.hasClass('mkd-sticky-sidebar') && !sidebar.hasClass('mkd-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY(' + mkdGlobalVars.vars.mkdStickyHeaderHeight + 'px)');
                            sidebar.css('transform', 'translateY(' + mkdGlobalVars.vars.mkdStickyHeaderHeight + 'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    } else {
                        if (mobileHeader.hasClass('mobile-header-appear') && sidebar.hasClass('mkd-sticky-sidebar') && !sidebar.hasClass('mkd-sticky-sidebar-on-bottom')) {
                            sidebar.css('-webkit-transform', 'translateY(' + mkdGlobalVars.vars.mkdMobileHeaderHeight + 'px)');
                            sidebar.css('transform', 'translateY(' + mkdGlobalVars.vars.mkdMobileHeaderHeight + 'px)');
                        } else {
                            sidebar.css('-webkit-transform', 'translateY(0px)');
                            sidebar.css('transform', 'translateY(0px)');
                        }
                    }
                });

            });
        }
    }


    /*
     * Init slider post one
     */
    function mkdInitSliderPostOne(reinit) {
        var sliderOneHolder = $('.mkd-sp-one-holder');

        if (sliderOneHolder.length) {

            sliderOneHolder.each(function () {

                var sliderOneData = mkdPostData($(this));
                var sliderOnePrimary = $(this).find('.mkd-post-slider-primary');
                var sliderOneSecondary = $(this).find('.mkd-post-slider-secondary');

                // kill secondary slider on windows resize event
                if (reinit == 'reinit') {
                    sliderOneSecondary.slick('unslick');
                }

                var autoplaySpeed = 2500;
                var slideTransition = 800;


                // initialise primary slider
                if (reinit != 'reinit') {
                    sliderOnePrimary.on('init', function () {

                        // change default opacity on init
                        sliderOneHolder.css({'opacity': '1'});

                    }).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: sliderOneData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: true,
                        arrows: false,
                        dots: false,
                        speed: slideTransition,
                        asNavFor: sliderOneSecondary,
                        cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                        fade: true,
                        responsive: [
                            {
                                breakpoint: 769,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    autoplay: sliderOneData.slider_autoplay,
                                    autoplaySpeed: autoplaySpeed,
                                    pauseOnHover: true,
                                    arrows: false,
                                    dots: true,
                                    cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                                    speed: slideTransition,
                                    fade: true,
                                }
                            }
                        ]
                    });
                }

                // initialize secondary slider - thumbnail navigation
                if (mkd.windowWidth >= 768) {
                    sliderOneSecondary.slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: sliderOneData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: true,
                        arrows: false,
                        dots: false,
                        speed: slideTransition,
                        asNavFor: sliderOnePrimary,
                        fade: false,
                        focusOnSelect: true,
                        responsive: [
                            {
                                breakpoint: 769,
                                settings: 'unslick',
                            }
                        ]
                    });
                }

                // custom play/pause on hovering parent container
                if (mkd.windowWidth >= 1024) {
                    if (sliderOneData.slider_autoplay_pause === true) {
                        sliderOneHolder.hover(
                            function () {
                                sliderOnePrimary.slick('slickPause');
                                sliderOneSecondary.slick('slickPause');
                            },
                            function () {
                                sliderOnePrimary.slick('slickPlay');
                                sliderOneSecondary.slick('slickPlay');
                            }
                        );
                    }
                }

                // set height of sliders according to value from shortcode
                sliderOnePrimary.find('.mkd-post-item-inner').innerHeight(sliderOneData.slider_height);
                if (mkd.windowWidth >= 768) {
                    sliderOneSecondary.innerHeight(sliderOneData.slider_height);
                }
            });
        }
    }


    /*

     * Init slider post two
     */
    function mkdInitSliderPostTwo(reinit) {
        var sliderTwoHolder = $('.mkd-sp-two-holder');
        var grid = sliderTwoHolder.find('.mkd-grid').width();
        var sliderTwoPadding = (mkd.windowWidth - grid) / 2 + 'px';
        var autoplaySpeed = 2500;
        var slideTransition = 800;

        if (sliderTwoHolder.length) {

            sliderTwoHolder.each(function () {

                var sliderTwoData = mkdPostData($(this));
                var sliderTwo = $(this).find('.mkd-post-slider');


                // kill slider on windows resize event
                if (reinit == 'reinit') {
                    sliderTwo.slick('unslick');
                }

                // initialise slider above 1024
                if (mkd.windowWidth > 1024) {
                    sliderTwo.on('init', function () {

                        // change default opacity on init
                        sliderTwoHolder.css({'opacity': '1'});

                        //blink fix
                        if (sliderTwoData.slider_center_mode) {
                            var slide = sliderTwo.find('.mkd-post-item'),
                                navBtn = sliderTwo.find('button'),
                                slideTransitionInterval = slideTransition,
                                toggleTimeout,
                                buttonTriggered = false,
                                cycle = slide.not('.slick-cloned').length,
                                delay = 0;

                            var toggleActive = function () {
                                slide.each(function () {
                                    var currentSlide = $(this),
                                        currentSlideOffsetLeft = currentSlide.offset().left,
                                        currentSlideWidth = currentSlide.outerWidth();

                                    if (currentSlideOffsetLeft > 0 && currentSlideOffsetLeft + currentSlideWidth < mkd.windowWidth) {
                                        currentSlide.addClass('mkd-active');
                                    }
                                });
                            }

                            toggleActive();

                            navBtn.on('click', function () {
                                buttonTriggered = true;
                                slide.removeClass('mkd-active');
                                clearTimeout(toggleTimeout);
                                toggleTimeout = setTimeout(function () {
                                    toggleActive();
                                    buttonTriggered = false;
                                }, slideTransitionInterval);
                            });

                            sliderTwo.on('beforeChange', function (e, slick, currentSlide) {
                                setTimeout(function () {
                                    if (!buttonTriggered) {
                                        if (currentSlide == cycle - 1) {
                                            delay = 400;
                                        } else {
                                            delay = 0;
                                        }

                                        slide.removeClass('mkd-active');
                                        setTimeout(function () {
                                            toggleActive();
                                        }, slideTransitionInterval + delay);
                                    }
                                }, 100); //check for buttonTriggered flag
                            });
                        }

                    }).slick({
                        slidesToShow: sliderTwoData.slider_slides_to_show,
                        slidesToScroll: sliderTwoData.slider_slides_to_scroll,
                        autoplay: sliderTwoData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: true,
                        arrows: sliderTwoData.slider_arrows,
                        speed: slideTransition,
                        centerMode: sliderTwoData.slider_center_mode,
                        centerPadding: sliderTwoPadding,
                        dots: sliderTwoData.slider_dots,
                        cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                    });
                }

                // initialise slider between 768 and 1024
                if ((mkd.windowWidth > 768) && (mkd.windowWidth <= 1024)) {
                    sliderTwo.on('init', function () {

                        // change default opacity on init
                        sliderTwoHolder.css({'opacity': '1'});

                    }).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: sliderTwoData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: false,
                        arrows: false,
                        speed: slideTransition,
                        centerMode: sliderTwoData.slider_center_mode,
                        centerPadding: sliderTwoPadding,
                        dots: sliderTwoData.slider_dots,
                        cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                    });
                }

                // initialise slider below 768
                if (mkd.windowWidth <= 768) {
                    sliderTwo.on('init', function () {

                        // change default opacity on init
                        sliderTwoHolder.css({'opacity': '1'});

                    }).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: sliderTwoData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: false,
                        arrows: false,
                        speed: slideTransition,
                        centerMode: sliderTwoData.slider_center_mode,
                        centerPadding: sliderTwoPadding,
                        dots: sliderTwoData.slider_dots,
                        cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                    });
                }

                // set bottom padding for slider holder if dots are being used in slider
                if (sliderTwoData.slider_dots === true) {
                    sliderTwoHolder.css({'padding-bottom': '52px'});
                }
            });
        }
    }


    /*
     * Init slider post three
     */
    function mkdInitSliderPostThree() {
        var sliderThreeHolder = $('.mkd-sp-three-holder');

        if (sliderThreeHolder.length) {

            sliderThreeHolder.each(function () {

                var sliderThreeData = mkdPostData($(this));
                var sliderThree = $(this).find('.mkd-post-slider');
                var sliderThreeItem = $(this).find('section');
                var autoplaySpeed = 2500;
                var slideTransition = 800;

                // initialise slider
                if (mkd.windowWidth > 768) {
                    sliderThree.on('init', function () {
                        // set item height
                        sliderThreeItem.innerHeight(sliderThreeData.slider_height);

                        // initialize parallax
                        if (sliderThreeData.slider_parallax === true && !$('html').hasClass('touch')) {
                            var mkdParallaxEffect = function () {
                                var translateFactor = 0.2,
                                    yPosition = sliderThree.offset().top;

                                var mkdTransform = function () {
                                    if (mkd.scroll >= yPosition - mkd.windowHeight && mkd.scroll < yPosition + mkd.windowHeight) {
                                        var translate = -(yPosition - mkd.scroll) * translateFactor;
                                        translate = Math.floor(translate);

                                        sliderThree.find('.mkd-pt-nine-bgrnd').css({'transform': 'translate3d(0,' + translate + 'px,0)'});
                                    }
                                }

                                mkdTransform();

                                $(window).scroll(function () {
                                    requestAnimationFrame(mkdTransform);
                                });
                            }

                            mkdParallaxEffect();
                        }

                        // change default opacity on init
                        sliderThreeHolder.css({'opacity': '1'});
                    }).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        fade: true,
                        autoplay: sliderThreeData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: true,
                        arrows: sliderThreeData.slider_arrows,
                        speed: slideTransition,
                        dots: sliderThreeData.slider_dots,
                        cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                    });
                }

                // initialise slider below 768
                if (mkd.windowWidth <= 768) {
                    sliderThree.on('init', function () {
                        // set item height
                        sliderThreeItem.innerHeight(sliderThreeData.slider_height);

                        // change default opacity on init
                        sliderThreeHolder.css({'opacity': '1'});
                    }).slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        fade: true,
                        autoplay: sliderThreeData.slider_autoplay,
                        autoplaySpeed: autoplaySpeed,
                        pauseOnHover: false,
                        arrows: false,
                        speed: slideTransition,
                        dots: sliderThreeData.slider_dots,
                        cssEase: mkd.modules.shortcodes.mkdSliderEasing,
                    });
                }

            });
        }
    }


    /**
     * Object that represents post pagination
     * @returns {{init: Function}} function that initializes post pagination functionality
     */
    var mkdPostPagination = mkd.modules.shortcodes.mkdPostPagination = function () {

        // get all post with load more
        var blogBlockWithPaginationLoadMore = $('.mkd-post-pag-load-more');
        var blogBlockWithPaginationPrevNext = $('.mkd-post-pag-np-horizontal');
        var blogBlockWithPaginationInfinitive = $('.mkd-post-pag-infinite');

        $('.mkd-post-item').addClass('mkd-active-post-page');

        /**
         * Function that triggers load more functionality
         */
        var mkdPostLoadMoreEvent = function (thisBlock) {
            var thisBlockShowLoadMoreHolder = thisBlock.children('.mkd-bnl-navigation-holder'),
                thisBlockShowLoadMore = thisBlockShowLoadMoreHolder.children('.mkd-bnl-load-more'),
                thisBlockShowLoadMoreLoading = thisBlockShowLoadMoreHolder.children('.mkd-bnl-load-more-loading'),
                thisBlockShowLoadMoreButton = thisBlockShowLoadMore.children(),
                blockData = mkdPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkd-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            thisBlockShowLoadMoreButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                thisBlockShowLoadMore.hide();
                thisBlockShowLoadMoreLoading.css('display', 'inline-block');

                blockData.paged = blockData.next_page;

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdGlobalVars.vars.mkdAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page++;

                            if (isBlockItem) {
                                blogBlockOuter.append(response.html);
                            }
                            else {
                                blogBlockOuter.children('.mkd-bnl-inner').append(response.html);
                            } // Append the new content

                            thisBlock.waitForImages(function () {
                                postAjaxCallback(thisBlock);
                                mkd.modules.blog.mkdInitFadeInLayouts();
                            });

                            if (blockData.max_pages > (blockData.paged)) {
                                thisBlockShowLoadMore.show();
                                thisBlockShowLoadMoreLoading.hide();
                            }
                            else {
                                thisBlockShowLoadMoreHolder.hide();
                            }
                        }
                    }
                });
            });
        };

        /**
         * Function that triggers next prev functionality
         */
        var mkdPostNextPrevEvent = function (thisBlock) {
            var thisBlockPostPrevNextButton = thisBlock.children('.mkd-bnl-navigation-holder').find('a'),
                thisBlockSliderPaging = thisBlock.find('.mkd-bnl-slider-paging'),
                thisBlockAjaxPreloader = thisBlock.children('.mkd-post-ajax-preloader'),
                blockData = mkdPostData(thisBlock),
                blogBlockOuter = thisBlock.children('.mkd-bnl-outer'),
                isBlockItem = isBlock(thisBlock);

            if (thisBlock.hasClass('mkd-post-pag-np-horizontal')) {
                setActivePaging(thisBlockSliderPaging, blockData.paged);
            }

            thisBlockPostPrevNextButton.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                blockData.paged = getClickedButton($(this), blockData);
                if (blockData.paged === false) {
                    return;
                }

                if (!setAjaxLoading(thisBlock, true)) {
                    return;
                }

                if (thisBlock.hasClass('mkd-post-pag-np-horizontal')) {
                    setActivePaging(thisBlockSliderPaging, blockData.paged);
                }

                thisBlockAjaxPreloader.show();

                if (!isBlockItem) {
                    blogBlockOuter.children('.mkd-bnl-inner').find('.mkd-post-item').addClass('mkd-removed-post-page');
                }

                $.ajax({
                    type: 'POST',
                    data: blockData,
                    url: mkdGlobalVars.vars.mkdAjaxUrl,
                    success: function (data) {
                        var response = $.parseJSON(data);
                        if (response.showNextPage === true) {
                            blockData.next_page = blockData.paged + 1;
                            blockData.prev_page = blockData.paged - 1;

                            if (isBlockItem) {
                                blogBlockOuter.html(response.html);
                            }
                            else {
                                var postItems = thisBlock.hasClass('mkd-pl-eight-holder') ? $(response.html).find('.mkd-post-item') : response.html;
                                blogBlockOuter.children('.mkd-bnl-inner').find('.mkd-post-item:last').after(postItems);
                                thisBlock.find('.mkd-removed-post-page').remove();
                            }// Append the new content

                            thisBlock.waitForImages(function () {
                                thisBlock.css('min-height', '');
                                thisBlockAjaxPreloader.hide();
                                setAjaxLoading(thisBlock, false);
                                postAjaxCallback(thisBlock);
                                mkd.modules.blog.mkdInitFadeInLayouts();
                            });
                        }
                    }
                });
            });

            function setAjaxLoading(thisBlock, start) {
                if (start) {
                    if (!thisBlock.hasClass('mkd-post-pag-active')) {
                        thisBlock.css('min-height', thisBlock.height());
                        thisBlock.addClass('mkd-post-pag-active');
                        return true;
                    }
                    else {
                        return false;
                    }
                }

                else if (!start && thisBlock.hasClass('mkd-post-pag-active')) {
                    thisBlock.removeClass('mkd-post-pag-active');
                }

                return true;
            }

            function getClickedButton(thisButton, blockData) {
                if (thisButton.hasClass('mkd-bnl-nav-next') && blockData.next_page <= blockData.max_pages) {
                    blockData.paged = blockData.next_page;
                }
                else if (thisButton.hasClass('mkd-bnl-nav-prev') && blockData.prev_page > 0) {
                    blockData.paged = blockData.prev_page;
                }
                else if (thisButton.hasClass('mkd-paging-button-holder')) {
                    blockData.paged = thisBlockSliderPaging.children('a').index(thisButton) + 1;
                }
                else {
                    return false;
                }
                return blockData.paged;
            }

            function setActivePaging(pagingHolder, number) {
                pagingHolder.children('a').removeClass('mkd-bnl-paging-active');
                pagingHolder.children('a:nth-child(' + number + ')').addClass('mkd-bnl-paging-active');
            }
        };

        /**
         * Function that triggers load more functionality
         */
        var mkdPostInfinitiveEvent = function (thisBlock) {
            var blogBlockOuter = thisBlock.children('.mkd-bnl-outer'),
                blockData = mkdPostData(thisBlock),
                isBlockItem = isBlock(thisBlock);

            mkd.window.scroll(function () {

                if (!thisBlock.hasClass('mkd-ajax-infinite-started') && (blockData.next_page <= blockData.max_pages) && ((mkd.window.height() + mkd.window.scrollTop()) > (blogBlockOuter.offset().top + blogBlockOuter.height()))) {

                    var preloaderHTML = '<div class="mkd-inf-scroll-preloader mkd-post-ajax-preloader"><div class="mkd-pulse"></div><div class="mkd-pulse"></div><div class="mkd-pulse"></div></div>';

                    thisBlock.after(preloaderHTML);
                    thisBlock.addClass('mkd-ajax-infinite-started');
                    blockData.paged = blockData.next_page;

                    setTimeout(function () {
                        $.ajax({
                            type: 'POST',
                            data: blockData,
                            url: mkdGlobalVars.vars.mkdAjaxUrl,
                            success: function (data) {
                                var response = $.parseJSON(data);
                                if (response.showNextPage === true) {
                                    blockData.next_page++;

                                    if (isBlockItem) {
                                        blogBlockOuter.append(response.html);
                                    }
                                    else {
                                        blogBlockOuter.children('.mkd-bnl-inner').append(response.html);
                                    } // Append the new content

                                    thisBlock.waitForImages(function () {
                                        postAjaxCallback(thisBlock);
                                        mkd.modules.blog.mkdInitFadeInLayouts();
                                        thisBlock.removeClass('mkd-ajax-infinite-started');
                                        $('.mkd-inf-scroll-preloader').remove();
                                    });
                                }
                            }
                        });
                    }, 300); //show inf animation
                }
            });
        };

        function isBlock($thisblock) {
            return ($thisblock.hasClass("mkd-block-holder"));
        }

        function postAjaxCallback(thisBlock) {

            thisBlock.find('.mkd-post-item').addClass('mkd-active-post-page');

            if (thisBlock.parent().hasClass('widget')) {
                mkd.modules.header.mkdDropDownMenu();
                thisBlock.parent().parent().css('height', '');
            }
            mkdBlockReveal();
            mkd.modules.common.mkdPrettyPhoto();
        }

        return {
            init: function () {
                if (blogBlockWithPaginationLoadMore.length) {
                    blogBlockWithPaginationLoadMore.each(function () {
                        mkdPostLoadMoreEvent($(this));
                    });
                }
                if (blogBlockWithPaginationPrevNext.length) {
                    blogBlockWithPaginationPrevNext.each(function () {
                        mkdPostNextPrevEvent($(this));
                    });
                }
                if (blogBlockWithPaginationInfinitive.length) {
                    blogBlockWithPaginationInfinitive.each(function () {
                        mkdPostInfinitiveEvent($(this));
                    });
                }
            }
        };
    };

    /*
     * Init pagination - load more
     * @returns object with data parameters
     */

    function mkdPostData(container) {

        var myObj = container.data();

        myObj.action = 'newshub_mikado_list_ajax';

        return myObj;
    }

    /**
     * Object that represents post layout tabs widget
     * @returns {{init: Function}} function that initializes post layout tabs widget functionality
     */
    var mkdPostLayoutTabWidget = mkd.modules.shortcodes.mkdPostLayoutTabWidget = function () {

        var layoutTabsWidget = $('.mkd-plw-tabs');


        var mkdPostLayoutTabWidgetEvent = function (thisWidget) {
            var plwTabsHolder = thisWidget.find('.mkd-plw-tabs-tabs-holder');
            var plwTabsContent = thisWidget.find('.mkd-plw-tabs-content-holder');
            var currentItemPosition = plwTabsHolder.children('.mkd-plw-tabs-tab:first-child').index() + 1; // +1 is because index start from 0 and list from 1

            setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);

            plwTabsHolder.find('a').mouseover(function (e) {
                e.preventDefault();

                currentItemPosition = $(this).parents('.mkd-plw-tabs-tab').index() + 1; // +1 is because index start from 0 and list from 1

                setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition);
            });
        };

        function setActiveTab(plwTabsContent, plwTabsHolder, currentItemPosition) {
            var activeItemClass = 'mkd-plw-tabs-active-item';

            plwTabsContent.children('.mkd-plw-tabs-content').removeClass(activeItemClass);
            plwTabsHolder.children('.mkd-plw-tabs-tab').removeClass(activeItemClass);

            var height = plwTabsContent.children('.mkd-plw-tabs-content:nth-child(' + currentItemPosition + ')').addClass(activeItemClass).height();
            plwTabsContent.css('min-height', height + 'px');
            plwTabsHolder.children('.mkd-plw-tabs-tab:nth-child(' + currentItemPosition + ')').addClass(activeItemClass);
        }

        return {
            init: function () {
                if (layoutTabsWidget.length) {
                    layoutTabsWidget.each(function () {
                        mkdPostLayoutTabWidgetEvent($(this));
                    });
                }
            },

        };
    };

    /*
     * Recent comments hover
     */
    function mkdRecentCommentsHover() {
        var link = $('footer .mkd-rpc-link');
        if (link.length) {
            link.each(function () {
                var thisLink = $(this),
                    commentsNumber = thisLink.closest('li').find('.mkd-rpc-number-holder');
                thisLink.mouseenter(function () {
                    commentsNumber.addClass('mkd-hovered');
                });
                thisLink.mouseleave(function () {
                    commentsNumber.removeClass('mkd-hovered');
                });

            });
        }
    }


    /*
     **	Show Google Map
     */
    function mkdShowGoogleMap() {

        if ($('.mkd-google-map').length) {
            $('.mkd-google-map').each(function () {

                var element = $(this);

                var customMapStyle;
                if (typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if (typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if (typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if (typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if (typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if (typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if (typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if (typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if (typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }
                var addresses;
                if (typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "mkd-map-" + uniqueId;

                mkdInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function mkdInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data) {

        var mapStyles = [
            {
                stylers: [
                    {hue: color},
                    {saturation: saturation},
                    {lightness: lightness},
                    {gamma: 1}
                ]
            }
        ];

        var googleMapStyleId;

        if (customMapStyle) {
            googleMapStyleId = 'mkd-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mikado Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if (!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkd-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkd-style', qoogleMapType);

        var index;

        for (index = 0; index < data.length; ++index) {
            mkdInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdInitializeGoogleAddress(data, pin, map, geocoder) {
        if (data === '')
            return;
        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode({'address': data}, function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function () {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function () {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    /*
     * Fix for loading widget in header
     * @returns object with data parameters
     */

    function mkdInitPostLayoutWidget() {

        var postLayoutWidgets = $('.mkd-plw-one, .mkd-plw-two, .mkd-plw-three');
        postLayoutWidgets.addClass('clearfix');
        postLayoutWidgets.css('opacity', '1');
    }

})(jQuery);