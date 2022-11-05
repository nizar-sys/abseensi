var apiUrl = "/api/rayons";

function HitData(url, data = null, type = "GET", ...args) {
    return new Promise((resolve, reject) => {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function (response) {
                resolve(response);
            },
            error: function (error) {
                reject(error);
            },
        });
    });
}

function loadingRowTable(message, colspan = 0) {
    return `
        <tr>
            <td colspan="${colspan}" class="animated-dots">${message}</td>
        </tr>
    `;
}

function snackbarRetryGetClassGroup() {
    SnackBar({
        message: "Gagal mendapatkan data!",
        position: "bc",
        width: "500px",
        status: "error",
        actions: [
            {
                text: "Ulangi",
                function: () => {
                    getClassGroup();
                },
            },
        ],
        fixed: true,
    });
}

function renderTableClassGroup(rayon) {
    return `
        <tr>
            <td>${rayon.nama_rayon}</td>
            <td class="text-end">
                <span class="dropdown">
                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Aksi</button>
                <div class="dropdown-menu dropdown-menu-center">
                    <a class="dropdown-item edit-class-groups text-yellow" data-uuid="${rayon.uuid}" href="#">
                    ${iconEdit} Edit
                    </a>
                    <a class="dropdown-item remove-class-groups text-red" data-uuid="${rayon.uuid}" href="#">
                    ${iconHapus} Hapus
                    </a>
                </div>
                </span>
            </td>
        </tr>
    `;
}

function renderEmptyTableClassGroup() {
    return `
        <tr>
            <td>Tidak ada rayon</td>
            <td></td>
        </tr>
    `;
}

function renderPaginateClassGroups(link) {
    const { url, label, active } = link;
    var isDisabled = url == null;
    var per_page = $("#input-length-class-groups").val();
    var newUrl = `${url}&filter%5Bper_page%5D=${per_page}`;
    return `
        <li class="page-item ${active ? "active" : ""} ${
        isDisabled ? "disabled" : ""
    } navigation-class-groups"><a class="page-link" href="${newUrl}">${label}</a></li>
    `;
}

async function getClassGroup(url = apiUrl, filterData = null) {
    $("#class-groups-data").html(loadingRowTable("Mendapatkan data rayon", 2));
    const response = HitData(url, filterData)
        .then(({ response, params }) => {
            const { data, from, to, total, links } = response;
            $("#class-groups-data").html("");
            $("#paginate-class-groups").html("");
            if (data.length > 0) {
                $("#input-length-class-groups")
                    .val(params?.filter?.per_page ?? 20)
                    .attr("disabled", false);
                data.map((rayon, i) => {
                    $("#class-groups-data").append(
                        renderTableClassGroup(rayon)
                    );
                });
            } else {
                $("#input-length-class-groups").val(0).attr("disabled", true);
                $("#class-groups-data").html(renderEmptyTableClassGroup());
            }
            $("#count-from-class-groups").html(from ?? 0);
            $("#count-to-class-groups").html(to ?? 0);
            $("#count-total-class-groups").html(total);
            links.map((link, i) => {
                $("#paginate-class-groups").append(
                    renderPaginateClassGroups(link)
                );
            });

            $(".navigation-class-groups").click((e) => {
                e.preventDefault();
                var url = $(e.target).attr("href");
                getClassGroup(url);
            });

            $(".remove-class-groups").click((e) => {
                e.preventDefault();
                var uuid = $(e.target).attr("data-uuid");
                removeClassGroups(uuid);
            });
        })
        .catch((error) => {
            snackbarRetryGetClassGroup();
        });
}

function inputInvalid(responseError) {
    var elementInputs = $(`.input-${Object.keys(responseError)}`);
    for (var i in responseError) {
        elementInputs.addClass("is-invalid");
        for (var j in responseError[i]) {
            elementInputs
                .parent()
                .find(".invalid-feedback")
                .html(`${responseError[i][j]}`);
        }
    }
}

function snackbarToast(message, status = "error") {
    SnackBar({
        message,
        position: "bc",
        width: "500px",
        status,
        fixed: true,
    });
}

async function saveNewClassGroups() {
    var data = $("#form-new-class-groups").serialize();
    var buttonSave = $("#save-class-groups");
    buttonSave
        .html("Tunggu sebentar")
        .addClass("animated-dots")
        .attr("disabled", true);
    const response = await HitData(apiUrl, data, "POST")
        .then((response) => {
            if (response.status == "ok") {
                $("#modal-add-class-groups").modal("hide");
                getClassGroup();
                SnackBar({
                    message: "Berhasil menambahkan rayon!",
                    position: "bc",
                    width: "500px",
                    status: "success",
                    fixed: true,
                });
            }
        })
        .catch((error) => {
            if (error.status == 422) {
                var responseError = error.responseJSON.errors;
                inputInvalid(responseError);
            }
            snackbarToast("Terjadi kesalahan, mohon coba lagi.");
        });
    buttonSave
        .html("Simpan")
        .removeClass("animated-dots")
        .attr("disabled", false);
}

async function removeClassGroups(uuid, status = "show-modal") {
    var buttonDelete = $("#delete-class-groups");
    if (status == "show-modal") {
        $("#modal-remove-class-groups").modal("show");
        buttonDelete.attr("data-uuid", uuid);
    } else {
        buttonDelete
            .html("Menghapus rayon")
            .addClass("animated-dots")
            .attr("disabled", true);
        const response = HitData(`/api/rayons/${uuid}`, null, "DELETE")
            .then(({ status, response }) => {
                if (status == "ok") {
                    $("#modal-remove-class-groups").modal("hide");
                    snackbarToast("Berhasil menghapus data rayon.", "success");
                    getClassGroup();
                }
            })
            .catch((error) => {
                snackbarToast("Gagal menghapus, mohon coba lagi.");
                buttonDelete
                    .html("Hapus")
                    .removeClass("animated-dots")
                    .attr("disabled", false);
            });
    }
}

$(document).ready(() => {
    getClassGroup();

    $("#input-length-class-groups").change((e) => {
        var filter = {
            filter: {
                per_page: $(e.target).val(),
            },
        };
        getClassGroup(apiUrl, filter);
    });

    $("#search-class-groups").change((e) => {
        var filter = {
            filter: {
                nama_rayon: $(e.target).val(),
            },
        };
        getClassGroup(apiUrl, filter);
    });

    $("#refresh-class-groups").click((e) => {
        e.preventDefault();
        getClassGroup();
    });

    $("#save-class-groups").click(() => {
        saveNewClassGroups();
    });

    $("#form-new-class-groups").submit((e) => {
        e.preventDefault();
        saveNewClassGroups();
    });

    $("#delete-class-groups").click((e) => {
        e.preventDefault();
        var uuid = $(e.target).attr("data-uuid");
        removeClassGroups(uuid, "delete");
    });
});
