<?php
session_start();

if (!isset($_SESSION["admin_session"])) {
    header("Location: admin-signin.php");
    exit();
}

unset($_SESSION["success"]);
unset($_SESSION["error"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель инструментов</title>
    <?php include "sections/style.php"; ?>

</head>

<body>

    <?php include 'sections/header.php'; ?>

    <div class="container">

        <h2 class="pb-2 border-bottom">Панель администратора</h2>

        <div class="row g-2 py-2 row-cols-1 row-cols-lg-3">

            <div class="feature col">
                <h3 class="fs-2 text-body-emphasis">Посты</h3>
                <a href="create_post.php" class="icon-link">Создать пост<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
                <a href="list_posts.php" class="icon-link">Список постов<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
                <a href="list_analysis.php" class="icon-link">Список анализов<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
                <a href="list_comments.php" class="icon-link">Список комментариев<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
            </div>

            <div class="feature col">
                <h3 class="fs-2 text-body-emphasis">Категории</h3>
                <a href="create_category.php" class="icon-link">Создать категорию<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
                <a href="list_categorys.php" class="icon-link">Список категорий<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
            </div>

            <div class="feature col">
                <h3 class="fs-2 text-body-emphasis">Сообщение</h3>
                <a href="list_messages.php" class="icon-link">Список сообщений<svg class="bi">
                        <use xlink:href="#chevron-right"></use>
                    </svg></a><br>
            </div>

        </div>
    </div>

    <?php
    // Server check version and start time for performance measurement
    $server_check_version = '1.0.4';
    $start_time = microtime(TRUE);

    // Determine the operating system
    $operating_system = PHP_OS_FAMILY;

    // Check if the operating system is Windows
    if ($operating_system === 'Windows') {
        // Windows CPU information
        $wmi = new COM('WinMgmts:\\\\.');
        $cpus = $wmi->InstancesOf('Win32_Processor');
        $cpuload = 0;
        $cpu_count = 0;

        foreach ($cpus as $key => $cpu) {
            $cpuload += $cpu->LoadPercentage;
            $cpu_count++;
        }

        // Windows Memory information
        $res = $wmi->ExecQuery('SELECT FreePhysicalMemory,FreeVirtualMemory,TotalSwapSpaceSize,TotalVirtualMemorySize,TotalVisibleMemorySize FROM Win32_OperatingSystem');
        $mem = $res->ItemIndex(0);
        $memtotal = round($mem->TotalVisibleMemorySize / 1000000, 2);
        $memavailable = round($mem->FreePhysicalMemory / 1000000, 2);
        $memused = round($memtotal - $memavailable, 2);

        // Windows Connections
        $connections = shell_exec('netstat -nt | findstr :' . $_SERVER['SERVER_PORT'] . ' | findstr ESTABLISHED | find /C /V ""');
        $totalconnections = shell_exec('netstat -nt | findstr :' . $_SERVER['SERVER_PORT'] . ' | find /C /V ""');
    } else {
        // Linux CPU information
        $load = sys_getloadavg();
        $cpuload = $load[0];
        $cpu_count = shell_exec('nproc');

        // Linux Memory information
        $free = shell_exec('free');
        $free = (string) trim($free);
        $free_arr = explode("\n", $free);
        $mem = explode(" ", $free_arr[1]);
        $mem = array_filter($mem, function ($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
        $mem = array_merge($mem);
        $memtotal = round($mem[1] / 1000000, 2);
        $memused = round($mem[2] / 1000000, 2);
        $memfree = round($mem[3] / 1000000, 2);
        $memshared = round($mem[4] / 1000000, 2);
        $memcached = round($mem[5] / 1000000, 2);
        $memavailable = round($mem[6] / 1000000, 2);

        // Linux Connections
        $connections = `netstat -ntu | grep -E ':80 |443 ' | grep ESTABLISHED | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`;
        $totalconnections = `netstat -ntu | grep -E ':80 |443 ' | grep -v LISTEN | awk '{print $5}' | cut -d: -f1 | sort | uniq -c | sort -rn | grep -v 127.0.0.1 | wc -l`;
    }

    // Calculate memory usage percentage
    $memusage = round(($memused / $memtotal) * 100);

    // Calculate PHP load
    $phpload = round(memory_get_usage() / 1000000, 2);

    // Calculate disk space information
    $diskfree = round(disk_free_space(".") / 1000000000);
    $disktotal = round(disk_total_space(".") / 1000000000);
    $diskused = round($disktotal - $diskfree);

    // Calculate disk usage percentage
    $diskusage = round($diskused / $disktotal * 100);

    // Determine the traffic light color based on resource usage
    if ($memusage > 85 || $cpuload > 85 || $diskusage > 85) {
        $trafficlight = 'red';
    } elseif ($memusage > 50 || $cpuload > 50 || $diskusage > 50) {
        $trafficlight = 'orange';
    } else {
        $trafficlight = '#2F2';
    }

    // Calculate end time and total time taken
    $end_time = microtime(TRUE);
    $time_taken = $end_time - $start_time;
    $total_time = round($time_taken, 4);

    // Output JSON if requested
    if (isset($_GET['json'])) {
        echo '{"ram":' . $memusage . ',"cpu":' . $cpuload . ',"disk":' . $diskusage . ',"connections":' . $totalconnections . '}';
        exit;
    }
    ?>

    <!-- Display Server Performance Information -->
    <div class="container mt-5" style="padding-left: 1rem; padding-right: 1rem; padding-bottom: 10rem;">
        <h2 class="pb-2 border-bottom">Использование ресурсов сервера</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Информация о памяти</h5>
                        <!-- Display various memory metrics -->
                        <p class="card-text">🌡️ Использование оперативной памяти:
                            <?php echo $memusage ?? 'Нет в наличии'; ?>%</p>
                        <p class="card-text">🖥️ Использование ЦП: <?php echo round($cpuload, 2) ?? 'Нет в наличии'; ?>%
                        </p>
                        <p class="card-text">💽 Использование жесткого диска:
                            <?php echo $diskusage ?? 'Нет в наличии'; ?>%</p>
                        <p class="card-text">🌐 Установленные связи: <?php echo $connections ?? 'Нет в наличии'; ?></p>
                        <p class="card-text">🌐 Всего подключений: <?php echo $totalconnections ?? 'Нет в наличии'; ?>
                        </p>
                        <hr>
                        <!-- Display additional memory metrics -->
                        <p class="card-text">🖥️ Потоки ЦП: <?php echo $cpu_count ?? 'Нет в наличии'; ?></p>
                        <hr>
                        <p class="card-text">🌡️ Всего оперативной памяти: <?php echo $memtotal ?? 'Нет в наличии'; ?>
                            ГБ</p>
                        <p class="card-text">🌡️ Используемая оперативная память:
                            <?php echo $memused ?? 'Нет в наличии'; ?> ГБ</p>
                        <p class="card-text">🌡️ Доступно оперативная память:
                            <?php echo $memavailable ?? 'Нет в наличии'; ?> ГБ</p>
                        <hr>
                        <!-- Display disk space metrics -->
                        <p class="card-text">💽 Жесткий диск свободен: <?php echo $diskfree ?? 'Нет в наличии'; ?> ГБ
                        </p>
                        <p class="card-text">💽 Жесткий диск используется: <?php echo $diskused ?? 'Нет в наличии'; ?>
                            ГБ</p>
                        <p class="card-text">💽 Всего на жестком диске: <?php echo $disktotal ?? 'Нет в наличии'; ?> ГБ
                        </p>
                        <hr>
                        <!-- Display server information -->
                        <p class="card-text">📟 Имя сервера: <?php echo $_SERVER['SERVER_NAME'] ?? 'Нет в наличии'; ?>
                        </p>
                        <p class="card-text">💻 Адрес сервера: <?php echo $_SERVER['SERVER_ADDR'] ?? 'Нет в наличии'; ?>
                        </p>
                        <p class="card-text">🌀 PHP-версия: <?php echo phpversion() ?? 'Нет в наличии'; ?></p>
                        <p class="card-text">🏋️ Загрузка PHP: <?php echo $phpload ?? 'Нет в наличии'; ?> ГБ</p>
                        <p class="card-text">⏱️ Время загрузки: <?php echo $total_time ?? 'Нет в наличии'; ?> сек</p>
                    </div>
                </div>
            </div>
            <!-- Display memory chart -->
            <div class="col-md-6" style="padding: 2rem; padding-top: 2rem;">
                <canvas id="memoryChart" width="300" height="300"></canvas>
            </div>
            <!-- Display CPU chart -->
            <div class="col-md-6" style="padding: 2rem; padding-top: 2rem;">
                <canvas id="cpuChart" width="300" height="300"></canvas>
            </div>
            <!-- Display disk space chart -->
            <div class="col-md-6" style="padding: 2rem; padding-top: 2rem;">
                <canvas id="diskSpaceChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Chart Memory
        let ctxMemory = document.getElementById('memoryChart').getContext('2d');
        let memoryChart = new Chart(ctxMemory, {
            type: 'doughnut',
            data: {
                labels: ['Использованная память', 'Доступная память'],
                datasets: [{
                    data: [<?php echo $memused; ?>, <?php echo $memavailable; ?>],
                    backgroundColor: ['#FF6384', '#36A2EB'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Использование памяти',
                },
            }
        });
    </script>

    <script>
        // Chart CPU
        let ctxCpu = document.getElementById('cpuChart').getContext('2d');
        let cpuChart = new Chart(ctxCpu, {
            type: 'doughnut',
            data: {
                labels: ['Процессор', 'Доступный ЦП'],
                datasets: [{
                    data: [<?php echo $cpuload; ?>, <?php echo 100 - $cpuload; ?>],
                    backgroundColor: ['#FF6384', '#36A2EB'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Использование ЦП',
                },
            }
        });
    </script>

    <script>
        // Chart Disk space
        let ctxDiskSpace = document.getElementById('diskSpaceChart').getContext('2d');
        let diskSpaceChart = new Chart(ctxDiskSpace, {
            type: 'doughnut',
            data: {
                labels: ['Использованный диск', 'Доступный диск'],
                datasets: [{
                    data: [<?php echo $diskusage; ?>, <?php echo $diskfree; ?>],
                    backgroundColor: ['#FF6384', '#36A2EB'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Использование дискового пространства',
                },
            }
        });
    </script>


    <?php include 'sections/footer.php'; ?>