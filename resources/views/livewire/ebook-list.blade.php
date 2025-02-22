<div class="container">
    <h2>Ebook List</h2>
    <table>
        <thead>
            <tr>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ebooks as $ebook)
                <tr>
                    <td>
                        <img src="{{ $ebook['cover'] }}"/>
                    </td>
                    <td >{{ $ebook['title'] }}</td>
                    <td >{{ $ebook['author'] }}</td>
                    <td >
                        <a href="{{ Storage::url($ebook['file_path']) }}" target="_blank" class="inline-block" style="padding: 10px 20px; font-size: 14px; font-weight: bold; color: white; background-color: #3B82F6; border-radius: 8px; text-decoration: none;">
                            Get
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
