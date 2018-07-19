<?php

require "../config.php";
require "../common.php";

if (isset($_GET["id"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $id = $_GET["id"];

        $sql = "DELETE FROM users WHERE id = :id";

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $success = "User successfully deleted";
        if ($success) echo $success;

    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT * FROM users";

    $statement = $connection->prepare($sql);
    $statement->execute();

    $result = $statement->fetchAll();
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>
<?php require "templates/header.php"; ?>

    <h2>Delete users</h2>

    <table align="center">
        <thead>
        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo escape($row["id"]); ?></td>
                <td><?php echo escape($row["firstname"]); ?></td>
                <td><?php echo escape($row["lastname"]); ?></td>
                <td><?php echo escape($row["email"]); ?></td>
                <td><?php echo escape($row["age"]); ?></td>
                <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="addform">
        <a href="index.php" class="home">Back to home</a>
    </div>

<?php require "templates/footer.php"; ?>