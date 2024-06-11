import Swal from "sweetalert2";

const deleteAction = (route_name, id) => {
    axios.delete(route(route_name, id))
        .then(result => {
            if (result.data) {
                alertAction(
                    'Eliminado!',
                    'Este registro ha sido eliminado.',
                    'success',
                    false,
                    "#3085d6",
                    null,
                    "ok")
                    .then(() => location.reload())
            } else {
                alertAction(
                    'Oops...',
                    'Ha ocurrido un error!',
                    'error',
                    false,
                    "#3085d6",
                    null,
                    "ok")
                    .then(() => location.reload())
            }
        })
        .catch(() => {
            return false
        })
}

const alertAction = (title, text, icon = 'success', showCancelButton = null, confirmButtonColor = null, cancelButtonColor = null, confirmButtonText = null) => {
    return Swal.fire({
        cancelButtonText: 'Cancelar',
        title,
        text,
        icon,
        showCancelButton,
        confirmButtonColor,
        cancelButtonColor,
        confirmButtonText
    });
}

export {
    deleteAction,
    alertAction
}
