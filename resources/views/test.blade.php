<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

    var_dump($products);

?>

<h1>blabla</h1>

@foreach($products as $product)

    <p>{{ $product }}</p>

@endforeach

<script>
    var products = '{{ $products }}'
</script>

</body>
</html>
