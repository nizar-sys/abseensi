var apiUrl = "/api/rombels";

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

function renderEmptyTableClass() {
    return `
                    <tr>
                        <td>Tidak ada rombel</td>
                        <td></td>
                        <td></td>
                    </tr>
                `;
}

function renderTableClass(rombel) {
    return `
                    <tr>
                        <td>${rombel.nama_rombel}</td>
                        <td>${
                            rombel.rayon?.nama_rayon ?? "tidak ada rayon"
                        }</td>
                        <td class="text-end">
                            <span class="dropdown">
                            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Aksi</button>
                            <div class="dropdown-menu dropdown-menu-center">
                                <button class="dropdown-item edit-class text-yellow" data-uuid="${
                                    rombel.uuid
                                }" data-bs-toggle="modal"
                                data-bs-target="#modal-edit-class">
                                ${iconEdit} Edit
                                </button>
                                <a class="dropdown-item remove-class text-red" data-uuid="${
                                    rombel.uuid
                                }" href="#">
                                ${iconHapus} Hapus
                                </a>
                            </div>
                            </span>
                        </td>
                    </tr>
                `;
}

function loadingRowTable(message, colspan = 0) {
    return `
                    <tr>
                        <td colspan="${colspan}" class="animated-dots">${message}</td>
                    </tr>
                `;
}

function snackbarRetryGetClass() {
    SnackBar({
        message: "Gagal mendapatkan rombel!",
        position: "bc",
        width: "500px",
        status: "error",
        actions: [
            {
                text: "Ulangi",
                function: () => {
                    getClass();
                },
            },
        ],
        fixed: true,
    });
}

function renderPaginateClass(link) {
    const { url, label, active } = link;
    var isDisabled = url == null;
    var per_page = $("#input-length-class").val();
    var newUrl = `${url}&filter%5Bper_page%5D=${per_page}`;
    return `
                    <li class="page-item ${active ? "active" : ""} ${
        isDisabled ? "disabled" : ""
    } navigation-class"><a class="page-link" href="${newUrl}">${label}</a></li>
                `;
}

async function getClass(url = apiUrl, filterData = null) {
    $("#class-data").html(loadingRowTable("Mendapatkan data rombel", 3));
    const response = HitData(url, filterData)
        .then(({ response, params }) => {
            const { data, from, to, total, links } = response;
            $("#class-data").html("");
            $("#paginate-class").html("");
            if (data.length > 0) {
                $("#input-length-class")
                    .val(params?.filter?.per_page ?? 20)
                    .attr("disabled", false);
                data.map((rombel, i) => {
                    $("#class-data").append(renderTableClass(rombel));
                });
            } else {
                $("#input-length-class").val(0).attr("disabled", true);
                $("#class-data").html(renderEmptyTableClass());
            }
            $("#count-from-class").html(from ?? 0);
            $("#count-to-class").html(to ?? 0);
            $("#count-total-class").html(total);
            links.map((link, i) => {
                $("#paginate-class").append(renderPaginateClass(link));
            });

            $(".navigation-class").click((e) => {
                e.preventDefault();
                var url = $(e.target).attr("href");
                getClass(url);
            });

            $(".remove-class").click((e) => {
                e.preventDefault();
                var uuid = $(e.target).data("uuid");
                deleteClass(uuid);
            });
        })
        .catch((error) => {
            snackbarRetryGetClass();
        });
}

