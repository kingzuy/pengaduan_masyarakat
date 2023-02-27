<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rekap Data Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <h2 style="text-align: center;">{!! $title !!}</h2>

    <table style="border-collapse: collapse; width: 100%; margin-top: 30px">
        <thead>
            <tr style="font-size: 12px; border: 1px solid black;"">
                <th style="border: 1px solid black; text-align: center;">
                    Pengadu
                </th>
                <th style="border: 1px solid black; text-align: center;">
                    Petugas</th>
                <th style="border: 1px solid black; text-align: center;">
                    Status
                </th>
                <th style="border: 1px solid black; text-align: center;">
                    Pesan</th>
                <th style="border: 1px solid black; text-align: center;">
                    Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $data)
                <tr style="font-size: 10px; border: 1px solid black;"">
                    <td style="border: 1px solid black;">
                        {{ $data->pengadu }}#{{ $data->username_pengadu }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ $data->petugas }}#{{ $data->username_petugas }}</td>
                    <td style="border: 1px solid black;">
                        {{ $data->status }}</td>
                    <td style="border: 1px solid black;">
                        {{ $data->pesan }}
                    </td>
                    <td style="border: 1px solid black;">
                        {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
