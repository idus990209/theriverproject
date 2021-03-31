<?php

include('config/session.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<link rel="manifest" href="manifest.json">
<script>
        //if browser support service worker
        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js');
        };
      </script>

<!--==========================
    Intro Section
  ============================-->
<section id="intro">
    <div class="intro-container wow fadeIn">
        <h1 class="mb-4 pb-0">The Centralised<br><span>River</span> Website</h1>
        <p class="mb-4 pb-0"></p>
        <a href="https://www.youtube.com/watch?v=9X9kvhcbyNQ" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
        <a href="#about" class="about-btn scrollto">About The River</a>
    </div>
</section>

<!--==========================
      About Section
    ============================-->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <h2>About The River Project</h2>
                <p>In order for preserve the water quality in rivers, we designed a centralized website to keep track of water quality in rivers. This website also targets to raise awareness among the public. Thus, it is becoming a platform to get information, review and post complaint about rivers.</p>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2">
                <h3>Members</h3>
                <p>Luqman Al-Hakim<br>Ahmad Nuri<br>Ahmad Firdaus</p>
            </div>
            <div class="col-lg-2">
                <h3>Course</h3>
                <p>SCSV1223 - Web Programming<br>Section 04<br>Dr. Azman Ismail</p>
            </div>
        </div>
    </div>
</section>

<!--==========================
      Contact Section
    ============================-->
<section id="contact" class="section-bg wow fadeInUp">

    <div class="container">

        <div class="section-header">
            <h2>Contact Us</h2>
            <p>For enquiries, please leave us a message.</p>
        </div>

        <div class="row contact-info">

            <div class="col-md-4">
                <div class="contact-address">
                    <i class="ion-ios-location-outline"></i>
                    <h3>Address</h3>
                    <address>School of Computing, UTM, 81310 Johor Bahru <br>
                        Malaysia</address>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-phone">
                    <i class="ion-ios-telephone-outline"></i>
                    <h3>Phone Number</h3>
                    <p><a href="tel:+155895548855">+60 xxx xxxx</a></p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="contact-email">
                    <i class="ion-ios-email-outline"></i>
                    <h3>Email</h3>
                    <p><a href="mailto:info@example.com">contact@syzygyteam.com</a></p>
                </div>
            </div>

        </div>

        <div class="form">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                        <div class="validation"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                        <div class="validation"></div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validation"></div>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                    <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
        </div>

    </div>
</section><!-- #contact -->

<?php include('templates/footer.php'); ?>

</html>