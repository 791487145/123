<?php namespace App\Widgets;

use Teepluss\Theme\Theme;
use Teepluss\Theme\Widget;

class Popup extends Widget {

    
    public $template = 'popup';

    
    public $watch = false;

    
    public $attributes = array(
        'userId' => 9999,
        'label'  => 'Generated Widget',
    );

    
    public $enable = true;

    
    public function init(Theme $theme)
    {
        

        
        
    }

    
    public function run()
    {
        $label = $this->getAttribute('label');

        

        $attrs = $this->getAttributes();

        return $attrs;
    }

}