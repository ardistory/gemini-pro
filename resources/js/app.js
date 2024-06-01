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