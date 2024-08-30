import axios from 'axios';
import '@fortawesome/fontawesome-free/js/all';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
