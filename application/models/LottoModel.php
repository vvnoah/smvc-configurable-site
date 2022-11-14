<?php

namespace app\models;

class LottoModel {
    public function get_grid(){
        $grid = [];
        
        for($i = 0; $i < 14; $i++){
            $random_numbers = $this->generate_random_numbers(1, 45, 6);
            $grid[$i] = [];
            for($j = 0; $j < 45; $j++){
                if(in_array($j, $random_numbers)){
                    $grid[$i][$j] = '<td class="highlight">' . $j+1 . '</td>';
                } else {
                    $grid[$i][$j] = '<td class="standard">' . $j+1 . '</td>';
                }
            }
        }

        return $grid;
    }

    // for each block (14)
        // for each number (45)
            // if number = random_number then give class highlight
            // else give class standard
    
    // desired output: 
    // [1] => [
    //      [1] => "<td class="standard/highlight"> 1 </td>, 
    //      [2] => "<td class="standard/highlight"> 2 </td>,
    //      ... 
    //      [45] => "<td class="standard/highlight"> 4 </td> 
    // ],
    // [2] => [
    //      [1] => "<td class="standard/highlight"> 1 </td>, 
    //      [2] => "<td class="standard/highlight"> 2 </td>,
    //      ... 
    //      [45] => "<td class="standard/highlight"> 4 </td> 
    // ],
    // ...
    // [14] => [
    //      [1] => "<td class="standard/highlight"> 1 </td>, 
    //      [2] => "<td class="standard/highlight"> 2 </td>,
    //      ... 
    //      [45] => "<td class="standard/highlight"> 4 </td> 
    // ]


    private function generate_random_numbers($min, $max, $quantity){
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
}