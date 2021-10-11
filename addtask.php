<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Add a Task</title>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h1 class="text-primary text-center">Add a Task</h1>
            <nav class="nav">
                <a href="index.php" class="nav-link">Task Home</a>
            </nav>
            <hr>
            <?php
             $display_add_task_form = true;

             if (isset($_POST['add_task_submission'], $_POST['task_name'],
                        $_POST['task_description']))
             {
                 require_once('dbconnection.php');

                 $task_name = htmlspecialchars($_POST['task_name'], ENT_QUOTES);
                 $task_description = htmlspecialchars($_POST['task_description'], ENT_QUOTES);

                 // connect to todo database
                 $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or trigger_error(
                                'Error connecting to MySQL server for ' .  DB_NAME,
                                E_USER_ERROR);

                // when adding movie set mark_as_deleted = false so it displays;
                 $query = "INSERT INTO task (name, description, date, color) "
                        . " VALUES ('$task_name', '$task_description', CURRENT_TIMESTAMP(), 'grey')";

                 mysqli_query($dbc, $query)
                    or trigger_error('Error querying the database studentListing', E_USER_ERROR);

                 $display_add_task_form = false;  
            ?>

            <h3 class="text-info">The Following Task Details were Added: </h3><br>

            <h1><?= $task_name ?></h1>
            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <th scope="row">Description</th>
                    <td><?= $task_description ?><Director</th>
                </tr>
                </tbody>
            </table>
            <hr>
            <p>Would you like to <a href='<?= $_SERVER['PHP_SELF'] ?>'>add another task</a>?</p>
        <?php
             }

             if ($display_add_task_form)
             {
        ?>
            <form class="needs-validation" novalidate method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group row">
                    <label for="task_name" class="col-sm-3 col-form-label-lg">Name</label>
                    <div class="col-sm-8">
                        <input type="text"
                               class="form-control"
                               id="task_name"
                               name="task_name"
                               placeholder="Name"
                               required>
                        <div class="invalid-feedback">Please provide a valid task name</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="task_description" class="col-sm-3 col-form-label-lg">Description</label>
                    <div class="col-sm-8">
                        <textarea name="task_description" 
                                  id="task_description" 
                                  cols="30" rows="10"
                                  class="form-control"
                                  placeholder="Description"
                                  required></textarea>
                        <div class="invalid-feedback">Please provide a description</div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="add_task_submission">Add Task</button>
            </form>
             <script>
                 (function () {
                     "use strict";
                     window.addEventListener(
                         "load",
                         function () {
                             // Fetch all the forms we want to apply custom Bootstrap validation styles to
                             var forms = document.getElementsByClassName("needs-validation");
                             // Loop over them and prevent submission
                             var validation = Array.prototype.filter.call(forms, function (form) {
                                 form.addEventListener(
                                     "submit",
                                     function (event) {
                                         if (form.checkValidity() === false) {
                                             event.preventDefault();
                                             event.stopPropagation();
                                         }
                                         form.classList.add("was-validated");
                                     },
                                     false
                                 );
                             });
                         },
                         false
                     );
                 })();
             </script>
            <?php
             } // display add task form
             ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>