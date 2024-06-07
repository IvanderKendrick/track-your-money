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
    <style>
        .hidden-form {
            display: none;
        }

        .show-form {
            display: block;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-4">Record Your Finances</h2>
        <div class="flex justify-center mb-6">
            <button id="income-btn" class="bg-blue-900 text-white py-2 px-4 rounded-l focus:outline-none">Add Income</button>
            <button id="outcome-btn" class="bg-purple-400 text-white py-2 px-4 rounded-r focus:outline-none">Add Outcome</button>
        </div>
        <!-- Income Form -->
        <form id="income-form" class="show-form" action="" method="post">
            <div class="mb-4">
                <label for="income-name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="income-name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Income name">
            </div>
            <div class="mb-4">
                <label for="income-cost" class="block text-gray-700">Cost</label>
                <input type="number" name="cost" id="income-cost" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Income cost ($)">
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
                <input type="text" name="name" id="outcome-name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" placeholder="Outcome name">
            </div>
            <div class="mb-4">
                <label for="outcome-cost" class="block text-gray-700">Cost</label>
                <input type="number" name="cost" id="outcome-cost" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" placeholder="Outcome cost ($)">
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
