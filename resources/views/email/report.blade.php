<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Short Link</th>
        <th>Website URL</th>
        <th>Created date</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data->links as $key=>$row)
        <tr>
            <td>{{ ++$key }}</td>
            <td><a href="{{ route('shorten.link', $row->code) }}"
                   target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
            <td>{{ $row->link }}</td>
            <td> {{ $row->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
