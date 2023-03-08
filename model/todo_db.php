<?php

function get_todos() {
    global $db;
    $query = 'SELECT *
        FROM todoitems
        ORDER BY ItemNum';

    $statement = $db->prepare($query);
    $statement->execute();
    $todos = $statement->fetchAll();
    $statement->closeCursor();
    return $todos;
}

function get_todo_title($item_number) {
    if (!$course_id) {
        return "All Courses";
    }
    global $db;
    $query = 'SELECT * 
    FROM courses 
    WHERE ItemNum = :item_number';

    $statement = $db->prepare($query);
    $statement->bindValue(':item_number', $item_number);
    $statement->execute();
    $title = $statement->fetch();
    $statement->closeCursor();
    $title = $todo['Title'];
    return $title;
}

function delete_todo($item_number) {
    global $db;
    $query = 'DELETE FROM todoitems WHERE ItemNum = :item_number';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_number', $item_number);
    $statement->execute();
    $statement->closeCursor();
}

function add_todo($title, $description) {
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description) VALUE (:title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

?>