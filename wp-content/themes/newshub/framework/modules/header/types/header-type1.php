<?php
namespace NewsHub\Modules\Header\Types;

use NewsHub\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType1
 */
class HeaderType1 extends HeaderType {
    protected $heightOfTransparency;
    protected $headerHeight;
    protected $mobileHeaderHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-type1';

        if(!is_admin()) {
            $menuAreaHeight       = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('menu_area_height_header_type1'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? (int)$menuAreaHeight : (int)47;


            $mobileHeaderHeight       = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('mobile_header_height'));
            $this->mobileHeaderHeight = $mobileHeaderHeight !== '' ? (int)$mobileHeaderHeight : (int)100;

            if(newshub_mikado_options()->getOptionValue('widget_area_header_type1') == 'no') {
                $this->widgetAreaHeight = 0;
            }
            else {
                $widgetAreaHeight       = newshub_mikado_filter_px(newshub_mikado_options()->getOptionValue('widget_area_height_header_type1'));
                $this->widgetAreaHeight = $widgetAreaHeight !== '' ? (int)$widgetAreaHeight : (int)100;

            }


            add_action('wp', array($this, 'setHeaderHeightProps'));

            add_filter('newshub_mikado_js_global_variables', array($this, 'getGlobalJSVariables'));
            add_filter('newshub_mikado_per_page_js_vars', array($this, 'getPerPageJSVariables'));
        }
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->headerHeight                 = $this->calculateHeightOfNonTransparentHeader();
        $this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $id = newshub_mikado_get_page_id();
        $transparencyHeight = 0;
        $headerTransparent = false;

        if(newshub_mikado_get_meta_field_intersect('header_style', $id) == 'transparent') {
            $headerTransparent = true;
        }

        if($headerTransparent) {
            $transparencyHeight = $this->menuAreaHeight + $this->widgetAreaHeight + newshub_mikado_get_top_bar_height();
        }

        return $transparencyHeight;
    }

    /**
     * Returns total height of header parts, needed in full screen post slider
     *
     * @return int
     */
    public function calculateHeightOfNonTransparentHeader() {
        $id = newshub_mikado_get_page_id();
        $headerTransparent = false;

        if(newshub_mikado_get_meta_field_intersect('header_style', $id) == 'transparent') {
            $headerTransparent = true;
        }

        if($headerTransparent) {
            $transparencyHeight = 0;
        }else{
            $transparencyHeight = $this->menuAreaHeight + $this->widgetAreaHeight + newshub_mikado_get_top_bar_height();
        }

        return $transparencyHeight;
    }
    
    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['widget_area'] = newshub_mikado_options()->getOptionValue('widget_area_header_type1') == 'yes' ? true : false;
        $parameters['widget_area_in_grid'] = newshub_mikado_options()->getOptionValue('widget_area_in_grid_header_type1') == 'yes' ? true : false;
        $parameters['menu_area_in_grid'] = newshub_mikado_options()->getOptionValue('menu_area_in_grid_header_type1') == 'yes' ? true : false;

        $parameters = apply_filters('newshub_mikado_header_type1_parameters', $parameters);

        newshub_mikado_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Returns total height of mobile header
     *
     * @return int|string
     */
    public function calculateMobileHeaderHeight() {
        $mobileHeaderHeight = $this->mobileHeaderHeight;

        return $mobileHeaderHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $globalVariables['mkdLogoAreaHeight'] = 0;
        $globalVariables['mkdWidgetAreaHeight'] = $this->widgetAreaHeight;
        $globalVariables['mkdMenuAreaHeight'] = $this->menuAreaHeight;
        $globalVariables['mkdMobileHeaderHeight'] = $this->mobileHeaderHeight;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {

        $perPageVars['mkdHeaderTransparencyHeight'] = $this->heightOfTransparency;
        $perPageVars['mkdHeaderHeight'] = $this->headerHeight;
        
        return $perPageVars;
    }
}