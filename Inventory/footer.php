    <!--Javascripts -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script> 
        <script src="data/jquery.dataTables.min.js"></script>
        <script src="data/filterDropDown.js"></script>

        <script> 
// initialising dt table

$(document).ready( function () {
    $('#my').DataTable();
} );
            $(document).ready(function() {
            
                $('#example').DataTable({                   
                    // Definition of filter to display                  
                    filterDropDown: {                                       
                        columns: [
                            { 
                                idx: 1
                            },
                            
                        ],
                        bootstrap: true
                    }
                } );
            } );
        //////////////////////////////////////

            $("#myform :input").change(function() {
           $("#myform").data("changed",true);
            });
            
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);
  

            $(document).ready(function(){
                $('.search').on('keyup',function(){
                    var searchTerm = $(this).val().toLowerCase();
                    $('#userTbl tbody tr').each(function(){
                        var lineStr = $(this).text().toLowerCase();
                        if(lineStr.indexOf(searchTerm) === -1){
                            $(this).hide();
                        }else{
                            $(this).show();
                        }
                    });
                });
            });
        </script>
    </body>
</html>



