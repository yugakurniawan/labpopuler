function alertSuccess(kalimat) {
    document.querySelector('.notifikasi').innerHTML = /* html */ `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
            <span class="alert-text">
                <strong>Berhasil</strong>
                ${kalimat}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
}

function alertError(kalimat) {
    document.querySelector('.notifikasi').innerHTML = /* html */ `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-check-circle"></i></span>
            <span class="alert-text">
                <strong>Gagal</strong>
                ${kalimat}
            </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    `;
}

function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function hanyaHuruf(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode == 32 )
        return false;
    return true;
}

document.addEventListener('change', function (event) {
    switch (event.target.localName) {
        case "input":
            event.target.classList.remove('is-invalid');
            break;
        case "select":
            event.target.classList.remove('is-invalid');
            break;
        case "textarea":
            event.target.classList.remove('is-invalid');
            break;
        default:
            event.target.classList.remove('is-invalid');
            break;
    }
});
