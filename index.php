<?php
           
           $client = mysqli_connect("localhost", "root", "password", "todo");
           
            if ($client->connect_error) {
                die("cant connect to db: ". $client->connect_error);
            }



            $task= $_POST['task_entered'];
            $submitbutton= $_POST['submitbutton'];

            $sql_add_task = "INSERT INTO tasks (task) VALUES ('$task')";
           
           

            //handle submission of a new task
            if ($submitbutton){
                if (!empty($task)) {
                   
                    if (mysqli_query($client, $sql_add_task)) {
                        echo "New record created successfully";
                    } else {
                        echo "Error: " . $sql_add_task . "<br>" . mysqli_error($client);
                    }   
                } 
            }

            if ($_REQUEST['functionName'] == 'deleteTask') {
                echo "deleting" . $_REQUEST['taskID'];
            }

           
            
           
            $client->close();
        ?>
<!DOCTYPE html>
    <head>
        <title>todolist with php and mysql</title>
    
  </head>
    <body>
    <div class="heading">
    <h2>Todolist with PHP and mySQL</h2>


    </div>
    <form action="" method="POST">
    <label>Enter Your Task Please:</label>
    <input type="text"name="task_entered" value='<?php echo $task; ?>'>
    <br><br>
    <input type="submit" name="submitbutton" value="Submit"/>
    </form>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <?php         

           $client = mysqli_connect("localhost", "root", "password", "todo");
                 //query db for existing tasks
                $sql = "SELECT * FROM tasks";
                $result = mysqli_query($client, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                        echo  "<tr class=`table-row`><th>". $row["id"] . "</th><th>" . $row['task'] . '</th><th>'. "Action" . "</th></tr>"; 
                    }
                } else {
                    echo "<tr><th>00</th><th>No Tasks Found</th><th>ALL Done</th></tr>";
                }
             ?>
            </tr>
        </tbody>

    </table>
        
    </body>

</html>