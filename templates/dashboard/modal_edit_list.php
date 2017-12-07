<?php
require_once(dirname(__FILE__) . "/../../includes/common/only_allow_login.php");
require_once(dirname(__FILE__) . "/../../classes/Project.php");

//if a get project id is set, that is the default one
if (isset($_GET['projectId'])) {
	$selectedProjectId = $_GET['projectId'];
}else{
	$selectedProjectId = 0;
}
//load projects if needed
if(!isset($projects) && !is_array($projects)){
	$projects = Project::getAllByUser($_SESSION["userId"]);
}
if(count($projects) == 0 || (count($projects) && $projects[0]->projectId != "0")){
	//create default project
	$projects = array_merge(array(new Project("0", "Private (No Project)")), $projects);
}
?>

<form class="modal modalEditList" opener="openEditListModal-<?= $todo->todoListId ?>" id ="modalEditList-<?= $todo->todoListId ?>">
	<div class="errors"></div>
	<div class="modalContent cardForm grid">
		<div class="formHeader">
			<h3 class="formTitle">Edit Todo List</h3>
		</div>
		<div class="formBody">
			<input type="hidden" name="todoListId" value="<?= $todo->todoListId ?>">
			<div>
				<input type="text" name="title" id="title" placeholder="List title" value="<?= htmlentities($todo->title) ?>" required>
			</div>
			<div>
				<input type="text" name="tags" id="tags" placeholder="Tags (Comma separate)" value="<?= $todo->tags ?>">
			</div>
			<div>
				<select name="projectId">
					<?php foreach ($projects as $p): ?>
						<option value="<?= $p->projectId ?>"><?= htmlentities($p->title) ?></option>
					<?php endforeach ?>
				</select>
			</div>
			<div>
				<select name="colour" value="<?= $todo->colour ?>">
					
					<option class="white" value="white">White</option>
					<option class="red" value="red">Red</option>
					<option class="orange" value="orange">Orange</option>
					<option class="yellow" value="yellow">Yellow</option>
					<option class="green" value="green">Green</option>
					<option class="teal" value="teal">Teal</option>
					<option class="blue" value="blue">Blue</option>
					<option class="purple" value="purple">Purple</option>
					<option class="pink" value="pink">Pink</option>
					<option class="brown" value="brown">Brown</option>
				</select>
			</div>
		</div>
		<footer class="formFooter">
			<input type="submit" value="Edit">
		</footer>
	</div>
</form>