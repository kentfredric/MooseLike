<?php

class MooseLike_Types {

  public static function IsArray( $value ){ 
    if( ! is_array( $value ) ){ 
      throw new CodeParamException("Expected Array, got '$value'");
    }
    return $value;
  }
  public static function IsBoolean( $value ){
    if( ((bool) $value ) !== $value ){ 
      throw new CodeParamException("Expected Boolean, got '$value'");
    }
    return $value;
  }

}
