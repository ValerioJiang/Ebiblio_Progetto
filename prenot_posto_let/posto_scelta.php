<?php
include('/xampp/htdocs/ebiblio/main_partials/menu.php');
?>

<div class="container-fluid">
    <div class="col-md-3">
        <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" />
    </div>
    <div class="col-md-3">
        <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" />
    </div>
    <div class="col-md-5">
        <input type="button" name="filter" id="filter" value="Filter" class="btn btn-info" />
    </div>
    <div style="clear:both"></div>
    <br />

</div>
</div>

<script>
    $(document).ready(function() {
        $.datepicker.setDefaults({
            dateFormat: 'yy-mm-dd'
        });
        $(function() {
            $("#from_date").datepicker();
            $("#to_date").datepicker();
        });
        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $.ajax({
                    url: "filter.php",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        to_date: to_date
                    },
                    success: function(data) {
                        $('#order_table').html(data);
                    }
                });
            } else {
                alert("Please Select Date");
            }
        });
    });
</script>
<?php
include('/xampp/htdocs/ebiblio/main_partials/footer.php');
?>