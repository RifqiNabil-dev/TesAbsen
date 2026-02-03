<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal PKL - {{ $group->name }}</title>
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
    @php
        Carbon\Carbon::setLocale('id'); 
    @endphp

    <div class="header">
        <div style="text-transform: uppercase;">JADWAL PKL {{ $group->name }} MALANG </div>
        <div>{{ $divisionName }}</div>
        <div style="text-transform: none; margin-top: 5px;">
            Tanggal {{ $startDate->translatedFormat('j F Y') }} - {{ $endDate->translatedFormat('j F Y') }}
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
            @foreach($data as $index => $item)
                @php 
                    $rows = $item['rows']; 
                    $rowCount = count($rows); 
                @endphp
                @foreach($rows as $rowIndex => $row)
                    <tr>
                        @if($rowIndex === 0)
                            <td rowspan="{{ $rowCount }}" class="text-center">{{ $index + 1 }}</td>
                            <td rowspan="{{ $rowCount }}" class="text-center">{{ $item['user']->name }}</td>
                        @endif
                        
                        <td class="text-center">
                            
                                {{ $row['start']->translatedFormat('j F Y') }} - <br> {{ $row['end']->translatedFormat('j F Y') }}

                        </td>
                        <td class="text-center">
                            {{ $row['location'] }}
                        </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>


</body>
</html>
