<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RAS System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">


        <div class="card mb-5">
            <div class="card-body text-center">
                <h2 class="card-title">Main Control</h2>
                <form action="{{ route('ras.show-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-lg btn-primary">Show main image in all screens</button>
                </form>
            </div>
        </div>

        <h3 class="mb-4">RAS Groups</h3>
        <div class="row mb-5">
            @foreach($rasgroups as $rasgroup)
                <div class="col-4 p-4">
                    <a href="{{ route('ras.details', $rasgroup->id) }}" class="text-decoration-none">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{$rasgroup->name}}</h5>
                                <p class="card-text">
                                    <strong>Devices Count:</strong> {{$rasgroup->rases->count()}}
                                </p>
                                <p class="card-text">
                                    <strong>Current Message:</strong> {{$rasgroup->current_message}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <h3 class="mb-4">All RAS Devices</h3>
        <form action="{{ route('ras.assign-group') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <select name="group_id" class="form-control" required>
                    <option value="">Select Group</option>
                    @foreach($rasgroups as $rasgroup)
                        <option value="{{ $rasgroup->id }}">{{ $rasgroup->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mb-4">Assign to Group</button>

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>ID</th>
                            <th>Serial</th>
                            <th>Groups </th>
                            <th>Last Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_rases->sortBy('id') as $ras)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" name="ras_ids[]" value="{{ $ras->id }}" class="form-check-input" id="ras_{{ $ras->id }}">
                                        <label class="form-check-label" for="ras_{{ $ras->id }}"></label>
                                    </div>
                                </td>
                                <td>{{$ras->id}}</td>
                                <td>{{$ras->unique_id}}</td>
                                <td>{{ $ras->rasgroups?->count() > 0 ? $ras->rasgroups->pluck('name')->join(', ') : 'No Group' }}</td>
                                <td>{{$ras->message}}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
