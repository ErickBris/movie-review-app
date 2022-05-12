<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php
    include('includes/function.php');
	include('messages/messages.php');
	require_once("thumbnail_images.class.php");  

		  if(isset($_POST['submit']))
			{
  		       
							$data = array(		
						    'movie_name'=>implode(',',$_POST['movie_name']),
							);
					 
			         $team_edit=Update('tbl_home', $data, "WHERE id = '".$_POST['id']."'");
					 
					  if ($team_edit > 0){
						 }
 					  $_SESSION['msg']= "Update Successfully";
 		  	          header("Loction:home_page.php");
					  //exit;
					  }
 	
		$qry="SELECT * FROM tbl_home";
		$result=mysql_query($qry);
		$row=mysql_fetch_assoc($result);
		
		$movie_qry="SELECT * FROM tbl_movie";
		$movie_result=mysql_query($movie_qry);
		 
		  ?>
<script src="js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<div id="content" class="span10">
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a>
					<i class="icon-angle-right"></i> 
				</li>
                <li>
					<i class="icon-table"></i>
					<a href="home_page.php">Latest Movie Setting</a>
 				</li>
				 
			</ul>
			
			<div class="row-fluid">
			 <div class="box span12">
			  <div class="box-header" data-original-title>
				<h2><i class="icon-edit"></i><span class="break"></span>Edit Latest Movie  Setting</h2>	 
			</div>
		     <div class="box-content">
               <p style="color:#990000; font-size:14px;" align="center">
					<?php if(isset($_SESSION['msg'])){ ?>
						
               <div class="alert alert-success">
				 <button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_SESSION['msg'] ; ?>
			   </div>
            	    <?php unset($_SESSION['msg']);}?>
                </p>
				<form id="" class="form-horizontal" method="post" action="home_page.php" enctype="multipart/form-data">
            	         <input  type="hidden" name="id" value="<?php echo $row['id'];?>" />
 						  <fieldset>
                         
                    <div class="control-group">
				<label class="control-label" for="selectError1">Latest Movie</label>
			    <div class="controls">
				<select id="selectError1" name="movie_name[]" multiple data-rel="chosen">
				<?php
        while($movie_row=mysql_fetch_array($movie_result))
	    {
     ?> 
<option value="<?php echo $movie_row['id'];?>" <?php $movie_ids=explode(',',$row['movie_name']); foreach($movie_ids as $movie_id){ if($movie_row['id']==$movie_id){ ?>selected<?php }}?>><?php echo $movie_row['movie_title'];?></option>
<?php 
}
?>    
				</select>
				</div>
				</div>
				
  							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Save</button>
 							</div>
						  </fieldset>
						</form>   
					</div>
				</div>
			</div>
        </div>
<?php include('includes/footer.php');?>                  