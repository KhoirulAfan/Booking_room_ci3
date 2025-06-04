 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
 </head>
 <body>
     <table class="table" border="1">
    <thead>
        <tr>
        <th>No</th>
        <th>Ruang</th>
        <th>purpose</th>
        <th>Nama user</th>                        
        <th>status</th>
        <th>Start</th>
        <th>End</th>                        
        </tr>
    </thead>
    <?php if($data >1):?>
    <tbody class="table-border-bottom-0">
        <?php $no=0; foreach($data as $item): $no++?>
        <tr>
            <td><?= $no ?></td>
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?= $item->nama_room ?></strong></td>
            <td><?= $item->purpose ?></td>
            <td><?= $item->nama_user ?></td>                          
            <td>
            <?php                             
            $statusBadge = [
                'pending'  => 'warning',
                'approved' => 'success'
            ];
            $bade = $statusBadge[$item->status] ?? 'danger';
            if($item->canceled):
            ?>
            <div class="badge bg-label-warning">
                Canceled
            </div>     
            <?php else:;?>
            <div class="badge bg-label-<?= $bade?>">
                <?= $item->status ?>
            </div>     
            <?php endif;?>                       
            </td>
            <td>
            <small>
                <?= date('d-m-Y',strtotime($item->start_time))?>
            </small>
            <span class="badge bg-label-primary">
                <?= date('H:i',strtotime($item->start_time))?>
            </span>
            </td>
            <td>
            <small>
                <?= date('d-m-Y',strtotime($item->end_time))?>
            </small>
            <span class="badge bg-label-primary">
                <?= date('H:i',strtotime($item->end_time))?>
            </span>
            </td>                            
        </tr>                                                   
        <?php endforeach;?>
    </tbody>
    <?php else:?>
        <tbody class="table-border-bottom-0">
        <tr>
            <td class="text-center" colspan="8">Data kosong</td>
        </tr>
        </tbody>
    <?php endif;?>
    </table>    
 <script>    
     window.print()
 </script>                  
 </body>
 </html>