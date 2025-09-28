<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Splash Screen - Kitapaketin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden; /* Mencegah scroll saat splash screen aktif */
        }
        
        #splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #F9FAFB; /* Light gray background */
            z-index: 9999;
            transition: opacity 0.8s ease-out;
            opacity: 1;
        }

        .dark #splash-screen {
            background-color: #111827; /* Dark gray background for dark mode */
        }

        #splash-screen.hidden {
            opacity: 0;
            pointer-events: none; /* Mencegah interaksi setelah disembunyikan */
        }

        .splash-content {
            text-align: center;
            animation: fadeInZoom 1.5s ease-in-out forwards;
        }
        
        @keyframes fadeInZoom {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">

    <!-- Splash Screen -->
    <div id="splash-screen">
        <div class="splash-content">
            <!-- Logo SVG Aksen Segar -->
            <svg width="150" height="150" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 10 V 90 H 35 V 10 H 20 Z" fill="#111827"/>
                <path d="M75 10 L 40 50 L 75 90 L 90 75 L 55 50 L 90 25 L 75 10 Z" fill="#16A34A"/>
                <line x1="27.5" y1="20" x2="27.5" y2="35" stroke="white" stroke-width="2.5" stroke-dasharray="5 5"/>
                <line x1="27.5" y1="45" x2="27.5" y2="60" stroke="white" stroke-width="2.5" stroke-dasharray="5 5"/>
                <line x1="27.5" y1="70" x2="27.5" y2="85" stroke="white" stroke-width="2.5" stroke-dasharray="5 5"/>
            </svg>
            <!-- Nama Brand -->
            <div class="mt-4">
                <span class="text-4xl font-bold tracking-wider" style="color: #16A34A;">k</span><span class="text-4xl font-semibold text-gray-700 dark:text-gray-300">itapaketin</span>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            const splashScreen = document.getElementById('splash-screen');

            // Durasi splash screen (misal: 3 detik)
            const splashDuration = 3000; 

            setTimeout(() => {
                // Tambah class untuk memicu animasi fade-out
                splashScreen.classList.add('hidden');

                // Setelah transisi fade-out selesai, arahkan ke halaman login.
                splashScreen.addEventListener('transitionend', () => {
                    // PENTING: Ganti 'login.html' dengan URL halaman login Anda yang sebenarnya.
                    window.location.href = 'public/index.php';
                }, { once: true }); // Pastikan event listener hanya berjalan sekali

            }, splashDuration);
        });
    </script>

</body>
</html>

