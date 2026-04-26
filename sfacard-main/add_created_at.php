<?php
// Script untuk menambah kolom created_at ke tabel notifikasi
$host = 'localhost';
$dbname = 'sfacard';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Check if column exists
    $result = $pdo->query("SHOW COLUMNS FROM notifikasi LIKE 'created_at'");
    
    if ($result->rowCount() == 0) {
        // Add column if it doesn't exist
        $query = "ALTER TABLE notifikasi ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP";
        $pdo->exec($query);
        echo "Kolom created_at berhasil ditambahkan!\n";
    } else {
        echo "Kolom created_at sudah ada.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>