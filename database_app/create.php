<?php

require "../config.php";
require "../common.php";

if (isset($_POST['submit'])) {

    try {
        $connection = new PDO($dsn, $username, $password, $options);

        $new_user = array(
            "firstname" => $_POST['firstname'],
            "lastname" => $_POST['lastname'],
            "email" => $_POST['email'],
            "age" => $_POST['age']
        );

        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "users",
            implode(", ", array_keys($new_user)),
            ":" . implode(", :", array_keys($new_user))
        );

        $statement = $connection->prepare($sql);
        $statement->execute($new_user);


    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }

}
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
    <blockquote style="color:#00c800; text-align: center;"><?php echo escape($_POST['firstname']); ?> successfully
        added. You can back to <a href="index.php" class="back">home page</a> or add the next user.
    </blockquote>
<?php endif; ?>

    <div class="addform">
        <form method="post">
            <label for="firstname">First Name</label>
            <input class="txt" type="text" name="firstname" id="firstname" required>
            <label for="lastname">Last Name</label>
            <input class="txt" type="text" name="lastname" id="lastname" required>
            <label for="email">Email Address</label>
            <input class="txt" type="email" name="email" id="email" required>
            <label for="age">Age</label>
            <input class="txt" type="number" name="age" id="age" max="99" required><br><br>
            <input class="button" type="submit" name="submit" value="Submit">
        </form>
        <br><br>
        <a href="index.php" class="home">Back to home</a>
    </div>

<?php include "templates/footer.php"; ?>