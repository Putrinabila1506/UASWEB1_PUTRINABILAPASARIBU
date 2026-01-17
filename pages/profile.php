<?php
// koneksi ke database
include '../dashboard.php';

// ambil id user (biasanya dari session atau GET)
$id = $_GET['id'];

// ambil data user dari database
$query = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil</title>
</head>
<body>

<div class="edit-profile">
    <h2>Edit Profil</h2>

    <form action="edit_profil_proses.php" method="POST">
        
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="<?php echo $data['name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $data['email']; ?>" required>
        </div>

        <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password">
            <small>Kosongkan jika tidak ingin mengubah password</small>
        </div>

        <div class="form-group">
            <button type="submit">Simpan Perubahan</button>
        </div>

    </form>
</div>

</body>
</html>
