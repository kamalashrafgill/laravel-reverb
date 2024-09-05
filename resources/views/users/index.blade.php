@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Newly Registered Users</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <table id="user-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="module">
        Echo.channel('announcements').listen('UserRegistered', (e) => {
            // Get the table element
            var table = document.getElementById("user-table").getElementsByTagName('tbody')[0];

            // Insert a new row at the top (index 0)
            var newRow = table.insertRow(0);

            // Insert new cells into the row
            var idCell = newRow.insertCell(0);
            var nameCell = newRow.insertCell(1);
            var emailCell = newRow.insertCell(2);

            // Add content to the new cells
            idCell.innerHTML = e.user.id;
            nameCell.innerHTML = e.user.name;
            emailCell.innerHTML = e.user.email;
        });
    </script>
@endsection
