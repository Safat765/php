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

<body>
<main class="bg-body-tertiary" id="main">
    <nav class="navbar sticky-top navbar-expand-lg border-bottom bg-body-tertiary">
          <div class="container-fluid">
    
            <!-- <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse"
            data-bs-target="#collapseWidthExample" aria-expanded="true" aria-controls="collapseWidthExample"
            style="margin-right: 10px; padding: 0px 5px 0px 5px;" id="sidebartoggle" onclick="changeclass()"> <i
                class="bi bi-arrows-expand-vertical"></i>
            </button> -->
            <!-- <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"
            style="margin-right: 10px; padding: 2px 6px 2px 6px;" id="sidebarshow">
            <i class="bi bi-arrow-bar-right"></i>
            </button> -->
    
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <?php
              if ($_SERVER['REQUEST_METHOD'] == "POST") {
              ?>
            <h2><a class="navbar-brand" href="../View/dashboardView.php">SRMS</a></h2>
            <?php
              } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
            ?>
            <h2><a class="navbar-brand" href="../View/dashboardView.php">SRMS</a></h2>
            <?php
              } else {
            ?>            
            <h2><a class="navbar-brand" href="../View/dashboardView.php">SRMS</a></h2>
            <?php
              }
            ?>
                  <ul class="navbar-nav ms-auto pe-5">
                    <li class="nav-item dropdown">
                        <button class="btn btn-outline-dark dropdown-toggle me-2" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> Profile <?php echo $_SESSION['username'];?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-light">
                          <li>
                            <form action="../Controller/profile.php" method="get">
                              <button type="submit" name="showLoggedProfile" class="btn btn-light">Create profile</button>
                            </form>
                          </li>
                            <!-- <li><a class="dropdown-item" href="../Profile/profile.php">View Profile</a></li> -->
                            <li><hr class="dropdown-divider"></li>
                            <li>
                            <div class="ps-3">
                              <?php
                                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                              ?>
                                <form action="../../Controller/userController.php" method="post">
                                    <button type="submit" name="logout" class="btn btn-danger" >Logout</button>
                                </form>
                                <?php
                                  } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
                                ?>                                
                                <form action="../Controller/userController.php" method="post">
                                    <button type="submit" name="logout" class="btn btn-danger" >Logout</button>
                                </form>
                                <?php
                                  } else {
                                ?>
                                <form action="../../Controller/userController.php" method="post">
                                    <button type="submit" name="logout" class="btn btn-danger" >Logout</button>
                                </form>
                                <?php
                                  }
                                ?>
                            </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>        
          </div>
        </nav>
    </main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
crossorigin="anonymous"></script>

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