<?php
session_start();

if (isset($_POST['name'])) {
    $_SESSION['username'] = $_POST['name'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Session Nama Pengguna</title>
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

    .session-card {
      transform: translateY(0);
      transition: transform 0.4s ease, opacity 0.4s ease;
      opacity: 1;
      background: #ffffff;
    }

    .session-card.loading {
      transform: translateY(15px);
      opacity: 0.6;
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

    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      align-items: center;
      justify-content: center;
    }

    .modal-content {
      background: #ffffff;
      padding: 24px;
      border-radius: 12px;
      max-width: 400px;
      width: 90%;
      text-align: center;
    }

    input {
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    input:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 8px rgba(59, 130, 246, 0.3);
    }

    .error {
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: none;
    }
  </style>
</head>
<body>
  <header class="w-full shadow-md py-5 px-6 flex items-center justify-between">
    <button id="back-btn" class="btn px-5 py-2 bg-yellow-500 text-white rounded-xl hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400">
      Kembali
    </button>
    <div class="text-center">
      <h1 class="text-3xl font-bold text-blue-600 md:text-4xl">Session Nama Pengguna</h1>
      <p class="mt-1 text-gray-600 text-sm md:text-base">Simpan nama Anda untuk pengalaman personal!</p>
    </div>
    <div class="w-16"></div>
  </header>

  <main class="flex-grow flex items-center justify-center px-4 py-10">
    <div class="session-card p-8 rounded-2xl shadow-lg max-w-lg w-full text-center">
      <p class="text-lg font-medium text-gray-700">Selamat datang, <span id="session-name" class="text-blue-600 font-semibold"><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Pengguna'; ?></span>!</p>
      <button id="change-name-btn" class="btn mt-6 px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
        Ubah Nama
      </button>
    </div>
  </main>

  <div id="name-modal" class="modal">
    <div class="modal-content">
      <h2 class="text-xl font-semibold text-gray-800 mb-4">Masukkan Nama Anda</h2>
      <form id="name-form" method="POST">
        <input id="name-input" name="name" type="text" placeholder="Nama Anda" class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 mb-4" />
        <p id="name-error" class="error">Nama harus diisi!</p>
        <button type="submit" id="save-name-btn" class="btn w-full px-6 py-3 bg-blue-500 text-white rounded-xl hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
          Simpan
        </button>
      </form>
    </div>
  </div>

  <footer class="w-full py-4 text-center shadow-inner">
    <p class="text-gray-600 text-sm">© 2025 Latihan Web Programming - Dibuat dengan ❤</p>
  </footer>

  <script>
    const sessionName = document.getElementById('session-name');
    const modal = document.getElementById('name-modal');
    const nameInput = document.getElementById('name-input');
    const saveNameBtn = document.getElementById('save-name-btn');
    const changeNameBtn = document.getElementById('change-name-btn');
    const nameError = document.getElementById('name-error');
    const nameForm = document.getElementById('name-form');

    function showModal() {
      modal.style.display = 'flex';
      nameInput.focus();
    }

    function hideModal() {
      modal.style.display = 'none';
      nameInput.value = '';
      nameError.style.display = 'none';
    }

    saveNameBtn.addEventListener('click', () => {
      const name = nameInput.value.trim();
      if (!name) {
        nameError.style.display = 'block';
        return;
      }
    });

    changeNameBtn.addEventListener('click', showModal);

    document.getElementById('back-btn').addEventListener('click', () => {
      window.history.back();
    });

    nameForm.addEventListener('submit', (e) => {
      const name = nameInput.value.trim();
      if (!name) {
        e.preventDefault();
        nameError.style.display = 'block';
        return;
      }
      sessionName.textContent = name;
      hideModal();
    });
  </script>
</body>
</html>