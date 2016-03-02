<link href="../assets/css/style2.css" rel="stylesheet">
<!-- Search For: <input name="searchquery"  id="myText" placeholder="Ex. (UOIT,lova,fun)" type="text" size="20" maxlength="30">
    <input  type="submit" onclick="myFunction()" value="Search"
           class="btn-danger btn-large"> <br/><br/>
 -->

<?php include('../Configs/find.php'); // Includes Search Script ?>

<form  method="post">
Search For:
    <input name="searchquery" id="myText" placeholder="Ex. Taylor, Cole " type="text" size="20" maxlength="30">
Within:
<select name="filter1" title="Select an option" id="filter1">
<option value="QUERY1">Artist</option>
<option value="QUERY2">Album Name</option>
<option value="QUERY3">Song Name</option>
<option value="QUERY4">Song Release Year</option>
<option value="QUERY5">Song By Rating</option>
<option value="QUERY6">Song By Genre</option>
</select>   
<!-- Keep values of the selected option -->
<script type="text/javascript">
  document.getElementById('filter1').value = "<?php echo $_POST['filter1'];?>";
  document.getElementById('myText').value = "<?php echo $_POST['searchquery'];?>";
</script>
    <br/>
    <input name="submit" type="submit" value="Submit Query" class="btn-danger btn-large" >   <br/><br/>
</form>


<div id="instaHead" hidden>
    <h3 id="results">Instagram Search Results</h3>
    <!-- instagram pics -->
    <div id="instagram" class="imgs"></div>

    <div class='clearfix'></div>

    <!-- button -->
    <div id="showMore">
        <div class='clearfix '><a id='more' next_url='"+next_url+"' href='#'>[More]</a></div>
    </div>
    
     <h3 id="results">Music Database Search Results</h3> 
     <?php echo $error ?>
</div>

<?php echo $search_output ?>        
<script type="text/javascript">
  myFunction();
</script>

<?php echo $search_output2 ?>