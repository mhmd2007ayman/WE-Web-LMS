let notifications = document.querySelector('.notifications');
    export  function createToast(type, icon, title, text){
        let newToast = document.createElement('div');
        newToast.innerHTML = `
            <div class="toast ${type}">
              
                <img src=${icon}  class='iconStyle'>
                <div class="content">
                    <div class="title">${title}</div>
                    <span>${text}</span>
                </div>
  
                <img class='close' src="../../Toster/icons/close.svg" alt="SVG Image"  onclick="(this.parentElement).remove()">

  
            </div>`;
        notifications.appendChild(newToast);
        newToast.timeOut = setTimeout(
            ()=>newToast.remove(), 5000
        )
    }
     export function success(message){
        let type = 'success';
        let icon = '../../Toster/icons/sucsses.svg';
        let title = 'Success';
        let text = message;
        createToast(type, icon, title, text);
    }
    export  function error(message){
        let type = 'error';
        let icon = ' ../../Toster/icons/error.svg';
        let title = 'Error';
        let text = message;
        createToast(type, icon, title, text);
    }
    export  function warning(message){
        let type = 'warning';
        let icon = '../../Toster/icons/warning.svg';
        let title = 'Warning';
        let text = message;
        createToast(type, icon, title, text);
    }
    export  function info(message){
        let type = 'info';
        let icon = '../../Toster/icons/info.svg';
        let title = 'Info';
        let text = message;
        createToast(type, icon, title, text);
    }