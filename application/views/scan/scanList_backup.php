<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>List Data</title>
	<link  rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
  <link href="<?php echo base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
  <!-- <link href="<?php echo base_url().'assets/css/jquery.dataTables.min.css'?>" rel="stylesheet"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  

    <style type="text/css">
    .center{
      position: absolute;
      margin-top: -100px;
      margin-left: -200px;
      left: 50%;
      top: 50%;
      width: 400px;
      height: 220px;
    }
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #fff;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    </style>
    <script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
    </script>
    <script>
		function confirmDialog() {
		 return confirm('Are you sure you want to delete this data?')
		}
	</script>
  <script type="text/javascript" src="<?php echo base_url("assets/js/bootstrap.js"); ?>"></script>
  <script language="JavaScript" type="text/javascript" src="<?php echo base_url("assets/js/jquery-2.2.4.min.js");?>"></script>
 
</head>
<body>
  <div class="preloader">
      <div class="loading">
        <img src="<?php echo base_url('assets/images/wait.gif'); ?>" width="70px">
      </div>
  </div>

	<div id="wrapper">
  <div class="container">
   <h2>List Data </h2>
      <a href="<?php echo site_url('scan/export_excel') ?>" class="btn btn-primary pull-left"><i class="fa fa-download" aria-hidden="true"></i> Export to Excel </a>
     <div class="col-md-3 date">
     <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      <input id="config-demo" type="text" class="form-control" name="date" placeholder="Search">
    </div>
     </div>

    <a href="<?php echo base_url('');?>" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Scan New Data</a>
   <table class="table table-bordered table-striped" id="mydata"><br>
   	<thead>
	       
       <tr><br><br> 
         <th>No</th>
         <th>Product Name</th>
         <th>Long Desc</th>
         <th>Range Desc</th>
         <th>S/N</th>
         <th>Scan Date</th>
         <th>Status</th>
         <th>Action</th>
       </tr>
     </thead>
     <tbody>

     	<?php if($sumData > 0):?>
        <?php $no=0; foreach ($scan as $s): $no++ ?>
        <tr class="data">
         <th><?php echo $no;?></th>
         <td><?php echo $s->product_name;?></td>
         <td><?php echo $s->long_desc;?></td>  
         <td><?php echo $s->range_desc;?></td>
         <td><?php echo $s->s_number;?></td>
         <td><?php echo $s->date;?></td>
         <td><?php echo $s->status;?></td>
         <td>

           <div class="dropdown">
              <button class="btn btn-xs btn-warning dropdown-toggle" id="Status" name="status" type="button" data-toggle="dropdown">Choose Status
              <span class="caret"></span></button>
              <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('scan/updateStatus/'.$s->id.'/OK');?>">OK</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo site_url('scan/updateStatus/'.$s->id.'/NG');?>">NG</a></li>
              </ul>
	          <!-- <a class="btn btn-xs btn-info" href="<?php echo site_url('scan/edit/'.$s->id);?>" aria-hidden="true"> Edit</a> -->
            <a class="btn btn-xs btn-danger" <?php echo anchor('scan/delete/'.$s->id, 'Delete', array('class'=>'delete', 'onclick'=>"return confirmDialog();")); ?> </a> </a>   
          </div>
         </td>
      </tr>
  <?php endforeach;?>
<?php else:?>
	
  <tr class="kosong">
         <td colspan="9" align="center">There is no data in the field</td>
  </tr>
<?php endif;?>
      </tbody>
     </table>
    </div>
  </div>

<script src="<?php echo base_url().'assets/js/jquery-2.2.4.min.js'?>"></script>
<script src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
<!-- <script src="<?php echo base_url().'assets/js/jquery.dataTables.min.js'?>"></script> -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
<script src="<?php echo base_url().'assets/js/moment.js'?>"></script> 
<script>
	$(document).ready(function(){
		$('#mydata').DataTable();
	});
</script>
<script>
$(document).ready(function(){
$(".preloader").fadeOut();
})
</script>
n
</body>
</html>