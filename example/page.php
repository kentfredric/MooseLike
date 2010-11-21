<?php

$class_page_conf = array( 'dir' => realpath(dirname(__FILE__)));
$class_page_conf['root'] = realpath( $class_page_conf['dir'] .'/../' );
$class_page_conf['lib'] = realpath( $class_page_conf['root'] .'/lib/' );
$class_page_conf['templates'] = realpath( $class_page_conf['root'] .'/templates/' );
$class_page_conf['compile_cache'] = realpath( $class_page_conf['root'] .'/compile_cache/' );
$class_page_conf['twig-lib'] = realpath( $class_page_conf['lib'] .'/Twig/lib/' );
$class_page_conf['twig-autoloader'] = realpath( $class_page_conf['twig-lib'] .'/Twig/Autoloader.php' );

require_once( $class_page_conf['twig-autoloader'] );
require_once( $class_page_conf['lib'] . '/class.exception.php' );

Twig_Autoloader::register();

class PageConfig extends MooseLike {
  public function _class(){ 
    return  'PageConfig';
  }
  public function _generate_attributes(){ 
    global $class_page_conf;
    $meta = $this->meta();
    $meta->add_attribute('templates', array( 
      'default' => $class_page_conf['templates'],
    ) );
    $meta->add_attribute('cache', array( 
      'default' => $class_page_conf['compile_cache'],
    ));
    $meta->add_attribute('debug', array( 
      'default' => false,
    ));
    $meta->add_attribute('charset', array(
      'default' => 'utf-8',
    ));
    $meta->add_attribute('auto_reload', array(
      'default' => 1,
    ));
    $meta->add_attribute('trim_blocks', array(
      'default' => true,
    ));
    $meta->add_attribute('strict_variables', array(
      'default' => true,
    ));
    $meta->add_attribute('required_thing', array(
      'required' => true,
    ));
  }
}

class Page {
  var $config = null;

  function set_config( $config ) { 
  }

}
