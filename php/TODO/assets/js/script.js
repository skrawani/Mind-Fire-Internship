// To load Tasks from Db and display them using DOM
const loadTasks = () => {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById("taskCard").innerHTML = "";
      data.forEach((obj) => {
        document.getElementById("taskCard").innerHTML += `<div id="task-${
          obj.id
        }" class="row flex-row py-3 p-md-3 p-lg-3 border-bottom ${
          obj.isComp === "1" ? "m-disabled" : ""
        } ">
        <div class="icons col-2 col-md-1 col-lg-1" style="height: 100%">
          <input type="checkbox"  onchange="onClickCheckBox(this)" ${
            obj.isComp === "1" ? "checked" : ""
          }  />
        </div>
        <span class="task col-6 overflow-auto col-md-9 col-lg-10  ${
          obj.isComp === "1" ? "strike-through" : ""
        }  ">
          ${obj.msg}
        </span>
        <div class="col-4 col-md-2 col-lg-1 d-flex flex-row justify-content-end">
          <button class="btn edit icons far fa-edit" onClick="handleEdit(this)" ></button>
          <button class="btn delete icons far fa-trash-alt" onClick="deleteTask(this)"></button>
        </div>
      </div>`;
      });
    }
  };
  xhttp.open("GET", "backend/utils/loadTasks.php", true);
  xhttp.send();
};

// Function to Delete a Task
const deleteTask = (ele) => {
  let id = ele.parentNode.parentNode.id.slice(5);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("DELETE", "./backend/utils/deleteTask.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      console.log(JSON.parse(xmlhttp.responseText));
    }
    loadTasks();
  };
  var vars = "id=" + id;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Function to Handle check for Task Completion
const onClickCheckBox = (ele) => {
  let id = ele.parentNode.parentNode.id.slice(5);
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "backend/utils/isTaskCompleted.php", true);
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = this.responseText;
      editTask(ele, "isComp", data == "0" ? "1" : "0", id);
    }
  };
  let vars = "id=" + id;
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(vars);
};

// Function to handle Tasnk Submit and call edit function if it's a edit or call insert function otherwise
const handleSubmit = (e) => {
  if (e.childNodes[1].value == "") {
    document
      .getElementById("inp-add-task")
      .setAttribute("placeholder", "Task name can't be empty...");
    document.getElementById("inp-add-task").classList.add("text-danger");
    return false;
  }
  if (e.childNodes[3].value === "-1") {
    addTask(e);
  } else {
    editTask(e);
  }
  e.childNodes[3].value = "-1";
  document
    .getElementById("inp-add-task")
    .setAttribute("placeholder", "Enter task here...");
  document.getElementById("inp-add-task").classList.remove("text-danger");
};

// Function to insert task into DB
const addTask = (e) => {
  let task = document.getElementById("inp-add-task").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "./backend/utils/addTask.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      console.log(JSON.parse(xmlhttp.responseText));
      document.getElementById("inp-add-task").value = "";
    }
    loadTasks();
  };
  var vars = "task=" + task + "&isComp=0" + "&isFav=0";
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Helper Function for Editing a task for handling preprocessing
const handleEdit = (ele) => {
  let id = ele.parentNode.parentNode.id.slice(5);
  let spanEle = document.querySelector(`#task-${id} > span`);
  spanEle.parentNode.classList.add("special-card", "bg-warning");
  spanEle.parentNode.setAttribute("disabled", true);
  document.getElementById("inp-add-task").value = spanEle.innerHTML.trim();
  document
    .getElementById("inp-add-task")
    .setAttribute("placeholder", "Edit task here...");
  document.getElementById("inp-add-task").parentNode.childNodes[3].value = id;
};

// Function to edit task in DB
const editTask = (ele, field = "msg", msg = false, id = null) => {
  msg = msg ? msg : ele.childNodes[1].value;
  id = id !== null ? id : ele.childNodes[3].value;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("PUT", "./backend/utils/editTask.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      console.log(JSON.parse(xmlhttp.responseText));
    }
    loadTasks();
  };
  var vars = "id=" + id + "&field=" + field + "&msg=" + msg;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
  if (ele.childNodes[1]) ele.childNodes[1].value = "";
};
