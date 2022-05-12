<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php
    include('includes/function.php');
	include('messages/messages.php');
	require_once("thumbnail_images.class.php");  

		  if(isset($_POST['submit']))
			{ 
							$data = array(											                          			           'latitude' => $_POST['latitude'],
						   'longitude' => $_POST['longitude'],
						    );
					 
			          $team_edit=Update('tbl_general', $data, "WHERE id = '".$_POST['id']."'");
					  }
					  if ($team_edit > 0){
						
 					  $_SESSION['msg']= "Update Successfully";
 		  	          header("Loction:contact.php");
					  //exit;
					  }
 	
		$qry="SELECT * FROM tbl_general";
		$result=mysql_query($qry);
		$row=mysql_fetch_assoc($result);
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
					<a href="contact.php">Contact Details</a>
 				</li>
				 
			</ul>
			
			<div class="row-fluid">
			 <div class="box span12">
			  <div class="box-header" data-original-title>
				<h2><i class="icon-edit"></i><span class="break"></span>Edit Contact Details</h2>	 
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
				<form id="" class="form-horizontal" method="post" action="contact.php" enctype="multipart/form-data">
            	         <input  type="hidden" name="id" value="<?php echo $row['id'];?>" />
 						  <fieldset>
 						  <h3> Google Map Latitude and Longitude</h3>
 						  <div class="control-group">
							  <label class="control-label" for="facebook">Latitude</label>
							  <div class="controls">
						    <input type="text" class="span8 typeahead" name="latitude" id="latitude" value="<?php echo $row['latitude'];?>">
                                </div>
                                </div>
                                
                                 <div class="control-group">
							  <label class="control-label" for="facebook">Longitude</label>
							  <div class="controls">
						    <input type="text" class="span8 typeahead" name="longitude" id="longitude" value="<?php echo $row['longitude'];?>">
                                </div>
                                </div>
 						     <br> 
 						     
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