<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="app">
    <DeviceComponent></DeviceComponent>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script>

    export default {

        components: {
            "device-component": DeviceComponent,
        },

    };
</script>
</body>
</html>
