<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
    mysql_query("SET NAMES 'utf8'");
	include('messages/messages.php');
	require_once("thumbnail_images.class.php"); 
	
 	 	if(isset($_GET['movie_id']))
	{
 			$qry="SELECT * FROM tbl_movie WHERE id='".$_GET['movie_id']."'";
			$result=mysql_query($qry);
			$row=mysql_fetch_assoc($result);
 	}
   
		  if(isset($_POST['submit']))
			{
			    $title=clean($_POST['movie_title']);		
				$title=htmlentities($title);		
				//$date=date("Y/m/d");
				$newtitle=string_limit_words($title, 20);
				$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);

				$newurltitle=strtolower(str_replace(" ","-",$newtitle));
				$url=$newurltitle.'-'.rand(0,999).'.html';
		
				
  		      if($_FILES['movie_image']['name']!=""){
		
				$img_res=mysql_query('SELECT * FROM tbl_movie WHERE id=\''.$_GET['movie_id'].'\'');
			    $img_res_row=mysql_fetch_assoc($img_res);
			
			    if($img_res_row['movie_image']!="")
		        {
					unlink('upload/'.$img_res_row['movie_image']);
					unlink('upload/'.$img_res_row['movie_image']);
					 
			      
 				   $movie_image=rand(0,99999)."_".$_FILES['movie_image']['name'];
				   $pic1=$_FILES['movie_image']['tmp_name'];
					
					 $tpath1='upload/'.$movie_image;
						
							 copy($pic1,$tpath1);
							 
					
					    $thumbpath='upload/thumbs/'.$movie_image;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
			   }
			   }
			   else
			   {
				   $movie_image = $_POST['old_image'];
				}
				
				 	
  		      if($_FILES['movie_poster_img']['name']!="")
  		      {
					 
					unlink('upload/'.$img_res_row['movie_poster_img']);
					unlink('upload/'.$img_res_row['movie_poster_img']);
					 
			      
 				   $movie_poster_img=rand(0,99999)."_".$_FILES['movie_poster_img']['name'];
				   $pic1=$_FILES['movie_poster_img']['tmp_name'];
					
					 $tpath1='upload/'.$movie_poster_img;
						
							 copy($pic1,$tpath1);
					       $thumbpath='upload/thumbs/'.$movie_poster_img;
						$obj_img = new thumbnail_images();
						$obj_img->PathImgOld = $tpath1;
						$obj_img->PathImgNew =$thumbpath;
						$obj_img->NewWidth = 72;
						$obj_img->NewHeight = 72;
						if (!$obj_img->create_thumbnail_images()) 
						  {
							echo $_SESSION['msg']="Thumbnail not created... please upload image again";
						    exit;
						  }
				}
				 else
				 {
				   $movie_poster_img = $_POST['old_poster_image'];
				 }

   						                               $data = array(
													  'cid'  =>  $_POST['cid'],
													  'genre_id' => implode(',',$_POST['genre_id']),
  													  'movie_title'=>$_POST['movie_title'],
  													  'movie_casts' => implode(',',$_POST['movie_casts']),
  													  'movie_image'  => $movie_image,
  													  'movie_poster_img'  => $movie_poster_img,
													  'movie_desc'=> addslashes($_POST['movie_desc']),
												      'movie_date'=>$_POST['movie_date'],
													  'movie_view'=>$_POST['movie_view'],
												      'movie_rating'=>$_POST['movie_rating'],
													  'url'=>$url
									 					);
								   $movie_edit=Update('tbl_movie', $data, "WHERE id = '".$_POST['id']."'");
								   }
					    if ($movie_edit > 0){
						
 						$_SESSION['msg']="25";
						header( "Location:edit-movie.php?movie_id=".$_POST['id']);
						exit;
						}
 		
		
	$cat_qry="SELECT * FROM tbl_category";
	$cat_result=mysql_query($cat_qry);
	
	$actors_qry="select * from tbl_actors";
    $actors_result=mysql_query($actors_qry);

   $genre_qry="select * from tbl_genres";
   $genre_result=mysql_query($genre_qry);
?>
<script src="js/jquery-1.9.1.min.js"></script>

