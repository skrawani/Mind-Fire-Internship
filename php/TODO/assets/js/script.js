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
        }" class="m-card ${obj.isComp === "1" ? "m-disabled" : ""} ">
        <div class="row flex-row py-3 p-md-3 p-lg-3  border-bottom ">
            <div class="row justify-content-around icons col-2 col-md-1 col-lg-1 mr-2" style="height: 100%">
            <input type="checkbox" name="isComp" onchange="onClickCheckBox(this)" ${
              obj.isComp === "1" ? "checked" : ""
            }  />
            <input type="checkbox" class="star" name="isFav"  onchange="onClickCheckBox(this)" ${
              obj.isFav === "1" ? "checked" : ""
            } />
            </div>
            <a class="task col-6 overflow-auto col-md-9 col-lg-10  text-decoration-none text-dark ${
              obj.isComp === "1" ? "strike-through" : ""
            }  "   data-toggle="collapse" href="#collapse-${
          obj.id
        }" role="button" >
              ${obj.msg}
            </a>
            <div class="col-4 col-md-2 col-lg-1 d-flex flex-row justify-content-end">
              <button class="btn edit icons fas fa-eye" type="button" data-toggle="collapse" data-target="#collapse-${
                obj.id
              }" ></button>
              <button class="btn edit icons far fa-edit" data-toggle="modal"
              data-target="#exampleModal" onClick="handleModal(this)" ></button>
              <button class="btn delete icons far fa-trash-alt" onClick="deleteTask(this)"></button>
            </div>
        </div>
        <div class="mt-2 collapse border-bottom" id="collapse-${obj.id}">
              <div class="card card-body description border-0 ${
                obj.description === "" ? "text-muted " : ""
              }">
                ${
                  obj.description === ""
                    ? "No description available!"
                    : obj.description
                }
              </div>
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
  let id = ele.closest(".m-card").id.slice(5);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("DELETE", "./backend/utils/deleteTask.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      console.log(JSON.parse(xmlhttp.responseText));
      loadTasks();
    }
  };
  var vars = "id=" + id;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Function to Handle check for Task Completion
const onClickCheckBox = (ele) => {
  let key = ele.name;
  let id = ele.closest(".m-card").id.slice(5);
  // console.log("ID", ele.closest(".m-card"));
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "backend/utils/isTaskCompleted.php", true);
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let data = this.responseText;
      editTask(ele, key, data == "0" ? "1" : "0", id);
    }
  };
  let vars = "id=" + id + "&key=" + key;
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
      loadTasks();
    }
  };
  var vars = "task=" + task + "&isComp=0" + "&isFav=0";
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Helper Function for Editing a task for handling preprocessing
const handleEdit = (ele) => {
  let id = ele.closest(".m-card").id.slice(5);

  let spanEle = document.querySelector(`#task-${id} span`);
  // console.log(spanEle);
  ele.closest(".m-card").classList.add("special-card", "bg-warning");
  ele.closest(".m-card").setAttribute("disabled", true);
  document.getElementById("inp-add-task").value = spanEle.innerHTML.trim();
  document
    .getElementById("inp-add-task")
    .setAttribute("placeholder", "Edit task here...");
  document.getElementById("inp-add-task").parentNode.childNodes[3].value = id;
};

// Function to edit task in DB
const editTask = (
  ele,
  field = "msg",
  msg = false,
  id = null,
  field2 = null,
  msg2 = null
) => {
  msg = msg ? msg : ele.childNodes[1].value;
  id = id !== null ? id : ele.childNodes[3].value;

  // console.log(ele, field, msg, id, field2, msg2);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("PUT", "./backend/utils/editTask.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      console.log(JSON.parse(xmlhttp.responseText));
      loadTasks();
    }
  };
  var vars = "id=" + id + "&field=" + field + "&msg=" + msg;
  if (field2 !== null && msg2 !== null)
    vars += "&field2=" + field2 + "&msg2=" + msg2;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
  if (ele && ele.childNodes[1]) ele.childNodes[1].value = "";
};

const handleModal = (ele) => {
  // console.log(ele.closest(".m-card").childNodes[1].childNodes[3].innerHTML);
  let id = ele.closest(".m-card").id;
  let vid = id.slice(5);
  let title = document.querySelector(`#${id} a`).innerHTML.trim();
  let description = document
    .querySelector(`#${id} .description`)
    .innerHTML.trim();

  // console.log(document.querySelector(`#${id} .description`).innerHTML);
  document.getElementById("modalTitle").value = title;
  document.getElementById("modalDescription").value = description;
  document.getElementById("modalID").value = vid;

  // console.log(ele.closest(".m-card star"));
  // document.
};
const handleModalSubmit = () => {
  // console.log(e);
  let id = document.getElementById("modalID").value;
  let title = document.querySelector("#modalTitle").value;
  let description = document.getElementById("modalDescription").value;
  // console.log(id, title, description);
  editTask(null, "msg", title, id, "description", description);
  let closeBtn = document.querySelector("[data-dismiss=modal]");
  closeBtn.click();
};
