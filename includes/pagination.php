<strong class="" style="color:#007bff">Pages:</strong> &nbsp;&nbsp;&nbsp;
<ul class="pagination mt-1">
    <style>
        .new-page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #007bff;
            background-color: #0f0f0f;
            border: 1px solid #dee2e6;
            border-top-color: rgb(222, 226, 230);
            border-right-color: rgb(222, 226, 230);
            border-bottom-color: rgb(222, 226, 230);
            border-left-color: rgb(222, 226, 230);
        }

        .new-page-link:hover {
            color: #0056b3;
            text-decoration: none;
            background-color: #e9ecef;
            border-color: #dee2e6;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #000;
            background-color: #00cf00;
            border-color: #dee2e6;
            /* border-color: #007bff; */
        }
    </style>
    <?php
    ///////////////// pagination links: perhaps put these BELOW where your results are echo'd out.
    if ($postnum > $limit) {

        $n = $pg + 1;
        $p = $pg - 1;
        $thisroot = $_SERVER['PHP_SELF'];
    }
    ?>
    <?php if ($pg > 1) : ?>
        <li class="page-item">
            <a class="new-page-link" href="<?php echo $thisroot; ?>?pg=<?php echo $p; ?>">
                << prev </a> </li> <?php endif; ?> <?php for ($i = 1; $i <= $num_pages; $i++) : ?> <?php if ($i != $pg) : ?> <li class="page-item">
                    <a class="new-page-link" href="<?php echo $thisroot; ?>?pg=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
        </li>
    <?php else : ?>
        <li class="page-item active">
            <span class="page-link"><?php echo $i; ?></span><span class="sr-only">(current)</span>
        </li>
    <?php endif; ?>
<?php endfor; ?>
<?php if ($pg < $num_pages) : ?>
    <li class="page-item"><a class="new-page-link" href="<?php echo $thisroot; ?>?pg=<?php echo $n; ?>">next >></a></li>
<?php endif; ?>
&nbsp;&nbsp;
</ul>