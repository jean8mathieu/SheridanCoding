<?php
/**
 * Created by PhpStorm.
 * User: Jean-Mathieu
 * Date: 12/20/14
 * Time: 9:45 AM
 */

class calculation {
    function add($x,$y){
        if(is_numeric($x) && is_numeric($y)){
            return ($x + $y);
        }else{
            return "Error";
        }
    }

    function sub($x,$y){
        if(is_numeric($x) && is_numeric($y)){
            return ($x - $y);
        }else{
            return "Error";
        }
    }

    function mul($x,$y){
        if(is_numeric($x) && is_numeric($y)){
            return ($x * $y);
        }else{
            return "Error";
        }
    }

    function div($x,$y){
        if($y != 0 && is_numeric($x) && is_numeric($y)){
            return ($x / $y);
        }else{
            return "Error";
        }
    }
} 