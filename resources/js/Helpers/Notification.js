class Notification {
    success() {
        new Noty({
            type: 'success',
            text: 'Successfully Done',
            layout: 'topRight',
            timeout: 1000
        }).show()
    }
    alert() {
        new Noty({
            type: 'alert',
            text: 'Are you sure to do this?',
            layout: 'topRight',
            timeout: 1000
        }).show()
    }
    error(msg = 'Something went wrong') {
        new Noty({
            type: 'error',
            text: msg,
            layout: 'topRight',
            timeout: 1000
        }).show()
    }
    warning() {
        new Noty({
            type: 'warning',
            text: 'Something went wrong',
            layout: 'Oops! wrong',
            timeout: 1000
        }).show()
    }
    image_validation() {
        new Noty({
            type: 'error',
            text: 'Image less then 1mb',
            layout: 'topRight',
            timeout: 1000
        }).show()
    }
}
export default (Notification = new Notification())
