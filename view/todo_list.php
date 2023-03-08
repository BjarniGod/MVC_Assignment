<?php include('header.php') ?>

<?php if(!$todos) { ?>
    <p>No tasks exist yet.</p>
<?php } ?>

<section id="list" class="list">

    <?php foreach($todos as $todo): ?>
        <div class="list_row">
            <div class="list_item">
                <h2><?= $todo['Title'] ?></h2>
                <p><?= $todo['Description'] ?></p>
            </div>
            <div class="list_removed">
                <form action="." method="post">
                    <input type="hidden" name="action" value="delete_todo">
                    <input type="hidden" name="item_number" value="<?= $todo['ItemNum'] ?>">
                    <button>X</button>
                </form>
            </div>
        </div>
    <?php endforeach ?>
</section>

<section>
    <h2>Add Task</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_todo">
        <div class="add__inputs">
            <label>Task Name:</label>
            <input type="text" name="title" maxlength="20" placeholder="Task Name" required>
            <label>Description</label>
            <input type="text" name="description" maxlength="50" Placeholder="Task Description" required>
        </div>
        <div class="add__addItem">
            <button class="add-button">Add Task</button>
        </div>
    </form>
</section>



<?php include('footer.php') ?> 