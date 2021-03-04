<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
  <script src="https://kit.fontawesome.com/eb5ea08954.js" crossorigin="anonymous"></script>
  <script src="./assets/js/script.js"></script>
  <style>
    .strike-through {
      text-decoration: line-through;
      color: gray;
    }

    input:focus,
    select:focus,
    textarea:focus,
    button:focus {
      outline: none;
    }

    .special-card {
      pointer-events: none;
      background-color: rgba(245, 245, 245, 1);
      opacity: .4;
    }
  </style>
  <?php
  //  echo json_encode(require , JSON_HEX_TAG); 
  include_once("./backend/models/queries.php");
  $q = new Queries();
  $queryData =  $q->viewTasks();
  // var_dump($queryData);
  ?>
  <script>
    var data = <?php echo json_encode($queryData) ?>;
    window.onload = function() {
      loadTasks();

    }
  </script>

  <title>TODO</title>
</head>

<body>

  <h1 class="text-center m-3">TODO</h1>
  <section id="Tasks">
    <div id="taskCard" class="card container px-4 overflow-auto" style="height: 73vh">

    </div>
  </section>
  <section id="add-task" class="mt-5 px-5">
    <div class="container">
      <form class="row border border-dark rounded-pill overflow-hidden" onsubmit="event.preventDefault(); addTask();">
        <input type=" text" name="task" id="inp-add-task" class="col-11 rounded-0 border-0" />
        <button type=" submit" class="btn btn-success rounded-0 col-1 position-relative">
          Add Task
        </button>
      </form>
    </div>
  </section>
</body>

</html>