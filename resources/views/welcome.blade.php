<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Must be compatible with Android 4 Browser on Android (Eclair) -->
        <meta charset="utf-8">

        <title>My Books</title>

        <!-- Styles -->
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .container {
                width: 100%;
                padding: 20px;
                background-color: #fff;
                margin: 0 auto;
            }
            h2 {
                font-size: 24px;
                font-weight: bold;
                color: #333;
                margin-bottom: 20px;
            }
            table {
                width: 90%;
                border-collapse: collapse;
            }
            th, td {
                padding: 10px;
                text-align: left;
            }
            th {
                color: #000000;
            }
            img {
                width: 100px;
            }
            .btn {
                padding: 10px 20px;
                font-size: 14px;
                font-weight: bold;
                color: white;
                background-color: #3B82F6;
                text-decoration: none;
                border-radius: 8px;
                display: inline-block;
            }
        </style>
    </head>
    <body class="antialiased font-sans">
       @livewire('ebook-list')
    </body>
</html>
