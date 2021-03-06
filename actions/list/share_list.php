<?php
require_once(dirname(__FILE__) . "/../../includes/common/only_allow_login.php");
verifyCSRF();

require_once(dirname(__FILE__) . "/../../includes/common/check_request.php");
verifyAttributes($_POST, ["todoListId"]);

require_once(dirname(__FILE__) . "/../../classes/TodoList.php");
require_once(dirname(__FILE__) . "/../../classes/Project.php");

$result = array("success" => false);

$todoList = new TodoList;
if ($todoList->load($_POST["todoListId"])) {
	if ($todoList->verifyOwnership($_SESSION["userId"])) {
		if($todoList->share()){
			$result["success"] = true;
			$result["link"] = $todoList->link;
		}else{
			$result["errors"] = array("Internal error");
		}
	} else {
		$result["errors"] = array("User has no permission to access Todo List");
	}
} else {
	$result["errors"] = array("Could not load Todo List");
}

echo json_encode($result);