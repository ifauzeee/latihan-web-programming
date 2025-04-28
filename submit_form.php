<?php
// Periksa apakah request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari formulir
    $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : '';
    $tempat_tanggal_lahir = isset($_POST['tempat_tanggal_lahir']) ? htmlspecialchars($_POST['tempat_tanggal_lahir']) : '';
    $alamat = isset($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : '';
    $kota = isset($_POST['kota']) ? htmlspecialchars($_POST['kota']) : '';
    $nomor_kartu_kredit = isset($_POST['nomor_kartu_kredit']) ? htmlspecialchars($_POST['nomor_kartu_kredit']) : '';

    // Siapkan data untuk disimpan ke CSV
    $data = [
        date('Y-m-d H:i:s'), // Timestamp
        $nama,
        $tempat_tanggal_lahir,
        $alamat,
        $kota,
        $nomor_kartu_kredit
    ];

    // Simpan ke file CSV
    $file = 'form_data.csv';
    $header = ['Timestamp', 'Nama', 'Tempat Tanggal Lahir', 'Alamat', 'Kota', 'Nomor Kartu Kredit'];
    
    // Cek apakah file CSV sudah ada, jika belum tambahkan header
    if (!file_exists($file)) {
        $fp = fopen($file, 'w');
        fputcsv($fp, $header);
        fclose($fp);
    }

    // Tambahkan data ke CSV
    $fp = fopen($file, 'a');
    fputcsv($fp, $data);
    fclose($fp);
} else {
    // Jika bukan POST, redirect kembali ke form
    header('Location: form_validation.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengiriman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #dbeafe 0%, #fef9d7 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Quicksand', sans-serif;
            color: #1f2937;
            overflow-x: hidden;
        }

        .result-card {
            transform: translateY(0);
            transition: transform 0.4s ease, opacity 0.4s ease;
            opacity: 1;
            background: #ffffff;
        }

        .btn {
            transition: background-color 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        footer {
            margin-top: auto;
            background: #eff6ff;
        }

        header {
            background: #ffffff;
            transition: background-color 0.3s ease;
        }
    </style>
</head>
<body>
    <header class="w-full shadow-md py-5 px-6 flex items-center justify-between">
        <button onclick="window.history.back()" class="btn px-5 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
            Kembali
        </button>
        <div class="text-center">
            <h1 class="text-3xl font-bold text-blue-600 md:text-4xl">Hasil Pengiriman</h1>
            <p class="mt-1 text-gray-600 text-sm md:text-base">Data Anda telah diterima!</p>
        </div>
        <div class="w-16"></div>
    </header>

    <main spree class="flex-grow flex items-center justify-center px-4 py-10">
        <div class="result-card p-8 rounded-2xl shadow-lg max-w-lg w-full">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Data yang Diterima:</h2>
            <p class="mb-2"><strong>Nama:</strong> <?php echo $nama; ?></p>
            <p class="mb-2"><strong>Tempat, Tanggal Lahir:</strong> <?php echo $tempat_tanggal_lahir; ?></p>
            <p class="mb-2"><strong>Alamat:</strong> <?php echo $alamat; ?></p>
            <p class="mb-2"><strong>Kota:</strong> <?php echo $kota; ?></p>
            <p class="mb-4"><strong>Nomor Kartu Kredit:</strong> <?php echo $nomor_kartu_kredit; ?></p>
            <p class="mb-4 text-gray-600">Data telah disimpan ke form_data.csv</p>
            <div class="flex flex-col space-y-4">
                <a href="form_data.csv" download class="btn w-full px-6 py-3 bg-green-500 text-white rounded-xl hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 text-center">
                    Unduh Data (CSV)
                </a>
                <a href="form_validation.html" class="btn w-full px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 text-center">
                    Isi Formulir Lagi
                </a>
            </div>
        </div>
    </main>

    <footer class="w-full py-4 text-center shadow-inner">
        <p class="text-gray-600 text-sm">© 2025 Latihan Web Programming - Dibuat dengan ❤</p>
    </footer>
</body>
</html>