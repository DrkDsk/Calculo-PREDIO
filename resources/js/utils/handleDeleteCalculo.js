import {deleteAction, alertAction} from '@/utils/handleSwalActions.js'

const deleteCalculo = (balance_id) => {
    alertAction(
        'Estás seguro de eliminar este cálculo?',
        'No podrás recuperarlo!',
        'warning',
        true,
        "#3085d6",
        "#d33",
        "Sí, eliminarlo!"
        ).then((result) => {
        if (result.isConfirmed) {
            try {
                deleteAction('balances.destroy', balance_id)
            } catch (e) {
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
        }
    })
}

export {
    deleteCalculo
}