<?php
session_start();
if(!isset($_SESSION["login_user"])){
    header("location: ../form/login.php");
    exit();
}
include '../koneksi.php';
include 'header.php';
?>

<title>Beranda Admin</title>
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
    }

    .calendar-container {
        width: 325px;
        height: 325px;
        border: 2px solid #ddd;
        padding: 0px;
        text-align: center;
    }

    .highlight-today {
        width: 30px; 
        height: 30px; 
        border-radius: 50%;
        background-color: white; 
        color: black; 
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto; 
        margin-top: 3px;
        border: 4px solid black;
    }
    
    .highlight-sunday {
        background-color: red;
        color: white;
    }
</style>

<body>
    <main class="main">
        <div class="wlcm">
            <h1 class="w1">Selamat Datang Di Halaman Admin</h1>
            <h1 class="w2">Buya Galung Catering</h1>
        </div>
        <div class="container">
            <div class="calendar-container">
                <?php
                date_default_timezone_set('Asia/Jakarta');
                    $currentDate = date('Y-m-d');
                    $currentDay = date('d', strtotime($currentDate));
                    $daysInMonth = date('t', strtotime($currentDate));
                    $firstDayOfMonth = date('N', strtotime(date('Y-m-01', strtotime($currentDate))));

                    echo "<h2>".date('F Y', strtotime($currentDate))."</h2>";

                    echo "<table border='1'>";
                    echo "<tr><th>Sen</th><th>Sel</th><th>Rab</th><th>Kam</th><th>Jum</th><th>Sab</th><th>Ming</th></tr>";
                    
                    $dayCounter = 1;
                    echo "<tr>";

                    for ($i = 1; $i < $firstDayOfMonth; $i++) {
                        echo "<td></td>";
                        $dayCounter++;
                    }

                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $class = ($day == $currentDay) ? 'highlight-today' : '';
                    
                        // Tambahkan kondisi untuk mengecek hari Minggu
                        if ($dayCounter % 7 == 0) {
                            echo "<td class='highlight-sunday'>$day</td>";
                        } else {
                            echo "<td class='$class'>$day</td>";
                        }
                    
                        if ($dayCounter % 7 == 0) {
                            echo "</tr><tr>";
                        }
                    
                        $dayCounter++;
                    }

                    echo "</tr>";
                    echo "</table>";
                ?>
            </div>
        </div>
    </main>
</body>
<?php include 'footer.php'; ?>
