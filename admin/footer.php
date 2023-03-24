<!-- </div> -->
    <!-- </div> -->
    <!-- end of main container -->

    <!-- js section -->
    <!-- bootstrap js popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- jquery datatable js cdn -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script>
        // $('.sidebar ul li').on('click', function(){
        //     $('.sidebar ul li.active').removeClass('active');
        //     $(this).addClass('active');
        // });

        $('.open-btn').on('click', function(){
            $('.sidebar').addClass('active');
        });

        $('.close-btn').on('click', function(){
            $('.sidebar').removeClass('active');
        });
    </script>
    <script type="text/javascript">
       $(document).ready( function () {
            $('#datatable').DataTable({
                "responsive": false, 
                "lengthChange": true, 
                "autoWidth": false,
                "searching": true,
                "paging": true,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "iDisplayLength": 10,
                "ordering": true,
            });
        } );
    </script>

    <!-- start of script for view user modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.view', function(event) {

                $('#view_user_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#view_user_id').val(data[1])
                $('#view_user_role').val(data[2]);
                $('#view_username').val(data[3]);
                $('#view_first_name').val(data[4]);
                $('#view_last_name').val(data[5]);
                $('#view_email').val(data[6]);
                $('#view_phone_number').val(data[7]);
                $('#view_is_verified').val(data[8]);
                $('#view_last_login').val(data[9]);
                $('#view_user_date_added').val(data[10]);
                $('#view_user_info_last_updated').val(data[13]);
                
            });
        });
    </script>
    <!-- end of script for view user modal -->

    <!-- start of script for edit user modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.edit', function(event) {

                $('#edit_service_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edit_user_id').val(data[1])
                $('#edit_user_role').val(data[2]);
                $('#edit_username').val(data[3]);
                $('#edit_first_name').val(data[4]);
                $('#edit_last_name').val(data[5]);
                $('#edit_email').val(data[6]);
                $('#edit_phone_number').val(data[7]);

            });
        });
    </script>
    <!-- end of script for edit user modal -->

    <!-- start of script for delete user modal -->
    <script>
        $(document).ready(function () {

            $('body').on('click', '.delete', function(event) {

                $('#delete_user_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_user_id').val(data[1]);

            });
        });
    </script>
    <!-- end of script for delete user modal -->

    <!-- start of script for view category modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.view', function(event) {

                $('#view_category_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#view_category_id').val(data[0])
                $('#view_category').val(data[1]);
                $('#view_category_date_added').val(data[2]);
                $('#view_category_last_updated').val(data[3]);
            });
        });
    </script>
    <!-- end of script for view category modal -->
    
    <!-- start of script for edit category modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.edit', function(event) {

                $('#edit_category_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edit_category_id').val(data[0])
                $('#edit_category').val(data[1]);
            });
        });
    </script>
    <!-- end of script for edit category modal -->

    <!-- start of script for delete category modal -->
    <script>
        $(document).ready(function () {

            $('body').on('click', '.delete', function(event) {

                $('#delete_category_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_category_id').val(data[0]);
            });
        });
    </script>
    <!-- end of script for delete category modal -->

    <!-- start of script for view service modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.view', function(event) {

                $('#view_service_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#view_service_id').val(data[0]);
                $('#view_category_id').val(data[1]);
                $('#view_category').val(data[2]);
                $('#view_service').val(data[3]);
                $('#view_description').val(data[4]);
                $('#view_price').val(data[5]);
                $('#view_service_date_added').val(data[6]);
                $('#view_service_last_updated').val(data[7]);
            });
        });
    </script>
    <!-- end of script for view service modal -->

    <!-- start of script for edit service modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.edit', function(event) {

                $('#edit_service_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edit_service_id').val(data[0]);
                $('#edit_category_id').val(data[1]);
                $('#edit_category').val(data[2]);
                $('#edit_service').val(data[3]);
                $('#edit_description').val(data[4]);
                $('#edit_price').val(data[5]);
            });
        });
    </script>
    <!-- end of script for edit service modal -->

    <!-- start of script for delete service modal -->
    <script>
        $(document).ready(function () {

            $('body').on('click', '.delete', function(event) {

                $('#delete_service_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_service_id').val(data[0]);

            });
        });
    </script>
    <!-- end of script for delete service modal -->

    <!-- start of script for view appointment modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.view', function(event) {

                $('#view_appointment_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#view_appointment_id').val(data[0]);
                $('#view_first_name').val(data[4]);
                $('#view_last_name').val(data[5]);
                $('#view_email').val(data[2]);
                $('#view_phone_number').val(data[3]);
                $('#view_pet_name').val(data[6]);
                $('#view_category').val(data[7]);
                $('#view_birthdate').val(data[8]);
                $('#view_gender').val(data[9]);
                $('#view_service').val(data[10]);
                $('#view_date').val(data[11]);
                $('#view_timeslot').val(data[12]);
                $('#view_status').val(data[13]);
                $('#view_appointment_date_added').val(data[14]);
                $('#view_appointment_last_updated').val(data[15]);
            });
        });
    </script>
    <!-- end of script for view appointment modal -->

    <!-- start of script for edit appointment modal -->
    <script>
        $(document).ready(function () {
            // $('body').on('click', '.edit', function(event) {
            $('body').on('click', '.edit', function(event) {

                $('#edit_appointment_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#edit_appointment_id').val(data[0]);
                $('#edit_service').val(data[10]);
                $('#edit_date').val(data[11]);
                $('#edit_timeslot').val(data[12]);
                // $('#edit_status').val(data[13]);
            });
        });
    </script>
    <!-- end of script for edit appointment modal -->

    <!-- start of script for delete appointment modal -->
    <script>
        $(document).ready(function () {

            $('body').on('click', '.delete', function(event) {

                $('#delete_appointment_modal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_appointment_id').val(data[0]);

            });
        });
    </script>
    <!-- end of script for delete appointment modal -->
</body>
</html>