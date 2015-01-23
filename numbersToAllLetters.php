<?php
/* 
 * (c) stevenchau 2015
 * 
 * 1--a
 * 2--b
 * ...
 * 26--z
 * Given a digit, return all possible outputs
 * Input: '1313'
 * Output: acac mac mm acm
 *
 * Input: '101'
 * Output: ja
 * 
 */

// Use Dynamic Programming
class NumToLetters{
    public $a;
    
    function __construct(){
        $this->a = array();
        
        for($i=97; $i<=122; $i++){
            $this->a[$i-96] = chr($i);            
        }
        /* 
        //Prints out the dictionary
        foreach($this->a as $k => $v){
            print "$k => $v\n";
        }         
        */
    }
    
    public function getLetters($str){
        $result = "";
        $this->getLettersHelper($str, $result, 0, 1);
    }
    
    public function getLettersHelper($str, $results, $start, $end){
        
        if($start > strlen($str) || $end > strlen($str)){
            $results .= "\n";
            print "-->$results";
            return;
        }
        
        for($i=$end; $i <= strlen($str); $i++){
            $n = substr($str, $start, $i - $start);
            
            // Lookup if number is valid            
            $c = $this->isValidLetter($n);
            //print "$n =>> $c\n";
            if($c != false){
                $results .= "$c";
                $this->getLettersHelper($str, $results, $i, $i+1);
                
                // Remove previous letter
                $results = substr($results, 0, $start);
            }else{
                // If we got here, then numbers out of range.  Short circuit.
                break;
            }
        }
    }
    
    public function isValidLetter($n){
        return isset($this->a[$n]) ? $this->a[$n] : false;
    }
}

// Test
$t = new NumToLetters();
$t->getLetters("1313");
print "\n";
$t->getLetters("110");
print "\n";
?>
