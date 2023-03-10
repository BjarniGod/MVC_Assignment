<?php include('view/header.php') ?>

<?php if($categories) { ?>
    <section id="list" class="list">
        <header>
            <h2>Category List</h2>
        </header>
        <?php foreach($categories as $category): ?>
            <?php if($category['categoryID'] != -1) { ?>
            <div class="list_row">
                <div class="list_item">
                    <p><?= $category['categoryName'] ?></p>
                </div>
                <div class="list_removed">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" value="<?= $category['categoryID'] ?>">
                        <button>Remove</button>
                    </form>
                </div>
            </div>
            <?php } ?>
        <?php endforeach ?>
    </section>
    
<?php } else { ?>
    <p>No categories exist yet.</p>
<?php } ?>

<section>
    <h2>Add Category</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_category">
        <div class="add__inputs">
            <label>Category Name:</label>
            <input type="text" name="category_name" maxlength="30" placeholder="Category Name" autofocus required>

        </div>
        <div class="add__addItem">
            <button class="add-button">Add Category</button>
        </div>
    </form>
</section>
<p><a href=".?action=list_todos">View To Do List</a></p>

<?php include('view/footer.php') ?>