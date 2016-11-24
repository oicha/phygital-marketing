<?php if ($display_ratings == 'yes') { ?>
<div class="mkd-ratings-holder">
    <div class="mkd-title-holder mkd-ratings-text-title">
        <h5 class="mkd-title-line-head"><?php esc_html_e('Rate This Article:', 'newshub' ); ?></h5>
        <div class="mkd-title-line-body"></div>
    </div>
    <div class="mkd-ratings-stars-holder">
        <div class="mkd-ratings-stars-inner">
            <span id="mkd-rating-1" ></span>
            <span id="mkd-rating-2" ></span>
            <span id="mkd-rating-3" ></span>
            <span id="mkd-rating-4" ></span>
            <span id="mkd-rating-5" ></span>
        </div>
    </div>
    <div class="mkd-ratings-message-holder">
        <div class="mkd-rating-value"></div>
        <div class="mkd-rating-message"></div>
    </div>
</div>
<?php } ?>