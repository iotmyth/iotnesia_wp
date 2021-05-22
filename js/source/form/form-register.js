const app = require('../utils/core');

app.querySelector('.vk-register-form', ((registerForms) => {
  const Logger = require('./Logger')();
  
  let errors = [];

  const getErrorElement = function (text) {
    const errorElement = document.createElement('p');

    errorElement.classList.add('error-field-message')
    errorElement.innerText = text;

    return errorElement;
  };

  const addError = function (text) {
    const errorElement = getErrorElement(text);
    errors.push(errorElement);
  };

  const showErrors = function (container) {
    for (const error of errors) {
      container.prepend(error);
    }
  };

  const removeErrors = function () {
    for (const error of errors) {
      error.remove();
    }

    errors = [];
  };

  const register = function (e) {
    e.preventDefault();

    // console.log('VK REGISTER FORM - FORM: ', this);
    // console.log('VK REGISTER FORM - FORM ELEMENTS: ', this.elements);

    const formElements = this.elements,
          email = formElements.register_email.value,
          username = formElements.register_username.value,
          password = formElements.register_password.value,
          passwordRepeat = formElements.register_password_repeat.value,
          submitButton = formElements.register_submit,
          formSubmittingClass = 'form-submit-button-submitting',
          formSubmittedClass = 'form-submit-button-submitted';

    // console.log('VK REGISTER FORM - EMAIL: ', email);
    // console.log('VK REGISTER FORM - USERNAME: ', username);
    // console.log('VK REGISTER FORM - PASSWORD: ', password);
    // console.log('VK REGISTER FORM - PASSWORD REPEAT: ', passwordRepeat);

    // remove errors
    formElements.register_email.classList.remove('input-error');
    formElements.register_username.classList.remove('input-error');
    formElements.register_password.classList.remove('input-error');
    formElements.register_password_repeat.classList.remove('input-error');
    removeErrors();

    // remove submitted
    submitButton.classList.remove(formSubmittedClass);

    // form already submitting, return
    if (submitButton.classList.contains(formSubmittingClass)) {
      return;
    }

    const emptyEmail = email === '',
          emptyUsername = username === '',
          emptyPassword = password === '',
          emptyPasswordRepeat = passwordRepeat === '',
          emptyValues = emptyEmail || emptyUsername || emptyPassword || emptyPasswordRepeat;

    // if there are empty values, return
    if (emptyValues) {
      if (emptyEmail) {
        formElements.register_email.classList.add('input-error');
      }
      
      if (emptyUsername) {
        formElements.register_username.classList.add('input-error');
      }

      if (emptyPassword) {
        formElements.register_password.classList.add('input-error');
      }

      if (emptyPasswordRepeat) {
        formElements.register_password_repeat.classList.add('input-error');
      }

      return;
    }

    // if passwords dont match, return
    if (password !== passwordRepeat) {
      formElements.register_password.classList.add('input-error');
      formElements.register_password_repeat.classList.add('input-error');
      addError(`* ${vikinger_translation.password_mismatch_message}`);
      showErrors(submitButton.parentElement);
      return;
    }

    // start submitting
    submitButton.classList.add(formSubmittingClass);

    const registerPromise = Logger.register({
      username: username,
      password: password,
      email: email
    });

    registerPromise
    .done((response) => {
      // console.log('VK REGISTER FORM - REGISTER RESPONSE: ', response);

      if (typeof response.errors !== 'undefined') {
        // if email is invalid
        if (typeof response.errors.invalid_email !== 'undefined')  {
          submitButton.classList.remove(formSubmittingClass);

          formElements.register_email.classList.add('input-error');

          addError(`* ${vikinger_translation.invalid_email_message}`);
          showErrors(submitButton.parentElement);
          
        } else if (typeof response.errors.existing_user_login !== 'undefined') {
          submitButton.classList.remove(formSubmittingClass);

          formElements.register_username.classList.add('input-error');

          addError(`* ${vikinger_translation.username_exists_message}`);
          showErrors(submitButton.parentElement);
        }
      } else {
        submitButton.classList.remove(formSubmittingClass);
        submitButton.classList.add(formSubmittedClass);

        formElements.register_email.parentElement.classList.remove('active');
        formElements.register_username.parentElement.classList.remove('active');
        formElements.register_password.parentElement.classList.remove('active');
        formElements.register_password_repeat.parentElement.classList.remove('active');

        this.reset();
      }
    })
    .fail((error) => {
      // console.log('VK REGISTER FORM - REGISTER ERROR: ', error);

      submitButton.classList.remove(formSubmittingClass);

      addError(`* ${vikinger_translation.generic_error}`);
      showErrors(submitButton.parentElement);
    });
  };

  for (const registerForm of registerForms) {
    registerForm.addEventListener('submit', register);
  }
}));