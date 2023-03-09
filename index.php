<?php 
require('model/database.php');
require('model/todo_db.php');
require('model/category_db.php');

$item_number = filter_input(INPUT_POST, "item_number", FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
$description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
$category_name = filter_input(INPUT_POST, "category_name", FILTER_UNSAFE_RAW);

$category_id = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
if(!$category_id) {
    $category_id = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, "action", FILTER_UNSAFE_RAW);
if(!$action) {
    $action = filter_input(INPUT_GET, "action", FILTER_UNSAFE_RAW);
    if(!$action) {
        $action = 'list_todos';
    }
}

switch($action) {
    case "list_todoss":
        $categories = get_categories();
        $todos = get_todos();
        include('view/todo_list.php');
        break;

    case "add_todo":
        if($title && $description) {
            if(!$category_id)
                $category_name = "None";
            add_todo($title, $description, $category_id);
            header("Location: .?action=list_todos");
        } else {
            $error_message = "Invalid assignment data. Check all the fields and try again!";
            include('view/error.php');
            exit();
        }
    
    case "delete_todo":
        if($item_number) {
            delete_todo($item_number);
            header("Location: .?action=list_todos");
        } else {
            $error_message = "Missing or incorrect item number!";
            include('view/error.php');
        }
        break;

    case "add_todo_page":
        $categories = get_categories();
        include('view/adding_task.php');
        break;
    
    case "list_categories":
        $categories = get_categories();
        include('view/category_list.php');
        break;

    case "add_category":
        if($category_name) {
            add_category($category_name);
            $categories = get_categories();
            header("Location: .?action=list_categories");
        } else {
            $error_message = "Missing Category name";
            include('view/error.php');
        }
        break;

    case "delete_category":
        if($category_id) {
            try {
            delete_category($category_id);
            } catch (PDOException $e) {
                $error_message = "You cannot delete a category if tasks exists in it!";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_categories");
        } else {
            $error_message = "Not able to !";
            include('view/error.php');
        }
        break;


    default:
        $category_name = get_category_name($category_id);
        $categories = get_categories();
        $todos = get_todos_by_category($category_id);
        include('view/todo_list.php');
}



?>

