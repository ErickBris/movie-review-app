<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
mysql_query("SET NAMES 'utf8'");
	include('messages/messages.php');
	require_once("thumbnail_images.class.php"); 
	
 	 	if(isset($_GET['actors_id']))
	{
 			$qry="SELECT * FROM tbl_actors WHERE id='".$_GET['actors_id']."'";
			$result=mysql_query($qry);
			$row=mysql_fetch_assoc($result);
 	}
   
		  if(isset($_POST['submit']))
			{ 
  		       if($_FILES['actors_image']['name']!=""){
		
				$img_res=mysql_query('SELECT * FROM tbl_actors WHERE id=\''.$_GET['actors_id'].'\'');
			    $img_res_row=mysql_fetch_assoc($img_res);
			
			    if($img_res_row['actors_image']!="")
		        {
					unlink('upload/'.$img_res_row['actors_image']);
					unlink('upload/'.$img_res_row['actors_image']);
					 
			      }
 				   $actors_image=rand(0,99999)."_".$_FILES['actors_image']['name'];
				   $pic1=$_FILES['actors_image']['tmp_name'];
					
					 $tpath1='upload/'.$actors_image;
					 
							  copy($pic1,$tpath1);
					       $thumbpath='upload/thumbs/'.$actors_image;
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
													  'actors_name'  =>  $_POST['actors_name'],
  													  'actors_image'  => $actors_image
												      );
								   $team_edit=Update('tbl_actors', $data, "WHERE id = '".$_POST['id']."'");
								   }
									else
								   {
													  $data = array(
													 'actors_name'  =>  $_POST['actors_name']
    												  );	
			 
			 
			           $team_edit=Update('tbl_actors', $data, "WHERE id = '".$_POST['id']."'");
					   }
					    if ($team_edit > 0){
						
 						$_SESSION['msg']="12";
						header( "Location:edit-actors.php?actors_id=".$_POST['id']);
						exit;
						}
 		}
	 
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
					<a href="manage_actors.php">Manage Actors</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Actors</a>
				</li>
			</ul>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Edit Actors</h2>
						 
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
            	         <input  type="hidden" name="id" value="<?php echo $_GET['actors_id'];?>" />
                           
                           <div class="control-group">
							  <label class="control-label" for="#">Actors Name</label>
							  <div class="controls">
						    <input type="text" class="span6 typeahead" name="actors_name" id="actors_name" value="<?php echo $row['actors_name'];?>">
                                </div>
                                </div>
                                
                                <div class="control-group">
							  <label class="control-label" for="#">Actors Image</label>
							  <div class="controls">
                              <input type="file" name="actors_image">
                              <img src="upload/<?php echo $row['actors_image']; ?>" width="150" />
						    <input type="hidden" name="actors_image" value="<?php echo $row['actors_image'];?> "> 
                                </div>
                                </div>
                           	</div>
			                     <fieldset>
                               
  							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Edit Actors</button>
 							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

			</div><!--/row-->
 </div>


<?php include('includes/footer.php');?>                  