<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sheet</title>
</head>
<body>
    <table border="1">
        <thead>
          <tr>
              スクリーン
          </tr>
        </thead>
        <tbody>
            @foreach (['a', 'b', 'c'] as $row)
          <tr>
                 @foreach ($sheets->where('row', $row) as $sheet)
                    <td>{{ $row }}-{{ $sheet->column }}</td>
                 @endforeach
          </tr>
            @endforeach
        </tbody>
    </table>
</body>

       