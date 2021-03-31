<?php

include('config/session.php');
include('config/db_connect.php');

$errors = array('river_name' => '', 'river_location' => '', 'map_url' => '', 'embed_url' => '', 'file' => '');
$river_name = $river_location = $map_url = $embed_url = '';
$create = '';

if (!$_SESSION['username'] == 'admin') {
    header('Location: rivers.php');
}

if (isset($_POST['create'])) {

    // check river name
    if (empty($_POST['river_name'])) {
        $errors['river_name'] = 'River name is required <br/>';
    } else {
        $river_name = $_POST['river_name'];
    }

    // check river location
    if (empty($_POST['river_location'])) {
        $errors['river_location'] = 'River location is required <br/>';
    } else {
        $river_location = $_POST['river_location'];
    }

    // check map url
    if (empty($_POST['map_url'])) {
        $errors['map_url'] = 'Map URL is required <br/>';
    } else {
        $map_url = $_POST['map_url'];
    }

    // check embed url
    if (empty($_POST['embed_url'])) {
        $errors['embed_url'] = 'Embed HTML is required <br/>';
    } else {
        $embed_url = $_POST['embed_url'];
    }

    // check file
    if (empty($_FILES['file'])) {
        $errors['file'] = 'Image file is required <br/>';
    }

    if (!array_filter($errors)) {

        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png', 'webp');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {

                // insert query
                $river_name = mysqli_real_escape_string($conn, $_POST['river_name']);
                $river_location = mysqli_real_escape_string($conn, $_POST['river_location']);
                $map_url = mysqli_real_escape_string($conn, $_POST['map_url']);
                $embed_url = str_replace('<iframe src="https://www.google.com/maps/embed?', "", $embed_url);
                $embed_url = str_replace('" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>', "", $embed_url);
                $embed_url = mysqli_real_escape_string($conn, $embed_url);
                $image_ext = mysqli_real_escape_string($conn, $fileActualExt);

                // create sql
                $sql = "INSERT INTO river(river_name, river_location, map_url, embed_url, image_ext) VALUES('$river_name', '$river_location', '$map_url', '$embed_url', '$image_ext')";

                // save to db and check
                if (mysqli_query($conn, $sql)) {
                    // success
                    $create = 'Process succesful!';
                } else {
                    // error
                    $create = 'Process failed!';
                    echo 'query error: ' . mysqli_error($conn);
                }

                // query to get new river id
                $sql = "SELECT id, river_name FROM  river WHERE river_name='$river_name'";
                $result = mysqli_query($conn, $sql);
                $river = mysqli_fetch_assoc($result);
                mysqli_free_result($result);

                $id = $river['id'];

                $fileNameNew = "river" . $id . "." . $fileActualExt;
                $fileDestination = 'img/uploads/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                // create sensor data
                $sql = "INSERT INTO `river_data` (`latitude`, `longitude`, `level`, `ph`, `do`, `temperature`, `ec`, `turbidity`, `river_id`) VALUES
                (1.6553, 103.9272, 2.21, 7.1, 6.5, 18.7, 403.7, 3, $id)";
                $river = mysqli_fetch_assoc($result);

                // save to db and check
                if (mysqli_query($conn, $sql)) {
                    // success
                    $create = 'Process succesful!';
                    mysqli_close($conn);
                    header("Location: rivers.php");
                } else {
                    // error
                    $create = 'Process failed!';
                    echo 'query error: ' . mysqli_error($conn);
                }
            } else {
                $error['file'] = 'File upload failed!';
            }
        } else {
            $errors['file'] = 'File is not in correct format!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div style="height: 5vh;"></div>

<!--==========================
      Add Section
    ============================-->
<section id="speakers" class="wow fadeInUp">
    <div class="container">
        <div class="section-header">
            <h2>Add river</h2>
            <p>Fill in the information for a new river</p>
        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                    <div class="form-group">
                        <input class="form-control" type="text" name="river_name" placeholder="River name" value="<?php echo $river_name ?>">
                        <div class="text-danger"><?php echo $errors['river_name'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="river_location" placeholder="Location" value="<?php echo $river_location ?>">
                        <div class="text-danger"><?php echo $errors['river_location'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="map_url" placeholder="Map URL" value="<?php echo $map_url ?>">
                        <?php echo htmlspecialchars('eg. https://goo.gl/maps/wfmoKDGFG2eAjPNC6'); ?>
                        <div class="text-danger"><?php echo $errors['map_url'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="embed_url" placeholder="Embed HTML" value="<?php echo $embed_url ?>">
                        <div class="text-danger"><?php echo $errors['embed_url'] ?></div>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" name="file" placeholder="Image">
                        <div class="text-danger"><?php echo $errors['file'] ?></div>
                    </div>
                    <div class="text-center">
                        <input type="submit" name="create" value="Create" class="btn btn-danger">
                        <div class="text-danger"><?php echo $create; ?></div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3"></div>
        </div>
</section>

<?php include('templates/footer.php'); ?>

</html>