import AppForm from '../app-components/Form/AppForm';

Vue.component('teacher-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                fname:  '' ,
                lname:  '' ,
                dob:  '' ,
                enabled:  false ,
                
            }
        }
    }

});