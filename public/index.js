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
      location.reload();


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
  var pwd1 = document.getElementById("password1");
  var pwd2 = document.getElementById("password2");
  if (pwd1.type === "password") {
    pwd1.type = "text";
    pwd2.type = "text";
  } else {
    pwd1.type = "password";
    pwd2.type = "password";
  }
}

function editUser(userID) {

  //Change column name
    document.getElementById("EditSave").innerHTML = "<span class=\"tooltiptext\">Save User</span>Sav";

  //Change symbol and Edit action to Save Action
    let html = `<button type=\"submit\"  onclick="saveUser(` + userID + `)">&#128428;</button>`;
    document.getElementById('Edt' + userID).innerHTML = html;

  //Unhide second row
    document.getElementById('Hdn' + userID).classList.toggle("hidden");
    document.getElementById('Hdn' + userID).classList.toggle("edit");

  //Highlight rows to show in Edit mode
    document.getElementById('userID' + userID).classList.toggle("edit");

  //enable form fields
    document.querySelector("#userID" + userID + " > th:nth-child(2) > input").disabled = false;
    document.querySelector("#userID" + userID + " > th:nth-child(3) > input").disabled = false;

};

function saveUser(userID) {
  //Create data to send to server.
    let data = {
      userID: userID,
      name: document.querySelector("#userID" + userID + " > th:nth-child(2) > input").value,
      initial: document.querySelector("#Hdn" + userID + " > th.initial > input").value,
      color: document.querySelector("#userID" + userID + "  > th:nth-child(3) > input").value,
      admin: document.querySelector("#Hdn" + userID + " > th.admin > input").value,
      email: document.querySelector("#Hdn" + userID + " > th.email > input").value,
    };
  // console.log(data);

  //call 3editUser.php
  fetch('/FamilyDashboard/public/familySetup/3editUser.php', {
    method: 'post',
    body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          document.getElementById('step3Msgs').innerHTML = status;
        })

    if (status = "Update Succeeded.") {

    //Change column name
      document.getElementById("EditSave").innerHTML = "<span class=\"tooltiptext\">Edit User</span>Edit";

    //Change symbol and Save action to Edit Action
      let html = `<button onclick="editUser(` + userID + `)">&#128393;</button>`;
      document.getElementById('Edt' + userID).innerHTML = html;

    //HIDE second row
      document.getElementById('Hdn' + userID).classList.toggle("hidden");
      document.getElementById('Hdn' + userID).classList.toggle("edit");

    //Highlight rows to show in Edit mode
      document.getElementById('userID' + userID).classList.toggle("edit");
      document.getElementById('userID' + userID).classList.toggle("saved");
    //enable form fields
      document.querySelector("#userID" + userID + " > th:nth-child(2) > input").disabled = false;
      document.querySelector("#userID" + userID + " > th:nth-child(3) > input").disabled = false;
    //change background to green

    //change button back to edit

  }

};

function toggleClass(ID, className) {
  document.getElementById(ID).classList.toggle(className);
}

function clickDeleteUser(row, ID, userName) {
  //Change alert message
  let divMsg = document.getElementById('delUserMsg');
  divMsg.innerHTML = "<p>Are you sure you want to delete user - " + userName + "?</p>";
  //Change OK button click function.
  let btn = document.getElementById('btnOK');
  btn.setAttribute("onclick", "deleteUser(" + row + ", '" + ID + "')");
  btn.innerHTML = "Yes";
  //make message visible
  toggleClass("delUser", "hidden");
}

function deleteUser(row, ID) {
  //call 3editUser.php
  fetch('/FamilyDashboard/public/familySetup/3deleteUser.php?row=' + row + '&id=' + ID, {
    method: 'GET',
    // body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          document.getElementById('step3Msgs').innerHTML = status;
          //Remove user row from tblUsers
          document.getElementById('userID' + ID).remove();
        })

    if (status = "Delete Succeeded.") {
      toggleClass("delUser", "hidden");
      deleteStatusMessage('step2Msgs');
  }
}

function deleteStatusMessage(id) {
  document.getElementById(id).innerHTML = '';
}
