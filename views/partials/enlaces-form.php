<?php 

function componenteEnlacesForm ($first_path, $first_brand, $second_path, $second_brand){
    return "
        <div class='acciones'>
            <a href='$first_path'>$first_brand</a>
            <a href='$second_path'>$second_brand</a>
        </div>
    ";
}