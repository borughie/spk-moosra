<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Metode MOOSRA</title>
    <link rel="stylesheet" href="./css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css/uicons-bold-rounded.css">
    <link rel="stylesheet" href="./css/tailwind.css">
    <link rel="stylesheet" href="./css/fonts.css">
    <link rel="stylesheet" href="./css/main.css">
    <script src="./js/jquery.min.js"></script>
    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/sweetalert2.all.min.js"></script>
    <script src="./js/swal2.js"></script>
</head>

<body>
    <script>
        let timerInterval
        Swal.fire({
            icon: 'warning',
            html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-3xl">Anda Belum Login</div> <div class="text-gray-700 font-semibold">Silahkan Login Terlebih Dahulu.</div>',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                document.location = './index.php';
            }
        })
    </script>
</body>

</html>