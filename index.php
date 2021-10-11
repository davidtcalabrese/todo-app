<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous" defer></script>
    <script src="https://kit.fontawesome.com/4c22d8ad01.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Todo App</title>
</head>
<body class="bg-gradient-warning">
<div class="card bg-gradient-light">
    <div class="card-body">
        <h1 class="text-primary text-center">Tasks</h1>

        <?php
        // import constants defined in this script
        require_once('dbconnection.php');

        // connect to Movie database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
        or trigger_error('Error connecting to MySQL server for ' .  DB_NAME, E_USER_ERROR);

        // define query, pass to database
        $query = "SELECT id, name FROM task";

        $result = mysqli_query($dbc, $query)
        or trigger_error('Error querying database studentListing', E_USER_ERROR);

        if (mysqli_num_rows($result) > 0):
            ?>
            <table class="table table-striped table-hover">
                <thead>
                <tr class="table-info">
                    <th scope="col" class="text-secondary">Task</th>
                    <th scope="col" class="text-secondary"></th>
                </tr>
                </thead>
                <tbody>
                <?php
                // if there are more rows, fetch them, display as row in table
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr><td>"
                        . "<a class='nav-link text-muted' href='taskdetails.php?id="
                        . $row['id'] . "'>" . $row['name'] . "</a></td>"
                        . "<td><a class='nav-link' href='removetask.php?id_to_delete="
                        . $row['id'] . "'><i class='fas fa-trash-alt'></i></a></td></tr>";
                }
                ?>
                </tbody>
            </table>
            <p><a href="addtask.php"><i class="fas fa-plus"></i></a></p>
        <?php
        else:
            ?>
            <h3>No Tasks Found</h3>
        <?php
        endif;
        ?>
    </div>
</div>

</body>
</html>
