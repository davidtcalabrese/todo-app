<html>
    <head>
        <title>Remove a task</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>
    </head>
    <body>
        <div class="card">
            <div class="card-body">
                <h1 class="text-primary text-center">Remove a Task</h1>
                <?php 
                // get db constants for connection
                require_once('dbconnection.php');  

                // connect to db
                $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                        or trigger_error('Error connection to MySQL server for ' 
                        . DB_NAME, E_USER_ERROR);

                // check if delete button was pressed to confirm deletion 
                if (isset($_POST['delete_task_submission']) 
                        && isset($_POST['id'])):

                    $id = $_POST['id'];

                    //  regular "hard" delete - deactivated
                    $query = "DELETE FROM task WHERE id = $id";

                    // delete task
                    $result = mysqli_query($dbc, $query) or 
                        trigger_error('Error querying database taskListing', 
                        E_USER_ERROR);
                    
                    // send user back to home page
                    header("Location: index.php");
                    exit;

                // if trashcan button is clicked, go to confirmation page
                elseif (isset($_GET['id_to_delete'])):
                ?>
                <h3 class="text-danger">
                    Confirm deletion of the following task details:
                </h3><br>
                <?php 
                // remind user of task details about to be deleted
                $id = $_GET['id_to_delete'];

                $query = "SELECT * FROM task WHERE id = $id";

                $result = mysqli_query($dbc, $query) or 
                    trigger_error('Error querying task database', 
                    E_USER_ERROR);

                if (mysqli_num_rows($result) == 1):

                    $row = mysqli_fetch_assoc($result);
                ?>
                <h1><?= $row['name'] ?></h1>
                <table class="table table-striped table-hover">
                    <tbody>
                        <tr>
                            <th scope="row">Description</th>
                            <td><?= $row['description'] ?></td>
                        </tr>                     
                    </tbody>
                </table>
                <br>
                <!-- two button form to confirm deletion or cancel -->
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <button class="btn btn-danger" 
                                    type="submit" 
                                    name="delete_task_submission">
                                Delete task
                            </button>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" 
                                    type="submit"
                                    name="do_not_delete_task_submission">
                                Do Not Delete    
                            </button>
                        </div>
                        <input type="hidden" name="id" value="<?= $id ?>">
                    </div>
                </form>
                <?php 
                else:
                ?>
                    <h3>No task Details</h3>
                <?php 
                endif;
                
            else:
                // if user enters url for delete page manually take them back to home
                header("Location: index.php");
                exit;

            endif;
            ?>

            </div>
        </div>
    </body>
</html>