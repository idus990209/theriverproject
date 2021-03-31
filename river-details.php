<?php

include('config/session.php');
include('config/db_connect.php');

$post_comment = '';

// check GET request id param
if (isset($_GET['id'])) {

  $river_id = mysqli_real_escape_string($conn, $_GET['id']);

  $sql = "SELECT * FROM river WHERE id = $river_id";
  $result = mysqli_query($conn, $sql);
  $river = mysqli_fetch_assoc($result);
  mysqli_free_result($result);

  if (empty($river['id'])) {
    header("location: rivers.php");
  }


  $sql = "SELECT * FROM river_data WHERE river_id = $river_id";
  $result = mysqli_query($conn, $sql);
  $datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);

  $sql = "SELECT * FROM comment WHERE river_id = $river_id ORDER BY date_created";
  $result = mysqli_query($conn, $sql);
  $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
}

if (isset($_POST['delete_comment'])) {
  $comment_id = $_POST['comment_id'];
  $sql = "DELETE FROM comment WHERE id = $comment_id";
  $result = mysqli_query($conn, $sql);
  mysqli_free_result($result);
  header("Location: river-details.php?id=$river_id");
}

if (isset($_POST['post_comment'])) {
  if (strlen($_POST['content']) < 4) {
    $post_comment = 'Comment must be at least 4 characters to avoid spam';
  } else {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $user_id = $_SESSION['user_id'];
    // create sql
    $sql = "INSERT INTO comment(content, river_id, user_id, date_created) VALUES('$content', '$river_id', '$user_id', now())";
    $result = mysqli_query($conn, $sql);
    mysqli_free_result($result);
    header("Location: river-details.php?id=$river_id");
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<main id="main" class="main-page">

  <!--==========================
      River Details Section
    ============================-->
  <section id="speakers-details" class="wow fadeIn">
    <div class="container">
      <div class="section-header">
        <h2><?php echo $river['river_name'] ?></h2>
        <p>Location: <?php echo $river['river_location'] ?></p>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="container-fluid">
            <?php
            echo '<img class="container img-fluid" width="100%" src="img/uploads/river' . $river['id'] . '.' . $river['image_ext'] . '">';
            $iframe = '<iframe class="container-fluid" src="https://www.google.com/maps/embed?' . $river['embed_url'] . '" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>';
            echo $iframe;
            ?>
          </div>
        </div>

        <div class="col-md-6">
          <div class="details">
            <div class="text-center">
              <h2>Water Quality Information</h2>
              <br>

              <?php foreach ($datas as $data) : ?>

                <h4>Sensor ID: <?php echo $data['id'] ?></h4>
                <div class="row">
                  <div class="col-6">
                    <h4>Latitude: <?php echo $data['latitude'] ?></h4>
                  </div>
                  <div class="col-6">
                    <h4>Longitude: <?php echo $data['longitude'] ?></h4>
                  </div>
                </div>
                <div class="row">
                  <div class="col-9">
                    <h1 class="text-primary" style="font-size: 72pt;"><?php echo $data['temperature'] ?> 'C</h1>
                  </div>
                  <div class="col-3">
                    <br>
                    <h5>Water level:</h5>
                    <h3 class="text-primary"><?php echo $data['level'] ?>m</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <h5><br>pH:</h5>
                  </div>
                  <div class="col-3">
                    <h5><br>Turbidity (NTU):</h5>
                  </div>
                  <div class="col-3">
                    <h5>Electrical <br> Conductivity (µmhos/cm):</h5>
                  </div>
                  <div class="col-3">
                    <h5>Dissolved <br> Oxygen (mg/L):</h5>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <h2 class="text-primary" style="font-size: 36pt;"><?php echo $data['ph'] ?></h2>
                  </div>
                  <div class="col-3">
                    <h2 class="text-primary" style="font-size: 36pt;"><?php echo $data['turbidity'] ?></h2>
                  </div>
                  <div class="col-3">
                    <h2 class="text-primary" style="font-size: 36pt;"><?php echo $data['ph'] ?></h2>
                  </div>
                  <div class="col-3">
                    <h2 class="text-primary" style="font-size: 36pt;"><?php echo $data['ph'] ?></h2>
                  </div>
                </div>
                <div style="margin-bottom: 60px;"></div>

              <?php endforeach; ?>

              <a href="" class="btn btn-primary btn-lg">Add location</a>
            </div>
          </div>
        </div>

      </div>
    </div>

  </section>

  <!--==========================
      Comments Section
    ============================-->
  <section id="schedule" class="wow fadeIn">
    <div class="container">
      <div class="section-header">
        <h2>Comments</h2>
        <p>Here is the comment section for the users</p>
      </div>

      <div class="justify-content-center">
        <div class="center col-lg-12">

          <?php
          foreach ($comments as $comment) :
            $user_id = $comment['user_id'];
            $sql = "SELECT username, id FROM user WHERE id = $user_id";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
          ?>

            <div class="row schedule-item">
              <div class="col-md-2"><time><?php echo date($comment['date_created']) ?></time></div>
              <div class="col-md-9">
                <h4><?php echo $user['username'] ?></h4>
                <p><?php echo $comment['content'] ?></p>
              </div>
              <?php if (isset($_SESSION['username'])) : ?>
                <?php if ($_SESSION['username'] == $user['username'] && $_SESSION['user_id'] == $user['id']) : ?>
                  <div class="col-md-1">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$river_id" ?>">
                      <input type="hidden" name="comment_id" value="<?php echo $comment['id'] ?>">
                      <input type="submit" name="delete_comment" value="Delete" class="btn btn-danger btn-sm">
                    </form>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
            </div>

          <?php
          endforeach;
          mysqli_close($conn);
          ?>

          <br>

          <?php if (isset($_SESSION['username'])) : ?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . "?id=$river_id" ?>">
              <div class="form-group">
                <input style="height: 80px;" class="form-control" type="text" name="content" placeholder="Write your comment...">
              </div>
              <div class="text-center">
                <div class="text-primary"><?php echo $post_comment; ?></div>
                <br>
                <input type="submit" name="post_comment" value="Post comment" class="btn btn-primary">
              </div>
            </form>
          <?php else : ?>
            <div class="text-center form-group">
              <p>Please login to comment.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

</main>

<?php include('templates/footer.php'); ?>

</html>