<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
	include('messages/messages.php');
	require_once("thumbnail_images.class.php"); 
    mysql_query("SET NAMES 'utf8'");	
 	if(isset($_POST['submit']))
	{
		
		$title=clean($_POST['movie_title']);		
		$title=htmlentities($title);		
		//$date=date("Y/m/d");
		$newtitle=string_limit_words($title, 20);
		$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);

		$newurltitle=strtolower(str_replace(" ","-",$newtitle));
		$url=$newurltitle.'-'.rand(0,999).'.html';
		
 			
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
		
		    					                   $data = array(
													  'cid'  =>  $_POST['cid'],
													  'genre_id' => implode(',',$_POST['genre_id']),
  													  'movie_title'=>$_POST['movie_title'],
  													  'movie_casts' => implode(',',$_POST['movie_casts']),
  													  'movie_image'  => $movie_image,
  													  //'movie_poster_img'  => $movie_poster_img,
													  'movie_desc'=> addslashes($_POST['movie_desc']),
												    'movie_date'=>date("Y-m-d", strtotime($_POST['movie_date'])),
													  'movie_view'=>$_POST['movie_view'],
												      'movie_rating'=>$_POST['movie_rating'],
													  'url'=>$url
														);		
 					  $qry = Insert('tbl_movie',$data);									
      				  $_SESSION['msg']="24";
					  header( "Location:manage_movie.php");
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

<script type="text/javascript">
(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#add_movie").validate({
                rules: {
                                        cid: "required",
										movie_title: "required",
									    movie_date: "required"
   									},
                 messages: { 
										 cid: "Please enter Category Name",
										 movie_title: "Please enter  Movie Name",
										 movie_date: "Please enter  Movie Date"
										                  },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>
<style>

#add_movie label.error {
    color: #FB3A3A;
    display: inline-block;
    margin: 4px 0 5px 20px;
    padding: 0;
    text-align: left;
    width: auto;
}
</style>

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
					<i class="icon-plus"></i>
					<a href="#">Add Movie</a>
				</li>
            </ul>
                         <div class="row-fluid">
                        <div class="box span12">
                        <div class="box-header" data-original-title>
						<h2><i class="icon-plus"></i><span class="break"></span>Add Movie</h2>
						 
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
                  
                <form id="add_movie" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                 
                   <div class="control-group">
							  <label class="control-label" for="cid">Category Name</label>
                 <div class="controls">
                 	<select name="cid" id="cid">
                    <option value="">select category</option>
                  	 
                     <?php 											 
											while($data=mysql_fetch_array($cat_result))
											{
										?>
                     <option value="<?php echo $data['cid'];?>"><?php echo $data['category_name'];?></option>
                   <?php }?>
						        </select>
 							</div>
							</div>
                            
                <div class="control-group">
				<label class="control-label" for="#">Movie Name</label>
				<div class="controls">
				<input type="text" class="span6 typeahead" name="movie_title" id="movie_title" value="">
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
				<option value="<?php echo $actors_row['id'];?>" <?php $actors_ids=explode(',',$data['movie_casts']); foreach($actors_ids as $actor_id){ if($actors_row['id']==$actor_id){ ?>class="selected"<?php }}?>><?php echo $actors_row['actors_name'];?></option>
				 <?php 
    }
    ?>
				</select>
				</div>
				</div>
		       
                <div class="control-group">
				<label class="control-label" for="#">Movie Description</label>
				<div class="controls">
				<textarea type="text" class="span6 typeahead" name="movie_desc" id="movie_desc" value=""></textarea>
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
<option value="<?php echo $genre_row['id'];?>" <?php $genres_ids=explode(',',$data['genre_id']); foreach($genres_ids as $genre_id){ if($genre_row['id']==$genre_id){ ?>selected<?php }}?>><?php echo $genre_row['genres_name'];?></option>
<?php 
}
?>    
</select>
			
				</div>
		        </div>	        
		        <div class="control-group">
				<label class="control-label" for="#">Movie Date</label>
				<div class="controls">
				<input type="date" class="span6 typeahead" name="movie_date" id="movie_date" value="">
 				</div>
		        </div>
		        
		        <div class="control-group">
				<label class="control-label" for="#">Movie Image</label>
				<div class="controls">
			  <input type="file" name="movie_image" id="movie_image" value="" class="input-xlarge">      
         		</div>
                 </div>
                    <!--<div class="control-group">
				<label class="control-label" for="#">home slider image</label>
				<div class="controls">
			  <input type="file" name="movie_poster_img" id="movie_poster_img" value="" class="input-xlarge">      
         		</div>
                 </div>-->
                 
		        <!--<style>
		        input[type="radio"]{
				display: none;
				}	
		        </style>-->   
		        <div class="control-group">
				<label class="control-label" for="#">Rating</label>
				<div class="controls">
				<div class="box-content">
			 	<select name="movie_rating">
					<option value="1"> 1 </option>
					<option value="2"> 2 </option>
					<option value="3"> 3 </option>
					<option value="4"> 4 </option>
					<option value="5"> 5 </option>
				</select>
			    </div>
				</div>
				</div>
		        <div class="form-actions">
			    <button type="submit" name="submit" class="btn btn-primary">Add Movie</button>
			    </div>
				</fieldset>
				</form>   
 			    </div>
				</div><!--/span-->

			</div><!--/row-->
            </div>			

<?php include('includes/footer.php');?>                  