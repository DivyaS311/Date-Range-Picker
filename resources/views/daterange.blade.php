<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daterange Filter in Datatables with Server-side Processing</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
</head>
<body>
	<h1 align="center">DateRange</h1><br>
<div class="container">
    <div class="row input-daterange">
        <div class="col-md-4">
            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date"  max={{date('Y-m-d')}} min="2018-08-31" />
        </div>
        <div class="col-md-4">
            <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" max={{date('Y-m-d')}} min="2018-08-31" />
        </div>
        <div class="col-md-4">
            <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
            <button type="button" name="refresh" id="refresh" class="btn btn-primary">Refresh</button>
        </div>
    </div>
    <br />

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover" id="order_table">
            <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Item</th>
                <th>Value</th>
                <th>Date</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
</html>

<script>

    
    $(document).ready(function(){
        $('#input-daterange').datepicker({
            
            format:'yyyy-mm-dd',
            changeMonth: true,
            changeYear: true,
            autoclose:true,
            

            
       });
     

        load_data();

        function load_data(from_date = '', to_date = '')
        {
            $('#order_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url:'/daterange',
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                    {
                        data:'order_id',
                        name:'order_id'
                    },
                    {
                        data:'order_customer_name',
                        name:'order_customer_name'
                    },
                    {
                        data:'order_item',
                        name:'order_item'
                    },
                    {
                        data:'order_value',
                        name:'order_value'
                    },
                    {
                        data:'order_date',
                        name:'order_date'
                    }
                ]
            });
        }

        $('#filter').click(function(){
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' &&  to_date != '')
            {
                $('#order_table').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else
            {
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#order_table').DataTable().destroy();
            load_data();
        });

    });
</script>
