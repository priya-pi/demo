<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <?php for ($i = 1; $i <= $pagi; $i++) {
            if ($current_page == $i) {    ?>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous"><?php echo $i; ?></a>
                </li>

            <?php } else { ?>

                <li class="page-item">
                    <a class="page-link" href="?start=<?php echo $i; ?>" aria-label="Previous"><?php echo $i; ?></a>
                </li>

        <?php }} ?>

        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>