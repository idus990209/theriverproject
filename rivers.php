<?php

include('config/session.php');
include('config/db_connect.php');

// write query for all rivers
$sql = 'SELECT id, river_name, river_location, map_url, image_ext FROM river ORDER BY id';

// make query & get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$rivers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div style="height: 5vh;"></div>

<!--==========================
      Rivers Section
    ============================-->
<section id="speakers" class="wow fadeInUp">
  <div class="container">
    <div class="section-header">
      <h2>Rivers</h2>
      <p>Here are some of the rivers</p>
    </div>

    <div class="row">
      <?php foreach ($rivers as $river) : ?>

        <div class="col-lg-4 col-md-6">
          <div class="speaker" style="height: 200px;">
            <!-- <h1><?php //echo htmlspecialchars($river['river_name']); 
                      ?></h1> -->
            <?php
            //  echo '<img class="img-fluid" width="100%" src="' . $river['image_url'] . '">';
            echo '<img class="img-fluid" width="100%" src="img/uploads/river' . $river['id'] . '.' . $river['image_ext'] . '">';
            ?>
            <div class="details" style="min-height: 100px;">
              <h3><a href="river-details.php?id=<?php echo $river['id'] ?>"><?php echo htmlspecialchars($river['river_name']); ?></a></h3>
              <a target="_blank" href="<?php echo $river['map_url'] ?>">View in Map</a>
            </div>
          </div>
        </div>

      <?php endforeach; ?>
    </div>

    <?php if (isset($_SESSION['username'])) : ?>
      <?php if ($_SESSION['username'] == 'admin') : ?>
        <div class="text-center">
          <a style="margin-top: 30px; margin-bottom: 30px;" class="btn btn-danger btn-lg" href="add.php" role="button">+ Add river</a>
        </div> <?php endif; ?>
    <?php endif; ?>
  </div>

</section>

<?php include('templates/footer.php'); ?>

</html>