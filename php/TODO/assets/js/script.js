const loadTasks = () => {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let data = JSON.parse(this.responseText);
      document.getElementById('taskCard').innerHTML = "";
      data.forEach(obj => {

        document.getElementById('taskCard').innerHTML +=
          `<div id="task-${obj.id}" class="row p-3 border-bottom ">
        <div class="icons col-1" style="height: 100%">
          <input type="checkbox" name="" id="" onchange="onClickCheckBox()" ${obj.isComp === "1" ? "checked":"" }  />
        </div>
        <span class="task col-10 ${obj.isComp === "1" ? "strike-through":"" }  ">
          ${obj.msg}
        </span>
        <div class="col-1 d-flex flex-row justify-content-end">
          <button class="btn edit icons far fa-edit" onClick="editTask(this)" ></button>
          <button class="btn delete icons far fa-trash-alt" onClick="deleteTask(this)"></button>
        </div>
      </div>`;
      })
    }
  };
  xhttp.open("GET", "backend/utils/loadTasks.php", true);
  xhttp.send();
}

const deleteTask = (ele) => {
  let id = ele.parentNode.parentNode.id.slice(5);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST","./backend/utils/deleteTask.php",true);
  xmlhttp.onreadystatechange = function() { 
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
        console.log(JSON.parse(xmlhttp.responseText));
    }
    loadTasks();
};
  var vars = "id="+id;
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
}
const onClickCheckBox = () => {
  console.log("hi");
};

const addTask = (e) => {
  let task = document.getElementById("inp-add-task").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.open("POST","./backend/utils/addTask.php",true);
  xmlhttp.onreadystatechange = function() { //Call a function when the state changes.
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200) { // complete and no errors
        console.log(JSON.parse(xmlhttp.responseText)); // some processing here, or whatever you want to do with the response
        document.getElementById("inp-add-task").value = "";
    }
    loadTasks();

  };
  var vars = "task="+task+"&isComp=0"+"&isFav=0";
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xmlhttp.send(vars);
  
};


const editTask = (ele) => {
  let id = ele.parentNode.parentNode.id.slice(5);
  let spanEle = document.querySelector(`#task-${id} > span`);
  spanEle.parentNode.classList.add("special-card");
  spanEle.parentNode.setAttribute("disabled",true);
  // spanEle.contenteditable="true";
  document.getElementById("inp-add-task").value = spanEle.innerHTML.trim();
  console.log(spanEle.innerHTML);
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.open("POST","./backend/utils/editTask.php",true);
//   xmlhttp.onreadystatechange = function() { 
//     if(xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
//         console.log(JSON.parse(xmlhttp.responseText));
//     }
//     loadTasks();
// };
//   var vars = "id="+id+"&field=msg"+"&msg=0";;
//   xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//   xmlhttp.send(vars);
}
