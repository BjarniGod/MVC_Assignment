<?php

function get_todos_by_category($category_id){
    global $db;
    if($category_id) {
        $query = 'SELECT A.ItemNum, A.Title, A.Description, C.categoryName, C.categoryID 
        FROM todoitems A 
        LEFT JOIN categories C 
        ON A.categoryID = C.categoryID 
        WHERE A.categoryID = :category_id
        ORDER BY A.categoryID';
    } else {
        $query = 'SELECT A.ItemNum, A.Title, A.Description, C.categoryName, C.categoryID 
        FROM todoitems A 
        LEFT JOIN categories C 
        ON A.categoryID = C.categoryID 
        ORDER BY A.categoryID';
    }
    $statement = $db->prepare($query);
    if($category_id) {
    $statement->bindValue(':category_id', $category_id);
    }
    $statement->execute();
    $todos = $statement->fetchAll();
    $statement->closeCursor();
    return $todos;
}

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
    if (!$item_number) {
        return "All Tasks";
    }
    global $db;
    $query = 'SELECT * 
    FROM todoitems 
    WHERE ItemNum = :item_number';

    $statement = $db->prepare($query);
    $statement->bindValue(':item_number', $item_number);
    $statement->execute();
    $todo = $statement->fetch();
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

function add_todo($title, $description, $category_id) {
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description, categoryID) VALUE (:title, :description, :category_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_todo_noc($title, $description) {
    global $db;
    $query = 'INSERT INTO todoitems (Title, Description) VALUE (:title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

?>