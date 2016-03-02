<?php
include_once('Config.php'); // Establishing Connection with Server by passing server_name, user_id and password  and database as a parameter
$error=''; // Variable To Store Error Message
$search_output= "";
$search_output2= "";
if (isset($_POST['submit'])) {


	if (empty($_POST['searchquery']) || ctype_space($_POST['searchquery'])) 
	{
	$error = "You haven't entered anything";
	}
	else {
	// Filter the search query user input
	$searchquery = preg_replace('#[^a-z 0-9]#i', '', $_POST['searchquery']);
	// To protect MySQL injection for Security purpose
	$searchquery = stripslashes($searchquery);
	$searchquery = mysqli_real_escape_string($db, $searchquery);
		
	// search for artist name
	if($_POST['filter1'] == "QUERY1"){
		
	// select command to view results
	$sqlCommand = " SELECT AlbumPicture,SongName,AlbumName,a.AlbumArtist,SongContributingArtist,SongYoutubeLink,SongMP3Download
					FROM Album AS a INNER JOIN Song As s ON a.AlbumNo=s.AlbumNo
					INNER JOIN Song_Link AS sl ON s.SongNo=sl.SongNo
					WHERE s.SongContributingArtist like '%$searchquery%' OR a.AlbumArtist like '%$searchquery%' ";
		
	// SQL query to fetch information of registerd users and finds user match.
	$results = mysqli_query($db, $sqlCommand) or die(mysqli_error($db));

	$count = mysqli_num_rows($results); // mysqli_num_rows return the # of rows from the query
	
	if ($count >= 1) { // if found at least one row in the database do the function
	$error = "Found something!";
	// adding .= dot to equal will make the var do many jobs and display them
	$search_output .= "<hr/> $count reuslts for <strong>$searchquery</strong>";
	
	$search_output2 .= "	
	<table style=width:150% id=t01>
    <tr>
   	<th>Album Cover</th>
   	<th>Song Name</th>
    <th>Album Name</th>
    <th>Album Artist</th>		
    <th>Contributing Artist</th>
    <th>Youtube Link</th>
  	</tr>
  	";
	while($row = mysqli_fetch_array($results)){
		$AlbumPicture			= $row["AlbumPicture"];
		$SongName 	 			= $row["SongName"];
		$AlbumName	 			= $row["AlbumName"];
		$AlbumArtist 			= $row["AlbumArtist"];
		$SongContributingArtist = $row["SongContributingArtist"];
		$SongYoutubeLink 		= $row["SongYoutubeLink"];
		$SongMP3Download		= $row["SongMP3Download"];
		
		$search_output2 .="
		
	<tr>
	<td><img src=$AlbumPicture alt=Album Picture style=width:100px;height:100px></td>
	<td>$SongName</td>
	<td>$AlbumName</td>
	<td>$AlbumArtist</td>	
	<td>$SongContributingArtist</td>	
	<td><a href=$SongYoutubeLink>$SongYoutubeLink</a></td>
	</tr>
		";
	}
		$search_output2 .= "</table>";
		$search_output .= "<hr/><br/>";
	}
		else {
	$error = "Nothing Found!";
		}
	}		


	// search for album name 
	if($_POST['filter1'] == "QUERY2"){
				
	// select command to view results
	$sqlCommand = " SELECT SongName, SongLength, AlbumName, s.SongArtist, SongsRating,SongReleaseDate
					FROM Song s LEFT JOIN Album a
					ON s.AlbumNo=a.AlbumNo
					WHERE a.AlbumName like'%$searchquery%'
					UNION
					SELECT SongName, SongLength, AlbumName, s.SongArtist, SongsRating,SongReleaseDate
					FROM Song s RIGHT JOIN Album a
					ON s.AlbumNo=a.AlbumNo
					WHERE a.AlbumName like '%$searchquery%' ";
		
	// SQL query to fetch information of registerd users and finds user match.
	$results = mysqli_query($db, $sqlCommand) or die(mysqli_error($db));

	$count = mysqli_num_rows($results); // mysqli_num_rows return the # of rows from the query
	
	if ($count >= 1) { // if found at least one row in the database do the function
	$error = "Found something!";
	// adding .= dot to equal will make the var do many jobs and display them
	$search_output .= "<hr/> $count reuslts for <strong>$searchquery</strong>";
	
	$search_output2 .= "	
	<table style=width:80% id=t01>
    <tr>
   	<th>Song Name</th>
   	<th>Song Length</th>
   	<th>Album Name</th>
   	<th>Song Artist</th>
   	<th>Song Rating</th>
   	<th>Song Release Date</th>   	   	   	   	
  	</tr>
  	";
	while($row = mysqli_fetch_array($results)){
		$SongName 	 			= $row["SongName"];
		$SongLength 	 		= $row["SongLength"];
		$AlbumName	 			= $row["AlbumName"];
		$SongArtist	 			= $row["SongArtist"];
		$SongsRating	 		= $row["SongsRating"];
		$SongReleaseDate		= $row["SongReleaseDate"];
										
		$search_output2 .="
		
	<tr>
	<td>$SongName</td>
	<td>$SongLength</td>
	<td>$AlbumName</td>
	<td>$SongArtist</td>
	<td>$SongsRating</td>
	<td>$SongReleaseDate</td>	
	
	</tr>
		";
	}
		$search_output2 .= "</table>";
		$search_output .= "<hr/><br/>";
	}
		else {
	$error = "Nothing Found!";
		}
	}	
	


	// search for songs name giving link
	if($_POST['filter1'] == "QUERY3"){
	
	// select command to view results
	$sqlCommand = " SELECT *
					FROM Song_Link AS sl , Song As s2
					WHERE SongName like '%$searchquery%' AND sl.SongNo=s2.SongNo ";
		
	// SQL query to fetch information of registerd users and finds user match.
	$results = mysqli_query($db, $sqlCommand) or die(mysqli_error($db));

	$count = mysqli_num_rows($results); // mysqli_num_rows return the # of rows from the query
	
	if ($count >= 1) { // if found at least one row in the database do the function
	$error = "Found something!";
	// adding .= dot to equal will make the var do many jobs and display them
	$search_output .= "<hr/> $count reuslts for <strong>$searchquery</strong>";
	
	$search_output2 .= "	
	<table style=width:80% id=t01>
    <tr>
   	<th>Song Name</th>
   	<th>YouTube Link</th>	   	   	   	
  	</tr>
  	";
	while($row = mysqli_fetch_array($results)){
		$SongName 	 				= $row["SongName"];
		$SongYouTubeLink 	 		= $row["SongYouTubeLink"];
		$SongMP3Download 	 		= $row["SongMP3Download"];
										
		$search_output2 .="
		
	<tr>
	<td>$SongName</td>
	<td><a href=$SongYouTubeLink>$SongYouTubeLink</a></td>
	</tr>
		";
	}
		$search_output2 .= "</table>";
		$search_output .= "<hr/><br/>";
	}
		else {
	$error = "Nothing Found!";
		}
	}

	// search for song release date
	if($_POST['filter1'] == "QUERY4"){
				
	// select command to view results
	$sqlCommand = " SELECT SongName, SongLength, s.SongArtist, SongsRating ,SongReleaseDate
					FROM   Song s 
					WHERE  SongReleaseDate= ('$searchquery')
					Order By SongsRating DESC ";
		
	// SQL query to fetch information of registerd users and finds user match.
	$results = mysqli_query($db, $sqlCommand) or die(mysqli_error($db));

	$count = mysqli_num_rows($results); // mysqli_num_rows return the # of rows from the query
	
	if ($count >= 1) { // if found at least one row in the database do the function
	$error = "Found something!";
	// adding .= dot to equal will make the var do many jobs and display them
	$search_output .= "<hr/> $count reuslts for <strong>$searchquery</strong>";
	
	$search_output2 .= "	
	<table style=width:80% id=t01>
    <tr>
   	<th>Song Name</th>
   	<th>Song Length</th>
   	<th>Song Artist</th>
   	<th>Song Rating</th>
   	<th>Song Release Date</th>   	   	   	   	
  	</tr>
  	";
	while($row = mysqli_fetch_array($results)){
		$SongName 	 			= $row["SongName"];
		$SongLength 	 		= $row["SongLength"];
		$SongArtist	 			= $row["SongArtist"];
		$SongsRating	 		= $row["SongsRating"];
		$SongReleaseDate		= $row["SongReleaseDate"];
										
		$search_output2 .="
		
	<tr>
	<td>$SongName</td>
	<td>$SongLength</td>
	<td>$SongArtist</td>
	<td>$SongsRating</td>
	<td>$SongReleaseDate</td>	
	
	</tr>
		";
	}
		$search_output2 .= "</table>";
		$search_output .= "<hr/><br/>";
	}
		else {
	$error = "Nothing Found!";
		}
	}
	
	// song rating 
	if($_POST['filter1'] == "QUERY5"){
				
	// select command to view results
	$sqlCommand = " SELECT SongName, SongArtist, SongLength, SongsRating
					FROM Song
					WHERE SongsRating like '%$searchquery%' ";
		
	// SQL query to fetch information of registerd users and finds user match.
	$results = mysqli_query($db, $sqlCommand) or die(mysqli_error($db));

	$count = mysqli_num_rows($results); // mysqli_num_rows return the # of rows from the query
	
	if ($count >= 1) { // if found at least one row in the database do the function
	$error = "Found something!";
	// adding .= dot to equal will make the var do many jobs and display them
	$search_output .= "<hr/> $count reuslts for <strong>$searchquery</strong>";
	
	$search_output2 .= "	
	<table style=width:80% id=t01>
    <tr>
   	<th>Song Name</th>
   	<th>Song Artist</th>
   	<th>Song Length</th>
  	</tr>
  	";
	while($row = mysqli_fetch_array($results)){
		$SongName 	 			= $row["SongName"];
		$SongArtist	 			= $row["SongArtist"];
		$SongLength 	 		= $row["SongLength"];
											
		$search_output2 .="
		
	<tr>
	<td>$SongName</td>
	<td>$SongArtist</td>
	<td>$SongLength</td>
	
	</tr>
		";
	}
		$search_output2 .= "</table>";
		$search_output .= "<hr/><br/>";
	}
		else {
	$error = "Nothing Found!";
		}
	}

	// search within song genre
	if($_POST['filter1'] == "QUERY6"){
	
	// select command to view results
	$sqlCommand = " SELECT SongName, AlbumName, a.AlbumArtist, SongLength
					FROM Song s, Album a
					WHERE s.SongGenre like '%$searchquery%' AND s.AlbumNo=a.AlbumNo ";
		
	// SQL query to fetch information of registerd users and finds user match.
	$results = mysqli_query($db, $sqlCommand) or die(mysqli_error($db));

	$count = mysqli_num_rows($results); // mysqli_num_rows return the # of rows from the query
	
	if ($count >= 1) { // if found at least one row in the database do the function
	$error = "Found something!";
	// adding .= dot to equal will make the var do many jobs and display them
	$search_output .= "<hr/> $count reuslts for <strong>$searchquery</strong>";
	
	$search_output2 .= "	
	<table style=width:80% id=t01>
    <tr>
   	<th>Song Name</th>
   	<th>Album Name</th>
   	<th>Album Artist</th>
   	<th>Song Length</th> 	   	   	   	
  	</tr>
  	";
	while($row = mysqli_fetch_array($results)){
		$SongName 	 			= $row["SongName"];
		$AlbumName 	 			= $row["AlbumName"];
		$AlbumArtist 			= $row["AlbumArtist"];
		$SongLength 	 		= $row["SongLength"];
										
		$search_output2 .="
		
	<tr>
	<td>$SongName</td>
	<td>$AlbumName</td>
	<td>$AlbumArtist</td>
	<td>$SongLength</td>	
	
	</tr>
		";
	}
		$search_output2 .= "</table>";
		$search_output .= "<hr/><br/>";
	}
		else {
	$error = "Nothing Found!";
		}
	}	

		
	}
	}
?>