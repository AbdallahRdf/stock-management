<table>
    <thead>
        <?php foreach($table_header as $value): ?>
            <th class="py-20"><?= $value ?></th>
        <?php endforeach; ?>
    </thead>
    <tbody>
        <?php foreach($items as $category): ?>
            <tr>
                <td><?= $category['name'] ?></td>
                <td>
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