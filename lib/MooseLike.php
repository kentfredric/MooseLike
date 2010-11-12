<?php

_use("MooseLike_Types");
_use("MooseLike_Meta_Object");

class MooseLike {

  public $_stash;
  public $_meta;

  public function _buildargs($config){
    return $config;
  }
  public function _generate_attributes(){ 
  }
  public function meta (){ 
    if( !isset($this->_meta) ){
      $this->_meta = new MetaObject( $this->_class(), $this );
    }
    return $this->_meta;
  }
  public function __construct(){ 
    $args = func_get_args();
    $this->_stash = array();
    $this->_generate_attributes();

    $config = array();
    if( isset( $args[0] ) ){
      if ( !is_array( $args[0] ) ){ 
        throw new CodeParamException('Invalid construction, syntax is: new ' . $this->_class . '([ $configArray ])');
      }
      $config  = $args[0];
    }

    #$reconfig = $this->_buildargs($config);
    #$this->_meta->attributes = $this->_attributes();
    foreach( $config as $name => $value ){ 
      $this->meta()->initialise_attribute( $name , $this, array('value' => $value) );
    }
    foreach( $this->meta()->attributes as $name => $value ){ 
      $this->meta()->initialise_attribute( $name, $this, array() );
    }
  }
  public function _class(){ 
    return "MooseLike";
  }
  public function _set( $variable, $value ){ 
    $this->_stash[$variable] = $value;
  }
  public function _get( $variable ){ 
    return $this->_stash[$variable];
  }
  public function _isset( $variable ){ 
    return isset( $this->_stash[$variable] );
  }
  public function _attributes(){ 
    return array();
  }
  public function __call( string $name , array $arguments ){
    if( ! $this->_meta->has_attribute($name) ){ 
      throw new CodeMethodException("No attribute '$name', and no method either.");
    }
  }
  public function __get( $name ){ 
    if( ! $this->meta()->has_attribute( $name ) ) { 
      throw new CodeMethodException("No attribute '$name'");
    }
    return $this->_get( $name );
  }
  public function __set( $name , $value ){ 
    if( ! $this->_meta->has_attribute( $name ) ) { 
      throw new CodeMethodException("No attribute '$name'");
    }
    return $this->_set( $name, $value );
  }
}
