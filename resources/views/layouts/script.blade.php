<script>
    function chngdepartment(empid) {

        $.ajax({
            type: 'GET',
            url: '/hrm/get_emp_ytpe/' + empid,
            cache: false,
            success: function(response) {
                console.log(response);
                var obj_data = JSON.parse(response);
                var output = '';
                output += '<option value = "all"> Select all </option>';
                $.each(obj_data, function(i, data) {
                    output += '<option value = "' + data.id + '" selected> ' + data.fname + ' ' + data.mid_name + ' ' + data.lname + ' {' + data.code + ' )' +
                        '</option>';
                });
                $('#employee_id').html(output);
                // document.getElementById("title").innerHTML = response;

            }
        });
    };

    function calculateDays() {
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();
        var fromdate = new Date(from_date);
        var todate = new Date(to_date);
        var diffDays = (todate.getDate() - fromdate.getDate()) + 1;
        $("#num_of_day").val(diffDays);
    }
</script>