<?php

namespace NewsHub\Modules\Blog\Shortcodes\Lib;

/*
	Layouts - shortcodes
*/
use NewsHub\Modules\Blog\Shortcodes\PostLayoutOne\PostLayoutOne;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutTwo\PostLayoutTwo;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutThree\PostLayoutThree;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutFour\PostLayoutFour;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutFive\PostLayoutFive;
use NewsHub\Modules\Blog\Shortcodes\PostLayoutSix\PostLayoutSix;

/* 
	Blocks - combinations of several layouts
*/
use NewsHub\Modules\Blog\Shortcodes\BlockOne\BlockOne;
use NewsHub\Modules\Blog\Shortcodes\BlockTwo\BlockTwo;
use NewsHub\Modules\Blog\Shortcodes\BlockThree\BlockThree;
use NewsHub\Modules\Blog\Shortcodes\BlockFour\BlockFour;
use NewsHub\Modules\Blog\Shortcodes\BlockFive\BlockFive;
use NewsHub\Modules\Blog\Shortcodes\BlockSix\BlockSix;
use NewsHub\Modules\Blog\Shortcodes\BlockSeven\BlockSeven;

/*
	Post Sliders - combinations of several layouts
*/
use NewsHub\Modules\Blog\Shortcodes\SliderPostOne\SliderPostOne;
use NewsHub\Modules\Blog\Shortcodes\SliderPostTwo\SliderPostTwo;
use NewsHub\Modules\Blog\Shortcodes\SliderPostThree\SliderPostThree;


/**
 * Class ShortcodeLoader
 */
class ShortcodeLoader
{
    /**
     * @var private instance of current class
     */
    private static $instance;
    /**
     * @var array
     */
    private $loadedShortcodes = array();

    /**
     * Private constuct because of Singletone
     */
    private function __construct() {
    }

    /**
     * Private sleep because of Singletone
     */
    private function __wakeup() {
    }

    /**
     * Private clone because of Singletone
     */
    private function __clone() {
    }

    /**
     * Returns current instance of class
     * @return ShortcodeLoader
     */
    public static function getInstance() {
        if (self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    /**
     * Adds new shortcode. Object that it takes must implement ListShortcode
     * @param ListShortcode $shortcode
     */
    private function addShortcode(ListShortcode $shortcode) {
        if (!array_key_exists($shortcode->getBase(), $this->loadedShortcodes)) {
            $this->loadedShortcodes[$shortcode->getBase()] = $shortcode;
        }
    }

    /**
     * Adds all shortcodes.
     *
     * @see ShortcodeLoader::addShortcode()
     */
    private function addShortcodes() {
        $this->addShortcode(new PostLayoutOne());
        $this->addShortcode(new PostLayoutTwo());
        $this->addShortcode(new PostLayoutThree());
        $this->addShortcode(new PostLayoutFour());
        $this->addShortcode(new PostLayoutFive());
        $this->addShortcode(new PostLayoutSix());
        $this->addShortcode(new BlockOne());
        $this->addShortcode(new BlockTwo());
        $this->addShortcode(new BlockThree());
        $this->addShortcode(new BlockFour());
        $this->addShortcode(new BlockFive());
        $this->addShortcode(new BlockSix());
        $this->addShortcode(new BlockSeven());
        $this->addShortcode(new SliderPostOne());
        $this->addShortcode(new SliderPostTwo());
        $this->addShortcode(new SliderPostThree());
    }

    /**
     * Calls ShortcodeLoader::addShortcodes and than loops through added shortcodes and calls render method
     * of each shortcode object
     */
    public function load() {
        $this->addShortcodes();

        foreach ($this->loadedShortcodes as $shortcode) {
            add_shortcode($shortcode->getBase(), array($shortcode, 'renderHolders'));
        }
    }
}

$shortcodeLoader = ShortcodeLoader::getInstance();
$shortcodeLoader->load();