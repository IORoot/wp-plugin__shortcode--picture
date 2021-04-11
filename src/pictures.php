<?php

namespace andyp\core;

class pictures {

    public $attributes;
    public $content;
    public $html;

    public function __construct()
    {
        add_shortcode( 'picture', [$this, 'run'] );
    }

    public function run($atts = array(), $content = null)
    {
        /**
         * atts = [
         *      src,
         *      class
         * ]
         */
        
        if (!array_key_exists('src', $atts)){ return; }
        if (!array_key_exists('class', $atts)){ return; }
        
        $this->attributes = $atts;
        $this->source();
        $this->render();
        return $this->html;
    }

    public function source()
    {
        $this->path = dirname($this->attributes['src']);
        $this->file = basename($this->attributes['src']);
    }

    
    public function render()
    {
        
        $this->html =  '<picture>';

            /**
             * <640px Thumbnail (640x0)
             */
            $this->html .= '<source media="(max-width: 639px)" srcset="'.$this->path. '/thumbnail/' . $this->file .'">';

            /**
             * >640px = Medium (768x0)
             */
            $this->html .= '<source media="(min-width: 640px)" srcset="'.$this->path. '/medium/' . $this->file .'">';

            /**
             * >768px = Large (1024x0)
             */
            $this->html .= '<source media="(min-width: 768px)" srcset="'.$this->path. '/large/' . $this->file .'">';

            /**
             * Original (1280x1280)
             */
            $this->html .= '<source media="(min-width: 1024px)" srcset="'.$this->attributes['src'].'">';

            /**
             * Fallback
             */
            $this->html .= '<img class="'.$this->attributes['class'].'" src="'.$this->attributes['src'].'" alt="'.$this->attributes['alt'].'">';


        $this->html .= '</picture>';
    }
}