<script type="text/javascript" src="js/jquery.validate.min.js"></script>

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

 
<script src="js/jquery-ui.js"></script>
<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
                <li>
					<i class="icon-table"></i>
					<a href="manage_movie.php">Manage Movie</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Movie</a>
				</li>
			</ul>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Edit Movie</h2>
						 
					</div>
					<div class="box-content">
          <p style="color:#990000; font-size:14px;" align="center">
					<?php if(isset($_SESSION['msg'])){ 
						?>
						
            <div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<?php echo $admin_lang[$_SESSION['msg']] ; ?>

						</div>
            	           
             <?php unset($_SESSION['msg']);		
							
					}?>
           </p>
				<form id="edit_ringtone" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            	         <input  type="hidden" name="id" value="<?php echo $_GET['movie_id'];?>" />
                                    <div class="control-group">
							  <label class="control-label" for="cat_id">Category Name</label>
							  <div class="controls">
                 	         <select name="cid" id="cid">
                                     <option>--Select Category--</option>
                                      <?php 											 
											while($cat_row=mysql_fetch_array($cat_result))
											{
										?>
                      <option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cid']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>
                  
                       <?php }?>
									</select>
 							  </div>
							</div>
                           
                           <div class="control-group">
							  <label class="control-label" for="#">Movie Name</label>
							  <div class="controls">
						    <input type="text" class="span6 typeahead" name="movie_title" id="movie_title" value="<?php echo $row['movie_title'];?>">
                                </div>
                                </div>
                                
                  
                  
                    <div class="control-group">
				<label class="control-label" for="selectError1">Movie Casts</label>
			    <div class="controls">
				<select id="selectError1" name="movie_casts[]" multiple data-rel="chosen">
				<?php
        while($actors_row=mysql_fetch_array($actors_result))
	    {
     ?> 
<option value="<?php echo $actors_row['id'];?>" <?php $actors_ids=explode(',',$row['movie_casts']); foreach($actors_ids as $actor_id){ if($actors_row['id']==$actor_id){ ?>selected<?php }}?>><?php echo $actors_row['actors_name'];?></option>
<?php 
}
?>    
				</select>
				</div>
				</div>
                  
		                     <div class="control-group">
							  <label class="control-label" for="name">Movie Description</label>
							  <div class="controls">
	<textarea type="text" class="span6 typeahead" name="movie_desc" id="movie_desc" value=""><?php echo $row['movie_desc'];?></textarea>
	  				           <script>                             
				                    CKEDITOR.replace( 'movie_desc' );
				                </script>
                                </div>
                                </div>
                
                 <div class="control-group">
				<label class="control-label" for="#">Movie Genre</label>
				<div class="controls">
				<select name="genre_id[]" id="genre_id" multiple>
     <?php
        while($genre_row=mysql_fetch_array($genre_result))
	    {
     ?> 
<option value="<?php echo $genre_row['id'];?>" <?php $genres_ids=explode(',',$row['genre_id']); foreach($genres_ids as $genre_id){ if($genre_row['id']==$genre_id){ ?>selected<?php }}?>><?php echo $genre_row['genres_name'];?></option>
<?php 
}
?>    
</select>
				</div>
		        </div>
		         
                               <div class="control-group">
							  <label class="control-label" for="name">Date</label>
							  <div class="controls">
						    <input type="date" class="span6 typeahead" name="movie_date" id="movie_date" value="<?php echo $row['movie_date'];?>">
                                </div>
                                </div>
                                <div class="control-group">
							  <label class="control-label" for="#">Movie Image</label>
							  <div class="controls">
                              <input type="file" name="movie_image" >
                              <img src="upload/<?php echo $row['movie_image']; ?>" width="150" />
						    <input type="hidden" name="old_image" value="<?php echo $row['movie_image'];?> "> 
                                </div>
                                </div>
                                
                                  <!--<div class="control-group">
							  <label class="control-label" for="#">Home Slider Image</label>
							  <div class="controls">
                              <input type="file" name="movie_poster_img">
                              <img src="upload/<?php echo $row['movie_poster_img']; ?>" width="150" />
						    <input type="hidden" name="old_poster_image" value="<?php echo $row['movie_poster_img'];?> "> 
                                </div>
                                </div>-->
                             <div class="control-group">
							<label class="control-label" for="#">Rating</label>
							<div class="controls">
					    <select name="movie_rating">
						<option value="1" <?php if($row['movie_rating']=='1'){?>selected<?php }?>> 1 </option>
						<option value="2" <?php if($row['movie_rating']=='2'){?>selected<?php }?>> 2 </option>
						<option value="3" <?php if($row['movie_rating']=='3'){?>selected<?php }?>> 3 </option>
						<option value="4" <?php if($row['movie_rating']=='4'){?>selected<?php }?>> 4 </option>
						<option value="5" <?php if($row['movie_rating']=='5'){?>selected<?php }?>> 5 </option>
					     </select>
						 
						    </div>
							</div>
							</div>
			                    
                                <fieldset>
                               
  							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Edit Movie</button>
 							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
 </div>


<?php include('includes/footer.php');?>                  