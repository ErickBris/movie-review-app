<?php include('includes/header.php');?>
<?php include('includes/menu.php');?>
<?php 
    include('includes/function.php');
   mysql_query("SET NAMES 'utf8'");
	include('messages/messages.php');
	require_once("thumbnail_images.class.php");  

 	 	if(isset($_GET['cid']))
	{
 			$qry="SELECT * FROM tbl_category WHERE cid='".$_GET['cid']."'";
			$result=mysql_query($qry);
			$row=mysql_fetch_assoc($result);
 	}
   
		  if(isset($_POST['submit']))
			{
  	                             $data = array(
  								  'category_name'  =>  $_POST['category_name'],
  								  );
																
								   $category_edit=Update('tbl_category', $data, "WHERE cid = '".$_POST['cid']."'");
								   
					    if ($category_edit > 0){
						
 						$_SESSION['msg']="9";
						header( "Location:edit-category.php?cid=".$_POST['cid']);
						exit;
						}
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
            $("#edit_category").validate({
                rules: {
                                        category_name: "required",
										},
                 messages: { 
										 category_name:"Please enter Category Name",
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

#edit_category label.error {
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
					<a href="manage_category.php">Manage Category</a>
					<i class="icon-angle-right"></i> 
				</li>
				<li>
					<i class="icon-edit"></i>
					<a href="#">Edit Category</a>
				</li>
			</ul>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="icon-edit"></i><span class="break"></span>Edit Category</h2>
						 
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
            	         <input  type="hidden" name="cid" value="<?php echo $_GET['cid'];?>" />
	
 						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="category_name">Category Name</label>
							  <div class="controls">
						    <input type="text" class="span6 typeahead" name="category_name" id="category_name" value="<?php echo $row['category_name'];?>">
                                </div>
                                </div>
                                
  							<div class="form-actions">
							  <button type="submit" name="submit" class="btn btn-primary">Edit Category</button>
 							</div>
						  </fieldset>
						</form>   
 					</div>
				</div><!--/span-->

			</div><!--/row-->
 </div>

<?php include('includes/footer.php');?>                  