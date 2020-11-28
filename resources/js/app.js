

require('./bootstrap');

window.Vue = require('vue');
import {
    Form,
    HasError,
    AlertError,
    AlertErrors,
    AlertSuccess
    } from 'vform';
    import Swal from 'sweetalert2'
    window.Form = Form;
    window.Swal=Swal;
    Vue.component(HasError.name, HasError);
    Vue.component(AlertError.name, AlertError);
    Vue.component(AlertErrors.name, AlertErrors);
    Vue.component(AlertSuccess.name, AlertSuccess);
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('product-component',require('./components/ProductComponent.vue').default);
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
  import VueProgressBar from 'vue-progressbar'

  Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '10px',
   thickness: '5px',
  });

const app = new Vue({
    el: '#app',
});
