<?php
// Tentukan nama file untuk menyimpan data
$filename = 'anniversary_data.txt';

// Ambil data JSON dari permintaan POST
$data = json_decode(file_get_contents('php://input'), true);

// Cek apakah data valid
if (isset($data['loveValue'], $data['message'], $data['gift'], $data['relationshipMessage'])) {
    // Format data yang akan disimpan
    $content = "Love Value: " . $data['loveValue'] . "%\n";
    $content .= "Message: " . $data['message'] . "\n";
    $content .= "Gift: " . $data['gift'] . "\n";
    $content .= "Relationship Message: " . $data['relationshipMessage'] . "\n";
    $content .= "-----------------------------\n";

    // Simpan data ke dalam file
    file_put_contents($filename, $content, FILE_APPEND | LOCK_EX);

    // Kirim respons sukses
    http_response_code(200);
    echo json_encode(['message' => 'Data berhasil disimpan']);
} else {
    // Kirim respons kesalahan
    http_response_code(400);
    echo json_encode(['message' => 'Data tidak valid']);
}
?>
