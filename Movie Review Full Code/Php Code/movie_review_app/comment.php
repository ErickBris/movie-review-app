<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php
    include('includes/function.php');
	include('messages/messages.php');
	require_once("thumbnail_images.class.php");  

		  if(isset($_POST['submit']))
			{
  		        
					$data = array(						
					 'comment' => addslashes($_POST['comment']),
					 'comment_limit' => $_POST['comment_limit']
							);
						 
					$team_edit=Update('tbl_general', $data, "WHERE id = '".$_POST['id']."'");
					 }
					  if ($team_edit > 0){
						  
 					  $_SESSION['msg']= "Update Successfully";
 		  	          header("Loction:comment.php");
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
					<a href="comment.php">Disqus Code</a>
 				</li>
				 
			</ul>
			
			<div class="row-fluid">
			 <div class="box span12">
			  <div class="box-header" data-original-title>
				<h2><i class="icon-edit"></i><span class="break"></span>Edit Disqus Code</h2>	 
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
				<form id="" class="form-horizontal" method="post" action="comment.php" enctype="multipart/form-data">
            	         <input  type="hidden" name="id" value="<?php echo $row['id'];?>" />
 						  <fieldset>
                             
                                 <div class="control-group">
							  <label class="control-label" for="google_analytics">Disqus Code</label>
							  <div class="controls">
						  <textarea name="comment" id="comment" value="" class="span8 typeahead" rows="8"><?php echo $row['comment']; ?></textarea> 
                                </div>
                                </div>
								 <div class="control-group">
							  <label class="control-label" for="google_analytics">Recent Comments</label>
							  <div class="controls">
						  <input type="number" name="comment_limit" id="comment_limit" value="<?php echo $row['comment_limit']; ?>" class="span8 typeahead">
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