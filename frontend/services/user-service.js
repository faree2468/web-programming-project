var UserService = {
  init: function () {
    var token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.hash = "home-main";
    }
    $("#login-form-form").validate({
      submitHandler: function (form) {
        var entity = Object.fromEntries(new FormData(form).entries());
        UserService.login(entity);
      },
    });
  },

  register: function() {
    const entity = {
      name: $("#name").val(),
      email: $("#email").val(),
      password: $("#password").val()
    }

    const confirm = $("#confirm-password").val();

    if(entity.password !== confirm) {
      toastr.error("Passwords do not match");
      return;
    }
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/register",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function(result) {
        console.log(result);
        window.location.hash = "login-main";
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
      },
    })
  },

  login: function (entity) {
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        console.log(result);
        localStorage.setItem("user_token", result.data.token);
        window.location.hash = "home-main";
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        toastr.error(XMLHttpRequest?.responseText ?  XMLHttpRequest.responseText : 'Error');
      },
    });
  },

  logout: function () {
    localStorage.clear();
    window.location.hash = "login-main";
  },


  editUser: function(id, userData) {

    if(Object.keys(userData).length === 0) {
      toastr.error("Empty/Unfinished fields");
      return;
    }

    if(userData.password && userData.confirm_password && userData.password != userData.confirm_password) {
      toastr.error("Passwords do not match");
      return;
    }

    

    delete userData.confirm_password;

    RestClient.patch('users/' + id, userData, function(_){
      toastr.success("User updated successfully");
    }, function(response) {
      toastr.error(response.responseText);
    })
  },

  // gets user count
  getUsers: function() {
    return new Promise((resolve, reject)=>{
      RestClient.get(
        'countusers',
        (response)=>resolve(response),
        (error)=>reject(error)
      )
    })
  },

  getUsersByName: function(name) {
    return new Promise((resolve, reject)=>{
      RestClient.get(
        'users/'+name,
        (response)=>resolve(response),
        (error)=>reject(error)
      )
    })
  },

  deleteUser: function(id) {
    RestClient.delete('users/' + id, function(_){
      toastr.success('User deleted');
    }, function(response){
      toastr.error(response);
    })
  }
  
};