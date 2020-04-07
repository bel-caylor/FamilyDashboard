function clickExpandBtn(section) {
  document.getElementById(section).classList.toggle("hidden");
}

document.addEventListener('submit', e => {

  // Store reference to form to make later code easier to read
  const form = e.target;

  // get status message references
  const statusBusy = form.querySelector('.status-busy');
  const statusFailure = form.querySelector('.status-failure');
  const statusMessage = form.querySelector('.status-message');
  // const doc = document;
  // const step = form.querySelector('Step').innerHTML;

  // Post data using the Fetch API
  fetch(form.action, {
      method: form.method,
      body: new FormData(form)
    })
    // Convert response to text
    .then(res => res.text())

    // Convert to HTML document
    .then(text => new DOMParser().parseFromString(text, 'text/html'))

    // Add status message to DOM
    .then(doc => {
      statusBusy.hidden = true;
      statusMessage.hidden = false;
      form.getElementsByTagName("fieldset")[0].disabled = false;
      statusMessage.innerHTML = doc.body.querySelector('.status-message').innerHTML;

      //Make changes to app based on Step1
      const step = doc.body.querySelector('.Step').innerHTML;
      appUpdate(step, doc);

    })
    .catch(err => {
      console.log("error", err)
      form.getElementsByTagName("fieldset")[0].disabled = false;  // Unlock form elements
      lastActive.focus();  // Return focus to active element
      statusBusy.hidden = true;  // Hide the busy state
      statusFailure.hidden = false;  // Show error message

    });

  // Remember the last active field
  const lastActive = document.activeElement;

  // Show busy state and move focus to it
  statusBusy.hidden = false;
  statusBusy.tabIndex = -1;
  statusBusy.focus();

  // Disable all form elements to prevent further input
  form.getElementsByTagName("fieldset")[0].disabled = true;

  // Make sure connection failure message is hidden
  statusFailure.hidden = true;
  statusBusy.hidden = true;

  // Prevent the default form submit
  e.preventDefault();

});

function appUpdate(step, doc) {
  switch (step) {
    case '1':
      document.getElementById(`head${step}`).innerHTML = "&#9660Edit Family";
      document.getElementById(`btn${step}`).innerHTML = "Edit";
      break;
  };
};

function togglePwdVisible() {
  var pwd1 = document.getElementById("password");
  var pwd2 = document.getElementById("password2");
  if (pwd1.type === "password") {
    pwd1.type = "text";
    pwd2.type = "text";
  } else {
    pwd1.type = "password";
    pwd2.type = "password";
  }
}
