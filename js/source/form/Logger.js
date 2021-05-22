const Logger = function () {
  const me = {};

  me.login = function (options) {
    const data = {
      action: 'vikinger_login',
      args: options,
      _ajax_nonce: vikinger_constants.vikinger_ajax_nonce
    };

    return jQuery.post(ajaxurl, data);
  };

  me.register = function (options) {
    const data = {
      action: 'vikinger_register_user_ajax',
      args: options,
      _ajax_nonce: vikinger_constants.vikinger_ajax_nonce
    };

    return jQuery.post(ajaxurl, data);
  };

  me.logout = function () {
    const data = {
      action: 'vikinger_logout',
      _ajax_nonce: vikinger_constants.vikinger_ajax_nonce
    };

    return jQuery.post(ajaxurl, data);
  };

  return me;
};

module.exports = Logger;