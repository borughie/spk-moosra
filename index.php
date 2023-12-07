<?php

session_start();
if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK | Metode MOOSRA</title>
    <?php include './src/header.php'; ?>
</head>

<body onload="<?= @$pesan ?>">
    <section id="isi">
        <div class="grid grid-cols-8 items-center justify-center mx-auto max-w-5xl h-screen">
            <div class="col-span-5 px-5 mr-12">
                <img src="./img/logo.png" class="max-w-[12rem] mx-auto mb-12">
                <div class="bg-base-300 rounded-lg px-5 py-1 select-none">
                    <div class="font-semibold text-xl text-center">Anggota Kelompok</div>
                    <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full my-1 mx-auto">
                    <div x-data="{}" x-init="$nextTick(() => {
        let ul = $refs.logos;
        ul.insertAdjacentHTML('afterend', ul.outerHTML);
        ul.nextSibling.setAttribute('aria-hidden', 'true');
    })" class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)] text-center">
                        <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
                            <li>
                                <span class="whitespace-nowrap">Adi Gunawan<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Atika Handayani<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.080</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Selviana Agusti<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">19.50.152</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Moris Zefanya B.S.<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.059</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Apriyansen<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.108</span></span>
                            </li>
                        </ul>
                        <ul class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll" aria-hidden="true">
                            <li>
                                <span class="whitespace-nowrap">Adi Gunawan<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Atika Handayani<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.080</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Selviana Agusti<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">19.50.152</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Moris Zefanya B.S.<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.059</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Apriyansen<br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.108</span></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-3 bg-base-300 rounded-lg p-6">
                <form action="./src/ceklogin.php" method="post" class="w-full">
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">NIM</span>
                        </div>
                        <input type="text" name="tnim" class="input input-bordered w-full" />
                    </label>
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Password</span>
                        </div>
                        <input type="password" name="tpassword" class="input input-bordered w-full" />
                    </label>
                    <div class="grid grid-cols-6 justify-center items-center gap-4">
                        <button type="submit" name="blogin" class="col-start-2 col-span-2 btn btn-primary mx-auto flex justify-center w-full mt-4">Login</button>
                        <button type="submit" name="bguest" class="col-span-2 btn btn-secondary mx-auto flex justify-center w-full mt-4">Guest</button>
                        <input type="hidden" name="login_type" value="user"> <!-- Tambahkan bidang tersembunyi -->
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>