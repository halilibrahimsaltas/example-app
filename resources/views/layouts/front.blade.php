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

        // API yanıtlarını otomatik olarak formatla
        $(document).ready(function () {
            console.log('Sayfa içeriği:', document.body.textContent);

            if (document.body.textContent.trim()) {
                try {
                    const jsonData = JSON.parse(document.body.textContent);
                    console.log('Parsed JSON:', jsonData);
                    document.body.innerHTML = '<pre class="json-response">' + JSON.stringify(jsonData, null, 2) + '</pre>';
                } catch (e) {
                    console.error('JSON parse hatası:', e);
                    document.body.innerHTML = '<pre class="json-response">Hata: JSON parse edilemedi</pre>';
                }
            } else {
                console.log('Sayfa içeriği boş');
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