<ol class="breadcrumb">
    <?php
    foreach ($breadcrumbArray as $item) {
        if (!empty($item['title'])) {
            if (!empty($item['url'])) {
                echo '<li><a href="' . $item['url'] . '">' . $item['title'] . '</a></li>';
            } else {
                echo '<li class="active"><strong>' . $item['title'] . '</strong></li>';
            }
        }
    }
    ?>
</ol>