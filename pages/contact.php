<?php include('../Configs/session.php'); // Starting Session ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Contact &middot; MI Cloud Base</title>

	<?php include('../Configs/links.php') ?>
  </head>

  <body>

    <div class="container">
	<?php include '../Configs/check_login.php';?>
      <div class="masthead">
        <h3 class="muted">Cloud Computing Assignment (2)</h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="about.php">About</a></li>
                <li class="active"><a href="contact.php">Contact us</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form-signin">
	        <h2 class="form-signin-heading">Contact Us</h2>
    <div>
        <label for="name">Name:</label>
        <input id="clientName" type="text" class="input-block-level" placeholder="my name" />
    </div>
    
        <label for="mail">E-mail:</label>
        <input type="email" class="input-block-level" placeholder="myemail@gmail.com" />
    
    <div>
        <label for="msg">Message:</label>
        <textarea  type="text" class="input-block-level" placeholder="msg.." ></textarea>
    </div>

    <div class="button">
        <button class="btn btn-large btn-primary" type="submit" name="submit" value="Submit">Send</button>
    </div>
</form>

  <?php if(isset($_POST['submit'])){  
    echo $output="Message Sent, we will contact you shortly. Thank you.";} ?>

<!-- footer of the page -->
<?php include('footer.php') ?>