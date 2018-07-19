<?php include "templates/header.php"; ?>

    <ul>
        <li class="add_item"><a class="add panel_links"href="create.php"><i class="fas fa-user-plus"></i>   add a user</a></li>
        <li class="del_item"><a class="del panel_links"href="delete.php"><i class="fas fa-user-minus"></i>   delete users</a></li>
        <li class="edit_item"><a class="edit panel_links"href="update.php"><i class="fas fa-user-edit"></i>   edit a user</a></li>
    </ul>

<?php

try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

} catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>


    <h2>Users</h2>

    <table align="center">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>


<?php include "templates/footer.php"; ?>