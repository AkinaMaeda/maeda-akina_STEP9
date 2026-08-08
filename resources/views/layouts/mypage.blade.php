    @extends('app')

    @section('title', 'ブログ一覧')

    @section('content')
    <div class="container">
        <h1>マイページ</h1>

        <div class="d-flex mb-3">
            <a href="{{ route('create') }}" class="btn btn-success md-3">新規投稿</a>
            <a href="{{ route('index') }}" class="ms-auto">他の人の投稿</a>
        </div>

        <table border="1" class="table">
            <thead>
                <tr>
                    <!-- <th>投稿者</th> -->
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>画像</th>
                    <th>投稿日</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                    <tr>
                        <!-- <td>{{ $blog->user->name }}</td> -->
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->content }}</td>
                        <td>
                            @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" width="100">
                        @else
                            画像なし
                        @endif
                        </td>
                        <td>{{ $blog->created_at->format('Y-m-d') }}</td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('detail', $blog->id) }}" class="btn btn-primary">詳細</a>

                            <form action="{{ route('destroy', $blog->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">あなたが投稿した記事はありません。</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    @endsection