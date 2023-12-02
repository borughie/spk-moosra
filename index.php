<?php
include './src/koneksi.php';

session_start();
if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

?>
<!DOCTYPE html>
<html lang="en">

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
                <div class="bg-base-300 rounded-lg px-5 py-1">
                    <div class="font-semibold text-xl text-center">Anggota Kelompok</div>
                    <hr class="w-12 h-1 outline-none border-none bg-gradient-to-r from-primary via-primary to-secondary rounded-full my-1 mx-auto">
                    <div x-data="{}" x-init="$nextTick(() => {
        let ul = $refs.logos;
        ul.insertAdjacentHTML('afterend', ul.outerHTML);
        ul.nextSibling.setAttribute('aria-hidden', 'true');
    })" class="w-full inline-flex flex-nowrap overflow-hidden [mask-image:_linear-gradient(to_right,transparent_0,_black_128px,_black_calc(100%-128px),transparent_100%)] text-center">
                        <ul x-ref="logos" class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll">
                            <li>
                                <span class="whitespace-nowrap">Adi Gunawan <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Nur Atika <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Selviana <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Moris <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Profile 1 <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                        </ul>
                        <ul class="flex items-center justify-center md:justify-start [&_li]:mx-8 [&_img]:max-w-none animate-infinite-scroll" aria-hidden="true">
                            <li>
                                <span class="whitespace-nowrap">Adi Gunawan <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Nur Atika <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Selviana <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Moris <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                            <li>
                                <span class="whitespace-nowrap">Profile 1 <br><span class="text-transparent bg-clip-text bg-gradient-to-br from-primary via-secondary to-secondary font-semibold">20.50.090</span></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-span-3 bg-base-300 rounded-lg p-6">
                <form action="./src/aksicrud.php" method="post" class="w-full">
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
                    <button type="submit" name="blogin" class="btn btn-primary mx-auto flex justify-center w-fit mt-4">Login</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>