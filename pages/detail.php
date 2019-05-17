<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/modules/head.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/modules/menu.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/php/connect.php");

    $id = '';
    if ( isset ($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = 1;

    }
    //тернарный оператор
    //$id = (условие) ? правильный ответ : неправильный ответ ;
    $id = (isset($_GET['id'])) ? $_GET['id'] : 1 ;




    $query = "SELECT * FROM `categories` 
                    WHERE `parent_category` = {$id}";
    
    $cats = mysqli_query($db, $query);  
    $template = [];  
   


 

    $goods_array = [];

    while ( $row = mysqli_fetch_assoc($cats) ) {
        $template ['cats'][] = $row;
      // array_push(  $template ['cats'] , $row);
    }

    // echo '<pre>';
    // print_r( $template);
    // echo '</pre>';


//$people =  "SELECT * FROM `categories` 
  //          WHERE `parent_category` = 0";

//$cats_people = mysqli_query($db, $people); 
//$template = [];

//while ( $row_people = mysqli_fetch_assoc($cats_people) ) {
 //   $template['cats_people'][] = $row_people; 


//}



$qr_people = "SELECT * FROM `categories` 
          WHERE `id` = {$id}";

$result_people = mysqli_query($db, $qr_people); 
$row_parent = mysqli_fetch_assoc($result_people); 

//хлебные крошки

$qr_detail_parent = "SELECT * FROM `categories` 
          WHERE `id` = {$id}";

$result_detail_parent = mysqli_query($db, $qr_detail_parent); 
$row_detail_parent = mysqli_fetch_assoc($result_detail_parent); 



$qr_detail = "SELECT * FROM `catalog` 
          WHERE `id` = {$id}";

$result_detail = mysqli_query($db, $qr_detail); 
$row_detail = mysqli_fetch_assoc($result_detail); 


?>
    


    <div class="breadcrumbs">
        <a href="/pages/catalog.php">Главная</a>
        <a href="#"><?=$row_parent['name']?></a>
        <a href="#"><?=$row_detail_parent['name']?></a>
        <a href="#"><?=$row_detail['name']?></a>
    </div>  

<div class="detail">
    <div class="detail-foto"></div> 
    <div class="detail-name">кеды с полоской</div> 
    <div class="article">Артикул:</div> 
    <div class="price">4500</div> 
    <div class="description">отличные кеды</div>
    <div class="size">РАЗМЕР</div> 
    <div class="size-number">    
        <div class="size-num">39</div>    
        <div class="size-num">40</div> 
        <div class="size-num">41</div> 
        <div class="size-num">42</div> 
        <div class="size-num">43</div> 
    </div>  
    <div class="addto">ДОБАВИТЬ В КОРЗИНУ</div>
</div> 







<?php
    include ($_SERVER['DOCUMENT_ROOT'] . '/modules/footer.php');
?>