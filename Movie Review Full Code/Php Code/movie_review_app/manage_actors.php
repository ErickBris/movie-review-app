<?php include("includes/header.php");?>
<?php include("includes/menu.php");?>

<?php
	include('includes/function.php');
	include('messages/messages.php'); 
 	
	mysql_query("SET NAMES 'utf8'");	
	
	//Get all owners
$actors_qry="SELECT * FROM tbl_actors";
$actors_result=mysql_query($actors_qry);
 	
	//Delete Player
	if(isset($_GET['actors_id']))
	{
  			$actors=mysql_query('SELECT * FROM tbl_actors WHERE id=\''.$_GET['actors_id'].'\'');
			$actors_row=mysql_fetch_assoc($actors);
			
			if($actors_row['actors_image']!="")
		    {
					unlink('upload/'.$actors_row['actors_image']);
					unlink('upload/'.$actors_row['actors_image']);
 			}
  
		Delete('tbl_actors','id='.$_GET['actors_id'].'');
		
		$_SESSION['msg']="13";
		header( "Location:manage_actors.php");
		exit;
 	}
 ?>

<!-- start: Content -->
			<div id="content" class="span10">
			
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Manage Actors</a></li>
			</ul>

			 			<div class="row-fluid">		
			 			
			 			 <div class="span12" align="right"><a href="add-actors.php" title="" data-rel="tooltip" class="btn btn-warning" data-original-title="Add Actors">Add Actors</a></div>
						</div>
 					<br/>
         <div class="row-fluid">	
				<div class="box span12">

					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Manage Actors</h2>
						 
					</div>
					<div class="box-content">
						<?php if(isset($_SESSION['msg'])){ 
						?>

					<div class="alert alert-info">
       					 <button type="button" class="close" data-dismiss="alert">×</button>
        				 <?php echo $admin_lang[$_SESSION['msg']] ; ?>
   					 </div>
                              <?php unset($_SESSION['msg']);		
 					}?>
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
																							         		
						  <thead>
							  <tr>
                                  <th>Actors Name</th>
                                  <th>Actors Image</th>
                                  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                
                             <?php 
									 
									while($actors_row=mysql_fetch_array($actors_result))
									{
								?>
                <tr>
                    <td><?php echo $actors_row['actors_name'];?></td>
                    <td><img src="upload/<?php echo $actors_row['actors_image'];?>" width="130"/></td> 
               
                   <td class="center">
                   <a class="btn btn-info" href="edit-actors.php?actors_id=<?php echo $actors_row['id'];?>">
                      <i class="halflings-icon white edit"></i>  
                    </a>                    
                    <a class="btn btn-danger" href="manage_actors.php?actors_id=<?php echo $actors_row['id'];?>" title="Delete taxi" onClick="return confirm('Delete this Actors?')">
                      <i class="halflings-icon white trash"></i> 
                    </a>
 
                      
                  </td>
                </tr>
                               <?php
									}
								?>
							  
						  </tbody>
					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->

			
			</div>
       
		
	</div><!--/.fluid-container-->
	
<!-- end: Content -->

<?php include("includes/footer.php");?>