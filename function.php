<?php 
// koneksi ke database
$conn = mysqli_connect("localhost","root","","toko");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);  
    $rows = [];
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
}
return $rows;
}

// function tambah($data){
//     global $conn;

//     // $foto = upload();
//     // if( !$foto ) {
//     //     return false;
//     // }


//     $id = "id";
//     $product_name = htmlspecialchars($data["product_name"]);
//     $price = htmlspecialchars($data["price"]);
//     $quantity = htmlspecialchars($data["quantity"]);

//     //query insert data
//     $query = "INSERT INTO murid
//                 VALUES
//                 ('$id', '$product_name', '$price', '$quantity')
//     "; 
//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }


// function upload() {

//     $namaFile = $_FILES['foto']['name'];
//     $ukuranFile = $_FILES['foto']['size'];
//     $error = $_FILES['foto']['error'];
//     $tmpName = $_FILES['foto']['tmp_name'];


// cek apakah tidak ada gambar yg di upload
// if( $error === 4) {
//     echo "<script>
//     alert('masukan gambar terlebih dahulu');
//     </script>
//     ";
//     return false;
// }

// cek apakah yang di upload adalah gambar
// $ekstensiGambarValid = ['jpg','jpeg','png'];
// $ekstensiGambar = explode('.', $namaFile);
// $ekstensiGambar = strtolower(end($ekstensiGambar));
// if( !in_array($ekstensiGambar, $ekstensiGambarValid)){
//     echo "<script>
//     alert('yang anda upload bukan gambar');
//     </script>
//     ";
//     return false;
// }

// cek jika ukurannya terlalu besar
// if( $ukuranFile > 1000000) {
//     echo "<script>
//     alert('ukuran gambar terlalu besar');
//     </script>
//     ";
//     return false;
// }

// lolos pengecekan, gambar siap di upload
// generate nama gambar baru
//     $namaFileBaru = uniqid();
//     $namaFileBaru .= '.';
//     $namaFileBaru .= $ekstensiGambar;


//     move_uploaded_file($tmpName, 'img/'. $namaFileBaru);
//     return $namaFileBaru;
// }



// function hapus($id){
//     global $conn;
//     mysqli_query($conn, "DELETE FROM murid WHERE id = $id");
//     return mysqli_affected_rows($conn);
// }

// function ubah($data){

//     global $conn;

//     $id = $data["id"];
//     $gambarLama= htmlspecialchars($data["gambarLama"]);

//     // cek apakah user pilih gambar baru atau tidak
//     if( $_FILES['foto']['error'] === 4){
//         $foto = $gambarLama;
//     } else {
//         $foto = upload();
//     }


//     $nama = htmlspecialchars($data["nama"]);
//     $eskul = htmlspecialchars($data["eskul"]);
//     $hobi = htmlspecialchars($data["hobi"]);

//     //query insert data
//     $query = "UPDATE murid SET
//                 foto = '$foto',
//                 nama = '$nama',
//                 eskul = '$eskul',
//                 hobi = '$hobi'
//                 WHERE id = $id
//     "; 
//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);

// }


// function cari($search){
//     $query = "SELECT * FROM murid
//                 WHERE
//                 nama LIKE '$search%' OR
//                 eskul LIKE '$search%' OR
//                 hobi LIKE '$search%' 

//     ";
//     return query($query);
// }


// Fungsi untuk menambahkan produk baru ke database
function addProduct($product_name, $price, $quantity)
{
    global $conn;

    $stmt = $conn->prepare("INSERT INTO products (product_name, price, quantity) VALUES (?, ?, ?)");
    $stmt->bind_param("sdi", $product_name, $price, $quantity);
    $stmt->execute();
    $stmt->close();
}

// Fungsi untuk mengambil semua produk dari database
function getAllProducts()
{
    global $conn;

    $result = $conn->query("SELECT * FROM products");
    return $result;
}

// Fungsi untuk mendapatkan produk berdasarkan ID
function getProductById($id)
{
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    return $product;
}

// Fungsi untuk memperbarui produk
function updateProduct($id, $product_name, $price, $quantity)
{
    global $conn;

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->bind_param("sdii", $product_name, $price, $quantity, $id);
    $stmt->execute();
    $stmt->close();
}

// Fungsi untuk menghapus produk
function deleteProduct($id)
{
    global $conn;

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function registrasi($data){
    global $conn;

    $namaDepan = strtolower(stripslashes($data["namaDepan"])); 
    $namaBelakang = strtolower(stripslashes($data["namaBelakang"])); 
    $username = strtolower(stripslashes($data["username"])); 
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $ver = mysqli_real_escape_string($conn, $data["ver"]);

    //cek username sudah ada apa belum
    $result = mysqli_query($conn, "SELECT username FROM regis WHERE username = '$username'");
    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
        alert('username sudah ada');
        </script>";
        return false;
    }

    //cek konfirmasi pw
    if( $password !== $ver) {
        echo "<script>
        alert('pw tidak sesuai');
        </script>";
        return false;
    }

    //enkripsi pw
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //tambah user baru ke db
    mysqli_query($conn, "INSERT INTO regis VALUES('', '$namaDepan', '$namaBelakang', '$username', '$password' )");
    return mysqli_affected_rows($conn);
}


































?>  
