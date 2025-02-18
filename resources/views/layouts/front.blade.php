<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- JSON Viewer CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.10.0/jsoneditor.min.css" rel="stylesheet"
        type="text/css">
    <!-- CSS dosyaları için doğru yol -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    @yield('css')
</head>

<body>
    @include('layouts.front.navbar')

    @yield('content')

    @include('layouts.front.footer')

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS Bundle -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- JSON Viewer JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.10.0/jsoneditor.min.js"></script>
    <!-- JS dosyaları için doğru yol -->
    <script src="{{ asset('/js/script.js') }}"></script>

    <script>
        function formatJSON(data) {
            if (typeof data === 'string') {
                try {
                    data = JSON.parse(data);
                } catch (e) {
                    return data;
                }
            }
            return JSON.stringify(data, null, 2);
        }

        // Sadece API endpoint'lerinde JSON parse işlemi yap
        $(document).ready(function () {
            // Sadece ana içerik alanındaki metni al
            const content = $('#content').text().trim();
            if (content) {
                const jsonData = JSON.parse(content);
                document.getElementById('content').innerHTML = '<pre class="json-response">' + JSON.stringify(jsonData, null, 2) + '</pre>';
            }
        });
    </script>

    <style>
        .json-response {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
            margin: 20px;
        }
    </style>

    @yield('js')
</body>

</html>