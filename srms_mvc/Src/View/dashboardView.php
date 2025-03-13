<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.118.2">
  <title>Student Result Management System</title>
  <!-- Script para el tema oscuro -->
  <!-- <script src="color-modes.js"></script> -->
  <!-- Bootstrao 5.3.2 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Iconos de bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- Estilos Basicos -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../../Public/CSS/style.css">

  <style>
    body {
      height: 100%;
    }

    aside {
      /* border: 1px yellow solid; */
      position: fixed;
      overflow: auto;
      height: calc(100vh - 12px);
      justify-content: flex-start;
      align-self: flex-start;

    }
    nav{
      position:sticky;
    }
    main {
      position: relative;
      overflow: visible;
      margin-left: auto;
      justify-content: flex-end;
      align-self: flex-end;
    }

    #sidebarshow {
      display: none;

    }

    @media screen and (max-width: 575px) {
      #sidebarshow {
        display: inline;
      }

      #sidebartoggle {
        display: none;
      }
    }
  </style>


  <!-- Custom styles for this template -->

</head>

<body class="bg-body-tertiary">

  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
    </symbol>
  </svg>

  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="bootstrap" viewBox="0 0 118 94">
      <title>Bootstrap</title>
      <path fill-rule="evenodd" clip-rule="evenodd"
        d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z">
      </path>
    </symbol>
  </svg>
  <!-- <button class="btn btn-outline-secondary" id="sidebarToggle"><i class="bi bi-arrows-expand-vertical"></i></button> -->

 


  <aside class="collapse show collapse-horizontal col-sm-2 p-3 border-end bg-body-tertiary" id="collapseWidthExample">

    <h2>
      <?php
        $userType = $_SESSION['user_type'];
        if ($userType == 1) {
          echo "Admin";
        } elseif ($userType == 2) {
          echo "Instructor";
        } else {
          echo "Student";
        }
      ?>
    </h2>   
    <hr>
    <hr>
    <ul class="list-unstyled ps-0">
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
          data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
          User
        </button>
        <div class="collapse" id="home-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="../View/User/userCreate.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add User</a></li>
            <li><a href="../View/User/userIndex.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">View All User</a></li>  
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
          data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
          Department
        </button>
        <div class="collapse" id="dashboard-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="../View/Department/departmentCreate.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Department</a></li>
            <li><a href="../View/Department/departmentIndex.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">View All Department</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
          data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
          Course
        </button>
        <div class="collapse" id="orders-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="../View/Course/Create.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Course</a></li>
            <li><a href="../View/Course/Index.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">View All Course</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
          data-bs-toggle="collapse" data-bs-target="#exam-collapse" aria-expanded="false">
          Exam
        </button>
        <div class="collapse" id="exam-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="../View/Exam/Create.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Exam</a></li>
            <li><a href="../View/Exam/Index.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">View All Exam</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
          data-bs-toggle="collapse" data-bs-target="#marks-collapse" aria-expanded="false">
          Marks
        </button>
        <div class="collapse" id="marks-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="../View/Marks/Create.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Marks</a></li>
            <li><a href="../View/Marks/Index.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">View All Marks</a></li>
          </ul>
        </div>
      </li>
      <li class="mb-1">
        <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed"
          data-bs-toggle="collapse" data-bs-target="#result-collapse" aria-expanded="false">
          Result
        </button>
        <div class="collapse" id="result-collapse">
          <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li><a href="../View/Result/Create.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">Add Result</a></li>
            <li><a href="../View/Result/Index.php" class="link-body-emphasis d-inline-flex text-decoration-none rounded">View All Result</a></li>
          </ul>
        </div>
      </li>
    </ul>
    <hr><hr>
    <!-- <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
        data-bs-toggle="dropdown" aria-expanded="true">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <span class="d-print-block"><strong>mdo</strong></span>
      </a>
      <ul class="dropdown-menu text-small shadow">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div> -->
  </aside>

    <main class="col-sm-10 bg-body-tertiary" id="main">
    <!-- NavBar -->
        <nav class="navbar sticky-top navbar-expand-lg border-bottom bg-body-tertiary">
          <div class="container-fluid">
    
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseWidthExample" aria-expanded="true" aria-controls="collapseWidthExample"
            style="margin-right: 10px; padding: 0px 5px 0px 5px;" id="sidebartoggle" onclick="changeclass()"> <i
                class="bi bi-arrows-expand-vertical"></i>
            </button>
            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"
            style="margin-right: 10px; padding: 2px 6px 2px 6px;" id="sidebarshow">
            <i class="bi bi-arrow-bar-right"></i>
            </button>
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <h2><a class="navbar-brand" href="../View/dashboardView.php">SRMS</a></h2>
                  <ul class="navbar-nav ms-auto pe-5">
                    <li class="nav-item dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle me-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> Profile <?php echo $_SESSION['username']; ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-light">
                            <li><a class="dropdown-item" href="../View/Profile/Index.php">View Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                            <div class="ps-3">
                                <form action="../Controller/userController.php" method="post">
                                    <button type="submit" name="logout" class="btn btn-danger" >Logout</button>
                                </form>
                            </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>        
        </div>
        </nav>
        <!-- NavBar Fin -->
        <br>
        <div class="ps-3 pe-3">
          <h4 class="welcome">Welcome "<?php echo $_SESSION['username'];?>" to <?php  echo $_SESSION['user_type'];?> dashboard of Student Result Management System</h2>
          <br>
          <?php
              if ($_SESSION['user_type'] === 1) {
                  echo "Welcome Admin : " . $_SESSION['username'] . "<br>";
              } elseif ($_SESSION['user_type'] === 2) {
                  echo "Welcome Student : " . $_SESSION['username'] . "<br>";
              } else {
                  echo "Welcome Instructor : " . $_SESSION['username'] . "<br>";
              }
          ?>
          <br>

          <div class="row" style="display: flex; gap: 20px;">

            <!-- First Trigger and Collapsible Content -->
            <div class="col">
              <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#target-1" aria-expanded="false" aria-controls="target-1">
                Toggle Target 1
              </button>
              <div class="collapse" id="target-1">
                <div class="card card-body" style="background-color: lightblue;">
                  This is the first collapsible content with a background color.
                </div>
              </div>
            </div>

            <!-- Second Trigger and Collapsible Content -->
            <div class="col">
              <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#target-2" aria-expanded="false" aria-controls="target-2">
                Toggle Target 2
              </button>
              <div class="collapse" id="target-2">
                <div class="card card-body" style="background-color: lightgreen;">
                  This is the second collapsible content with a background color.
                </div>
              </div>
            </div>

            <!-- Third Trigger and Collapsible Content -->
            <div class="col">
              <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#target-3" aria-expanded="false" aria-controls="target-3">
                Toggle Target 3
              </button>
              <div class="collapse" id="target-3">
                <div class="card card-body" style="background-color: lightcoral;">
                  This is the third collapsible content with a background color.
                </div>
              </div>
            </div>

          </div>
          
        </div>
    </main>
  </div>

  <!-- Script de bootstap 5.2.3 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.js"
    integrity="sha384-eI7PSr3L1XLISH8JdDII5YN/njoSsxfbrkCTnJrzXt+ENP5MOVBxD+l6sEG4zoLp"
    crossorigin="anonymous"></script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <script src="dashboard.js"></script>
  <script>
    new Chartist.Line('#traffic-chart', {
      labels: ['January', 'Februrary', 'March', 'April', 'May', 'June'],
      series: [
        [23000, 25000, 19000, 34000, 56000, 64000]
      ]
    }, {
      low: 0,
      showArea: true
    });
  </script>

  <script>
    function changeclass() {
      $("#main").toggleClass('col-sm-10 col-sm-12');
    }

  </script>
</body>

</html>