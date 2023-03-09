<?php include('view/header.php') ?>



<section id="add" class="add">
    <h2>Add Tasks</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_todo">
        <div class="add__inputs">
            <label>Category:</label>
            <select name="category_id" required>
                <option>Please Select the Category</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category['categoryID'] ?>">
                        <?= $category['categoryName'] ?>    
                    </option>
                <?php endforeach ?>
            </select>
            <label>Title</label>
            <input type="text" name="title" maxlength="120" Placeholder="Task Title" required>
            <label>Description</label>
            <input type="text" name="description" maxlength="120" Placeholder="Task Description" required>
        </div>
        <div class="add__addItem">
            <button>Add Task</button>
        </div>
    </form>
</section>

<p>
    <a href=".?action=list_todos">View To Do List</a>
</p>

<?php
include('view/footer.php')
?>