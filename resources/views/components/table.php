<?php
    $last_element = end($items);
?>

<table>
    <thead>
        <?php foreach($table_header as $value): ?>
            <th class="py-20"><?= $value ?></th>
        <?php endforeach; ?>
    </thead>
    <tbody>
        <?php foreach($items as $category): ?>
            <?php
                // if the current element in the loop is the last item in the array then add the last class;
                $class = $last_element === $category ? "last" : "";  
            ?>
            <tr>
                <td class="<?= $class?>">
                    <?= $category['name'] ?>
                </td>
                <td class="<?= $class?>">
                    <button class="modify-btn" value="<?= $category['id'] ?>">
                        <img src="../../img/write-svgrepo-com.svg" alt="modify icon">
                    </button>
                    <button class="delete-btn" value="<?= $category['id'] ?>">
                        <img src="../../img/delete.svg" alt="delete-icon">
                    </button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>