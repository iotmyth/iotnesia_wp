const app = require('../utils/core');

app.querySelector('.vk-login-form', ((loginForms) => {
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

  const login = function (e) {
    e.preventDefault();

    // console.log('VK LOGIN FORM - FORM: ', this);
    // console.log('VK LOGIN FORM - FORM ELEMENTS: ', this.elements);

    const formElements = this.elements,
          username = formElements.login_username.value,
          password = formElements.login_password.value,
          rememberMe = formElements.login_remember.checked,
          submitButton = formElements.login_submit,
          formSubmittingClass = 'form-submit-button-submitting';

    // console.log('VK LOGIN FORM - USERNAME: ', username);
    // console.log('VK LOGIN FORM - PASSWORD: ', password);
    // console.log('VK LOGIN FORM - REMEMBER ME: ', rememberMe);

    // remove errors
    formElements.login_username.classList.remove('input-error');
    formElements.login_password.classList.remove('input-error');
    removeErrors();

    // form already submitting, return
    if (submitButton.classList.contains(formSubmittingClass)) {
      return;
    }

    const emptyUsername = username === '',
          emptyPassword = password === '',
          emptyValues = emptyUsername || emptyPassword;

    // if there are empty values, return
    if (emptyValues) {
      if (emptyUsername) {
        formElements.login_username.classList.add('input-error');
      }

      if (emptyPassword) {
        formElements.login_password.classList.add('input-error');
      }

      return;
    }

    // start submitting
    submitButton.classList.add(formSubmittingClass);

    const loginPromise = Logger.login({
      username: username,
      password: password,
      remember: rememberMe
    });

    loginPromise
    .done((response) => {
      // console.log('VK LOGIN FORM - LOGIN RESPONSE: ', response);

      if (typeof response.result.errors === 'undefined') {
        window.location.replace(response.redirect_uri);
      } else {
        submitButton.classList.remove(formSubmittingClass);

        formElements.login_username.classList.add('input-error');
        formElements.login_password.classList.add('input-error');

        addError(`* ${vikinger_translation.wrong_user_message}`);
        showErrors(submitButton.parentElement);
      }
    })
    .fail((error) => {
      // console.log('VK LOGIN FORM - LOGIN ERROR: ', error);

      submitButton.classList.remove(formSubmittingClass);

      addError(`* ${vikinger_translation.generic_error}`);
      showErrors(submitButton.parentElement);
    });
  };

  for (const loginForm of loginForms) {
    loginForm.addEventListener('submit', login);
  }
}));