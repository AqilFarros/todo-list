<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TODO LIST</title>
</head>

<body>
    <h1>MY TODO</h1>

    <form action="{{ route('todo.store') }}" method="post">
        @csrf
        @method('POST')
        <label for="">TASK</label>
        <input type="text" name="task">

        <button type="submit">SUBMIT</button>
    </form>

    <div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Todo</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($todo as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->task }}</td>
                        <td>{{ $row->status }}</td>
                        <td style="display: flex">
                            <form action="{{ route('todo.update', $row->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                @if ($row->status == 'Todo')
                                    <button type="submit">DO NOW</button>
                                @else
                                    <button type="submit">DO LATER</button>
                                @endif
                            </form>
                            <form action="{{ route('todo.destroy', $row->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit">DONE</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">NO TODO</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <form action="{{ route('logout') }}" method="post">
    @csrf
    <button type="submit">LOG OUT</button>
    </form>
</body>

</html>
