<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
mysql_query("SET NAMES 'utf8'");
	include('messages/messages.php');
	require_once("thumbnail_images.class.php");  

 	 	if(isset($_GET['genres_id']))
	{
 			$qry="SELECT * FROM tbl_genres WHERE id='".$_GET['genres_id']."'";
			$result=mysql_query($qry);
			$row=mysql_fetch_assoc($result);
 	}
   
		  if(isset($_POST['submit']))
			{
  	                             $data = array(
  								 'genres_name'  =>  $_POST['genres_name'],
  								  );
																
								   $genres_edit=Update('tbl_genres', $data, "WHERE id = '".$_POST['id']."'");
								   
					    if ($genres_edit > 0){
						
 						$_SESSION['msg']="9";
						header( "Location:edit-genre.php?genres_id=".$_POST['id']);
						exit;
						}
 		}
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
					<a href="manage_genre.php">Manage Genres</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Genres</a>
				</li>
			</ul>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Edit Genres</h2>
						 
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
				<form id="edit_category" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            	         <input  type="hidden" name="id" value="<?php echo $_GET['genres_id'];?>" />
	
 						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="#">Genres Name</label>
							  <div class="controls">
						    <input type="text" class="span6 typeahead" name="genres_name" id="genres_name" value="<?php echo $row['genres_name'];?>">
                                </div>
                                </div>
                                
  							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Edit Genres</button>
 							</div>
						  </fieldset>
						</form>   
 					</div>
				</div><!--/span-->

			</div><!--/row-->
 </div>

<?php include('includes/footer.php');?>                  