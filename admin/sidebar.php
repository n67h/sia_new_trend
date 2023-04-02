<?php
    require_once 'includes/session.inc.php';
?>
    <!-- jquery datatable css cdn -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <!-- font-awesome cdn -->
    <script src="https://kit.fontawesome.com/3481525a72.js" crossorigin="anonymous"></script>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="../resources/css/style.css">
</head>
<body>
    <!-- start of main container -->
    <div class="main-container d-flex">
        <!-- start of sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="header-box px-2 pt-3 pb-2 d-flex justify-content-between">
                <?php
                    if(isset($_SESSION['admin_id'])){
                        $sql_level = "SELECT * FROM admin WHERE admin_id = $admin_id_session;";
                        $result_level = mysqli_query($conn, $sql_level);
                        if(mysqli_num_rows($result_level) > 0){
                            while($row_level = mysqli_fetch_assoc($result_level)){
                                $level = $row_level['user_level'];
                            }
                            echo '<h1 class="fs-4"><a href="dashboard.php" class="text-decoration-none"><span class="axgg text-white rounded shadow px-2 me-2 p-1">AXGG</span></a></h1>';
                            // <span class="text-white text-uppercase">' .$level. '</span>
                            // echo '<h1 class="fs-4"><a href="dashboard.php" class="text-decoration-none"><span class="bg-white text-dark rounded shadow px-2 me-2 p-1">AXGG</span><span class="text-white">Clinic</span></a></h1>';
                        }
                    }
                ?>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i class="fa-solid fa-bars-staggered"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <div class="d-flex mt-1 ps-2 pb-1">
                    <?php
                        if(isset($_SESSION['admin_id'])){
                            $sql = "SELECT * FROM admin WHERE admin_id = $admin_id_session;";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $name = $row['name'];
                                }
                                // echo '<li class="px-3 py-2 d-block text-white">' .$name. '</li>';
                            }
                        }
                    ?>
                </div>
                <div class="text-white">
                    <hr class="mx-2">
                </div>
                <?php
                    $url =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                    $parts = parse_url($url);
                    // fetch all the sub folders in url
                    $path_parts = explode('/', $parts['path']);

                    if($url !== 'localhost/sia/admin/dashboard.php'){
                        echo '<li class=""><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"></i> Dashboard</a></li>';
                    }else{
                        echo '<li class="active"><a href="dashboard.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"></i> Dashboard</a></li>';
                    }

                    if($url !== 'localhost/sia/admin/category.php'){
                        echo '<li class=""><a href="category.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-vest"></i> Categories</a></li>';
                    }else{
                        echo '<li class="active"><a href="category.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-vest"></i> Categories</a></li>';
                    }
                ?>
                    <a class="text-decoration-none px-3 py-2 d-block text-white" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fa-solid fa-shirt"></i> <span class="me-5">Products</span><i class="fa-solid fa-chevron-down ms-5"></i></a>
                    
                    <div class="collapse" id="collapseExample">
                        <div class="">
                            <ul class="list-unstyled px-2">
                            <?php
                                if($path_parts[3] !== 'product.php'){
                                    echo '<li class=""><a href="product.php?cat_id=0" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-shirt"></i> Products</a></li>';
                                }else{
                                    echo '<li class="active"><a href="product.php?cat_id=0" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-shirt"></i> Products</a></li>';
                                }
                                if($path_parts[3] !== 'color.php'){
                                    echo '<li class=""><a href="color.php?prod_id=0" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-palette"></i> Colors</a></li>';
                                }else{
                                    echo '<li class="active"><a href="color.php?prod_id=0" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-palette"></i> Colors</a></li>';
                                }

                                if($url !== 'localhost/sia/admin/size.php'){
                                    echo '<li class=""><a href="size.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-chart-simple"></i> Sizes</a></li>';
                                }else{
                                    echo '<li class="active"><a href="size.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-chart-simple"></i> Sizes</a></li>';
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                <?php   
                    if($url !== 'localhost/sia/admin/order.php'){
                        echo '<li class=""><a href="order.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-regular fa-calendar-days"></i></i> Orders</a></li>';
                    }else{
                        echo '<li class="active"><a href="order.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-regular fa-calendar-days"></i></i> Orders</a></li>';
                    }

                    if($url !== 'localhost/pet-clinic-booking-system/app/admin/category.php'){
                        echo '<li class=""><a href="scanner.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-barcode"></i> Scanner</a></li>';
                    }else{
                        echo '<li class="active"><a href="scanner.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-barcode"></i> Scanner</a></li>';
                    }

                    echo '
                        <div class="text-white">
                            <hr class="mx-2">
                        </div>
                    ';
                ?>
            </ul>
            <ul class="list-unstyled px-2">
                <li class=""><a href="includes/logout.inc.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-right-from-bracket"></i> Log out</a></li>
            </ul>
        </div>
        <!-- end of sidebar -->

        <div class="content">
            <!-- start of navbar -->
            <nav class="navbar navbar-expand-md navbar-light navbar-admin">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                        <a class="navbar-brand fs-4 text-dark" href="#">AXGG</a>
                        <button class="btn px-1 py-0 open-btn"><i class="fa-solid fa-bars-staggered"></i></button>
                    </div>
                    
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end me-5" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <!-- <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                            </li> -->
                            <li class="nav-item dropdown admin-dropdown1">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php
                                        if(isset($_SESSION['admin_id'])){
                                            $sql = "SELECT * FROM admin WHERE admin_id = $admin_id_session;";
                                            $result = mysqli_query($conn, $sql);
                                            if(mysqli_num_rows($result) > 0){
                                                while($row = mysqli_fetch_assoc($result)){
                                                    $name = $row['name'];
                                                }
                                                echo $name;
                                            }
                                        }
                                    ?>
                                </a>
                                <ul class="dropdown-menu admin-dropdown" aria-labelledby="navbarDropdown">
                                    <li class="admin-dropdown-li"><a class="dropdown-item admin-dropdown" href="profile.php">Profile</a></li>
                                    <li class="admin-dropdown-li"><a class="dropdown-item admin-dropdown" href="change-password.php">Change Password</a></li>
                                    <li class="admin-dropdown-li"><hr class="dropdown-divider"></li>
                                    <li class="admin-dropdown-li"><a class="dropdown-item admin-dropdown" href="includes/logout.inc.php">Log out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- end of navbar -->