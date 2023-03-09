<?php include('header.php') ?>

<!-- <?php if(!$todos) { ?>
    <p>No tasks exist yet.</p>
<?php } ?> -->

<section id="list" class="list">
    <header>
        <h1>Tasks</h1>
        <form action="." method="get" id="list_header_select" class="list__header__select">
            <input type="hidden" name="action" value="list_todos">
            <select name="category_id" required>
                <option value="0">View All</option>
                <?php foreach($categories as $category) : ?>
                    <?php if($category_id == $category['categoryID']) { ?>
                        <option value="<?= $category['categoryID'] ?>" selected>
                    <?php } else { ?>
                        <option value="<?= $category['categoryID'] ?>">
                    <?php } ?>
                    <?= $category['categoryName'] ?>
                    </option>
                    <?php endforeach; ?>

            </select>
            <button>GO</button>
        </form>
    </header>
    
    <?php if($todos) { ?>
        <?php foreach($todos as $todo): ?>
            <div class="list__row">
                <div class="list__item">
                    <label class="title_label">Title</label>
                    <p><?= $todo['Title'] ?></p>
                    <label class="description_label">Description</label>
                    <p><?= $todo['Description'] ?></p>
                    <label class="category_label">Category</label>
                    <p><?= get_category_name($todo['categoryID']) ?></p>
                </div>
                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_todo">
                        <input type="hidden" name="item_number" value="<?= $todo['ItemNum'] ?>">
                        <button class="delete_assignment_button">X</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?>
        <br>
        <?php if($category_id) { ?>
            <p>No tasks exists for this category yet.</p>
        <?php } else { ?>
            <p>No tasks exist yet.</p>
            <?php } ?>
    <?php } ?>

</section>

<p><a href=".?action=add_todo_page">Click here</a> to add a new item to the list</p>
<p><a href=".?action=list_categories">View/Edit Categories</a></p>

<?php include('footer.php') ?> 