import AppForm from '../app-components/Form/AppForm';

Vue.component('doctor-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                
            }
        }
    }

});