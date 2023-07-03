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

$editId = $_GET['edit'];
$qu = "select id FROM book where id='$editId'";
$co = mysqli_query($conn, $qu);
$ar = mysqli_fetch_array($co);


if ($ar['id'] == $editId) {
} else {
    header('location:display.php');
}

// for edit data query
$sql1 = "SELECT b.user_id,u.name as user_name,b.id,b.name as book_name,b.description,b.no_of_page,b.author,b.category,b.price,b.released_year,b.status 
        FROM book as b,user as u where b.id='$editId'";
$data1 = mysqli_query($conn, $sql1);
$arr = mysqli_fetch_assoc($data1);

if (isset($_POST['addBook'])) {

    if (empty($_POST['book_name'])) {         //book_name
        $farr = "required book_name";
    } elseif (!preg_match("/[a-zA-Z]+/", $_POST['book_name'])) {
        $farr = "only letter allowed";
    } elseif (empty($_POST['description'])) {     //description
        $darr = "required description";
    } elseif (empty($_POST['no_of_page'])) {     //no_of_page
        $parr = "required no_of_page";
    } elseif (!preg_match("/[0-9]/", $_POST['no_of_page'])) {
        $parr = "only number allowed";
    } elseif (empty($_POST['author'])) {     //author
        $aarr = "required author";
    } elseif (!preg_match("/[a-zA-Z]+/", $_POST['author'])) {
        $aarr = "only letter allowed";
    } elseif (empty($_POST['category'])) {     //category
        $carr = "required category";
    } elseif (!preg_match("/[a-zA-Z]+/", $_POST['category'])) {
        $carr = "only letter allowed";
    } elseif (empty($_POST['price'])) {     //price
        $prarr = "required price";
    } elseif (!preg_match("/[0-9]/", $_POST['price'])) {
        $prarr = "only number allowed";
    } elseif (empty($_POST['released_year'])) {     //released_year
        $yarr = "required released_year";
    } elseif (!preg_match("/[0-9]/", $_POST['released_year'])) {
        $yarr = "only number allowed";
    } else {

        $book_name = $_POST['book_name'];
        $description = $_POST['description'];
        $no_of_page = $_POST['no_of_page'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $released_year = $_POST['released_year'];
        $status = $_POST['status'];

        $insert = "INSERT INTO book (`user_id`,`name`,`description`,`no_of_page`,`author`,`category`,`price`,`released_year`,`status`) 
                        VALUES ('$userId','$book_name','$description','$no_of_page','$author','$category','$price','$released_year','$status')";

        $data = mysqli_query($conn, $insert);
        if ($data) {

            $_SESSION['insert'] = true;
            $_SESSION['message'] = "Book Inserted Successfully";

            header('location:display.php');
        } else {
            echo mysqli_error($conn);
        }
    }
}

if (isset($_POST['update'])) {

    if (empty($_POST['book_name'])) {         //book_name
        $farr = "required book_name";
    } elseif (!preg_match("/[a-zA-Z]+/", $_POST['book_name'])) {
        $farr = "only letter allowed";
    } elseif (empty($_POST['description'])) {     //description
        $darr = "required description";
    } elseif (empty($_POST['no_of_page'])) {     //no_of_page
        $parr = "required no_of_page";
    } elseif (!preg_match("/^[0-9]*$/", $_POST['no_of_page'])) {
        $parr = "only number allowed";
    } elseif (empty($_POST['author'])) {     //author
        $aarr = "required author";
    } elseif (!preg_match("/[a-zA-Z]+/", $_POST['author'])) {
        $aarr = "only letter allowed";
    } elseif (empty($_POST['category'])) {     //category
        $carr = "required category";
    } elseif (!preg_match("/[a-zA-Z]+/", $_POST['category'])) {
        $carr = "only letter allowed";
    } elseif (empty($_POST['price'])) {     //price
        $prarr = "required price";
    } elseif (!preg_match("/[0-9]/", $_POST['price'])) {
        $prarr = "only number allowed";
    } elseif (empty($_POST['released_year'])) {     //released_year
        $yarr = "required released_year";
    } elseif (!preg_match("/[0-9]/", $_POST['released_year'])) {
        $yarr = "only number allowed";
    } else {


        $book_name = $_POST['book_name'];
        $description = $_POST['description'];
        $no_of_page = $_POST['no_of_page'];
        $author = $_POST['author'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $released_year = $_POST['released_year'];
        $status = $_POST['status'];

        $insert = "update book set name='$book_name',description='$description',no_of_page='$no_of_page',
                   author='$author',category='$category',price='$price',released_year='$released_year',status='$status' where id='$editId'";

        $data = mysqli_query($conn, $insert);
        if ($data) {

            $_SESSION['update'] = true;
            $_SESSION['updatemsg'] = "Book Updated Successfully";

            header('location:display.php');
        } else {
            echo mysqli_error($conn);
        }
    }
}

?>

<div class="pic">
    <div class="container h-100">
        <section>
            <div class="design">

                <form action="" method="post" class="" id="addForm">

                    <?php if (!$editId) { ?>
                        <h2 class="text-center p-3">Add Book</h2>
                    <?php } else { ?>
                        <h2 class="text-center p-3">Edit book</h2>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="book_name">bookName :</label>
                                <span class="error">*<?php echo $farr; ?></span>
                                <input type="text" name="book_name" id="book_name" class="form-control" value="<?php if (isset($_POST['book_name'])) {
                                                                                                                    echo $_POST['book_name'];
                                                                                                                } else {
                                                                                                                    echo $arr['book_name'];
                                                                                                                } ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="description">description :</label>
                                <span class="error">*<?php echo $darr; ?></span>
                                <input type="text" class="form-control p-3" name="description" id="description" value="<?php if (isset($_POST['description'])) {
                                                                                                                        echo $_POST['description'];
                                                                                                                    } else {
                                                                                                                        echo $arr['description'];
                                                                                                                    } ?>" />

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-2">
                            <label class="form-label" for="no_of_page">no_of_page :</label>
                            <span class="error">*<?php echo $parr; ?></span>
                            <div class="form-outline">
                                <input type="text" name="no_of_page" id="no_of_page" class="form-control" value="<?php if (isset($_POST['no_of_page'])) {
                                                                                                                        echo $_POST['no_of_page'];
                                                                                                                    } else {
                                                                                                                        echo $arr['no_of_page'];
                                                                                                                    } ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 pb-2">
                            <label class="form-label" for="author">author :</label>
                            <span class="error">*<?php echo $aarr; ?></span>
                            <div class="form-outline">
                                <input type="text" name="author" id="author" class="form-control" value="<?php if (isset($_POST['author'])) {
                                                                                                                echo $_POST['author'];
                                                                                                            } else {
                                                                                                                echo $arr['author'];
                                                                                                            } ?>" />

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-2">
                            <label class="form-label" for="category">category :</label>
                            <span class="error">*<?php echo $carr; ?></span>
                            <div class="form-outline">
                                <input type="text" name="category" id="category" class="form-control" value="<?php if (isset($_POST['category'])) {
                                                                                                                    echo $_POST['category'];
                                                                                                                } else {
                                                                                                                    echo $arr['category'];
                                                                                                                } ?>" />

                            </div>
                        </div>
                        <div class="col-md-6 pb-2">
                            <label class="form-label" for="price">price :</label>
                            <span class="error">*<?php echo $prarr; ?></span>
                            <div class="form-outline">
                                <input type="text" name="price" id="price" class="form-control" value="<?php if (isset($_POST['price'])) {
                                                                                                            echo $_POST['price'];
                                                                                                        } else {
                                                                                                            echo $arr['price'];
                                                                                                        } ?>" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-2">
                            <label class="form-label" for="released_year">released_year :</label>
                            <span class="error">*<?php echo $yarr; ?></span>
                            <div class="form-outline">
                                <input type="text" name="released_year" id="released_year" class="form-control" value="<?php if (isset($_POST['released_year'])) {
                                                                                                                            echo $_POST['released_year'];
                                                                                                                        } else {
                                                                                                                            echo $arr['released_year'];
                                                                                                                        } ?>" />
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <h6 class="mb-2 pb-1">status: </h6>
                            <span class="error">*<?php echo $sarr; ?></span>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="1" <?php if ($_POST['status'] == '1') {
                                                                                                                        echo "checked='checked'";
                                                                                                                    } else {
                                                                                                                        if ($arr['status'] == "1") {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?> />
                                <label class="form-check-label" for="status">on</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status" value="0" <?php if ($_POST['status'] == '0') {
                                                                                                                        echo "checked='checked'";
                                                                                                                    } else {
                                                                                                                        if ($arr['status'] == '0') {
                                                                                                                            echo 'checked';
                                                                                                                        }
                                                                                                                    } ?> />
                                <label class="form-check-label" for="status">off</label>
                            </div>
                            <!-- <label id="status-error" class="error" for="status">enter status</label> -->
                            <br>
                        </div>
                    </div>



                    <div class="pt-3 d-flex justify-content-center">
                        <?php if (!$editId) { ?>
                            <button class="btn btn-lg btn-dark" name="addBook" type="submit">Add Book</button>
                        <?php } else { ?>
                            <button class="btn btn-lg btn-dark" name="update" type="submit">Update</button>
                        <?php } ?>
                    </div>
                </form>

            </div>
        </section>
    </div>
</div>

<script>
    $(document).ready(function()
    {

        //   insert and update
  $("#addForm").validate({
    // onsubmit: false,
    // focusInvalid: false,
    // onfocusout: false,
    rules: {
      book_name: {
        required: true,
        alpha: true,
      },
      description: {
        required: true,
      },
      no_of_page: {
        required: true,
        number: true
      },
      author: {
        required: true,
        alpha: true,
      },
      category: {
        required: true,
        alpha: true,
      },
      price: {
        required: true,
        number: true
      },
      released_year: {
        required: true,
        maxlength: 4,
      },
      status: {
        required: true,
      },
    },
    messages: {
      book_name: {
        required: "please enter  book name",
        alpha: "letter only",

      },
      description: {
        required: "enter book description 3-20 characters",
      },
      no_of_page: {
        required: " enter no_page",
        number: "only digit accepet"
      },
      author: {
        required: " enter author",
        alpha: "letter only",
      },
      category: {
        required: "enter category",
        alpha: "letter only",
      },
      price: {
        required: "enter price",
        number: "only digit accepet"
      },
      released_year: {
        required: "enter released_year",
        maxlength: "4 length",
      },
      status: {
        required: "enter status",
      },
    },
  });

    });
</script>