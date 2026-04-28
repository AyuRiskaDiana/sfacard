<?php
// Script untuk menambah kolom is_read ke tabel notifikasi
$host = 'localhost';
$dbname = 'sfacard';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Check if column exists
    $result = $pdo->query("SHOW COLUMNS FROM notifikasi LIKE 'is_read'");
    
    if ($result->rowCount() == 0) {
        // Add column if it doesn't exist
        $query = "ALTER TABLE notifikasi ADD COLUMN is_read TINYINT(1) DEFAULT 0";
        $pdo->exec($query);
        echo "Kolom is_read berhasil ditambahkan!\n";
    } else {
        echo "Kolom is_read sudah ada.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>