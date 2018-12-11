<?php
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename= $title.xls");  

header("Pragma: no-cache");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
echo ""; //no ending ; here
 
 ?>
<table border="1" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Product Name</th>
      <th>Long Desc</th>
      <th>Range Desc</th>
      <th>Serial Number</th>
      <th>Scan Date</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php if(isset($sumData) > 0):?>
    <tr class="kosong">
      <td colspan="9" align="center">There is no data in the field</td>
    </tr>
    <?php else:?>
    <?php $no=1;  ?>
    <?php $i=1; foreach($scan as $scan) { ?>
    <tr>
      <td>
        <?php echo $no;?>
      </td>
      <td>
        <?php echo $scan->product_name; ?>
      </td>
      <td>
        <?php echo $scan->long_desc; ?>
      </td>
      <td>
        <?php echo $scan->range_desc; ?>
      </td>
      <td>
        <?php echo $scan->s_number; ?>
      </td>
      <td>
        <?php echo $scan->date; ?>
      </td>
      <td>
        <?php echo $scan->status; ?>
      </td>
    </tr>
    <?php $i++; $no++;} ?>
    <?php endif;?>
  </tbody>
</table>