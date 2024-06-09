<?php 

// connecting to database
$db = mysqli_connect("localhost", "root", "", "tym");

// QUERY
function query($query){
    global $db;

    // query
    $result = mysqli_query($db, $query);

    $rows = [];

    // fetch
    while ( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    
    // returning 2 dimensions array
    return $rows;
}

// REGISTER
function register($data){
    global $db;
    
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);
    $password = htmlspecialchars($data["password"]);

    $query = "INSERT INTO accounts
                VALUES
                ('', '$username', '$password', '$email')
             ";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// ADD
function add($data, $username, $input){
    global $db;

    $name = htmlspecialchars($data["name"]);
    $cost = htmlspecialchars($data["cost"]);
    $month = $data["month"];

    // Query insert data
    $query = "INSERT INTO $input
                VALUES
                ('', '$name', '$cost', '$username', '$month')
                ";
    
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// UPDATE
function update($data){
    global $db;

    $id = $data["id"];
    $type = $data["type"];
    $name = htmlspecialchars($data["name"]);
    $cost = htmlspecialchars($data["cost"]);
    $month = htmlspecialchars($data["month"]);

    // Query update data
    $query = "UPDATE $type SET
                name = '$name',
                cost = '$cost',
                month = '$month'
            WHERE id = $id
            ";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

// DELETE
function delete($id, $type){
    global $db;
    mysqli_query($db, "DELETE FROM $type WHERE id = $id");

    return mysqli_affected_rows($db);
}

?>
