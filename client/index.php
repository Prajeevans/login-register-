<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/login.css">
    <link rel="stylesheet" href="./assets/register.css">
    <link rel="stylesheet" href="./assets/upload.css">

</head>

<body>
    <?php
    session_start();
    if (isset($_POST["upload"])) {
        $fullname = $_SESSION['user_name'];
        $email = $_SESSION['user_email'];
        // print_r($fullname);
        // print_r($email);
        $note = $_POST["note"];
        // $deliveryAddress = $_POST["deliveryaddress"];

        $deliveryAddress = isset($_POST["deliveryaddress"]) ? $_POST["deliveryaddress"] : "";
        $delivery_slot = isset($_POST["delivery_slot"]) ? $_POST["delivery_slot"] : "";
        $delivery_slot_str = strval($delivery_slot);
        require_once("database.php");

        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $image_paths = [];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (isset($_FILES['images'])) {
            $file_count = count($_FILES['images']['name']);
            if ($file_count > 5) {
                echo "<div class='alert alert-danger'>You can only upload a maximum of 5 images.</div>";
            } else {
                for ($i = 0; $i < 5; $i++) {
                    if (!empty($_FILES['images']['name'][$i])) {
                        $file_type = $_FILES['images']['type'][$i];
                        if (in_array($file_type, $allowed_types)) {
                            $ext = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
                            $filename = uniqid("img{$i}_") . "." . $ext;
                            $target = $upload_dir . $filename;
                            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $target)) {
                                $image_paths[] = $target;
                            } else {
                                $image_paths[] = null;
                            }
                        } else {
                            $image_paths[] = null;
                        }
                    } else {
                        $image_paths[] = null;
                    }
                }
            }
        }

        // Fill missing images with null
        while (count($image_paths) < 5) {
            $image_paths[] = null;
        }
        // $conn    
        require_once("database.php");

        $stmt = mysqli_prepare($conn, "INSERT INTO userimages (fullname, image_1, image_2, image_3, image_4, image_5, email, note, deliveryAddress, timeslot) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        for ($i = 0; $i < 5; $i++) {
            if ($image_paths[$i] === null) {
                $image_paths[$i] = "";
            }
        }
        mysqli_stmt_bind_param(
            $stmt,
            "ssssssssss",
            $fullname,
            $image_paths[0],
            $image_paths[1],
            $image_paths[2],
            $image_paths[3],
            $image_paths[4],
            $email,
            $note,
            $deliveryAddress,
            $delivery_slot_str,
        );

        $stmt->execute();

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Images and details uploaded successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Upload failed: " . $stmt->error . "</div>";
        }
        $stmt->close();
        $conn->close();
    }
    ?>
    <form method="post" class="imageUpload" enctype="multipart/form-data">
        <div class="container">
            <input type="text" name="note" class="textfiled" placeholder="Note"><br>

            <input type="text" name="deliveryaddress" class="textfiled" placeholder="Delivery Address"><br>
            <label for="delivery_slot">Select Delivery Time Slot:</label>
            <select name="delivery_slot" id="delivery_slot" required>
                <option value="">-- Select a Time Slot --</option>
                <option value="8AM - 10AM">8AM - 10AM</option>
                <option value="10AM - 12PM">10AM - 12PM</option>
                <option value="12PM - 2PM">12PM - 2PM</option>
                <option value="2PM - 4PM">2PM - 4PM</option>
                <option value="4PM - 6PM">4PM - 6PM</option>
                <option value="6PM - 8PM">6PM - 8PM</option>
            </select>

            <h1>Upload your prescription images</h1>
            <input type="file" name="images[]" accept="image/*" multiple required id="imgInput"><br>
            <input type="submit" name='upload' value="Upload Images" value="Submit" class="btn">
        </div>
    </form>

    <script>
        document.getElementById('imgInput').addEventListener('change', function(e) {
            if (this.files.length > 5) {
                alert('You can only upload a maximum of 5 images.');
                this.value = '';
            }
        });
    </script>
   
</body>

</html>
