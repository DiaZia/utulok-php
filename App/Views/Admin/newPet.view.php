<?php
namespace App\Controllers\Admin;

use App\Models\Pet;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["name"], $_POST["type"], $_POST["imagePath"], $_POST["age"])) {
        $name = $_POST["name"];
        $type = $_POST["type"];
        $imagePath = $_POST["imagePath"];
        $age = $_POST["age"];

        $newPet = new Pet();
        $newPet->setName($name);
        $newPet->setType($type);
        $newPet->setImagePath($imagePath);
        $newPet->setAge($age);

        $newPet->save();
        echo "Nové zvieratko úspešne pridané";
    }
} else {
    ?>
    <form action="" class="addPet" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <br>
        </div>

        <div>
            <label for="type">Type:</label>
            <input type="text" name="type" required>
            <br>
        </div>

        <div>
            <label for="imagePath">Image Path:</label>
            <input type="text" name="imagePath" required>
            <br>
        </div>

        <div>
            <label for="age">Age:</label>
            <input type="text" name="age" required>
            <br>
        </div>

        <button type="submit">Add Pet</button>
    </form>
    <?php
}
?>