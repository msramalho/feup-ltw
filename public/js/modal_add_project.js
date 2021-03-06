document.addEventListener('keydown', (e) => { //on keyboard press
	if (e.ctrlKey && e.keyCode == 80) { //Ctrl+p -> open modal (new project)
		document.getElementById("openAddProject").click();
		e.preventDefault();
	}
});

let newProjectForm = document.getElementById("modalAddProject");

newProjectForm.addEventListener("submit", function (e) {
	let formData = new FormData(newProjectForm);
	let data = {};
	for (let [key, value] of formData.entries()) {
		data[key] = value;
	}
	request("actions/project/add_project.php", function (data) {
		console.log(data);
		if (data.success) {
			newProjectForm.style.display = "none";
			newProjectForm.reset();
			location.reload();
		} else {
			addErrorMessage(newProjectForm, data.errors);
		}
	}, data, "post");
	e.preventDefault();
}, false);