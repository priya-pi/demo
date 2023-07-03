<?php

include 'config.php';
include 'header.php';


if (!isset($_SESSION['id'])) {
    header('location:login.php');
}
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_COOKIE['id'];
}


?>

<!-- edit modal -->

<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" class="" action="#" id="modalForm">
                    <input type="hidden" id="id" name="" value="">

                    <div class="row">
                        <div class="col-md-12 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="book_name">bookName :</label>
                                <span id="name_error" class="error" value="">*</span>
                                <input type="text" name="name" id="name" class="form-control" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="desc">description :</label>
                                <span id="desc_error" class="error" value="">*</span>
                                <input type="text" class="form-control" name="desc" id="desc">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-2">
                            <div class="form-outli ne">
                                <label class="form-label" for="no_of_page">no_of_page :</label>
                                <span id="page_error" class="error" value="">*</span>
                                <input type="text" name="no_of_page" id="no_of_page" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="author">author :</label>
                                <span id="author_error" class="error" value="">*</span>
                                <input type="text" name="author" id="author" class="form-control" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="category">category :</label>
                                <span id="category_error" class="error" value="">*</span>
                                <input type="text" name="category" id="category" class="form-control" value="" />
                            </div>
                        </div>
                        <div class="col-md-6 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="price">price :</label>
                                <span id="price_error" class="error" value="">*</span>
                                <input type="text" name="price" id="price" class="form-control" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 pb-2">
                            <div class="form-outline">
                                <label class="form-label" for="released_year">released_year :</label>
                                <span id="year_error" class="error" value="">*</span>
                                <input type="text" name="released_year" id="released_year" class="form-control" value="" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="save">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- delete -->
<div class="modal" tabindex="-1" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" class="" id="">
                    <input type="text" id="delete_id">
                    <p>Are you sure u want delete data?</p>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="confrimDelete">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid back p-2 justify-content-center mt-4">
    <div class="mt-5 p-3 mb-5">
        <h3 class="text-center p-3 theme">serverBook Details</h3>

        <div class="mb-3">
            <!-- <a href="creatBook.php" class="btn btn-success">Add</a> -->
            <a href="logout.php" class="btn btn-danger">Logout</a>
            <a href="display.php" class="btn btn-primary">display</a>
        </div>
        <table class="table table-light" id="myTable">
            <thead class="table">
                <tr>
                    <th>book_id</th>
                    <th>book_name</th>
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
        </table>
    </div>
</div>

