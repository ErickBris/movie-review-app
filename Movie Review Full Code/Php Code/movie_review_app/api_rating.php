<?php include("includes/db_connection.php");
	mysql_query("SET NAMES 'utf8'");	
include("includes/function.php");
  
    
    if(isset($_GET['movie']))
	{
		 
    	//search if the user(ip) has already gave a note
    	$ip = $_GET['device_id'];
    	$therate = $_GET['rate'];
    	$movie_id = $_GET['movie_id'];
	
    	$query1 = mysql_query("select * from tbl_rating where movie_id  = '$movie_id' && ip = '$ip' "); 
    	while($data1 = mysql_fetch_assoc($query1)){
    		$rate_db1[] = $data1;
    	}
    	if(@count($rate_db1) == 0 ){
			
    		   $data = array(            
               'movie_id'  =>$movie_id,
              'rate'  =>  $therate,
              'ip'  => $ip,
               );  
 	$qry = Insert('tbl_rating',$data); 
     	
					//Total rate result
					 
				$query = mysql_query("select * from tbl_rating where movie_id  = '$movie_id' ");
               
			   while($data = mysql_fetch_assoc($query)){
                  	$rate_db[] = $data;
                    $sum_rates[] = $data['rate'];
               
                }
				
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
				 
				$rate_avg=round($rate_value); 
				
		  $sql="update tbl_movie set movie_total_rate=movie_total_rate + 1,movie_rate_avg='$rate_avg' where id='".$movie_id."'";
           mysql_query($sql) or die (mysql_error());
		 /*?> $data = array(											 
				    'movie_total_rate'  =>  $rate_times,
					'movie_rate_avg'  =>  $rate_avg
				);

		$category_edit=Update('tbl_movie', $data, "where id = '".$movie_id."'")or die(mysql_error());	<?php */
		
				echo '{"MovieReview":[{"MSG":"You have succesfully rated"}]}';
				
    	}else{
    						
				echo '{"MovieReview":[{"MSG":"You have already rated"}]}';
    	}
   
	}
	else
	{
		echo '{"MovieReview":[{"MSG":"Error"}]}';
		
	}
?>