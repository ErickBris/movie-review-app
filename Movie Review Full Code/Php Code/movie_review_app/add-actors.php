<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
	include('messages/messages.php');
	require_once("thumbnail_images.class.php"); 
    mysql_query("SET NAMES 'utf8'");	
    
 	if(isset($_POST['submit']))
	{
		
		$image=rand(0,99999)."_".$_FILES['actors_image']['name'];
				    $pic1=$_FILES['actors_image']['tmp_name'];
					
					 $tpath1='upload/'.$image;
				  				
					     copy($pic1,$tpath1);
						 
					    $thumbpath='upload/thumbs/'.$image;
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
  													  'actors_image	'  => $image	,
												      );		
 					  $qry = Insert('tbl_actors',$data);									
      				  $_SESSION['msg']="11";
					  header( "Location:manage_actors.php");
					  exit;
 	}
	 
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
            $("#add_actors").validate({
                rules: {
                                        actors_name: "required",
									 
   									},
                 messages: { 
										 actors_name: "Please enter Actors Name",
										  
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

#add_actors label.error {
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
					<a href="manage_actors.php">Manage Actors</a>
					<i class="icon-angle-right"></i> 
				 </li>
				
                 <li>
					<i class="icon-plus"></i>
					<a href="#">Add Actors</a>
				</li>
            </ul>
                         <div class="row-fluid">
                        <div class="box span12">
                        <div class="box-header" data-original-title>
						<h2><i class="icon-plus"></i><span class="break"></span>Add Actors</h2>
						 
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
                  
                <form id="add_actors" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                            
                <div class="control-group">
				<label class="control-label" for="#">Actors Name</label>
				<div class="controls">
				<input type="text" class="span6 typeahead" name="actors_name" id="actors_name" value="">
 				</div>
		        </div>
                
 				<div class="control-group">
				<label class="control-label" for="#">Actors Image</label>
				<div class="controls">
			  <input type="file" name="actors_image" id="actors_image" value="" class="input-xlarge">      
         		</div>
                 </div>
                          
                <div class="form-actions">
			    <button type="submit" name="submit" class="btn btn-primary">Add Actors</button>
			    </div>
				</fieldset>
				</form>   
 			    </div>
				</div><!--/span-->

			</div><!--/row-->
            </div>			

<?php include('includes/footer.php');?>                  