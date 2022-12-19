<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://groupstore/styles/layout.css">
    @yield('style')
    <title>Store Staff</title>
</head>
<body>
    <header>
        <nav class="layoutRoutes">
            <ul class="routes" style="justify-content: center;">
                <li><a href="{{route('lots.index')}}">Lots</a></li>
                <li><a href="{{route('categories.index')}}">Categories</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="content">
        @yield('content')
    </div>
</body>
</html>