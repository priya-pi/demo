<?php

include 'config.php';

$userId = $_SESSION['id'];

$columns = array(

    0 => "book_id",
    1 => "book_name",
    2 => "description",
    3 => "no_of_page",
    4 => "author",
    5 => "category",
    6 => "price",
    7 => "released_year",
    8 => "status"
);

// fetch records
$sql = "SELECT b.id as book_id,u.id as user_id,b.name as book_name,b.description,b.no_of_page,b.author,b.category,b.price,b.released_year,b.status 
FROM book as b JOIN user as u ON u.id = b.user_id and b.user_id=$userId";
$result = mysqli_query($conn, $sql);
$count_num_rows = mysqli_num_rows($result);

// searching
if (isset($_POST['search']['value'])) {

    $value = $_POST['search']['value'];
    $sql .= " where b.id like  '%" . $value . "%'";
    $sql .= " or b.name like  '%" . $value . "%'";
    $sql .= " or description like  '%" . $value . "%'";
    $sql .= " or no_of_page like  '%" . $value . "%'";
    $sql .= " or author like '%" . $value . "%'";
    $sql .= " or category like '%" . $value . "%'";
    $sql .= " or price like '%" . $value . "%'";
    $sql .= " or released_year like '%" . $value . "%'";
}

// sorting
if (isset($_POST['order'])) {

    $column = $columns[$_POST['order'][0]['column']];
    $order =  $_POST['order'][0]['dir'];
    $sql .= " order by " . $column . " " . $order;

} else {
    $sql .= "order by b.id ASC";
}


$run_query = mysqli_query($conn, $sql);
$filter_row = mysqli_num_rows($run_query);

// paging
if (isset($_POST['length']) != 0 &&  $_POST['length'] != -1) {
    
    $start = $_POST['start'];
    $length = $_POST['length'];
    
    $sql .= " limit " . $start . ", " . $length;
}

$array = array();
$run_query = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($run_query)) {


    $row['status'] = '<div class="form-switch"><input type="checkbox" class="form-check-input" onchange="statusData('.$row['book_id'].','.$row['status'].')" id="'.$row['book_id'].'" value="'.$row['status'].'" '.($row['status'] == "1" ? "checked" : "").' /></div>';
    $row['action'] = '<a href="javascript:void();" onclick="deleteData('.$row['book_id'].')" class="deleteBtn"><i class="fa-solid fa-trash-can"></i></a>
                    <a  onclick="editData('.$row['book_id'].')" class="editBtn"><i class="fa-solid fa-pen"></i></a>';
    $array[] = $row;
}


$dataset = array(
    "draw" => intval($_POST['draw']),
    "recordsTotal" => $count_num_rows,
    "recordsFiltered" => $filter_row,
    "data" => $array
);

echo json_encode($dataset);
