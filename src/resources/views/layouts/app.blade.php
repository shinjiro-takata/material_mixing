<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>配合手順確認表</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('css')
</head>

<body>
    <nav class="navbar">
        <div class="navbar__container">
            <div class="navbar__brand">
                <a href="{{ route('index') }}" class="navbar__logo">配合手順確認表</a>
            </div>
            <div class="navbar__user">
                @if(Auth::check())
                <span class="navbar__user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="navbar__logout-form">
                    @csrf
                    <button type="submit" class="navbar__logout-btn">ログアウト</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="btn" style="margin: 0;">ログイン</a>
                @endif
            </div>
        </div>
    </nav>

    <main class="main-content">
        <div class="container">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2026 配合手順確認表</p>
    </footer>
</body>

</html>