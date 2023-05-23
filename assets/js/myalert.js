const flashData = $('.flash-data').data('flashdata');

if (flashData) {
    Swal.fire({
        //position: 'top-end',
        icon: 'success',
        title: flashData + ' Successfully',
        showConfirmButton: false,
        timer: 1500
    });
}

const flashFailed = $('.flash-failed').data('flashdata');
if (flashFailed) {
    Swal.fire({
        icon: 'warning',
        title: flashFailed,
        showConfirmButton: false,
        timer: 1500
    });
}

// Delete
$('.tombol-hapus').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

// Update
$('.tombol-updete').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "You will not be able to change this back!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

// Delete All
$('.delete-all').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {

            let timerInterval
            Swal.fire({
                icon: 'warning',
                title: 'On Process',
                html: 'It will finish on <b></b> milliseconds.',
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    document.location.href = href;
                }
            })

        }
    })
});

// Logout
$('.tombol-logout').on('click', function (e) {

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Are you sure?',
        text: "Ready to end your current session?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Sign out!'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});