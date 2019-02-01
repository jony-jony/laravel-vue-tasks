export default {
    methods: {
        formatDate(date) {
            return moment(date).format('DD-MM-YYYY hh:mm A');
        },
        showMessage(message) {
            swal({
                type: 'success',
                text: message
            });
        },
        globalError() {
            swal({
                type: 'error',
                text: 'Something went wrong!, try it again'
            });
        }
    }
};