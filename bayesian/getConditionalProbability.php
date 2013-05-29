<?php

/**
* Returns conditional probability of $A given $B and $SamplePairs .
*/
function getConditionalProbabilty($A, $B, $SamplePairs) {
  $NumAB = 0;
  $NumB  = 0;
  $SampleNum = count($SamplePairs);
  for ($i=0; $i < $SampleNum; $i++) {
    if (in_array($B, $SamplePairs[$i])) {
      $NumB++;
      if (in_array($A, $SamplePairs[$i])) {
        $NumAB++;
      }
    }   
  } 
  return $NumAB / $NumB;
}


// Test the function

/**
* The $SamplePairs dataset uses this coding convention:
*
* +cancer - patient has cancer
* -cancer - patient does not have cancer
* +test   - patient tested positive on cancer test
* -test   - patient tested negative on cancer test
*/
$SamplePairs[0] = array("+cancer", "+test");
$SamplePairs[1] = array("-cancer", "-test");
$SamplePairs[2] = array("+cancer", "+test");
$SamplePairs[3] = array("-cancer", "+test");

// specify query variable $A and conditioning variable $B
$A = "+cancer";
$B = "+test";

// compute the conditional probability of having cancer given 1) 
// a positive test and 2) the test efficacy dataset $SamplePairs
echo getConditionalProbabilty($A, $B, $SamplePairs);

// Answer: 0.66666666666667

?>
