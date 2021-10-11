<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Edit a Task</title>
</head>
<body>
    <div class="card">
        <div class="card-body">
            <h1 class="text-primary text-center">Edit a Task</h1>
            <nav class="nav">
                <a href="index.php" class="nav-link">Tasks</a>
            </nav>
            <hr>
            <?php
         
                 require_once('dbconnection.php');

                 // connect to task database
                 $dbc = mysqli_connect(DB_HOST, DB_USER,
                     DB_PASSWORD, DB_NAME)
                        or trigger_error(
                                'Error connecting to MySQL server for ' .  DB_NAME,
                                E_USER_ERROR);

                if (isset($_GET['id_to_edit'])) 
                {
                    $id_to_edit = $_GET['id_to_edit'];

                    $query = "SELECT * FROM task WHERE id = $id_to_edit";

                    $result = mysqli_query($dbc, $query) or
                        trigger_error('Error querying the task database ', E_USER_ERROR);

                    if (mysqli_num_rows($result) == 1) 
                    {
                        $row = mysqli_fetch_assoc($result);

                        $name = $row['name'];
                        $description = $row['description'];
                    }
                } elseif (isset($_POST['edit_task_submission'], $_POST['name'],
                        $_POST['description']))
                {
                    $new_name = htmlspecialchars($_POST['name'], ENT_QUOTES);
                    $new_description = $_POST['description'];
                
                    
                    $query = "UPDATE task SET name = '$new_name', ";
                    $query .= "description = '$new_description' ";
                    $query .= "WHERE id = $id_to_update";

                    mysqli_query($dbc, $query)
                    or trigger_error('Error querying the task database: Failed to update task ', E_USER_ERROR);

                    $nav_link = 'taskdetails.php?id=' . $id_to_update;
                    
                    header("Location: $nav_link");
                    exit;   
                } else // unintended page link, link back to exit
                {
                    header("Location: index.php");
                    exit;
                }    
            ?>

            <form class="needs-validation" novalidate method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                <div class="form-group row">
                    <label for="name" class="col-sm-3 col-form-label-lg">Name</label>
                    <div class="col-sm-8">
                        <input type="text"
                               class="form-control"
                               id="name"
                               for="name"
                               name="name"
                               value='<?= $name ?>'
                               placeholder="Name"
                               required>
                        <div class="invalid-feedback">Please provide a valid task name</div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-3 col-form-label-lg">Description</label>
                    <div class="col-sm-8">
                    <textarea name="task_description" 
                                  id="task_description" 
                                  cols="30" rows="10"
                                  class="form-control"
                                  placeholder="Description"
                                  value='<?= $description ?>'
                                  required>
                                  <?php 
                                        if(isset($_POST['description']))
                                        {
                                            echo htmlentities($_POST['description'], ENT_QUOTES);
                                        }
                                  ?>
                              </textarea>
                        <div class="invalid-feedback">Please provide a description</div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" name="edit_task_submission">Update Task</button>
                <input type="hidden" name="id_to_update" value="<?= $id_to_update ?>">
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
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>