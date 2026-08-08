<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TNGブログ')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!-- ヘッダー部分 -->
    <header class="py-3 mb-4 bg-primary-subtle">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a href="{{ route('index') }}" class="text-decoration-none link-body-emphasis">
                <h3 class="mb-0">TNGブログ</h3>
            </a>

        @if(auth()->check())
            <div>ログインユーザー: {{ auth()->user()->name }}</div>
        @endif

            <div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    ログアウト
                </a>
            </div>

        </div>
    </header>

    <div class="container">
        <div class="row justify-content-center">
            <!-- フラッシュメッセージの表示 -->
             @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 各画面の中身 -->
             <div class="col-8">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-center py-3 mt-5 bg-primary-subtle">
        <!-- フッター部分 -->
         <p>&copy; 2024 All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
