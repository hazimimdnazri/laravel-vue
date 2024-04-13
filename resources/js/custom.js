import Swal from 'admin-lte/plugins/sweetalert2/sweetalert2'

const events = new EventSource("https://events.litera.my/events");

const et = (fx) => setTimeout(fx, 10000);
let timeoutId;

const runLoader = (type) => {
    Swal.fire({
        title: type == 'load' ? 'Loading...' : 'Saving...',
        html: 'Please wait for a moment...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        heightAuto: false,
        didOpen: () => {
            Swal.showLoading();
            timeoutId = et(showError);
        }
    })

    function showError(){
        Swal.fire(
            'Error!',
            'An error has been encountered, please contact the system administrator.',
            'error'
        )
    }
}

const runAnnouncement = (message) => {
    Swal.fire({
        icon: 'warning',
        title: 'Announcement!',
        text: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
    })
}

const runReminder = (message) => {
    Swal.fire({
        icon: 'warning',
        title: 'Reminder!',
        text: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
    })
}

const runAlertSuccess = (message) => {
    return new Promise((resolve, reject) => {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: message,
            allowOutsideClick: false,
            allowEscapeKey: false,
            heightAuto: false,
        }).then((result) => {
            resolve(result)
        });
    
        clearTimeout(timeoutId)
    })
}

const runError = (message) => {
    return new Promise((resolve, reject) => {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: message,
            allowOutsideClick: false,
            allowEscapeKey: false,
            heightAuto: false,
        }).then((result) => {
            resolve(result)
        });
    
        clearTimeout(timeoutId)
    })
}

const runAlertError = (message) => {
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
        heightAuto: false,
    })
    
    clearTimeout(timeoutId)
}

const runSuccess = (message) => {
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: message,
        allowOutsideClick: false,
        allowEscapeKey: false,
        heightAuto: false,
    }).then((result) => {
        if(result.value){
            runLoader('load')
            location.reload()
        }
    })
}

const closeLoader = () => {
    Swal.close()
    clearTimeout(timeoutId)
}

window.addEventListener('beforeunload', () => {
    events.close();
});

events.onmessage = (event) => {
    const data = JSON.parse(event.data);
    if(data.apps == 'sportsarena-dev'){
        runAnnouncement(data.message)
    }
};

events.addEventListener('heartbeat',(event) => {
    console.log(event.data);
});

events.onerror = (error) => {
    console.error('Unable to connect to SSE server.');
    events.close();
};

const decodeEntities = (encodedString) => {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = encodedString;
    return textArea.value;
}

export const customJs = {
    runLoader,
    runSuccess,
    runError,
    runAlertError,
    closeLoader
};