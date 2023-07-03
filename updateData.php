<?php

include 'config.php';

$data1 = [];

if (empty($_POST['name'])) {         //book_name
        $data1['error']['name'] = "required book_name";
} elseif (!preg_match("/[a-zA-Z]+/", $_POST['name'])) {
        $data1['error']['name'] = "only letter allowed";
} elseif (empty($_POST['desc'])) {     //description
        $data1['error']['desc'] = "required description";
} elseif (empty($_POST['no_of_page'])) {     //no_of_page
        $data1['error']['no_of_page'] = "required no_of_page";
} elseif (!preg_match("/^[0-9]*$/", $_POST['no_of_page'])) {
        $data1['error']['no_of_page'] = "only number allowed";
} elseif (empty($_POST['author'])) {     //author
        $data1['error']['author'] = "required author";
} elseif (!preg_match("/[a-zA-Z]+/", $_POST['author'])) {
        $data1['error']['author'] = "only letter allowed";
} elseif (empty($_POST['category'])) {     //category
        $data1['error']['category'] = "required category";
} elseif (!preg_match("/[a-zA-Z]+/", $_POST['category'])) {
        $data1['error']['category'] = "only letter allowed";
} elseif (empty($_POST['price'])) {     //price
        $data1['error']['price'] = "required price";
} elseif (!preg_match("/[0-9]/", $_POST['price'])) {
        $data1['error']['price'] = "only number allowed";
} elseif (empty($_POST['released_year'])) {     //released_year
        $data1['error']['released_year'] = "required released_year";
} elseif (!preg_match("/[0-9]/", $_POST['released_year'])) {
        $data1['error']['released_year'] = "only number allowed";

}

if (isset($data1['error']) && count($data1['error']) > 0) {

        $data1['success'] = false;
        echo json_encode($data1);
}else{


        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['desc'];
        $no_of_page = $_POST['no_of_page'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $released_year = $_POST['released_year'];
        
        $server = isset($_GET['server']) && $_GET['server'] == true ? true : false;
        
        
        $query = "update book set name='$name',description='$description',no_of_page='$no_of_page',
        author='$author',category='$category',price='$price',released_year='$released_year' where id=$id";
        $con = mysqli_query($conn, $query);
        
        $data = [];
        
        if ($con) {
                
                $data['updateServer'] = true;
                $data['serverMsg'] = "Book updated Successfully";
                echo json_encode($data);
        }
}
        

?>