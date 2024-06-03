// import './bootstrap';
import iziToast from 'izitoast';
import 'izitoast/dist/css/iziToast.min.css';

import ClipboardJS from "clipboard";

const clipboard = new ClipboardJS('#copyApiKey');
clipboard.on('success', () => {
    iziToast.success({
        'position': 'topCenter',
        'title': 'Copied!',
        'pauseOnHover': false,
        'close': false
    });
});

document.getElementById('clearChat').addEventListener('click', function () {
    iziToast.error({
        title: "Clear Chat!",
        message: "Chat has been cleared",
        position: 'topCenter',
        pauseOnHover: false,
        close: false
    });
});