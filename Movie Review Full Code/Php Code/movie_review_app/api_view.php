<?php include("includes/db_connection.php");
	mysql_query("SET NAMES 'utf8'");	
  
    
    if(isset($_GET['view']))
	{
		 
    	//search if the user(ip) has already gave a note
    	$ip = $_GET['device_id'];
    	$movie_id = $_GET['movie_id'];
	
    	$query1 = mysql_query("select * from tbl_views where movie_id  = '$movie_id' && ip = '$ip' "); 
    	while($data1 = mysql_fetch_assoc($query1)){
    		$rate_db1[] = $data1;
    	}
		
    	if(@count($rate_db1) == 0 ){
			
    		   $data = array(            
              'movie_id'  =>$movie_id,
              'ip'  => $ip,
               );  
      
      function Insert($table, $data){

    $fields = array_keys( $data );  
    $values = array_map( "mysql_real_escape_string", array_values( $data ) );
	
	
    mysql_query( "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysql_error() );

}   
      
     		$qry = Insert('tbl_views',$data); 
     	
					//Total rate result
					 
				  $sql="update tbl_movie set movie_view=movie_view + 1 where id='".$movie_id."'";
           mysql_query($sql);
				echo '{"MovieReview":[{"MSG":"You Have Succesfully Views"}]}';
				
    	}else{
    						
				echo '{"MovieReview":[{"MSG":"You Have Already Views"}]}';
    	}
    
		
	}
	else
	{
		echo '{"MovieReview":[{"MSG":"Error"}]}';
		
	}
?>