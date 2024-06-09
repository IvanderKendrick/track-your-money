<?php 

session_start();

if (!isset($_SESSION["login"])){
    header("Location: index.html");
    exit;
}

require "functions.php";

// Ambil data dari url
$id = $_GET["id"];
$type = $_GET["type"];
$data = query("SELECT * FROM $type WHERE id = $id")[0];

if( isset($_POST["submit"]) ){

    // Cek apakah data berhasil diubah atau tidak
    if (update($_POST) > 0){
        echo "
        <script>
            alert('Data Updated Successfully');
            document.location.href = 'form.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Failed to be Updated');
            document.location.href = 'form.php';
        </script>
        ";
    }

    // Cek apakah data berhasil ditambahkan atau tidak
    // btw di aku kodenya ga bekerja (mungkin udah update jadi lebih aman?) - PHP WPU . 12 / 27:18
    // if (mysqli_affected_rows($db) > 0) {
    //     echo "Berhasil";
    // } else {
    //     echo "Gagal";
    //     echo "<br>";
    //     echo mysqli_error($db);
    // }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Incomes Data</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex-col flex items-center justify-center">
    
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <a href="main.php"><</a>
        <h2 class="text-2xl font-bold text-center mb-4">Update Your Finances</h2>
        <div class="flex justify-center mb-6">
            <?php if ( $type == 'income' ) : ?>
            <button id="income-btn" class="bg-blue-900 text-white py-2 px-4 rounded focus:outline-none">Update Your Income</button>
            <?php else: ?>
            <button id="outcome-btn" class="bg-purple-400 text-white py-2 px-4 rounded focus:outline-none">Update Your Outcome</button>
            <?php endif; ?>
        </div>
        <?php if ( $type == 'income' ) : ?>
        <!-- Income Form -->
        <form id="income-form" class="show-form" action="" method="post">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <input type="hidden" name="type" value="income">
            <div class="mb-4">
                <label for="income-name" class="block text-gray-700">Name</label>
                <input type="text" name="name" value="<?= $data['name']; ?>" id="income-name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Income name">
            </div>
            <div class="mb-4">
                <label for="income-cost" class="block text-gray-700">Cost</label>
                <input type="number" name="cost" value="<?= $data['cost']; ?>" id="income-cost" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-blue-500" placeholder="Income cost ($)">
            </div>
            <div class="mb-4">
                <label>Month<span class="text-pink-800">*</span></label>
                <select name="month">
                <option value="January" <?= $data['month'] == 'January' ? 'selected' : ''; ?>>January</option>
                <option value="February" <?= $data['month'] == 'February' ? 'selected' : ''; ?>>February</option>
                <option value="March" <?= $data['month'] == 'March' ? 'selected' : ''; ?>>March</option>
                <option value="April" <?= $data['month'] == 'April' ? 'selected' : ''; ?>>April</option>
                <option value="May" <?= $data['month'] == 'May' ? 'selected' : ''; ?>>May</option>
                <option value="June" <?= $data['month'] == 'June' ? 'selected' : ''; ?>>June</option>
                <option value="July" <?= $data['month'] == 'July' ? 'selected' : ''; ?>>July</option>
                <option value="August" <?= $data['month'] == 'August' ? 'selected' : ''; ?>>August</option>
                <option value="September" <?= $data['month'] == 'September' ? 'selected' : ''; ?>>September</option>
                <option value="October" <?= $data['month'] == 'October' ? 'selected' : ''; ?>>October</option>
                <option value="November" <?= $data['month'] == 'November' ? 'selected' : ''; ?>>November</option>
                <option value="December" <?= $data['month'] == 'December' ? 'selected' : ''; ?>>December</option>
                </select>
            </div>
            <button type="submit" name="submit" class="w-full bg-blue-900 text-white py-2 px-4 rounded-lg focus:outline-none hover:bg-blue-600">Update Income</button>
        </form>

        <?php else: ?>

        <!-- Outcome Form -->
        <form id="outcome-form" class="hidden-form" action="" method="post">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">
            <input type="hidden" name="type" value="outcome">
            <div class="mb-4">
                <label for="outcome-name" class="block text-gray-700">Name</label>
                <input type="text" name="name" value="<?= $data['name']; ?>" id="outcome-name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" placeholder="Outcome name">
            </div>
            <div class="mb-4">
                <label for="outcome-cost" class="block text-gray-700">Cost</label>
                <input type="number" name="cost" value="<?= $data['cost']; ?>" id="outcome-cost" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-purple-600" placeholder="Outcome cost ($)">
            </div>
            <div class="mb-4">
                <label>Month<span class="text-pink-800">*</span></label>
                <select name="month">
                <option value="January" <?= $data['month'] == 'January' ? 'selected' : ''; ?>>January</option>
                <option value="February" <?= $data['month'] == 'February' ? 'selected' : ''; ?>>February</option>
                <option value="March" <?= $data['month'] == 'March' ? 'selected' : ''; ?>>March</option>
                <option value="April" <?= $data['month'] == 'April' ? 'selected' : ''; ?>>April</option>
                <option value="May" <?= $data['month'] == 'May' ? 'selected' : ''; ?>>May</option>
                <option value="June" <?= $data['month'] == 'June' ? 'selected' : ''; ?>>June</option>
                <option value="July" <?= $data['month'] == 'July' ? 'selected' : ''; ?>>July</option>
                <option value="August" <?= $data['month'] == 'August' ? 'selected' : ''; ?>>August</option>
                <option value="September" <?= $data['month'] == 'September' ? 'selected' : ''; ?>>September</option>
                <option value="October" <?= $data['month'] == 'October' ? 'selected' : ''; ?>>October</option>
                <option value="November" <?= $data['month'] == 'November' ? 'selected' : ''; ?>>November</option>
                <option value="December" <?= $data['month'] == 'December' ? 'selected' : ''; ?>>December</option>
                </select>
            </div>
            <button type="submit" name="submit" class="w-full bg-purple-400 text-white py-2 px-4 rounded-lg focus:outline-none hover:bg-purple-600">Add Outcome</button>
        </form>
        <?php endif; ?>
    </div>

</body>
</html>