<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nail Art - Daftar</title>

    <link rel="icon" type="image/png" href="assets/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="assets/favicon/favicon.svg" />
    <link rel="shortcut icon" href="assets/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="assets/favicon/site.webmanifest" />

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Kapakana:wght@400&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inika:wght@400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-dark': '#A3485A',
                        'nav-hover': '#A31111',
                        'nav-inactive': '#D1A5AE',
                    },
                    fontFamily: {
                        kapakana: ['Kapakana', 'cursive'], 
                        inika: ['Inika', 'serif'],   // FONT INIKA
                    }
                }
            }
        }
    </script>

    <style>
        .custom-navbar-shadow {
            box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.5);
        }

        .register-container {
            background-color: #A3A3A3; 
            max-width: 600px; 
            width: 90%; 
            padding: 30px; 
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); 
        }

        .input-label {
            color: #4A4A4A; 
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .input-field {
            width: 100%;
            background-color: white;
            border: none;
            padding: 12px; 
            margin-bottom: 15px;
            border-radius: 5px;
            color: black;
            font-size: 1rem;
        }

        /* 🎨 Tambahan: Style untuk placeholder agar terlihat jelas */
        .input-field::placeholder {
            color: #A3A3A3; /* Warna abu-abu yang lebih terang */
            opacity: 1; /* Agar tidak transparan */
        }

        .register-button {
            background-color: #FF0000; 
            color: white;
            padding: 18px; 
            border-radius: 5px;
            font-size: 1.3rem; 
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .register-button:hover {
            background-color: #CC0000;
        }

        .register-title {
            font-family: 'inika', serif; 
            font-size: 2.5rem; 
            color: black;
            text-align: center;
            margin-bottom: 25px; 
            padding-bottom: 10px;
            border-bottom: 1px solid black;
        }

        /* Style untuk tautan navigasi di footer */
        .footer-link {
            color: #4A4A4A; /* Abu-abu gelap */
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-link:hover {
            color: #FF0000; /* Merah cerah saat di-hover */
            text-decoration: underline;
        }
    </style>
</head>

<body class="bg-[#FEF3E2] text-gray-800 flex justify-center items-center min-h-screen">

    <div class="register-container">
        
        <h1 class="register-title">RENA_ILS04</h1>

        <form action="#" method="POST" class="space-y-4">
            
            <div class="flex space-x-6"> 
                <div class="flex-1">
                    <label for="nama_depan" class="block input-label">Nama Depan</label>
                    <input type="text" id="nama_depan" name="nama_depan" 
                            class="input-field" 
                            placeholder="Masukkan Nama Depan Anda"
                            required> </div>
                <div class="flex-1">
                    <label for="nama_belakang" class="block input-label">Nama Belakang</label>
                    <input type="text" id="nama_belakang" name="nama_belakang" 
                            class="input-field"
                            placeholder="Masukkan Nama Belakang Anda">
                </div>
            </div>

            <div>
                <label for="username" class="block input-label">Username</label>
                <input type="text" id="username" name="username" 
                        class="input-field" 
                        placeholder="Buat Username"
                        required> </div>

            <div>
                <label for="email" class="block input-label">Email</label>
                <input type="email" id="email" name="email" 
                        class="input-field" 
                        placeholder="cth: namaanda@email.com"
                        required> </div>

            <div>
                <label for="tanggal_lahir" class="block input-label">Tanggal Lahir</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" 
                        class="input-field"
                        required> </div>

            <div>
                <label for="nomor_handphone" class="block input-label">Nomor Handphone</label>
                <div class="flex">
                    <span class="bg-[#666666] text-white p-3 flex items-center rounded-l-md font-medium px-4 text-base" 
                            style="margin-bottom: 15px; height: 47px;">+62</span>
                    <input type="tel" id="nomor_handphone" name="nomor_handphone" 
                            class="input-field rounded-l-none" 
                            placeholder="cth: 81234567890"
                            style="margin-bottom: 15px; border-top-left-radius: 0; border-bottom-left-radius: 0;" 
                            required> </div>
            </div>
            
            <div>
                <label for="password" class="block input-label">Password</label>
                <input type="password" id="password" name="password" 
                        class="input-field" 
                        placeholder="Minimal 8 karakter"
                        required> </div>

            <button type="submit" class="register-button font-inika w-full">
                REGISTER
            </button>
        </form>

        <div class="mt-8 text-center pt-4 border-t border-gray-600">
            <a href="<?= site_url('/') ?>" class="footer-link text-sm">
                <i class="fas fa-home mr-1"></i> Kembali ke Halaman Utama
            </a>
        </div>
        </div>

</body>
</html>