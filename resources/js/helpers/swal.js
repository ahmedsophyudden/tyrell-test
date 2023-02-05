import Swal from "sweetalert2";
import { useAxios } from "@/helpers/axios"

export const swalWrapper = {
    confirmDialog: dialog('confirmDialog'),
    successDelete: dialog('successDelete'),
    failedDelete: dialog('failedDelete'),
    errorType: dialog('errorType')
}

function dialog(type) {
    return (url) => {
        return eval(type + '("' + url + '")');
    }
}

function confirmDialog(url) {
    return Swal.fire({
        title: "Confirm delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Confirm",
        showLoaderOnConfirm: true,
        preConfirm: async () => {
            const { error } = await useAxios('delete', url);
            if (!error.value) {
                successDelete();
            } else {
                failedDelete();
                throw new Error(error.value)
            }
        },
        allowOutsideClick: () => !Swal.isLoading()
    }).then(async (result) => {
        return result;
    });
}

function successDelete() {
    return Swal.fire("Deleted!", "", "success");
}

function failedDelete() {
    return Swal.fire("Failed to Deleted!", "", "error");
}

function errorType() {
    return Swal.fire("Input value does not exists or value is invalid!", "", "error");
}