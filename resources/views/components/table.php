<?php $last_element = end($items); ?> <!-- getting the last element in the array -->

<div class="table-container">
    <button id="add-btn" class="add-btn">
        <img src="../../../img/plus-svgrepo-com.svg" alt="plus icon"> Add
    </button>
    <table>
        <thead>
            <?php foreach ($table_header as $value): ?>
                <th class="py-20">
                    <?= $value ?>
                </th>
            <?php endforeach; ?>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <!-- if the current element in the loop is the last item in the array then add the last class; -->
                <?php $class = $last_element === $item ? "last" : ""; ?>
                <tr>
                    <?php $indexed_item = array_values($item) ?> <!-- turn the assoc array into the indexed  array  -->
                    <?php for ($i = 1; $i < count($indexed_item); $i++): ?>
                        <td class="<?= $class ?>">
                            <?= htmlspecialchars($indexed_item[$i]) ?>
                        </td>
                    <?php endfor; ?>
                    <td class="<?= $class ?>">
                        <button class="modify-btn" value="<?= $item['id'] ?>" title="Modify">
                            <img src="../../../img/write-svgrepo-com.svg" alt="modify icon">
                        </button>
                        <button class="delete-btn" value="<?= $item['id'] ?>" title="Delete">
                            <img src="../../../img/delete.svg" alt="delete-icon">
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>