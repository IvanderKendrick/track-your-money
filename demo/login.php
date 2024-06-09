<?php 

// starting session
session_start();

// checking session
if (isset($_SESSION["login"])){
  header("Location: main.php");
  exit;
}

// configure with functions.php
require "functions.php";



// checking is Login button has been clicked
if ( isset($_POST["login"]) ) {

  $loginUsername = $_POST["loginUsername"];
  $loginPassword = $_POST["loginPassword"];

  // search for username in db
  $user = mysqli_query($db, "SELECT * FROM accounts WHERE username = '$loginUsername'");

  // checking username
  if ( mysqli_num_rows($user) === 1 ) {

    $row = mysqli_fetch_assoc($user);

    // checking password
    if( $loginPassword === $row['password'] ){

      // set the login session to true to indicate that the user has successfully logged in
      $_SESSION["login"] = true;
      $_SESSION["username"] = $loginUsername;

      header("Location: main.php");
      exit;
    }
  }
  $error = true;
}



if ( isset($_POST["register"]) ) {

  $username = $_POST["username"];
  $email = $_POST["email"];

  // search for username in db
  $user = mysqli_query($db, "SELECT * FROM accounts WHERE username = '$username' OR email = '$email'");

  // checking username and email
  if ( mysqli_num_rows($user) >= 1 ) {
    $registerError = true;
  } else {
    register($_POST);

    // set the login session to true to indicate that the user has successfully logged in
    $_SESSION["login"] = true;
    $_SESSION["username"] = $loginUsername;

    header("Location: main.php");
    exit;
  }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register & Login Page</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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
      /* Particles JS */
      #particles-js {
        background: linear-gradient(45deg, #1e3a8a, #8b5cf6);
      }
    </style>
  </head>

  <body class="bg-gray-100 h-screen flex items-center justify-center font-Karla">
    <div id="particles-js" class="w-full h-full absolute -z-10"></div>
    <div class="bg-white shadow-md rounded-md p-8 w-96 relative">
      <!-- Switch tabs -->
      <div class="flex mb-4">
        <button
          id="registerTab"
          class="flex-1 bg-blue-900 text-white py-2 px-4 rounded-tl-md focus:outline-none"
        >
          Register
        </button>
        <button
          id="loginTab"
          class="flex-1 bg-gray-200 text-gray-700 py-2 px-4 rounded-tr-md focus:outline-none"
        >
          Login
        </button>
      </div>

      <!-- Register Form -->
      <form id="registerForm" class="block" action="" method="post">
        <div class="mb-4">
          <label for="username" class="block text-gray-700">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          />
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-gray-700">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          />

          <?php if( isset($registerError) ) : ?>
            <p style="color: red; font-style: italic;">taken username or email</p>
          <?php endif; ?>
          
          <?php if( isset($error) ) : ?>
            <p style="color: red; font-style: italic;">incorrect username or password</p>
          <?php endif ?>

        </div>
        <button
          type="submit" name="register"
          class="bg-blue-900 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
        >
          Register
        </button>
      </form>

      <!-- Login Form -->
      <form id="loginForm" class="hidden" action="" method="post">
        <div class="mb-4">
          <label for="loginUsername" class="block text-gray-700"
            >Username</label
          >
          <input
            type="text"
            id="loginUsername"
            name="loginUsername"
            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          />
        </div>
        <div class="mb-4">
          <label for="loginPassword" class="block text-gray-700"
            >Password</label
          >
          <input
            type="password"
            id="loginPassword"
            name="loginPassword"
            class="border border-gray-300 rounded-md px-3 py-2 w-full focus:outline-none focus:border-blue-500"
          />
        </div>
        <button
          type="submit" name="login"
          class="bg-purple-400 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600"
        >
          Login
        </button>
      </form>
    </div>

    <script>
      const registerTab = document.getElementById("registerTab");
      const loginTab = document.getElementById("loginTab");
      const registerForm = document.getElementById("registerForm");
      const loginForm = document.getElementById("loginForm");

      registerTab.addEventListener("click", function () {
        registerForm.classList.remove("hidden");
        loginForm.classList.add("hidden");
        registerTab.classList.remove("bg-gray-200", "text-gray-700");
        registerTab.classList.add("bg-blue-900", "text-white");
        loginTab.classList.remove("bg-purple-400", "text-white");
        loginTab.classList.add("bg-gray-200", "text-gray-700");
      });

      loginTab.addEventListener("click", function () {
        registerForm.classList.add("hidden");
        loginForm.classList.remove("hidden");
        registerTab.classList.remove("bg-blue-900", "text-white");
        registerTab.classList.add("bg-gray-200", "text-gray-700");
        loginTab.classList.remove("bg-gray-200", "text-gray-700");
        loginTab.classList.add("bg-purple-400", "text-white");
      });
    </script>

    <!-- scripts particles js -->
    <script src="../particles.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
