<?php 

require "functions.php";

// starting session
session_start();

// checking session
if (!isset($_SESSION["login"])){
  header("Location: login.php");
  exit;
}           

$username = $_SESSION['username'];
$totalOfIncomes = query("SELECT SUM(cost) AS total_income FROM income WHERE username = '$username'")[0];
$totalIncomes = $totalOfIncomes['total_income'];

$totalOfOutcomes = query("SELECT SUM(cost) AS total_outcome FROM outcome WHERE username = '$username'")[0];
$totalOutcomes = $totalOfOutcomes['total_outcome'];

$totalWealth = $totalIncomes - $totalOutcomes;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Chart JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Major+Mono+Display&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: "selector",
        theme: {
          extend: {
            fontFamily: {
              Montserrat: "Montserrat",
              Roboto: "Roboto",
              MajorMonoDisplay: "Major Mono Display",
              Karla: "Karla",
            },
          },
        },
      };
    </script>
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/7e4642851c.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-100 font-Karla">
    <!-- Navigation Bar -->
    <nav class="bg-gray-800 text-white w-64 h-full hidden fixed md:flex flex-col justify-between">
        <div class="p-4">
            <img src="img/tym-nobg.png" alt="Logo" class="w-20 mx-auto mb-8">
            <div class="flex flex-col space-y-4">
                <a href="#home" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded-md">
                    <i class="fas fa-home fa-lg"></i>
                    <span class="text-orange-400">Home</span>
                </a>
                <a href="form.php" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded-md">
                    <i class="fas fa-book fa-lg"></i>
                    <span>Track</span>
                </a>
                <a href="#account" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded-md">
                    <i class="fas fa-user fa-lg"></i>
                    <span>Account</span>
                </a>
            </div>
        </div>
        <div class="p-4">
            <a href="logout.php" class="flex items-center space-x-3 hover:bg-red-500 p-2 rounded-md">
                <i class="fas fa-sign-out-alt fa-lg"></i>
                <span>Logout</span>
            </a>
        </div>
    </nav>

    <nav class="bg-gray-800 text-white md:hidden w-full h-content fixed top-0 flex justify-between">
        <div class="p-4 w-full">
            <div class="flex justify-between p-3 items-center w-full">
                <img src="img/tym-nobg.png" alt="Logo" class="w-20">
                <button id="menu-btn" class="md:hidden focus:outline-none">
                    <i class="fas fa-bars fa-2x"></i>
                </button>
            </div>
            <div id="menu" class="hidden flex-col gap-y-3 space-y-4">
                <a href="#home" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded-md">
                    <i class="fas fa-home fa-lg"></i>
                    <span class="text-orange-400">Home</span>
                </a>
                <a href="form.php" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded-md">
                    <i class="fas fa-book fa-lg"></i>
                    <span>Track</span>
                </a>
                <a href="#account" class="flex items-center space-x-3 hover:bg-gray-700 p-2 rounded-md">
                    <i class="fas fa-user fa-lg"></i>
                    <span>Account</span>
                </a>
                <a href="#logout" class="flex items-center space-x-3 hover:bg-red-500 p-2 rounded-md mb-5">
                    <i class="fas fa-sign-out-alt fa-lg"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="md:ml-72 md:mt-0 mt-36 w-full md:w-3/4">
        <div class="p-8 w-full flex flex-col space-y-8">
            <!-- Section 1 -->
            <section class="flex flex-wrap gap-4">
                <div class="bg-white p-4 rounded-lg shadow flex flex-wrap items-center w-full md:w-1/2 lg:w-1/4">
                    <div class="flex-1 flex flex-col">
                        <p class="text-gray-500">Total of</p>
                        <h4 class="text-lg font-bold">Incomes</h4>
                        <h4 class="text-2xl font-bold"><?= $totalIncomes ?><span class="font-light text-sm"> $</span></h4>
                    </div>
                    <div class="w-12 h-12">
                        <img src="img/salary.png" alt="Icon 1" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex flex-wrap items-center w-full md:w-1/2 lg:w-1/4">
                    <div class="flex-1 flex flex-col">
                        <p class="text-gray-500">Total of</p>
                        <h4 class="text-lg font-bold">Outcome</h4>
                        <h4 class="text-2xl font-bold"><?= $totalOutcomes ?><span class="font-light text-sm"> $</span></h4>
                    </div>
                    <div class="w-12 h-12">
                        <img src="img/spending.png" alt="Icon 2" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex flex-wrap items-center w-full md:w-1/2 lg:w-1/4">
                    <div class="flex-1 flex flex-col">
                        <p class="text-gray-500">Total of</p>
                        <h4 class="text-lg font-bold">Wealth</h4>
                        <h4 class="text-2xl font-bold"><?= $totalWealth ?><span class="font-light text-sm"> $</span></h4>
                    </div>
                    <div class="w-12 h-12">
                        <img src="img/money.png" alt="Icon 3" class="w-full h-full object-cover">
                    </div>
                </div>
                <!-- <div class="bg-white p-4 rounded-lg shadow flex flex-wrap items-center w-full md:w-1/2 lg:w-1/4">
                    <div class="flex-1 flex flex-col">
                        <p class="text-gray-500">Title 4</p>
                        <h4 class="text-lg font-bold">Content 4</h4>
                    </div>
                    <div class="w-12 h-12">
                        <img src="https://via.placeholder.com/50" alt="Icon 4" class="w-full h-full object-cover rounded-full">
                    </div>
                </div> -->
            </section>

            <!-- Section 2 -->
            <section class="flex flex-col space-y-4">
                <div class="bg-white p-4 rounded-lg shadow flex flex-col items-start">
                    <canvas id="myChart"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex flex-col items-start">
                    <canvas id="myChart1"></canvas>
                </div>
                <div class="bg-white p-4 rounded-lg shadow flex flex-col items-start">
                    <canvas id="myChart2"></canvas>
                </div>
            </section>
        </div>
    </div>

    <script>
        const menuBtn = document.getElementById("menu-btn");
        const menu = document.getElementById("menu");

        menuBtn.addEventListener("click", function(){
            menu.classList.toggle("flex");
            menu.classList.toggle("hidden");
        })

        // CHART INCOMES
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: 'Incomes',
                        // data: [12, 19, 3, 5, 2, 3],
                        data: [
                            <?php 

                            $username = $_SESSION['username'];
                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'January' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'February' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'March' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'April' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'May' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'June' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'Jully' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'August' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'September' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'October' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'November' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'December' AND username = '$username'")[0];
                            $total = $incomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // CHART OUTCOMES
        const ctx1 = document.getElementById('myChart1');

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: 'Outcomes',
                        // data: [12, 19, 3, 5, 2, 3],
                        data: [
                            <?php 

                            $username = $_SESSION['username'];
                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'January' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'February' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'March' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'April' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'May' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'June' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'Jully' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'August' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'September' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'October' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'November' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                            ,
                            <?php 

                            $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'December' AND username = '$username'")[0];
                            $total = $outcomes['total_cost'];
                            
                            echo $total;
                            
                            ?>
                        ],
                        borderWidth: 1,
                        borderColor: '#800080',
                        backgroundColor: '#D1B3FF',
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // COMPARASION CHART
        const ctx2 = document.getElementById('myChart2');

        const data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'Jully', 'August', 'September', 'October', 'November', 'December'],
            datasets: [
                {
                label: 'Incomes',
                data: [
                        <?php 

                        $username = $_SESSION['username'];
                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'January' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'February' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'March' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'April' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'May' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'June' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'Jully' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'August' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'September' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'October' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'November' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $incomes = query("SELECT SUM(cost) AS total_cost FROM income WHERE month = 'December' AND username = '$username'")[0];
                        $total = $incomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                    ],
                    borderColor: '#0000FF',
                    backgroundColor: '#ADD8E6',
                },
                {
                label: 'Outcomes',
                data: [
                        <?php 

                        $username = $_SESSION['username'];
                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'January' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'February' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'March' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'April' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'May' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'June' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'Jully' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'August' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'September' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'October' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'November' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                        ,
                        <?php 

                        $outcomes = query("SELECT SUM(cost) AS total_cost FROM outcome WHERE month = 'December' AND username = '$username'")[0];
                        $total = $outcomes['total_cost'];
                        
                        echo $total;
                        
                        ?>
                    ],
                    borderColor: '#800080',
                    backgroundColor: '#D1B3FF',
                }
            ]
        };

        new Chart(ctx2, {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Incomes vs Outcomes'
                    }
                }
            },
        });

    </script>
</body>

</html>