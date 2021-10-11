<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>
    <title>Task Details</title>
</head>
<body>


<div class="card border">
    <div class="card-body">
        <nav class="nav">
            <a href="index.php" class="nav-link">Task Home</a>
        </nav>
        <?php
        if (isset($_GET['id'])):                // check that GET request was sent

            require_once('dbconnection.php');   // import constants defined in this script

            $id = $_GET['id'];

            // connect to Movie database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or trigger_error('Error connecting to MySQL server for ' .  DB_NAME, E_USER_ERROR);

            // define query, pass to database
            $query = "SELECT * FROM task WHERE id = $id";

            $result = mysqli_query($dbc, $query) or
            trigger_error('Error querying database movieListing', E_USER_ERROR);

            if (mysqli_num_rows($result) == 1): // only show results if single row is returned

                $row = mysqli_fetch_assoc($result);
                ?>
                <h1><?= $row['name'] ?></h1>
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr>
                        <th scope="row">Decription</th>
                        <td><?= $row['description'] ?></td>
                    </tr>
                    <tbody>
                </table>
                <hr>
                <p>If you would like to change any of the details,
                    <a href="edittask.php?id_to_edit=<?=$row['id']?>"> edit it</a></p>
            <?php
            else:
                ?>
                <h3>No Task Details</h3>
            <?php
            endif;
        else:
            ?>
            <h3>No Task Details</h3>
        <?php
        endif;
        ?>
    </div> <!-- end card-body -->
</div> <!-- end card -->

</body>
</html>
