/*
 *  Document   : formsValidation.js
 *  Author     : pixelcave
 *  Description: Custom javascript code used in Forms Validation page
 */

var FormVoters = function() {

    return {
        init: function() {
            /*
             *  Jquery Validation, Check out more examples and documentation at https://github.com/jzaefferer/jquery-validation
             */

            /* Initialize Form Validation */
            $('#form-voters').validate({
                errorClass: 'help-block animation-pullUp', // You can change the animation class for a different entrance animation - check animations page
                errorElement: 'div',
                errorPlacement: function(error, e) {
                    e.parents('.form-group > div').append(error);
                },
                highlight: function(e) {
                    $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
                    $(e).closest('.help-block').remove();
                },
                success: function(e) {
                    // You can use the following if you would like to highlight with green color the input after successful validation!
                    e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
                    e.closest('.help-block').remove();
                },
                rules: {
                    'country_id': {
                        required: true,
                        maxlength: 100,
                        number: true
                    },
                    'name': {
                        required: true,
                        maxlength: 100
                    },
                    'address': {
                        required: true,
                        maxlength: 100
                    },
                    'email': {
                        maxlength: 100,
                        email: true
                    }
                },
                messages: {
                    'country_id': {
                        required: 'El número de cédula es requerido',
                        maxlength: 'El número de cédula puede tener máximo 100 números',
                        number: 'El número de cédula debe ser un número'
                    },
                    'name': {
                        required: 'El nombre es requerido',
                        maxlength: 'El nombre puede tener máximo 100 números'
                    },
                    'address': {
                        required: 'La dirección es requerida',
                        maxlength: 'La dirección puede tener máximo 100 caracteres'
                    },
                    'email': {
                        maxlength: 'El correo electrónico puede tener máximo 100 caracteres',
                        email: 'El correo debe ser ejemplo@empresa.com'
                    },
                    'location_id':{
                        required: 'La ubicación es requerida'
                    },
                    'date_of_birth':{
                        required: 'La fecha de nacimiento es requerida'
                    }
                }
            });
        }
    };
}();