<?php

$TESTS_RUN = 0;

function pass( $explanation ){ 
  global $TESTS_RUN;
  $TESTS_RUN++;
  print "ok $TESTS_RUN";
  if ( $explanation ){ 
    print " - ";
    print $explanation;
  }
  print "\n";
}
function fail( $explanation ){ 
  global $TESTS_RUN;
  $TESTS_RUN++;
  print "not ok $TESTS_RUN";
  if ( $explanation ){ 
    print " - ";
    print $explanation;
  }
  print "\n";
  print "#\tFailed test ";
  if( $explanation ){ 
    print "'$explanation'\n#\t";
  }
  print "somewhere we can't debug yet :(";
  print "\n";
}
function diag( $message ){ 
  $lines = explode("\n", $message ); 
  foreach( $lines as $i => $v ){ 
    print "#\t$v\n";
  }
}

function test_is( $result, $expected, $explanation ){
  if( $result === $expected ){ 
    pass( $explanation );
  } else { 
    fail( $explanation );
    diag( "Got '$result'" ); 
    diag( "Expected '$expected'");
  }
}
function done_testing(){ 
  global $TESTS_RUN;
  print "1..$TESTS_RUN";
}
