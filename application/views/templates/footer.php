

</div>
<!-- ./wrapper -->

 <!-- Main Footer -->
 <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.0
    </div>
  </footer>

<!-- view password -->
<script>
  function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<!-- image preview -->
<script>
  var loadFile = function(event) {
    var output = document.getElementById('img_prev');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>

<!-- Export DataTable -->
<script>
  function fnExcelReport()
  {
      $("#myTableCnt").table2csv({  
          filename: 'Reports.csv'  
      }); 
  }
  </script>
  
<!-- DataTable -->
<script>
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
</script>
<script>
        
        $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#myTableCnt thead tr').clone(true).appendTo( '#myTableCnt thead' );
            $('#myTableCnt thead tr:eq(1) th').each( function (i) {
                var title = $(this).text();
                $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        
                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        
            var table = $('#myTableCnt').DataTable( {
                aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
                iDisplayLength: 10,
                orderCellsTop: true,
                fixedHeader: true
            } );
        } );
    </script>

    <!-- user type dropdown change -->
    <script>
      $('#user_type').on('change', function() {
        if(this.value == "admin"){
          $('#branch_id').hide();
          $('#branch_id_label').hide();
        }else{
          $('#branch_id').show();
          $('#branch_id_label').show();
        }
      });
    </script>


<!-- AdminLTE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>

</body>
</html>
