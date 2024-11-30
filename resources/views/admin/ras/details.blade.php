<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $rasgroup->name }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $rasgroup->name }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('rasgroup.update-message', $rasgroup->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="current_message">Current Message</label>
                                <input type="text" class="form-control" id="current_message" name="current_message"
                                    value="{{ $rasgroup->current_message }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Update Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>RAS Devices</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($rasgroup->rases as $ras)
                                <div class="col-6 p-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">RAS Device Details</h5>
                                            <div class="card-text">
                                                <p><strong>ID:</strong> {{$ras->id}}</p>
                                                <p><strong>Unique ID:</strong> {{$ras->unique_id}}</p>
                                                <p><strong>Created:</strong> {{$ras->created_at}}</p>
                                                <p><strong>Updated:</strong> {{$ras->updated_at}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
