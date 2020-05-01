function clickExpandBtn(section) {
  document.getElementById(section).classList.toggle("hidden");
  switch (section) {
    case 'Step3':
      document.getElementById('Step2').classList.toggle("hidden");
      break;
    case 'addTasks':
      document.getElementById('Step2').classList.toggle("hidden");
      document.getElementById('Step3').classList.toggle("hidden");
  }
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
    let Admin = 0;
    if (document.querySelector("#Hdn" + userID + " > th.admin.tooltip > input").checked == true) {
      Admin = 1;
    };
    console.log(Admin);
    let data = {
      userID: userID,
      name: document.querySelector("#userID" + userID + " > th:nth-child(2) > input").value,
      initial: document.querySelector("#Hdn" + userID + " > th.initial > input").value,
      color: document.querySelector("#userID" + userID + "  > th:nth-child(3) > input").value,
      admin: Admin,
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

function editTask(taskID) {
  //Show Rows & Hightlight
    toggleTask(taskID);

  //Make Task editable.
    document.querySelector("#task" + taskID + " > th.task > input").disabled = false;

  //Change symbol and Edit action to Save Action
    let html = `<span class="tooltiptext">Save Task</span><button type=\"submit\"  onclick="saveTask(` + taskID + `)">&#128428;</button>`;
    document.getElementById('EdtTask' + taskID).innerHTML = html;

  //Remove onchange for assign user.
    document.getElementById('user' + taskID).setAttribute("onchange", "");
}

function toggleTask(taskID) {
  document.getElementById('freqRow' + taskID).classList.toggle("hidden");
  document.getElementById('Note' + taskID).classList.toggle("hidden");
  document.getElementById('freqRow' + taskID).classList.toggle("edit");
  document.getElementById('Note' + taskID).classList.toggle("edit");
  document.getElementById('task' + taskID).classList.toggle("edit");
}

function taskSaved(taskID) {
    document.getElementById('task' + taskID).classList.remove("edit");
    document.getElementById('task' + taskID).classList.add("saved");
    document.getElementById('freqRow' + taskID).classList.remove("edit");
    document.getElementById('Note' + taskID).classList.remove("edit");
    document.getElementById('freqRow' + taskID).classList.add("hidden");
    document.getElementById('Note' + taskID).classList.add("hidden");
    document.querySelector("#task" + taskID + " > th.task > input").disabled = false;
    //Add onchange for assign user.
    document.getElementById('user' + taskID).setAttribute("onchange", "saveTask(" + taskID + ")");

  }

function saveTask(taskID) {
  //Create data to send to server.
    let data = {
      taskID: taskID,
      user: document.querySelector("#user" + taskID).value,
      task: document.querySelector("#task" + taskID + " > th.task > input").value,
      freq: document.getElementById("freq" + taskID).value,
      start: document.querySelector("#freqRow" + taskID + " > th:nth-child(2) > input").value,
      time: document.querySelector("#freqRow" + taskID + " > th:nth-child(3) > input").value,
      note: document.querySelector("#Note" + taskID + " > th > input").value
    };
  console.log(data);

  //call 3editUser.php
  fetch('/FamilyDashboard/public/familySetup/5editTask.php', {
    method: 'post',
    body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          // document.getElementById('step5Msgs').innerHTML = status;
        })

    if (status = "Update Succeeded.") {

      location.reload();

    //Change symbol and Save action to Edit Action
      // let html = `<button onclick="editTask(` + taskID + `)">&#128393;</button>`;
      // document.getElementById('EdtTask' + taskID).innerHTML = html;

      //Fetch new assigned Chart
      // fetch('/FamilyDashboard/public/familySetup/5sumAssign.php', {
      //   method: 'POST',
      // })
      //   .then(res => res.text())
      //     .then(text => new DOMParser().parseFromString(text, 'text/html'))
      //       .then(doc => {
      //         let chart = doc.body.innerHTML;
      //         document.getElementsById('assigedChart').innerHTML = chart;
      //       })


    //Change highlight and disabled
      // taskSaved(taskID)
  }
}

function deleteTask(taskID) {
  //call 3editUser.php
  fetch('/FamilyDashboard/public/familySetup/5deleteTask.php?taskID=' + taskID, {
    method: 'GET',
    // body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          document.getElementById('step5Msgs').innerHTML = status;
          //Remove user row from tblUsers
        })

    if (status = "Delete Succeeded.") {
      document.getElementById('task' + taskID).remove();
      document.getElementById('freqRow' + taskID).remove();
      document.getElementById('Note' + taskID).remove();
    }
}

function changeCatName() {
  //If CatName is NEW unhide type and category_names input.
  console.log(document.getElementById('formCategory').value);
  if (document.getElementById('formCategory').value == 0) {
    document.getElementById('typeRow').classList.remove('hidden');
    document.getElementById('newCat').classList.remove('hidden');
  }else {
    document.getElementById('typeRow').classList.add('hidden');
    document.getElementById('newCat').classList.add('hidden');
  }

}

function onLoad() {
  document.getElementById('start').valueAsDate = new Date();
}

function toggleCompleteTask($taskID) {
    //Is task completed or not?
    $task = document.querySelector(`#task${$taskID}> th:nth-child(1) > input[type=checkbox]`);
    console.log($task.checked);
      if ($task.checked == true) {
        //Completed task - add task to task_log Table
        saveCompleteTask($taskID);
      } else {
        //Unchecked task - remove completed task from task_log table

      }
}

function saveCompleteTask($taskID) {
  //Create data to send to server.
    let date = new Date();
    let tzOffset = date.getTimezoneOffset();
    let data = {
      taskID: $taskID,
      time: document.getElementById("time" + $taskID).value,
      tzOffset: tzOffset
    };
  console.log(data);

  //call 3editUser.php
  fetch('/FamilyDashboard/public/dashboard/2completeTask.php', {
    method: 'post',
    body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          document.getElementById('status').innerHTML = status;
          let taskLogID = doc.getElementById('taskLogID').innerHTML;
          let newStart = doc.getElementById('newStart').innerHTML;
          console.log(taskLogID);
          console.log(newStart);
          if (taskLogID !== "insert failed") {
            //change background color to green & add taskLogID
            document.getElementById("task" + $taskID).classList.add('saved');
            document.querySelector("#task353 > th:nth-child(1) > input[type=checkbox]").setAttribute("name", "taskLogID" + taskLogID);
          }
        })
    .catch(err => {
      console.log("error", err)
    });
}

function changeTaskTime($taskID) {
    //Is task complete?
      $task = document.querySelector(`#task${$taskID}> th:nth-child(1) > input[type=checkbox]`);
      console.log($task.checked);
        if ($task.checked == true) {
        //Completed task - edit task_log time
        let data = {
          taskLogID: $taskID,
          time: document.getElementById("time" + $taskID).value,
          tzOffset: tzOffset
        };
      console.log(data);
        }
}

function assignTask($taskID) {
  //Create data to send to server.
    let data = {
      taskID: taskID,
      user: document.querySelector("#user" + taskID).value,
      task: document.querySelector("#task" + taskID + " > th.task > input").value,
    };
  console.log(data);

  //call 3editUser.php
  fetch('/FamilyDashboard/public/dashboard/4assignTask.php', {
    method: 'post',
    body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          // document.getElementById('step5Msgs').innerHTML = status;
        })

    if (status = "Update Succeeded.") {

      location.reload();
  }
}
