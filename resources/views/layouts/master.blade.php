<!doctype html>
<html>
<head>
    <title>{{'Bill Splitter'}}</title>
    <meta charset='utf-8'>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link href='/css/main.css' type='text/css' rel='stylesheet'>
    @stack('head')
</head>
<body>
<div class='container'>
    <header>
        <h1>Bill Splitter</h1>
    </header>

    <section>
        @yield('content')
    </section>
</div>
    <footer>
        &copy; {{ date('Y') }}
    </footer>

    @stack('body')
</body>
</html>