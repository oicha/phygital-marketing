<?php

/**
 * Widget that adds search form
 *
 * Class NewsHubMikadoSearchForm
 */
class NewsHubMikadoSearchForm extends NewsHubMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkd_search_form', // Base ID
            esc_html__('Mikado Search Form', 'newshub') // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array();
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        if (is_search())
            $placeholder = get_query_var('s');
        else
            $placeholder = esc_html('SEARCH', 'newshub'); ?>


        <form class="mkd-search-menu-holder" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <div class="mkd-form-holder">
                <div class="mkd-column-left">
                    <input type="text" placeholder="<?php echo esc_html($placeholder); ?>" name="s" class="mkd-search-field" autocomplete="off"/>
                </div>
                <div class="mkd-column-right">
                    <button class="mkd-search-submit" type="submit" value="Search"><span class="ion-android-search"></span>
                    </button>
                </div>
            </div>
        </form>

    <?php }
}