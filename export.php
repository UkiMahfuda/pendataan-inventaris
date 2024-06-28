<?php
require 'function.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>List Inventaris</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
</head>

<body>
<div class="container">
  <h2>List Inventaris</h2>
  <h4>(PT IPC Terminal Petikemas Area Panjang)</h4>
  <div class="data-tables datatable-dark">
    <table class="table table-bordered" id="mauexport" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Barang</th>
          <th>Deskripsi</th>
          <th>Stock</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $ambilsemuadatalist = mysqli_query($conn,"SELECT * FROM list");
        $i = 1;
        while($data = mysqli_fetch_array($ambilsemuadatalist)){
          $namabarang = $data['namabarang'];
          $deskripsi = $data['deskripsi'];
          $stock = $data['stock'];
          $idb = $data['idbarang'];
        ?>
        <tr>
          <td><?=$i++;?></td>
          <td><?php echo $namabarang;?></td>
          <td><?php echo $deskripsi;?></td>
          <td><?php echo $stock;?></td>
        </tr>
        <?php
        };
        ?>
      </tbody>
    </table>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#mauexport').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel',
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                customize: function(doc) {
                    doc.pageMargins = [20, 20, 20, 20];

                    doc.pageOrientation = 'portrait';
                    doc.pageSize = 'A4';

                    var objLayout = {};
                    objLayout['hLineWidth'] = function(i) { return .5; };
                    objLayout['vLineWidth'] = function(i) { return .5; };
                    objLayout['hLineColor'] = function(i) { return '#aaa'; };
                    objLayout['vLineColor'] = function(i) { return '#aaa'; };
                    objLayout['paddingLeft'] = function(i) { return 4; };
                    objLayout['paddingRight'] = function(i) { return 4; };
                    doc.content[1].layout = objLayout;

                    doc.content[1] = {
                        table: doc.content[1].table,
                        layout: doc.content[1].layout,
                        margin: [100, 0, 100, 0], 
                    };
                }
            },
            'print'
        ]
    });
});
</script>

</body>
</html>
