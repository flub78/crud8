# Datatable

Datatable is a convenient Jquery module that provides filtering, pagination, element order, etc. out of the box.

    https://datatables.net/
    
Warning, datable does not like the colspan attribute. When used an Uncaught TypeError: ba is undefined error is reported.

To use datatable include the required css and javascript files in the app.blade.php file

and add the following in templates that use datatable (index.blade.php)

    <script type="text/javascript">
    <!--
    $(document).ready( function () {
        $('#maintable').DataTable({
            paging:true,
            dom: 'frtipB',
            buttons: [
                'csv',
                'print',
                'pdf'
            ]
            });
    } );
    //-->
    </script>

