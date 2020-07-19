<?php

$grid = file_get_contents('./example_file6');

function GridCrosser($grid){
    $grid = explode("\n",$grid);
    unset($grid[0]);
    $grid = array_values($grid);
    for( $i = 0 ; $i < count($grid) ; $i++ ){
        $grid[$i] = str_split($grid[$i],1);
    }

    $maxLength = 0;
    $posX = 0;
    $posY = 0;
    for( $y = 0 ; $y < count($grid) ; $y++ ){ 

        for( $x = 0 ; $x < count($grid[$y]) ; $x++ ){ 
        
            if( $grid[$y][$x] == '.'){ 
            
                $length = 1; 
                $find = false;
    
                for( $i = 1 ; $i < (count($grid[$y]) - $x) ; $i++ ){

                    if(isset($grid[$y+$i]) && isset($grid[$y+$i][$x+$i])  ){
                
                        if( $grid[$y][$x+$i] == '.'  && $grid[$y+$i][$x] == '.'   && $grid[$y+$i][$x+$i] == '.' ){

                            for ($j = 1; $j < $i; $j++) {
                                if($grid[$y+$i][$x+$j] == 'o' ||    $grid[$y+$j][$x+$i] == 'o'){
                                    $find = true;
                                }
                            }

                            if($find){
                                break;
                            }
                            else{            
                                $length ++;
                                if( $length > $maxLength  ){
                                    $maxLength = $length;
                                    $posX = $x;
                                    $posY = $y;   
                                }
                            } 
                        }
                        else{
                            break;
                        }
                    }
                    else{
                        break;
                    }      
                }
            }   
        }
    }

    for($i = 0 ; $i < $maxLength ; $i++ ){
        for( $j = 0 ; $j < $maxLength ; $j++ ){
            $grid[$posY+$i][$posX+$j] = 'x';
        }
    }

    for( $i = 0 ; $i < count($grid) ; $i++){
        $grid[$i] = implode($grid[$i]);
    }

    $grid = implode("\n",$grid);

    return $grid;
}

echo GridCrosser($grid);