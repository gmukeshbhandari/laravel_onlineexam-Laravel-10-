function togglePasswordloginadmin() {
    const passwordInput = document.getElementById('adminloginpassword');
    const passwordType = passwordInput.getAttribute('type');
  
    if (passwordType === 'password') {
      passwordInput.setAttribute('type', 'text');
    } else {
      passwordInput.setAttribute('type', 'password');
    }
  }
  
  function togglePasswordregisteradmin() {
    const passwordInput = document.getElementById('password');
    const passwordType = passwordInput.getAttribute('type');
  
    if (passwordType === 'password') {
      passwordInput.setAttribute('type', 'text');
    } else {
      passwordInput.setAttribute('type', 'password');
    }
  }
  function togglePasswordCheckregisteradmin() {
    const passwordInput = document.getElementById('confirmpassword');
    const passwordType = passwordInput.getAttribute('type');
  
    if (passwordType === 'password') {
      passwordInput.setAttribute('type', 'text');
    } else {
      passwordInput.setAttribute('type', 'password');
    }
  }



  
  function togglePasswordoldpasswordadmin() {
    const passwordInput = document.getElementById('oldpassword');
    const passwordType = passwordInput.getAttribute('type');
  
    if (passwordType === 'password') {
      passwordInput.setAttribute('type', 'text');
    } else {
      passwordInput.setAttribute('type', 'password');
    }
  }

  function togglePasswordloginuser() {
    const passwordInput = document.getElementById('password');
    const passwordType = passwordInput.getAttribute('type');
  
    if (passwordType === 'password') {
      passwordInput.setAttribute('type', 'text');
    } else {
      passwordInput.setAttribute('type', 'password');
    }
  }
