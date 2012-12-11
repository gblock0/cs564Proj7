
<html>

 <head><title>CS 564 PHP Project Insert Result Page</title></head>

 <body>      
	
 <?php
   // First check the itemid to see if it has been set
  if (!isset($_POST['iCandyName']) ) {
    echo "  <h3><i>Error, title not set to an acceptable value</i></h3>\n".
        " <a href=\"https://cs564.cs.wisc.edu/gblock/cs564Proj7/index.html\">Back to main page</a>\n".
	" </body>\n</html>\n";
    exit();
  }
  $candyName = $_POST['iCandyName'];
  $candyPrice = $_POST['iCandyPrice'];
  $candyQuantity = $_POST['iCandyQuantity'];
  $candyType = $_POST['iCandyType'];
  // Connect to the Database
  pg_connect('dbname=cs564_f12 host=postgres.cs.wisc.edu') 
	or die ("Couldn't Connect ".pg_last_error()); 
  // Get category name and item counts
  if( strlen($candyPrice) > 0 || strlen($candyType) > 0 || strlen($candyQuantity) > 0)	{
    $query = "insert into candy_store_schema.candy (cprice, ctype, cquantity, cname) values (";
	if( strlen($candyPrice) )	{
    $query .= $candyPrice . ",";
  }else{
    $query .= "'',";
  }

	if( strlen($candyType) )	{
    $query .= "'".$candyType."',";
  }else{
    $query .= "'',";
  }

  if(strlen($candyQuantity)){
    $query .= $candyQuantity . ",";
  }else{
    $query .= "'',";
  }

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
  echo "  <h3>Insert Successful</h3>";
  
  pg_close();
?>

        <?php echo "<a href=\"https://cs564.cs.wisc.edu/gblock/cs564Proj7/index.html\">Back to main page</a>\n"?>
 </body>

</html>
