<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 40px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0D9488; padding-bottom: 20px; margin-bottom: 30px; }
        .header h1 { margin: 0; color: #0F172A; }
        .header p { color: #64748B; margin: 5px 0 0 0; }
        
        .dashboard-grid {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        .chart-box {
            flex: 1;
            border: 1px solid #E2E8F0;
            padding: 20px;
            text-align: center;
        }
        .assets-box {
            flex: 2;
            border: 1px solid #E2E8F0;
            padding: 20px;
        }
        .assets-box h3, .chart-box h3 { margin-top: 0; color: #0F172A; border-bottom: 1px solid #E2E8F0; padding-bottom: 10px; }
        
        .asset-list { list-style: none; padding: 0; margin: 0; }
        .asset-item { display: flex; justify-content: space-between; border-bottom: 1px solid #f1f5f9; padding: 8px 0; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 14px; }
        th, td { padding: 10px 12px; border: 1px solid #E2E8F0; text-align: left; }
        th { background-color: #F8FAFC; color: #0F172A; font-weight: 600; text-transform: uppercase; font-size: 12px; }
        tr:nth-child(even) { background-color: #F8FAFC; }
        .status-done { color: #059669; font-weight: bold; }
        .status-pending { color: #D97706; font-weight: bold; }
        .status-in_progress { color: #2563EB; font-weight: bold; }
        .footer { margin-top: 50px; text-align: right; font-size: 14px; color: #64748B; }
        @media print {
            .no-print { display: none; }
            body { margin: 0; }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #0D9488; color: white; border: none; border-radius: 5px; cursor: pointer;">Print Sekarang</button>
    </div>

    <div class="header">
        <h1>Laporan IT HelpDesk</h1>
        <p>Rekapitulasi Tiket Layanan Bantuan IT <?php echo $tahun ? 'Tahun ' . $tahun : ''; ?></p>
        <p>Tanggal Cetak: <?php echo date('d M Y H:i:s'); ?></p>
    </div>

    <div class="dashboard-grid">
        <div class="chart-box">
            <h3>Status Penanganan</h3>
            <div style="width: 200px; height: 200px; margin: 0 auto;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
        <div class="assets-box">
            <h3>Top 5 Aset Sering Rusak</h3>
            <?php if(empty($top_assets)): ?>
                <p style="color: #94a3b8; font-style: italic;">Belum ada data kerusakan aset.</p>
            <?php else: ?>
                <ul class="asset-list">
                    <?php foreach($top_assets as $i => $ta): ?>
                    <li class="asset-item">
                        <span><strong><?php echo $i+1; ?>. <?php echo $ta->nama_asset; ?></strong> <br><small style="color:#64748b;"><?php echo $ta->jenis_asset; ?></small></span>
                        <span style="background: #fee2e2; color: #e11d48; padding: 2px 8px; border-radius: 12px; font-weight: bold; font-size: 12px; height: fit-content;"><?php echo $ta->total_rusak; ?>x Rusak</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Karyawan</th>
                <th>Kategori</th>
                <th>Staf IT</th>
                <th>Status</th>
                <th>Durasi Penyelesaian</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            if(empty($tickets)) {
                echo '<tr><td colspan="7" style="text-align:center;">Data laporan kosong.</td></tr>';
            }
            foreach ($tickets as $t): 
                $durasi = '-';
                if ($t->status_tiket == 'Selesai' && !empty($t->waktu_selesai)) {
                    $start = strtotime($t->waktu_dibuat);
                    $end = strtotime($t->waktu_selesai);
                    $diff = $end - $start;
                    
                    $hours = floor($diff / 3600);
                    $mins = floor(($diff / 60) % 60);
                    $durasi = $hours . ' Jam ' . $mins . ' Menit';
                }
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo date('d M Y H:i', strtotime($t->waktu_dibuat)); ?></td>
                <td><?php echo $t->pelapor; ?></td>
                <td><?php echo $t->nama_kategori; ?><br><small><?php echo $t->nama_asset ? $t->nama_asset : ''; ?></small></td>
                <td><?php echo $t->nama_staf ? $t->nama_staf : '-'; ?></td>
                <td class="status-<?php echo strtolower(str_replace(' ', '_', $t->status_tiket)); ?>"><?php echo strtoupper($t->status_tiket); ?></td>
                <td><?php echo $durasi; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Admin IT HelpDesk</p>
    </div>

    <script>
        window.onload = function() {
            <?php if(!empty($tickets)): ?>
            const ctx = document.getElementById('statusChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Dikerjakan', 'Selesai'],
                    datasets: [{
                        data: [
                            <?php echo $chart_data['Menunggu'] ?? 0; ?>, 
                            <?php echo $chart_data['Dikerjakan'] ?? 0; ?>, 
                            <?php echo $chart_data['Selesai'] ?? 0; ?>
                        ],
                        backgroundColor: ['#F59E0B', '#3B82F6', '#10B981'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: false, // Matikan animasi agar siap di-print
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
            <?php endif; ?>
            
            // Beri jeda sejenak untuk memastikan chart terender lalu trigger print
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
