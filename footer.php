
<script>
    // sweert alert with ajax:
    function confirmDelete(id) {

        swal("Are you sure you want to delete a book no: ?" + id, {
            dangerMode: true,
            buttons: true,
            icon: "warning",
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "delete.php",
                    type: "get",
                    data: {
                        delete_id: id
                    },
                    dataType: "html",
                    success: function(data) {


                        if (window.location.href != "http://localhost/demo/serverSide.php") {

                            window.location.href = 'display.php';
                        } 
                        // else {
                        //     // $('#myTable').DataTable().ajax.reload();

                        // }
                    }
                });
            }
        });
    }

    // toster js for msg :
    $(document).ready(function() {

        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",

        }

        var deletevar = "<?php echo $_SESSION['delete'] ?>";
        if (deletevar == true) {
            toastr.error("<?= $_SESSION['delmsg']; ?>");
            <?php
            unset($_SESSION['delete']);
            unset($_SESSION['delmsg']);
            ?>
        }
        var insert = "<?php echo $_SESSION['insert'] ?>";
        if (insert == true) {
            toastr.success("<?= $_SESSION['message']; ?>");
            <?php
            unset($_SESSION['insert']);
            unset($_SESSION['message']);
            ?>
        }
        var update = "<?php echo $_SESSION['update'] ?>";
        if (update == true) {
            toastr.success("<?= $_SESSION['updatemsg']; ?>");
            <?php
            unset($_SESSION['update']);
            unset($_SESSION['updatemsg']);
            ?>
        }

        var statusDisplay = "<?php echo $_SESSION['statusDisplay'] ?>";
        if (statusDisplay == true) {
            toastr.success("<?= $_SESSION['msgDisplay']; ?>");
            <?php
            unset($_SESSION['statusDisplay']);
            unset($_SESSION['msgDisplay']);
            ?>
        }
    });

    //  /// for status code
    $('input[name=status]').click(function() {
        var id = $(this).attr('id');
        var status = $(this).val();
        if (status == 1) {
            status = 0;
        } else {
            status = 1;
        }
        $.ajax({
            type: 'GET',
            url: 'updateStatus.php',
            data: 'id=' + id + '&status=' + status,
            success: function() {
                location.reload();
            }
        });
    });

    function selectId() {

        var length = document.getElementById("length").value;
        var sql = '';
        if (length) {
            sql = sql + '&length=' + length;
        }
        location.href = 'display.php?' + sql;
    }
</script>