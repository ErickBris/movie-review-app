
<?php include("includes/header.php");?>
 <?php include("includes/menu.php");?>

<?php
	include('includes/function.php');
	include('messages/messages.php'); 
 	
	mysql_query("SET NAMES 'utf8'");	
 	
 	//Delete Player
	if(isset($_GET['genres_id']))
	{
  		  
		Delete('tbl_genres','id='.$_GET['genres_id'].'');
		
		$_SESSION['msg']="18";
	}
	//Get all owners
	 $genres_qry="SELECT * FROM tbl_genres";
	 $genres_result=mysql_query($genres_qry);
	
 ?>

<!-- start: Content -->
			<div id="content" class="span10">
			
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="dashboard.php">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Manage Genres</a></li>
			</ul>

			 			<div class="row-fluid">		
			 			 <div class="span12" align="right"><a href="add_genre.php" title="" data-rel="tooltip" class="btn btn-warning" data-original-title="Add Genres">Add Generes</a></div>
						</div>
 					<br/>
         <div class="row-fluid">	
				<div class="box span12">

					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Manage Genres</h2>
						 
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
                              <th>Genres Name</th>
                              <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                
                              <?php 
								 	while($genres_row=mysql_fetch_array($genres_result))
									{
								?>
                <tr>
                   <td><?php echo $genres_row['genres_name'];?></td>
                   <td class="center">
                   <a class="btn btn-info" href="edit-genre.php?genres_id=<?php echo $genres_row['id'];?>">
                      <i class="halflings-icon white edit"></i>  
                    </a>                    
                    <a class="btn btn-danger" href="manage_genre.php?genres_id=<?php echo $genres_row['id'];?>" title="Delete Genres" onClick="return confirm('Delete this Genres?')">
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