<table border="1">
    <thead>
        <tr>
            <th colspan="8">LAPORAN IT HELPDESK</th>
        </tr>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Karyawan</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Staf IT</th>
            <th>Status</th>
            <th>Durasi Penyelesaian</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
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
            <td><?php echo $t->nama_kategori; ?></td>
            <td><?php echo $t->nama_ruangan; ?></td>
            <td><?php echo $t->nama_staf ? $t->nama_staf : '-'; ?></td>
            <td><?php echo strtoupper($t->status_tiket); ?></td>
            <td><?php echo $durasi; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
