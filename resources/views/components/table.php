<?php

require_once "../../../app/util/functions.php";
$current_view = get_current_view();  // getting the name of the current view

$last_element = end($items); // getting the last element in the array;

$description_index = array_search("Description", $table_header); // get the position (index) of the description
?>

<div class="table-container">
    <div class="table-controllers">
        <button id="add-btn" class="add-btn"> <!-- button to add new elements to the table -->
            <img src="../../img/plus-svgrepo-com.svg" alt="plus icon"> Add
        </button>
        <div>
            Show
            <select name="limit" id="limit">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
            entries
        </div>
    </div>
    <table id="table">
        <thead>
            <tr>
                <?php foreach ($table_header as $value): ?>
                    <th class="py-20">
                        <?= $value ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <!-- if the current element in the loop is the last item in the array then add the last class; because we want each td to have a border-bottom except for the td in the last tr of the table -->
                <?php $class = $last_element === $item ? "last" : ""; ?>
                <tr>
                    <?php
                    $indexed_item = array_values($item); // turn the assoc array into the indexed  array
                    array_shift($indexed_item); // removing the first element which is the id, we are not going to show the id of each record in the table;
                    ?>
                    <?php for ($i = 0; $i < count($indexed_item); $i++): ?>
                        <!-- if the current iteration is showing the description then put the description in a hidden <td> to use it later and skip the currenct iteration -->
                        <?php if (!empty($description_index) && ($i === $description_index)): ?>
                            <td class="<?= $class ?>" style="display:none">
                                <p>
                                    <?= htmlspecialchars($indexed_item[$i]) ?>
                                </p>
                            </td>
                            <?php continue; endif; ?>

                        <td class="<?= $class ?>">
                            <p>
                                <?= htmlspecialchars($indexed_item[$i]) ?>
                            </p>
                        </td>

                    <?php endfor; ?>
                    <td class="<?= $class ?>">
                        <?php if ($current_view === "products"): ?>
                            <button class="info-btn" id="info-btn" value="<?= $item['id'] ?>" title="info">
                                <img src="../../img/info.svg" alt="info icon">
                            </button>
                        <?php endif; ?>
                        <button class="modify-btn" id="modify-btn" value="<?= $item['id'] ?>" title="modify">
                            <img src="../../img/update.svg" alt="modify icon">
                        </button>
                        <button class="delete-btn" id="delete-btn" value="<?= $item['id'] ?>" title="delete">
                            <img src="../../img/delete.svg" alt="delete icon">
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- pagination -->
    <div class="pagination">
        <button class="pagination-btn previous" id="previous">
            <img src="../../img/less-than.svg" alt="previous icon">
        </button>
        <p class="pagination-btn" id="page">1</p>
        <button class="pagination-btn next" id="next">
            <img src="../../img/greater-than.svg" alt="next icon">
        </button>
    </div>
</div>