
<html>

 <head><title>CS 564 PHP Project Delete Result Page</title></head>

 <body>      
	
 <?php
   // First check the itemid to see if it has been set
  if (!isset($_POST['dCandyName']) ) {
    echo "  <h3><i>Error, title not set to an acceptable value</i></h3>\n".
        " <a href=\"https://cs564.cs.wisc.edu/gblock/cs564Proj7/index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  $candyName = $_POST['dCandyName'];
  $candyPrice = $_POST['dCandyPrice'];
  $candyQuantity = $_POST['dCandyQuantity'];
  $candyType = $_POST['dCandyType'];
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 
  // Get category name and item counts
  if( strlen($candyPrice) > 0 || strlen($candyType) > 0 || strlen($candyQuantity) > 0)	{
    $query = "delete from candy_store_schema.candy (cname) values (";
    if(strlen($candyName)){
      $query .= "'" .$candyName . "')";
    }else{
      $query .= "'')";
    }

  }else	{
    echo "  <h3><i>no field to be updated</i></h3>\n".
        " <a href=\"https://cs564.cs.wisc.edu/gblock/cs564Proj7/index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  // Execute the query and check for errors
  $result = pg_query($query);
  if (!$result) {
    $errormessage = pg_last_error();
    echo "Error with query: " . $errormessage;
    exit();
  }
  echo "  <h3>Delete Successful</h3>";
  
  pg_close();
?>

        <?php echo "<a href=\"https://cs564.cs.wisc.edu/gblock/cs564Proj7/index.html\">Back to main page</a>\n"?>
 </body>

</html>

