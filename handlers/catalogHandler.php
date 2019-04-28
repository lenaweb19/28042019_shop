<?php 
    //echo 'Привет';
    include ($_SERVER['DOCUMENT_ROOT'] .'/php/connect.php');
    
    $cat = $_GET['id'];
    //ищем дочерние категории на основании переданной родительской 
    $query = "SELECT * FROM `categories`
            WHERE `parent_category` = $cat";
    
    $result = mysqli_query($db, $query);

    sleep(2);
    if ( mysqli_num_rows ($result) !=0 ) {
        // если пришла род кат 
    
    $allCategoriesID = [];
    while ($row = mysqli_fetch_assoc($result)) {
    //1.идентификаторы каждой строчки помещаем в массив 
    array_push($allCategoriesID, $row['id']);}
    //2.превращаем массив в строку
    // implode(); превратить массив в строчку
    // explode(); превратить строчку в массив
    $catsLine = implode( ',', $allCategoriesID);  

    $query = "SELECT * FROM `catalog` WHERE `category_id`  IN ($catsLine)";
    
    $goods = mysqli_query($db, $query);  

    //echo mysqli_num_rows($goods);

    $goods_array = [];

    while ( $row = mysqli_fetch_assoc($goods) ) {
       array_push( $goods_array, $row);
    }
    
    //JSON 

    //print_r( $goods_array );


    echo json_encode($goods_array);



    } else {
   

    //ищем товары, соответствующие категории
    //'4,5,6,7'
    //die();

    
    $query = "SELECT * FROM `catalog` WHERE `category_id`  = $cat";
    
    $goods = mysqli_query($db, $query);  

    //echo mysqli_num_rows($goods);

    $goods_array = [];

    while ( $row = mysqli_fetch_assoc($goods) ) {
       array_push( $goods_array, $row);
    }
    
    //JSON 

    //print_r( $goods_array );


    echo json_encode($goods_array);








    //echo '<pre>';
    //print_r($goods_array);
    //echo '</pre>';

}




?>

