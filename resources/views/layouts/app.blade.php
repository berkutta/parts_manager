<!DOCTYPE html>
<html lang="en">
    <style>
    body {
        font-family:Calibri;
    }
    tr:nth-of-type(even) {
        background:#efefef;
    }
    tr td {
        padding: 10px;
        box-sizing: border-box;
        -webkit-box-sizing:border-box;
        -moz-box-sizing: border-box;
    }
    tr:first-of-type {
        font-weight:bold;
    }
    a, input[type="submit"] {
        display:inline-block;
        margin:5px;
        padding:5px 10px;
        background:darkgrey;
        color:#fff;
        text-decoration:none;
        border:none;
    }
    input, select {
        padding: 5px 10px;
        margin:5px;
        border:none;
        border-bottom:1px solid lightgrey;
        outline:none;
        box-sizing: border-box;
        -webkit-box-sizing:border-box;
        -moz-box-sizing: border-box;
    }
    </style>
    <head>
        @guest

        @else
        <form action="/components/search" method="POST">
            @csrf
            Search: 
            <input type="text" name="search" value="" />
            <input type="submit" />
        </form>
        <a href="/components/create">Add Component</a>
        <a href="/storages/create">Add Storage</a>
        <a href="/components">Components</a>
        <a href="/storages">Storage</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
        @csrf
        </form>
        @endguest
    </head>
    <body>
        @yield('content')
    </body>

</html>