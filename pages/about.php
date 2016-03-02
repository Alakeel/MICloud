<?php include('../Configs/session.php'); // Starting Session ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>About &middot; MI Cloud Base</title>
    
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
                <li class="active"><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact us</a></li>
              </ul>
            </div>
          </div>
        </div><!-- /.navbar -->
      </div>

  
	  <div id="section">
		<h1>About MI Cloud Base</h1> 
		<hr/>
		<p>
           MI Cloud Base is a music database and instagram hashtag search intergered to  allow to its user to search for music (artist,albums,songs) just by one click and display the results on a table for you. Moreover, it gives you the option to see 
           the latest photos posted from instagram hashtag search while you searching for musics. The instagram photo feature allow you to view, download and know number of likes giving for the latest 
           photos within the givin hashtag search. Using the search field allow you to enter any name you like to get the latest photo and music information you want from insagram and our music database.
           The web is still in beta and will be improved in the future.
		</p>
		</div>


<!-- footer of the page -->
<?php include('footer.php') ?>
