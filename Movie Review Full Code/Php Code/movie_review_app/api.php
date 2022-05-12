<?php include("includes/db_connection.php");?>
<?php include("includes/function.php");
      
      mysql_query("SET NAMES 'utf8'");	
	
	if(isset($_GET['cid']))
	{
     	$cat_id=$_GET['cid'];	
     	
     	$jsonObj = array();
		$query="SELECT * FROM tbl_movie
		LEFT JOIN tbl_category ON tbl_movie.cid= tbl_category.cid 
		where tbl_movie.cid like'%$cat_id%'";
		$sel = mysql_query($query);
		while($data = mysql_fetch_assoc($sel))
		{
			$row['id'] = $data['id'];
			$row['cid'] = $data['cid'];
			//$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = $data['movie_title'];
		    //$row['movie_casts'] = $data['movie_casts'];
			$row['movie_image'] = $data['movie_image'];
 			$row['movie_desc'] = $data['movie_desc'];
			$row['movie_date'] = $data['movie_date'];
			$row['movie_view'] = $data['movie_view'];
			$row['movie_rating'] = $data['movie_rating'];
			$row['movie_total_rate'] = $data['movie_total_rate'];
			$row['movie_rate_avg'] = $data['movie_rate_avg'];
			$row['movie_casts'] = '';
			$cat  = explode(',', $data['movie_casts']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',', $data['movie_casts']) as $category ){
							   
							   $sql="select * from tbl_actors where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['movie_casts'] .=  $cat['actors_name'];	
							}
							else
							{
							$row['movie_casts'] .=  $cat['actors_name'].',';	
							}
							  }


            $row['genre_id'] = '';
			$cat  = explode(',', $data['genre_id']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',',$data['genre_id']) as $category ){
							   
							   $sql="select * from tbl_genres where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['genre_id'] .=  $cat['genres_name'];	
							}
							else
							{
							$row['genre_id'] .=  $cat['genres_name'].',';	
							}
							
							  }

			
			$row['movie_image'] = $data['movie_image'];
		array_push($jsonObj,$row);
		
		}
		 $set['MovieReview'] = $jsonObj;
			
		      header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
			die();
		 
	}
     	
     	 
	    //$query="SELECT * FROM tbl_movie
		//LEFT JOIN tbl_category ON tbl_movie.cid= tbl_category.cid 
		//where tbl_movie.cid like'%$cat_id%'";
		
	 
	else if(isset($_GET['latest']))
	{
		$limit=$_GET['latest'];	 	
		$query="SELECT * FROM tbl_movie
		LEFT JOIN tbl_category ON tbl_movie.cid= tbl_category.cid 
		ORDER BY tbl_movie.id DESC LIMIT $limit";
	}
	else if(isset($_GET['actors']))
	{
	  $query="SELECT id,actors_name,actors_image FROM tbl_actors";
	}
	
	else if(isset($_GET['actors_id']))
	{
    	$cat_id=$_GET['actors_id'];		
	
	    $jsonObj = array();

$query="SELECT tbl_movie.id as movie_id,tbl_movie.cid,tbl_movie.genre_id,tbl_movie.movie_title,tbl_movie.movie_casts,tbl_movie.movie_image,tbl_movie.movie_desc,tbl_movie.movie_date,tbl_movie.movie_view,tbl_movie.movie_total_rate,tbl_movie.movie_rate_avg,tbl_actors.actors_name FROM tbl_movie
LEFT JOIN tbl_actors ON tbl_movie.movie_casts= tbl_actors.id 
where tbl_movie.movie_casts like'%$cat_id%'";
	    
	    //$query="SELECT * FROM tbl_movie
		//LEFT JOIN tbl_actors ON tbl_movie.movie_casts= tbl_actors.id 
		//where tbl_movie.movie_casts like'%$cat_id%'";
		$sel = mysql_query($query);

		while($data = mysql_fetch_assoc($sel))
		{
			$row['movie_id'] = $data['movie_id'];
			$row['cid'] = $data['cid'];
			//$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = $data['movie_title'];
		    //$row['movie_casts'] = $data['movie_casts'];
			$row['movie_image'] = $data['movie_image'];
 			$row['movie_desc'] = $data['movie_desc'];
			$row['movie_date'] = $data['movie_date'];
			$row['movie_view'] = $data['movie_view'];
			$row['movie_rating'] = $data['movie_rating'];
			$row['movie_total_rate'] = $data['movie_total_rate'];
			$row['movie_rate_avg'] = $data['movie_rate_avg'];
			$row['movie_casts'] = '';
			$cat  = explode(',', $data['movie_casts']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',', $data['movie_casts']) as $category ){
							   
							   $sql="select * from tbl_actors where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['movie_casts'] .=  $cat['actors_name'];	
							}
							else
							{
							$row['movie_casts'] .=  $cat['actors_name'].',';	
							}
							  }
 
            $row['genre_id'] = '';
			$cat  = explode(',', $data['genre_id']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',',$data['genre_id']) as $category ){
							   
							   $sql="select * from tbl_genres where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['genre_id'] .=  $cat['genres_name'];	
							}
							else
							{
							$row['genre_id'] .=  $cat['genres_name'].',';	
							}
							
							  }
							   	 		  

 	   		$row['movie_image'] = $data['movie_image'];
		array_push($jsonObj,$row);
		
		}
		 $set['MovieReview'] = $jsonObj;
			
		  header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
			die();
  	}
		
	 
	
	else if(isset($_GET['movie_id']) && !isset($_GET['comments']))
	{
       $cat_id=$_GET['movie_id'];		
 	   
 	    $jsonObj = array();
		$query="SELECT * FROM tbl_movie	 
		where tbl_movie.id=$cat_id";
		$sel = mysql_query($query);
		while($data = mysql_fetch_assoc($sel))
		{
			$row['id'] = $data['id'];
			$row['cid'] = $data['cid'];
			//$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = $data['movie_title'];
		//	$row['movie_casts'] = $data['movie_casts'];
			$row['movie_image'] = $data['movie_image'];
 			$row['movie_desc'] = $data['movie_desc'];
			$row['movie_date'] = $data['movie_date'];
			$row['movie_view'] = $data['movie_view'];
			$row['movie_rating'] = $data['movie_rating'];
			$row['movie_total_rate'] = $data['movie_total_rate'];
			$row['movie_rate_avg'] = $data['movie_rate_avg'];
			$row['movie_casts'] = '';
			$cat  = explode(',', $data['movie_casts']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',', $data['movie_casts']) as $category ){
							   
							   $sql="select * from tbl_actors where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['movie_casts'] .=  $cat['actors_name'];	
							}
							else
							{
							$row['movie_casts'] .=  $cat['actors_name'].',';	
							}
							  }
 
            $row['genre_id'] = '';
			$cat  = explode(',', $data['genre_id']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',',$data['genre_id']) as $category ){
							   
							   $sql="select * from tbl_genres where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['genre_id'] .=  $cat['genres_name'];	
							}
							else
							{
							$row['genre_id'] .=  $cat['genres_name'].',';	
							}
							
							  }
							   	$SQL2 = "select * from tbl_movie where cid = '".$data['cid']."'";
				       			$result2 = mysql_query($SQL2);
								
								$subvidArr=array();
								while ($row2 = mysql_fetch_assoc($result2)) 
								{	
				 					if($data['id'] != $row2['id'])
									{									
									$temp = array('rel_id' => $row2['id'], 'rel_movie_title' => $row2['movie_title'] , 'rel__movie_id' =>$row2['id'],
									 'rel_movie_thumbnail' => $row2['movie_image']);
									$subvidArr[]=$temp;
									}
								}
								$row['related']=$subvidArr;			  

 	   		$row['movie_image'] = $data['movie_image'];
		array_push($jsonObj,$row);
		
		}
		 $set['MovieReview'] = $jsonObj;
			
		      header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
			die();
  	}
	else if(isset($_GET['genres']))
	{
	  $query="SELECT id,genres_name FROM tbl_genres";
	}
	
	else if(isset($_GET['genres_id']))
	{

		$cat_id=$_GET['genres_id'];	
		
	$jsonObj = array();

$query="SELECT tbl_movie.id as movie_id,tbl_movie.cid,tbl_movie.genre_id,tbl_movie.movie_title,tbl_movie.movie_casts,tbl_movie.movie_image,tbl_movie.movie_desc,tbl_movie.movie_date,tbl_movie.movie_view,tbl_movie.movie_total_rate,tbl_movie.movie_rate_avg,tbl_genres.genres_name FROM tbl_movie
LEFT JOIN tbl_genres ON tbl_movie.genre_id= tbl_genres.id 
where tbl_movie.genre_id like'%$cat_id%'";
	   
	    //$query="SELECT * FROM tbl_movie
		//LEFT JOIN tbl_genres ON tbl_movie.genre_id= tbl_genres.id 
		//where tbl_movie.genre_id like'%$cat_id%'";
		 
		$sel = mysql_query($query);

		while($data = mysql_fetch_assoc($sel))
		{
			$row['movie_id'] = $data['movie_id'];
			$row['cid'] = $data['cid'];
			//$row['genre_id'] = $data['genre_id'];
			$row['movie_title'] = $data['movie_title'];
		    //$row['movie_casts'] = $data['movie_casts'];
			$row['movie_image'] = $data['movie_image'];
 			$row['movie_desc'] = $data['movie_desc'];
			$row['movie_date'] = $data['movie_date'];
			$row['movie_view'] = $data['movie_view'];
			$row['movie_rating'] = $data['movie_rating'];
			$row['movie_total_rate'] = $data['movie_total_rate'];
			$row['movie_rate_avg'] = $data['movie_rate_avg'];
			$row['movie_casts'] = '';
			$cat  = explode(',', $data['movie_casts']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',', $data['movie_casts']) as $category ){
							   
							   $sql="select * from tbl_actors where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['movie_casts'] .=  $cat['actors_name'];	
							}
							else
							{
							$row['movie_casts'] .=  $cat['actors_name'].',';	
							}
							  }
 
            $row['genre_id'] = '';
			$cat  = explode(',', $data['genre_id']);
			$lastElement = end($cat);
			
			foreach($cat = explode(',',$data['genre_id']) as $category ){
							   
							   $sql="select * from tbl_genres where id='$category'";
							   $mysql=mysql_query($sql);
							   $cat=mysql_fetch_array($mysql);
							    	
							if($category == $lastElement)
							{
							$row['genre_id'] .=  $cat['genres_name'];	
							}
							else
							{
							$row['genre_id'] .=  $cat['genres_name'].',';	
							}
							
							  }
							   	 		  

 	   		$row['movie_image'] = $data['movie_image'];
		array_push($jsonObj,$row);
		
		}
		 $set['MovieReview'] = $jsonObj;
			
		     header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
			die();
  	}			
	 
	elseif(isset($_GET['comments']))
	{
	//echo time();
	//exit;
	   //echo strtotime(date('Y-m-d H:i'));
	   //exit;
	    //$curr_timestamp = date('Y-m-d H:i:s');
          
              $movie_id  =  $_GET['movie_id'];
              $user_id  = $_GET['user_id'];
              $comment  = $_GET['comment'];
			  $created = strtotime(date('Y-m-d H:i'));
			  
              
      mysql_query("insert into tbl_comment(movie_id, user_id, comment, created) values                      ('$movie_id','$user_id','$comment','$created')");
     //$qry = Insert('tbl_comment',$data) or die(mysql_error()); 
       
     $set['MovieReview'][]=array('msg' => 'Comment Added SuccessFull','Success'=>'1');
    
   header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
	die();
     }
     
     elseif(isset($_GET['mid']))
	{
	    $id = $_GET['mid'];
		$query="select tbl_comment.comment,tbl_comment.created,tbl_registration.username from tbl_comment inner join tbl_registration on tbl_registration.id=tbl_comment.user_id WHERE tbl_comment.movie_id='$id' ORDER BY tbl_comment.id";  
     
     $sel = mysql_query($query);
     if (mysql_num_rows($sel) > 0)
     {
	 	
	 }
	 else
	 {
	 	 $set['MovieReview'][]=array('msg' => 'No Comment Found','Success'=>'0');
				  header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
				die();
	 }
       
     }
     
				
	 
	
	elseif(isset($_GET['task']) && ($_GET['task']) == "registration")
	{
		$user_name  = $_GET['username'];
		$email  = $_GET['email'];
		$pass  = $_GET['password'];
		
		if($email)
     {
      //Check duplicate entry
      $qry="SELECT * FROM tbl_registration WHERE email='".$_GET['email']."'";
      $result=mysql_query($qry);
      $row=mysql_fetch_assoc($result);
      
      if($row['email']==$_GET['email'])
      {
       $set['MovieReview'][]=array('msg' => "Email address already used",'success'=>'0');
      }
      else
      {
       
          $data = array(            
               'username'  =>  $_GET['username'],
              'email'  =>  $_GET['email'],
              'password'  => $_GET['password'],
               );  
      
     $qry = Insert('tbl_registration',$data); 
       
     $set['MovieReview'][]=array('msg' => 'Registration SuccessFull','Success'=>'1');
        }
	     header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
	die();
     }
	 	
	}
	
	elseif(isset($_GET['task']) && ($_GET['task']) == "login")
	{
		$email  = $_GET['email'];
		$pass  = $_GET['password'];
		
		$sel = mysql_query("select * from tbl_registration where email = '".$email."' && password = '".$pass."'  ");
		if(mysql_num_rows($sel) > 0)
		{
			$sel = "select id,username,email from tbl_registration where email = '".$email."' && password = '".$pass."'  ";
			$sql = mysql_query($sel);
			$user = mysql_fetch_assoc($sql);
			$id = $user['id'];
			$email = $user['email'];
			$username = $user['username'];
			$set['MovieReview'][]=array('Success'=>'1','id'=>$id,'username'=>$username,'email'=>$email);
		
		
		   header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
			 
			die();
		}
		else
		{
				$set['MovieReview'][]=array('msg' => 'Email or Password wrong','Success'=>'0');
	 header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
				die();
		}
	}
	  
	else
	{
		$query="SELECT cid,category_name FROM tbl_category";
			
	}
	 
	$resouter = mysql_query($query)or die(mysql_error());
     
    $set = array();
     
    $total_records = mysql_numrows($resouter);
    if($total_records >= 1){
     
      while ($link = mysql_fetch_array($resouter, MYSQL_ASSOC)){
	   
        $set['MovieReview'][] = $link;
      }
    }
      header( 'Content-Type: application/json; charset=utf-8' );
     echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE));
	
?>