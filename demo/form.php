<?php 

// starting session
session_start();

// checking session
if (!isset($_SESSION["login"])){
  header("Location: index.html");
  exit;
}

// configure with functions.php
require "functions.php";



// checking is income button has been clicked
if ( isset($_POST["income"]) ) {

    if (add($_POST, $_SESSION["username"], "income") > 0){
        echo "
        <script>
            alert('Income Data has been Added');
            document.location.href = 'form.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Income Data failed to Add');
            document.location.href = 'form.php';
        </script>
        ";
    }

}
// checking is outcome button has been clicked
if ( isset($_POST["outcome"]) ) {

    if (add($_POST, $_SESSION["username"], "outcome") > 0){
        echo "
        <script>
            alert('Outcome Data has been Added');
            document.location.href = 'form.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Outcome Data failed to Add');
            document.location.href = 'form.php';
        </script>
        ";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income and Outcome Form</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/7e4642851c.js" crossorigin="anonymous"></script>
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
    <style>
        .hidden-form {
            display: none;
        }

        .show-form {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-100 flex-col flex items-center justify-center p-5 font-Karla">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <a href="main.php" class="w-6 h-6 text-white text-center bg-red-900 inline-block rounded-full hover:bg-red-500"><</a>
        <h2 class="text-2xl font-bold text-center mb-4">Record Your Finances</h2>
        <div class="flex justify-center mb-6">
            <button id="income-btn" class="bg-blue-900 text-white py-2 px-4 rounded-l focus:outline-none">Add Income</button>
            <button id="outcome-btn" class="bg-purple-400 text-white py-2 px-4 rounded-r focus:outline-none">Add Outcome</button>
        </div>
        <!-- Income Form -->
        <form id="income-form" class="show-form" action="" method="post">
            <div class="mb-4">
                <label for="income-name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="income-name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Income name" required>
            </div>
            <div class="mb-4">
                <label for="income-cost" class="block text-gray-700">Cost</label>
                <input type="number" name="cost" id="income-cost" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Income cost ($)" required>
            </div>
            <div class="mb-4">
                <label>Month<span class="text-pink-800">*</span></label>
                <select name="month">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="Jully">Jully</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <button type="submit" name="income" class="w-full bg-blue-900 text-white py-2 px-4 rounded-lg focus:outline-none hover:bg-blue-600">Add Income</button>
        </form>
        <!-- Outcome Form -->
        <form id="outcome-form" class="hidden-form" action="" method="post">
            <div class="mb-4">
                <label for="outcome-name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="outcome-name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" placeholder="Outcome name" required>
            </div>
            <div class="mb-4">
                <label for="outcome-cost" class="block text-gray-700">Cost</label>
                <input type="number" name="cost" id="outcome-cost" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" placeholder="Outcome cost ($)" required>
            </div>
            <div class="mb-4">
                <label>Month<span class="text-pink-800">*</span></label>
                <select name="month">
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="Jully">Jully</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
            <button type="submit" name="outcome" class="w-full bg-purple-400 text-white py-2 px-4 rounded-lg focus:outline-none hover:bg-purple-600">Add Outcome</button>
        </form>
    </div>

    
    <div class="container mx-auto mt-8">
        <!-- Income Table -->
        <?php $username = $_SESSION['username']; ?>
        <?php $incomes = query("SELECT * FROM income WHERE username = '$username'"); ?>
        <?php if($incomes != null) : ?>
        <table class="min-w-full bg-white border border-blue-300">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Action</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Cost</th>
                    <th class="py-2 px-4 border-b">Month</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($incomes as $icm) : ?>
                <tr class="hover:bg-blue-100">
                    <td class="py-2 px-4 border-b"><?= $i; ?></td>
                    <td class="py-2 px-4 border-b">
                        <a href="update.php?id=<?= $icm["id"]; ?>&type=income" class="text-blue-600 hover:text-blue-800">Edit</a> |
                        <a href="delete.php?id=<?= $icm["id"]; ?>&type=income" onclick="return confirm('Are You Sure ???');" class="text-red-600 hover:text-red-800">Delete</a>
                    </td>
                    <td class="py-2 px-4 border-b"><?= $icm["name"] ?></td>
                    <td class="py-2 px-4 border-b"><?= $icm["cost"] ?></td>
                    <td class="py-2 px-4 border-b"><?= $icm["month"] ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <!-- Outcome Table -->
        <?php $outcomes = query("SELECT * FROM outcome WHERE username = '$username'"); ?>
        <?php if($outcomes != null) : ?>
        <table class="min-w-full bg-white border border-purple-300 mt-8">
            <thead>
                <tr class="bg-purple-500 text-white">
                    <th class="py-2 px-4 border-b">No</th>
                    <th class="py-2 px-4 border-b">Action</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Cost</th>
                    <th class="py-2 px-4 border-b">Month</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($outcomes as $ocm) : ?>
                <tr class="hover:bg-purple-100">
                    <td class="py-2 px-4 border-b"><?= $i; ?></td>
                    <td class="py-2 px-4 border-b">
                        <a href="update.php?id=<?= $ocm["id"]; ?>&type=outcome" class="text-purple-600 hover:text-purple-800">Edit</a> |
                        <a href="delete.php?id=<?= $ocm["id"]; ?>&type=outcome" onclick="return confirm('Are You Sure ???');" class="text-red-600 hover:text-red-800">Delete</a>
                    </td>
                    <td class="py-2 px-4 border-b"><?= $ocm["name"] ?></td>
                    <td class="py-2 px-4 border-b"><?= $ocm["cost"] ?></td>
                    <td class="py-2 px-4 border-b"><?= $ocm["month"] ?></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>

    <script>
        const incomeBtn = document.getElementById('income-btn');
        const outcomeBtn = document.getElementById('outcome-btn');
        const incomeForm = document.getElementById('income-form');
        const outcomeForm = document.getElementById('outcome-form');

        incomeBtn.addEventListener('click', function () {
            incomeForm.classList.remove('hidden-form');
            incomeForm.classList.add('show-form');
            outcomeForm.classList.remove('show-form');
            outcomeForm.classList.add('hidden-form');
        });

        outcomeBtn.addEventListener('click', function () {
            outcomeForm.classList.remove('hidden-form');
            outcomeForm.classList.add('show-form');
            incomeForm.classList.remove('show-form');
            incomeForm.classList.add('hidden-form');
        });
    </script>
</body>

</html>
