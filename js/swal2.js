function simpan() {
    const Toast = Swal.mixin({
        toast: true,
        position: "center",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Berhasil Menyimpan Data</div>',
    });
}

function gagalsimpan() {
    const Toast = Swal.mixin({
        toast: true,
        position: "center",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "error",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Gagal Menyimpan data ke Database</div>',
    });
}

function update() {
    const Toast = Swal.mixin({
        toast: true,
        position: "center",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Berhasil Memperbarui Data</div>',
    });
}

function gagalupdate() {
    const Toast = Swal.mixin({
        toast: true,
        position: "center",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "error",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Gagal Memperbarui Data ke Database</div>',
    });
}

function hapus() {
    const Toast = Swal.mixin({
        toast: true,
        position: "center",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Berhasil Menghapus Data</div>',
    });
}

function gagalhapus() {
    const Toast = Swal.mixin({
        toast: true,
        position: "center",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "error",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Gagal Menghapus Data Dari Database</div>',
    });
}

function login() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Login Berhasil</div>',
    });
}

function logout() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "success",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Logout Berhasil</div>',
    });
}

function password() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "error",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">Password yang anda masukan salah</div>',
    });
}

function username() {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener("mouseenter", Swal.stopTimer);
            toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
    });

    Toast.fire({
        icon: "error",
        html: '<div class="drop-shadow-md text-transparent bg-clip-text bg-gradient-to-br from-blue-700 via-blue-800 to-gray-900 font-bold text-xl flex items-center gap-3">NIM Tidak Ditemukan</div>',
    });
}
