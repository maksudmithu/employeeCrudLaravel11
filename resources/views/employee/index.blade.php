<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Employee Crud</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('employee.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
                <div class="col-md-10 alert alert-success mt-4">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">All Employee</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($employee as $employees)
                                    <tr>
                                        <th scope="row">{{ $employees->id }}</th>
                                        <td>{{ $employees->name }}</td>
                                        <td>{{ $employees->role }}</td>
                                        <td>{{ $employees->salary }}</td>
                                        <td>
                                            @if ($employees->image != '')
                                                <img src="{{ asset('uploads/employee/' . $employees->image) }}"
                                                    alt="" width="80">
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($employees->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a class="btn btn-warning"
                                                href="{{ route('employee.edit', $employees->id) }}">Edit</a>
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                                href="{{ route('employee.delete', $employees->id) }}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
