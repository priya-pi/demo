<?php

include 'config.php';
include 'header.php';

if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}


$userId = $_SESSION['id'];

$sql = "SELECT u.id as user_id,b.id as book_id,b.name as book_name,b.description,b.no_of_page,b.author,b.category,b.price,b.released_year,b.status 
FROM book as b JOIN user as u ON u.id = b.user_id and b.user_id=$userId";
$data = mysqli_query($conn, $sql);

?>

<div class="container-fluid back p-2 justify-content-center mt-4">
    <div class="mt-5 p-3 mb-5">
        <h3 class="text-center p-3 theme">clientBook Details</h3>

        <div class="mb-3">
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <a href="display.php" class="btn btn-primary">display</a>
        </div>
        <table class="table table-light" id="myTable">
            <thead class="table">
                <tr>
                    <th>book_ID</th>
                    <th>Book_name</th>
                    <th>description</th>
                    <th>no_of_page</th>
                    <th>author</th>
                    <th>category</th>
                    <th>price</th>
                    <th>released_year</th>
                    <th>status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
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

                        <td><a href="delete.php?del=<?php echo $p['book_id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                            <a href="creatBook.php?edit=<?php echo $p['book_id']; ?>"><i class="fa-solid fa-pen"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    $('input[name=status]').click(function() {
        var id = $(this).attr('id');
        var status = $(this).val();
        if (status == 1) {
            status = 0;
        } else {
            status = 1;
        }
        $.ajax({
            type: 'POST',
            url: 'updateStatus.php',
            data: 'id= ' + id + '&status=' + status
        });
    })
</script>