async function deleteClass(uuid, status = "show-modal") {
    var buttonDelete = $("#delete-class");
    if (status == "show-modal") {
        $("#modal-remove-class").modal("show");
        buttonDelete.attr("data-uuid", uuid);
    } else {
        buttonDelete
            .html("Menghapus rombel")
            .addClass("animated-dots")
            .attr("disabled", true);
        const response = HitData(`${apiUrl}/${uuid}`, null, "DELETE")
            .then(({ status, response }) => {
                if (status == "ok") {
                    $("#modal-remove-class").modal("hide");
                    snackbarToast("Berhasil menghapus data rombel.", "success");
                    getClass();
                }
                buttonDelete
                    .html("Hapus")
                    .removeClass("animated-dots")
                    .attr("disabled", false);
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

function snackbarToast(message, status = "error", ...args) {
    SnackBar({
        message,
        position: "bc",
        width: "500px",
        status,
        fixed: true,
        ...args,
    });
}

function initializeSelectRayon(filter = null) {
    var buttonSave = $("#save-class");
    var dataRayonListView = $("#rayonListData");
    dataRayonListView.html("");
    buttonSave
        .html("Tunggu sebentar")
        .addClass("animated-dots")
        .attr("disabled", true);
    const response = HitData("/api/rayons", filter)
        .then(({ response }) => {
            var rayonListData = response.data;
            rayonListData.map((rayon) => {
                dataRayonListView.append(
                    `<option data-uuid="${rayon.uuid}" value="${rayon.nama_rayon}"></option>`
                );
            });
            buttonSave
                .html("Simpan")
                .removeClass("animated-dots")
                .attr("disabled", false);
        })
        .catch((error) => {
            snackbarToast("Gagal memuat data rayon. Mohon coba lagi.");
            buttonSave
                .html("Simpan")
                .removeClass("animated-dots")
                .attr("disabled", false);
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

function saveNewClass() {
    var selectRayon = $("#rayon_id");
    var payloadRombel = {
        nama_rombel: $(".input-nama_rombel").val(),
        rayon_id:
            $(
                `#${selectRayon.attr("list")} option[value='` +
                    selectRayon.val() +
                    "']"
            ).attr("data-uuid") || null,
    };
    var buttonSave = $("#save-class");
    buttonSave
        .html("Tunggu sebentar")
        .addClass("animated-dots")
        .attr("disabled", true);
    const response = HitData(apiUrl, payloadRombel, "POST")
        .then(({ response, status }) => {
            if (status == "ok") {
                $("#modal-add-class").modal("hide");
                getClass();
                SnackBar({
                    message: "Berhasil menambahkan rombel!",
                    position: "bc",
                    width: "500px",
                    status: "success",
                    fixed: true,
                });
                $("#form-new-class").trigger("reset");
            }
            buttonSave
                .html("Simpan")
                .removeClass("animated-dots")
                .attr("disabled", false);
        })
        .catch((error) => {
            if (error.status == 422) {
                var responseError = error.responseJSON.errors;
                inputInvalid(responseError);
            }
            snackbarToast("Terjadi kesalahan, mohon coba lagi.");
            buttonSave
                .html("Simpan")
                .removeClass("animated-dots")
                .attr("disabled", false);
        });
}

function updateClass(uuid) {
    var buttonUpdate = $("#update-class");
    var payloadUpdateRombel = {
        nama_rombel: $("#rombel-edit").val(),
        rayon_id:
            $(
                `#${$("#rayon-edit").attr("list")} option[value='` +
                    $("#rayon-edit").val() +
                    "']"
            ).attr("data-uuid") || $("#old_rayon").val(),
        uuid,
    };
    buttonUpdate
        .html("Mengubah rombel")
        .addClass("animated-dots")
        .attr("disabled", true);
    const response = HitData(`${apiUrl}/${uuid}`, payloadUpdateRombel, "PUT")
        .then(({ status }) => {
            if (status == "ok") {
                $("#modal-edit-class").modal("hide");
                getClass();
                SnackBar({
                    message: "Berhasil mengubah rombel!",
                    position: "bc",
                    width: "500px",
                    status: "success",
                    fixed: true,
                });
                $("#form-edit-class").trigger("reset");
            }
            buttonUpdate
                .html("Simpan")
                .removeClass("animated-dots")
                .attr("disabled", false);
        })
        .catch((error) => {
            if (error.status == 422) {
                var responseError = error.responseJSON.errors;
                inputInvalid(responseError);
            }
            snackbarToast("Gagal mengubah rombel. mohon coba lagi.");
            buttonUpdate
                .html("Simpan")
                .removeClass("animated-dots")
                .attr("disabled", false);
        });
}

$(document).ready(() => {
    getClass();

    $("#input-length-class").change((e) => {
        var filter = {
            filter: {
                per_page: $(e.target).val(),
            },
        };
        getClass(apiUrl, filter);
    });

    $("#search-class").change((e) => {
        var filter = {
            filter: {
                nama_rombel: $(e.target).val(),
            },
        };
        getClass(apiUrl, filter);
    });

    $("#refresh-class").click((e) => {
        e.preventDefault();
        getClass();
    });

    $("#modal-add-class").on("shown.bs.modal", () => {
        var filter = {
            filter: {
                per_page: 100,
            },
        };
        $("#form-new-class").trigger("reset");
        initializeSelectRayon(filter);
    });

    $("#form-new-class").submit((e) => {
        e.preventDefault();
        saveNewClass();
    });

    $("#save-class").click(() => {
        saveNewClass();
    });

    $("#delete-class").click((e) => {
        e.preventDefault();
        var uuid = $(e.target).attr("data-uuid");
        deleteClass(uuid, "delete");
    });

    $("#modal-edit-class").on("shown.bs.modal", (e) => {
        var uuid = $(e.relatedTarget).data("uuid");
        var buttonUpdate = $("#update-class");
        var formUpdate = $("#form-edit-class");
        var dataRayonListView = $("#rayonEditListData");
        formUpdate.trigger("reset");
        dataRayonListView.html("");
        buttonUpdate
            .html("Tunggu sebentar")
            .addClass("animated-dots")
            .attr("disabled", true);
        formUpdate.find("input").attr("disabled", true);

        const rombelDetail = HitData(`${apiUrl}/${uuid}`, null, "GET")
            .then(({ response }) => {
                var rombel = response;
                var filter = {
                    filter: {
                        per_page: 100,
                    },
                };
                const rayonList = HitData("/api/rayons", filter, "GET")
                    .then(({ response }) => {
                        var rayonListData = response.data;
                        rayonListData.map((rayon) => {
                            dataRayonListView.append(
                                `<option data-uuid="${rayon.uuid}" value="${
                                    rayon.nama_rayon
                                }" ${
                                    rayon.id == rombel.rayon_id ?? "0"
                                        ? "selected"
                                        : ""
                                }>${rayon.nama_rayon}</option>`
                            );
                            $("#rombel-edit").val(rombel.nama_rombel);
                            $("#old_rayon").val(rombel.rayon?.uuid);
                            $("#rayon-edit").val(rombel.rayon?.nama_rayon);
                            buttonUpdate.attr("data-uuid", uuid);
                        });
                        buttonUpdate
                            .html("Simpan")
                            .removeClass("animated-dots")
                            .attr("disabled", false);
                        formUpdate.find("input").attr("disabled", false);
                    })
                    .catch((error) => {
                        buttonUpdate
                            .html("Simpan")
                            .removeClass("animated-dots")
                            .attr("disabled", false);
                        snackbarToast(
                            "Gagal mendapatkan data rayon. Mohon coba lagi"
                        );
                    });
            })
            .catch((error) => {
                buttonUpdate
                    .html("Simpan")
                    .removeClass("animated-dots")
                    .attr("disabled", false);
                snackbarToast(
                    "Gagal mendapatkan data rombel. Mohon coba lagi."
                );
            });
    });

    $("#update-class").click((e) => {
        var uuid = $(e.target).data("uuid");
        updateClass(uuid);
    });
});
