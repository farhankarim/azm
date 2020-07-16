import AppForm from '../app-components/Form/AppForm';

Vue.component('nurse-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                
            }
        }
    }

});