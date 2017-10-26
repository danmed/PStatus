<!DOCTYPE html>
<html>
<head>
   <title>PHP - Jquery Datatables Example</title>
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
   <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/css/jquery.dataTables.css">
   <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
</head>
<body>

<div class="container">
  <h2>PHP - Jquery Datatables Example</h2>
  <table id="my-example">
    <thead>
      <tr>
          <th>Device</th>
          <th>Type</th>
          <th>Info</th>
          <th>Purpose</th>
          <th>Status></th>
          <th>Uptime</th>
      </tr>
    </thead>
  </table>
</div>

</body>

<script type="text/javascript">
  $(document).ready(function() {
      $('#my-example').dataTable({
        "bProcessing": true,
        "sAjaxSource": "pro.php",
        "aoColumns": [
              { mData: 'id' } ,
              { mData: 'name' },
              { mData: 'email' }
            ]
      });  
  });
</script>
</html>
