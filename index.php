<?php 
require('model/database.php');
require('model/todo_db.php');

$item_number = filter_input(INPUT_POST, "item_number", FILTER_VALIDATE_INT);
$title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
$description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);



$action = filter_input(INPUT_POST, "action", FILTER_UNSAFE_RAW);
if(!$action) {
    $action = filter_input(INPUT_GET, "action", FILTER_UNSAFE_RAW);
    if(!$action) {
        $action = 'list_todos';
    }
}

switch($action) {
    case "list_todos":
        $todos = get_todos();
        include('view/todo_list.php');
        break;

    case "add_todo":
        if($title && $description) {
        add_todo($title, $description);
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
    


    default:
        $title = get_todo_title($course_id);
        $todos = get_todos();
        include('view/todo_list.php');
}



?>

