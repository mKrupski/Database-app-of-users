<?php include "templates/header.php"; ?>

<?php

try {
    require "../config.php";
    require "../common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();

} catch (PDOException $error) {
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
            <th>Edit</th>
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
                <td><a href="edit-single.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="addform">
        <a href="index.php" class="home">Back to home</a>
    </div>
<?php
?>

<?php include "templates/footer.php"; ?>