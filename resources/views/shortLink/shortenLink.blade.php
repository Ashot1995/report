@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <form method="POST" action="{{ route('generate.shorten.link.post') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="link" class="form-control" placeholder="Enter URL"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">

                @if (Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                    <a href="{{url('/download-csv')}}" class="btn btn-primary">Export as CSV</a>
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Website URL</th>
                        <th>Qr code</th>
                        <th>Creation date</th>
                        <th>Creator full name</th>
                        <th>Creator email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shortLinks as $key=>$row)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}"
                                   target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                            <td> {{ SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate( $row->link ) }}</td>
                            <td> {{ $row->created_at }}</td>
                            <td> {{ $row->user->name }}</td>
                            <td> {{ $row->user->email }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
