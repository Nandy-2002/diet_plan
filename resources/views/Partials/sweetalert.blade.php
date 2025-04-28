<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .swal2-popup {
        font-size: 1rem; /* Smaller font size */
        width: 400px;
        height: 350px; /* Set a fixed width for the popup */
    }
    .swal2-title {
        font-size: 1.5rem; /* Adjust title size */
    }
    .swal2-html {
        padding: 0.5rem; /* Adjust padding */
    }
    .swal2-confirm {
        background-color: #6A5ACD; /* Custom purple button color */
        color: white;
        border-radius: 5px; /* Optional: Add rounded corners */
    }
    .swal2-confirm:hover {
        background-color: #5A4FCF; /* Darker purple on hover */
    }
    .swal2-cancel {
        background-color: #f44336; /* Custom cancel button color */
        color: white;
    }
    .swal2-cancel:hover {
        background-color: #e53935; /* Custom cancel hover color */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'custom-popup'
                }
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ $errors->first() }}',
                confirmButtonText: 'OK',
                customClass: {
                    popup: 'custom-popup'
                }
            });
        @endif
    });
</script>