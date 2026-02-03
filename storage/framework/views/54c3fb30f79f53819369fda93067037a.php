<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal PKL - <?php echo e($group->name); ?></title>
    <style>
        body { 
            font-family: 'Times New Roman', Times, serif; 
            font-size: 11pt; 
            color: black;
        }
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
            font-weight: bold; 
            text-transform: uppercase;
        }
        .header div { margin-bottom: 2px; }
        .sub-header {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 30px; 
        }
        th, td { 
            border: 1px solid black; 
            padding: 5px 8px; 
            vertical-align: middle; 
        }
        th { 
            text-align: center; 
            font-weight: bold;
            background-color: #fff; 
        }
        .text-center { text-align: center; }
        
        .footer { 
            float: right; 
            text-align: center; 
            width: 300px; 
            margin-top: 30px; 
        }
        
        @media print {
            @page { 
                size: A4 portrait;
                margin: 2cm; 
            }
            body { 
                -webkit-print-color-adjust: exact; 
                margin: 0;
            }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <?php
        Carbon\Carbon::setLocale('id'); 
    ?>

    <div class="header">
        <div style="text-transform: uppercase;">JADWAL PKL <?php echo e($group->name); ?> MALANG </div>
        <div><?php echo e($divisionName); ?></div>
        <div style="text-transform: none; margin-top: 5px;">
            Tanggal <?php echo e($startDate->translatedFormat('j F Y')); ?> - <?php echo e($endDate->translatedFormat('j F Y')); ?>

        </div>
    </div>

    <table>
        <thead>
            <tr>    
                <th style="width: 50px;">NO</th>
                <th style="width: 25%;">NAMA</th>
                <th style="width: 25%;">TANGGAL</th>
                <th>LOKASI</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                    $rows = $item['rows']; 
                    $rowCount = count($rows); 
                ?>
                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rowIndex => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php if($rowIndex === 0): ?>
                            <td rowspan="<?php echo e($rowCount); ?>" class="text-center"><?php echo e($index + 1); ?></td>
                            <td rowspan="<?php echo e($rowCount); ?>" class="text-center"><?php echo e($item['user']->name); ?></td>
                        <?php endif; ?>
                        
                        <td class="text-center">
                            
                                <?php echo e($row['start']->translatedFormat('j F Y')); ?> - <br> <?php echo e($row['end']->translatedFormat('j F Y')); ?>


                        </td>
                        <td class="text-center">
                            <?php echo e($row['location']); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>


</body>
</html>
<?php /**PATH C:\Users\intan\Downloads\PKL\TesAbsen\resources\views/admin/schedules/print.blade.php ENDPATH**/ ?>