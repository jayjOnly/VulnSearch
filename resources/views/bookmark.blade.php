<div class="container">
    <h1>Your Bookmarks</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Vulnerability</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookmarks as $bookmark)
                <tr>
                    <td>{{ $bookmark->vulnerability->name }}</td>
                    <td>{{ $bookmark->notes }}</td>
                    <td>
                        <form action="{{ route('bookmark.toggle', $bookmark->vulnerability_id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Remove Bookmark</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>