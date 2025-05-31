import Swal from 'sweetalert2';
// Ensure jQuery is available globally
import $ from 'jquery';
window.jQuery = window.$ = $;
const csrfToken = document.querySelector('input[name="_token"]').value;


window.deleteTask = function (taskId) {
    const url = `/tasks/${taskId}`;
    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to delete this task?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: csrfToken
                },
                success: function (response) {
                    $('#task-' + taskId).remove();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Task deleted successfully.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
};

window.markDone = function (taskId, btn) {
    const url = `/tasks/${taskId}/done`;
    $.ajax({
        url: url,
        type: 'PUT',
        data: {
            _token: csrfToken
        },
        success: function (response) {
            $(`#task-status-${taskId}`).removeClass("bg-warning");
            $(`#task-status-${taskId}`).text("completed");
            $(`#task-status-${taskId}`).addClass("bg-success");
            btn.remove();
            Swal.fire({
                title: 'Success!',
                text: 'Task marked as completed.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function (xhr) {
            Swal.fire({
                title: 'Error!',
                text: 'Something went wrong.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
};

window.showTask = function(id, title, desciption, status) {
    Swal.fire({
            title: title,
            text: desciption,
            confirmButtonText: 'OK'
        });
};