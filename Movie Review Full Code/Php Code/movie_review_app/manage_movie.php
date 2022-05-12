<?php include("includes/header.php");?>
<?php include("includes/menu.php");?>

<?php
	include('includes/function.php');
	include('messages/messages.php'); 
 	
	mysql_query("SET NAMES 'utf8'");	
	
	//Get all owners
    $movie_qry="SELECT * FROM tbl_movie m,tbl_category c WHERE m.cid=c.cid ORDER BY m.id";
    $movie_result=mysql_query($movie_qry);
 	
	//Delete Player
	if(isset($_GET['movie_id']))
	{
  			$img=mysql_query('SELECT * FROM tbl_movie WHERE id=\''.$_GET['movie_id'].'\'');
			$img_row=mysql_fetch_assoc($img);
			
			if($img_row['movie_image']!="")
		    {
					unlink('upload/'.$img_row['movie_image']);
					unlink('upload/'.$img_row['movie_image']);
 			}
  
		Delete('tbl_movie','id='.$_GET['movie_id'].'');
		
		$_SESSION['msg']="26";
		header( "Location:manage_movie.php");
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
				<li><a href="#">Manage Movie</a></li>
			</ul>

			 			<div class="row-fluid">		
			 			
			 			 <div class="span12" align="right"><a href="add-movie.php" title="" data-rel="tooltip" class="btn btn-warning" data-original-title="Add Movie">Add Movie</a></div>
						</div>
 					<br/>
         <div class="row-fluid">	
				<div class="box span12">

					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Manage Movie</h2>
						 
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
                                  <th>Category Name</th>
                                  <th>Movie Name</th>
                                  <th>Image</th>
                                  <th>Actions</th>
							  </tr>
						  </thead>   
						  <tbody>
                
                             <?php 
									 
									while($movie_row=mysql_fetch_array($movie_result))
									{
								?>
                <tr>
                    <td><?php echo $movie_row['category_name'];?></td>
                    <td><?php echo $movie_row['movie_title'];?></td>
                   <td><img src="upload/<?php echo $movie_row['movie_image'];?>" width="130"/></td> 
                   
                   <td class="center">
                   <a class="btn btn-info" href="edit-movie.php?movie_id=<?php echo $movie_row['id'];?>">
                      <i class="halflings-icon white edit"></i>  
                    </a>                    
                    <a class="btn btn-danger" href="manage_movie.php?movie_id=<?php echo $movie_row['id'];?>" title="Delete Movie" onClick="return confirm('Delete this Movie?')">
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