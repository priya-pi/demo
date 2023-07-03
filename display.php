<?php

include 'config.php';
include 'header.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}

$userId = $_SESSION['id'];

$sql = "SELECT u.id as user_id,b.id as book_id,b.name as book_name,b.description,b.no_of_page,b.author,b.category,b.price,b.released_year,b.status 
FROM book as b JOIN user as u ON u.id = b.user_id and b.user_id=$userId";


// sorting code
$columns = array('book_id', 'user_name', 'book_name', 'description', 'no_of_page', 'author', 'category', 'price', 'released_year');
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

$up_or_down = str_replace(array('ASC', 'DESC'), array('up', 'down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';

// pagination:
$length = $_GET['length'] ?? 5;
$page = $_GET['page'];

$num_per_page = $length;
if (isset($page)) {
    $page = $page;
} else {
    $page = 1;
}
$start_from = ($page - 1) * 5;

// searching code
$like_string = '';
$value = $_GET['search'];

// select checkbox for search data:
if (isset($_GET['user_name']) && $_GET['user_name'] == 'user_name') {
        
        if (strlen($like_string) > 0) {
            
        $like_string .= " or u.name like  '%$value%'";
    } else {
        $like_string .= " u.name like  '%$value%'";
    }
}

if (isset($_GET['book_name']) && $_GET['book_name'] == 'book_name') {
    
    if (strlen($like_string) > 0) {
        
        $like_string .= " or b.name like  '%$value%'";
    } else {
        $like_string .= " b.name like  '%$value%'";
    }
}
if (isset($_GET['description']) && $_GET['description'] == 'description') {
    
    if (strlen($like_string) > 0 ) {
        
        $like_string .= " or description like  '%$value%'";
    } else {
        $like_string .= " description like  '%$value%'";
    }
}

if (isset($_GET['author']) && $_GET['author'] == 'author') {
    
    if (strlen($like_string) > 0) {
        
        $like_string .= " or author like  '%$value%'";
    } else {
        $like_string .= " author like  '%$value%'";
    }
}
if (isset($_GET['category']) && $_GET['category'] == 'category') {
    
    if (strlen($like_string) > 0) {

        $like_string .= " or category like  '%$value%'";
    } else {
        $like_string .= " category like  '%$value%'";
    }
}

if (strlen($like_string) > 0) {

    $sql .= " AND $like_string";
}

$sql .= " order by $column $sort_order LIMIT  $start_from,$num_per_page";
$data = mysqli_query($conn, $sql);
pr($sql);

?>

<div class="container-fluid back mt-5">
    <div class="mt-5 p-3 mb-5">
        
        <h3 class="text-center p-3 theme">userBook Details</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="">
                    <a href="creatBook.php" class="btn btn-success">Add</a>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                    <a href="clientSide.php" class="btn btn-primary">ClientSide</a>
                    <a href="serverSide.php" class="btn btn-primary">ServerSide</a>

                </div>
            </div>
            <div class="col-md-8">
                <div class="">
                    <form class="" method="get">
                        <div class="row">
                            <div class="col">
                                <input type="checkbox" name="book_name" id="book_name" class="form-check-input" value="book_name" <?php if ($_GET['book_name'] == 'book_name') {
                                                                                                                                        echo "checked='checked'";
                                                                                                                                    } ?>>
                                <label class="form-check-label" for="book_name">
                                    book_name
                                </label>
                                <input type="checkbox" name="description" id="description" class="form-check-input" value="description" <?php if ($_GET['description'] == 'description') {
                                                                                                                                            echo "checked='checked'";
                                                                                                                                        } ?>>
                                <label class="form-check-label" for="description">
                                    description
                                </label>
                                <input type="checkbox" name="author" id="author" class="form-check-input" value="author" <?php if ($_GET['author'] == 'author') {
                                                                                                                                echo "checked='checked'";
                                                                                                                            } ?>>
                                <label class="form-check-label" for="author">
                                    author
                                </label>
                                <input type="checkbox" name="category" id="category" class="form-check-input" value="category" <?php if ($_GET['category'] == 'category') {
                                                                                                                                    echo "checked='checked'";
                                                                                                                                } ?>>
                                <label class="form-check-label" for="category">
                                    category
                                </label>
                            </div>
                            <div class="col d-flex">
                                <input class="form-control me-2" value="<?php echo $value; ?>" name="search" type="text" placeholder="Search" id="search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <label>show <select class="btn btn-light dropdown-toggle" onchange="selectId()" id="length">
            <option value="5" <?php if ($length == 5) echo "selected"; ?>>5</option>
            <option value="10" <?php if ($length == 10) echo "selected"; ?>>10</option>
            <option value="20" <?php if ($length == 20) echo "selected"; ?>>20</option>
            <option value="50" <?php if ($length == 50) echo "selected"; ?>>50</option>
    </select></label>

    <table class="table table-light">
        <thead class="table-dark">
            <tr>
                <th><a href="?column=book_id&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        book_id<i class="fas fa-sort<?php echo $column == 'book_id' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=book_name&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        Book_name <i class="fas fa-sort<?php echo $column == 'book_name' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=description&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        description<i class="fas fa-sort<?php echo $column == 'description' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=no_of_page&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        no_of_page <i class="fas fa-sort<?php echo $column == 'no_of_page' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=author&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        author <i class="fas fa-sort<?php echo $column == 'author' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=category&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        category<i class="fas fa-sort<?php echo $column == 'category' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=price&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        price<i class="fas fa-sort<?php echo $column == 'price' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>

                <th><a href="?column=released_year&order=<?php echo $asc_or_desc; ?>&length=<?php echo $length; ?>" style="margin-left:10px;text-decoration:none;color:white;">
                        released_year<i class="fas fa-sort<?php echo $column == 'released_year' ? '-' . $up_or_down : ''; ?> ps-1"></i></a></th>
                <th>status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="table">

            <?php while ($p = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?php echo $p['book_id']; ?></td>
                    <td><?php echo $p['book_name']; ?></td>
                    <td><?php echo $p['description']; ?></td>
                    <td><?php echo $p['no_of_page']; ?></td>
                    <td><?php echo $p['author']; ?></td>
                    <td><?php echo $p['category']; ?></td>
                    <td><?php echo $p['price']; ?></td>
                    <td><?php echo $p['released_year']; ?></td>
                    <td>
                        <div class="form-switch">
                            <input type="checkbox" class="form-check-input" name="status" id="<?php echo $p['book_id']; ?>" value="<?php echo $p['status']; ?>" <?php echo $p['status'] == '1' ? 'checked' : ''; ?> />
                        </div>
                    </td>
                    <td><a onclick="confirmDelete(<?php echo $p['book_id']; ?>)"><i class="fa-solid fa-trash-can"></i></a>
                        <a href="creatBook.php?edit=<?php echo $p['book_id']; ?>"><i class="fa-solid fa-pen"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <?php

    $filter_row = "SELECT u.id as user_id,b.id as book_id,b.name as book_name,b.description,b.no_of_page,b.author,b.category,b.price,b.released_year,b.status 
            FROM book as b JOIN user as u ON u.id = b.user_id and b.user_id=$userId";

    if (strlen($like_string) > 0) {

        $filter_row .= " AND $like_string";
    }

    $con = mysqli_query($conn, $filter_row);
    $totalrecord = mysqli_num_rows($con);
    $totalpages = ceil($totalrecord / $num_per_page);

    for ($i = 1; $i <= $totalpages; $i++) {
        
        if ($length) {
            echo "<a href='display.php?length=" . $length . "&page=" . $i . "' class='btn btn-success'>$i</a>";
        } else {
            echo "<a href='display.php?page=" . $i . "' class='btn btn-info'>$i</a>";
        }
    }
    ?>

</div>
</div>

<?php include 'footer.php' ?>
