<?php
$conn = mysqli_connect("localhost", "root", "", "tugas");

function query($query){
  global $conn;
  $result = mysqli_query($conn, $query);

  if (!$result){
    echo mysqli_error ($conn);
  }
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function register($data) {
    global $conn;
    
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    $check = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($check) ) {
        echo "<script>
                alert('username sudah terdaftar, silahkan pilih yang lain');
              </script>";
        return false;
        
    }

    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sama!');
              </script>";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($conn, "INSERT INTO user (username, password)
                    VALUES
                ('$username', '$password')");
    
    return mysqli_affected_rows($conn);
}