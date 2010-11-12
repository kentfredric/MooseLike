#!/usr/bin/env php
<?php

require_once(dirname(__FILE__) . '/../lib/core.php' );

_use("MooseLike_Exceptions");
_use("Test");

function pr($arg){
    ob_start();
    print_r($arg);
    return ob_get_clean();
}

try{
    MooseLike_Exceptions::notimplemented();
    fail("notimplemented didn't throw");
} catch ( MooseLike_Exception_NotImplementedException $e ){
    pass("notimplemented threw");
    diag(pr($e));
}

done_testing();