<script>
    var table = '';
    $(document).ready(function() {

        table = $('#myTable').dataTable({

            "bProcessing": false,
            "serverSide": true,
            "searchable": true,
            "orderable": true,
            "ajax": {
                url: "getdata.php",
                type: "POST"
            },
            "columns": [

                {
                    "data": "book_id"
                },
                {
                    "data": "book_name"
                },
                {
                    "data": "description"
                },
                {
                    "data": "no_of_page"
                },
                {
                    "data": "author"
                },
                {
                    "data": "category"
                },
                {
                    "data": "price"
                },
                {
                    "data": "released_year"
                },
                {
                    "data": "status"
                },
                {
                    "data": "action"
                },
            ],
            'columnDefs': [{
                'targets': [8, 9], // disable column for sorting
                'orderable': false, // set orderable false for selected columns
            }],
            'lengthMenu': [
                [5, 10, 25, -1],
                [5, 10, 25, 'All'],
            ],

        });


        // modal
        $.validator.addMethod(
            "alpha",
            function(value, element) {
                return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
                // --
            }
        );

        // modal form
        $("#modalForm").validate({
            rules: {
                name: {
                    required: true,
                    alpha: true
                },
                desc: {
                    required: true,
                },
                no_of_page: {
                    required: true,
                    number: true
                },
                author: {
                    required: true,
                    alpha: true
                },
                category: {
                    required: true,
                    alpha: true
                },
                price: {
                    required: true,
                    number: true
                },
                released_year: {
                    required: true,
                    maxlength: 4
                }
            },
            messages: {
                name: {
                    required: "please enter  book name",
                    alpha: "letter only",
                },
                desc: {
                    required: "enter some description about book",
                },
                no_of_page: {
                    required: " enter no_page",
                    number: "only digit accepet",
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
                    number: "only digit accepet",
                },
                released_year: {
                    required: "enter released_year",
                    maxlength: "4 length year",
                },
            },
        });
    });

    //  edit value:
    function editData(id) {

        $.ajax({
            url: "editData.php",
            type: "get",
            dataType: "json",
            data: {
                id: id,
            },
            success: function(data) {

                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#desc').val(data.description);
                $('#no_of_page').val(data.no_of_page);
                $('#category').val(data.category);
                $('#author').val(data.author);
                $('#price').val(data.price);
                $('#released_year').val(data.released_year);

                $('#edit').modal('show');
            }
        });
    }

    function deleteData(id) {

        swal("Are you sure you want to delete a book?", {
            dangerMode: true,
            buttons: true,
            icon: "warning",
        }).then(function(isConfirm) {

            if (isConfirm) {

                $.ajax({
                    url: "delete.php?server=true",
                    type: "get",
                    dataType: 'JSON',
                    data: {
                        delete_id: id
                    },
                    success: function(data) {

                        toastr.options = {
                            "closeB utton": true,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "timeOut": "3000",

                        }

                        if (data.deleteServer == true) {
                            toastr.error(data.serverMsg);
                        }
                        $('#myTable').DataTable().ajax.reload();
                    }
                });
            }
        });
    }

    // update data :
    $(document).on('click', '#save', function(e) {

        e.preventDefault();
        if ($("#modalForm").valid() == true) {
            // debugger
        } else {
            return false;
        }
        var id = $('#id').val();
        var name = $('#name').val();
        var desc = $('#desc').val();
        var no_of_page = $('#no_of_page').val();
        var author = $('#author').val();
        var category = $('#category').val();
        var price = $('#price').val();
        var released_year = $('#released_year').val();

        $.ajax({
            url: "updateData.php",
            type: "post",
            dataType: 'json',
            data: {
                id: id,
                name: name,
                desc: desc,
                no_of_page: no_of_page,
                author: author,
                category: category,
                price: price,
                released_year: released_year
            },
            success: function(resp) {

                console.log(resp)
                if (resp.success == false) {
                    if (resp.error.name != "") {
                        $('#name_error').html(resp.error.name);
                    }
                    if (resp.error.desc != "") {
                        $('#desc_error').html(resp.error.desc);
                    }
                    if (resp.error.no_of_page != "") {
                        $('#page_error').html(resp.error.no_of_page);
                    }
                    if (resp.error.author != "") {
                        $('#author_error').html(resp.error.author);
                    }
                    if (resp.error.category != "") {
                        $('#category_error').html(resp.error.category);
                    }
                    if (resp.error.price != "") {
                        $('#price_error').html(resp.error.price);
                    }
                    if (resp.error.released_year != "") {
                        $('#year_error').html(resp.error.released_year);
                    }


                } else {
                    toastr.options = {

                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "timeOut": "3000",
                    }

                    if (resp.updateServer == true) {
                        toastr.success(resp.serverMsg);
                    }

                    $('#edit').modal('hide');
                    $('#myTable').DataTable().ajax.reload();

                }



            }
        });

    });

    // status changed :
    function statusData(id, value) {

        var status = value;
        var dataid = id;

        if (status == 1) {
            status = 0;

        } else {
            status = 1;
        }
        $.ajax({

            type: 'GET',
            url: 'updateStatus.php',
            data: 'id=' + dataid + '&status=' + status + '&server=' + true,
            dataType: 'JSON',
            success: function(data) {

                toastr.options = {
                    "closeButton": true,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000",

                }

                if (data.statusServer == true) {
                    toastr.success(data.statusMsg);
                }
                $('#myTable').DataTable().ajax.reload();
            }
        });
    }
</script>