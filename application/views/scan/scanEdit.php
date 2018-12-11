<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <title>Scan IQC Apps</title>
 <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" type="text/css">
 <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css');?>" type="text/css">
 <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" type="text/css">
 <script src="<?php echo base_url('assets/js/jquery.min.js');?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/js/jquery-migrate.js');?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/js/tether.min.js');?>" type="text/javascript"></script>
 <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>" type="text/javascript"></script>

</head>
<body>

 <div id="wrapper">
  <div class="container">
   <h3> Update Data </h3>
    <a href="<?php echo site_url('scan/');?>" class="btn btn-primary pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a></p><br><br>

   <div class="grid-layout">
    <form method="post" action="<?php echo site_url('scan/update');?>">
       <input type="hidden" name="id" value="<?php echo $s->id;?>">
       
       <div class="form-group">
         <label for="product_name">Product Name</label>
         <input type="text" class="form-control" value="<?php echo $s->product_name;?>" name="product_name" disabled>
         <?php echo form_error('product_name', '<div class="error">', '</div>'); ?>
       </div>


       <div class="form-group">
         <label for="long_desc">Long Desc</label>
         <input type="text" class="form-control" value="<?php echo $s->long_desc;?>" name="long_desc" disabled>
          <?php echo form_error('long_desc', '<div class="error">', '</div>'); ?>
       </div>

       <div class="form-group">
         <label for="range_desc">Range Desc</label>
         <input type="text" class="form-control" value="<?php echo $s->range_desc;?>" name="range_desc" disabled>
          <?php echo form_error('range_desc', '<div class="error">', '</div>'); ?>
       </div>

       <div class="form-group">
         <label for="s_number">S/N</label>
         <input type="text" class="form-control" value="<?php echo $s->s_number;?>" name="s_number" disabled>
          <?php echo form_error('s_number', '<div class="error">', '</div>'); ?>
       </div>


       <div class="form-group">
         <label for="Status">Status</label>
         <select class="form-control" id="Status" name="status">
           <option value="">---</option>
           <option value="OK">OK</option>
           <option value="NG">NG</option>
         </select>
          <?php echo form_error('status', '<div class="error">', '</div>'); ?>
       </div>
        
       <button type="submit" class="btn btn-primary">Submit</button>
     </form>
   </div>

  </div>
 </div>

</body>
</html>