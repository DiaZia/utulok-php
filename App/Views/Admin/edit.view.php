<?php
namespace App\Controllers\Admin;

use App\Models\Pet;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["petId"], $_POST["name"], $_POST["type"], $_POST["imagePath"], $_POST["age"])) {
        $petId = $_POST["petId"];
        $name = $_POST["name"];
        $type = $_POST["type"];
        $imagePath = $_POST["imagePath"];
        $age = $_POST["age"];

        $pet = Pet::getAll($petId);
        $selected = $pet[0];

        if ($selected) {
            $selected->setName($name);
            $selected->setType($type);
            $selected->setImagePath($imagePath);
            $selected->setAge($age);

            $selected->save();
            echo "Zvieratko úspešne upravené";
        }
    }
} else {

    if (isset($_GET['id'])) {
        $petId = $_GET['id'];
        $pet = Pet::getAll($petId);
        $selected = $pet[0];
        if ($selected) {
            ?>
            <form action="" class="editPet" method="post">
                <input type="hidden" name="petId" value="<?= $selected->getId() ?>">
                <div>
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $selected->getName() ?>">
                    <br>
                </div>

                <div>
                    <label for="type">Type:</label>
                    <input type="text" name="type" value="<?= $selected->getType() ?>">
                    <br>
                </div>

                <div>
                    <label for="imagePath">Image Path:</label>
                    <input type="text" name="imagePath" value="<?= $selected->getImagePath() ?>">
                    <br>
                </div>

                <div>
                    <label for="age">Age:</label>
                    <input type="text" name="age" value="<?= $selected->getAge() ?>">
                    <br>
                </div>

                <button type="submit">Update Pet</button>
            </form>
            <?php
        }
    }
}
?>
