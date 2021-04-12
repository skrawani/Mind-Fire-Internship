// Gloabal variable(state) to store Tasks Data
var globalData = [];

// Function to dispay task through DOM
const displayTask = () => {
  document.getElementById("taskCard").innerHTML = "";
  globalData.forEach((obj) => {
    document.getElementById("taskCard").innerHTML += `<div id="task-${
      obj.id
    }" class="m-card ${obj.isComp === "1" ? "m-disabled" : ""} ">
        <div class="row flex-row py-3 p-md-3 p-lg-3  border-bottom ">
           
            <a class="task row col-9 overflow-auto col-md-9 col-lg-10  text-decoration-none text-dark"  data-toggle="collapse" 
            href="#collapse-${obj.id}" role="button" >
             <span class="col-9 col-md-10 col-lg-10 "> ${obj.msg} </span>
             <span class="col-3 col-md-2 col-lg-2 px-0  btn btn-${
               obj.isFav === "1" ? "success" : "danger"
             }">${obj.isFav === "1" ? "" : "not a"}  priority </span>
            </a>
           
            <div class="col-4 col-md-2 col-lg-2 d-flex flex-row justify-content-end">
             
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
};

// To load Tasks from Db
const loadTask = () => {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState === 4 && this.status === 200) {
      let data = JSON.parse(this.responseText);
      globalData = data;
      displayTask();
    }
  };
  xhttp.open("GET", "./backend/controller/TaskController.php", true);
  xhttp.send();
};

// Function to Delete a Task
const deleteTask = (ele) => {
  let id = ele.closest(".m-card").id.slice(5);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("DELETE", "./backend/controller/TaskController.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      let res = JSON.parse(xmlhttp.responseText);
      let alertButtonContent = `<button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
        <span aria-hidden="true">&times;</span>
      </button>`;

      let alertColor = res.success === "1" ? "alert-warning" : "alert-danger";
      let alertEle = document.getElementById("myAlert");
      alertEle.innerHTML = res.message + alertButtonContent;
      alertEle.classList.add(alertColor);
      alertEle.classList.remove("d-none");
      setTimeout(() => {
        if (alertEle) alertEle.classList.add("d-none");
      }, 5000);
      search();
    }
  };
  var vars = "api=deleteTask" + "&id=" + id;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Function to insert task into DB
const addTask = () => {
  let title = document.querySelector("#modalTitle").value;
  let description = document.getElementById("modalDescription").value;
  let priority = document.getElementById("modalPriority").value;
  let isFav = priority === "yes" ? 1 : 0;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "./backend/controller/TaskController.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 201) {
      let res = xmlhttp.responseText;
      res = JSON.parse(res);
      let alertButtonContent = `<button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
        <span aria-hidden="true">&times;</span>
      </button>`;

      let alertColor = res.success === "1" ? "alert-success" : "alert-danger";
      let alertEle = document.getElementById("myAlert");
      alertEle.innerHTML = res.message + alertButtonContent;
      alertEle.classList.add(alertColor);
      alertEle.classList.remove("d-none");
      setTimeout(() => {
        if (alertEle) alertEle.classList.add("d-none");
      }, 5000);
      loadTask();
    }
  };

  var vars =
    "api=addTask" +
    "&task=" +
    title +
    "&description=" +
    description +
    "&isComp=0" +
    "&isFav=" +
    isFav;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Function to edit task in DB
const editTask = () => {
  let id = document.getElementById("modalID").value;
  let title = document.getElementById("modalTitle").value;
  let description = document.getElementById("modalDescription").value;
  let priority = document.getElementById("modalPriority").value;
  let isFav = priority === "yes" ? 1 : 0;

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("PUT", "./backend/controller/TaskController.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      let res = xmlhttp.responseText;

      res = JSON.parse(res);
      let alertButtonContent = `<button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
        >
        <span aria-hidden="true">&times;</span>
      </button>`;
      let alertColor = res.success === "1" ? "alert-primary" : "alert-danger";
      let alertEle = document.getElementById("myAlert");
      alertEle.innerHTML = res.message + alertButtonContent;
      alertEle.classList.add(alertColor);
      alertEle.classList.remove("d-none");
      setTimeout(() => {
        if (alertEle) alertEle.classList.add("d-none");
      }, 5000);
      search();
    }
  };
  var vars =
    "api=editTask" +
    "&id=" +
    id +
    "&task=" +
    title +
    "&description=" +
    description +
    "&isComp=0" +
    "&isFav=" +
    isFav;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Function to handle onlClick for Modal (Editting)
const handleModal = (ele) => {
  let id = ele.closest(".m-card").id;
  let vid = id.slice(5);
  let title = document.querySelector(`#${id} a > span`).innerHTML.trim();
  let description = document
    .querySelector(`#${id} .description`)
    .innerHTML.trim();
  let priority = document
    .querySelector(`#${id} a span:last-child`)
    .innerHTML.trim();
  document.getElementById("modalTitle").value = title;

  let priorityEle = document.getElementById("modalPriority");
  if (priority == "priority") {
    priorityEle.childNodes[1].setAttribute("selected", "selected");
    priorityEle.childNodes[3].removeAttribute("selected");
  } else {
    priorityEle.childNodes[1].removeAttribute("selected");
    priorityEle.childNodes[3].setAttribute("selected", "selected");
  }
  document.getElementById("modalDescription").value = description;
  document.getElementById("modalID").value = vid;
};

// Function to Handle Modal Submit(editing)
const handleModalSubmit = () => {
  let id = document.getElementById("modalID").value;
  if (id === "") {
    addTask();
  } else {
    editTask();
  }
  let closeBtn = document.querySelector("[data-dismiss=modal]");
  closeBtn.click();
};

// FIXME: Dependent Modules are changed so have to change this function
// TODO: Changes for 2nd filter(Full Text Search)
// Function to Handle searching(with all filters)
const search = (key = "") => {
  // let key = document.getElementById("tsearch").value;
  if (key.length === 0) {
    loadTask();
    return;
  }
  let priority = document.getElementById("priorityInput").checked;
  let nPriority = document.getElementById("npriorityInput").checked;

  // NOTE: if no filters are selected then by default both priority and not priority task will be displayed
  let byPrority = 2;
  if (priority === true && nPriority === true) {
    byPrority = 2;
  } else if (priority) {
    byPrority = 0;
  } else if (nPriority) {
    byPrority = 1;
  }

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST", "./backend/controller/TaskController.php", true);
  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
      globalData = JSON.parse(xmlhttp.responseText);
      displayTask();
    }
  };
  var vars = "api=filter" + "&key=" + key + "&byPrority=" + byPrority;
  // if (ft) vars += "&isFullText=" + ft;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
};

// Function to Handle Filter
const handleFilter = () => {
  search("byPriority");
  document.getElementById("dropdown-menu").classList.remove("show");
  return false;
};
