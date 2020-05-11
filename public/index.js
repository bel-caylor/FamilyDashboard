//Toggle visible sections on familySetup.
function clickExpandBtn(section) {
  document.getElementById("content" + section).classList.toggle("hidden");
}

//Toggle visible sections on dashboard.
function clickDashboardSection(section) {
  //Hide all sections.
  document.getElementById("completeTasks").classList.add("hidden");
  document.getElementById("assignTasks").classList.add("hidden");
  document.getElementById("gradeTasks").classList.add("hidden");
  //Unhide clicked section.
  document.getElementById(section).classList.remove("hidden");
}

function toggleInfo(section) {
  document.getElementById(section).classList.toggle("hidden");
}

function  toggleNav( ) {
  document.getElementById("navContent").classList.toggle("hidden");
}

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
    document.getElementById("EditSave").innerHTML = "Save";

  //Change symbol and Edit action to Save Action
    let html = `<button type=\"submit\"  onclick="saveUser(` + userID + `)"><i class="far fa-save"></i>`;
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
    let data = {
      userID: userID,
      name: document.querySelector("#userID" + userID + " > th:nth-child(2) > input").value,
      initial: document.querySelector("#Hdn" + userID + " > th.initial > input").value,
      color: document.querySelector("#userID" + userID + "  > th:nth-child(3) > input").value,
      admin: Admin,
      email: document.querySelector("#Hdn" + userID + " > th.email > input").value,
    };

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
      document.getElementById("EditSave").innerHTML = "Edit";

    //Change symbol and Save action to Edit Action
      let html = `<button onclick="editUser(` + userID + `)"><i class="fas fa-pencil-alt"></i>`;
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

function editCat(id) {
  document.getElementById('cat' + id).disabled = false;
  toggleCat(id);
  document.getElementById('btncat' + id).setAttribute("onclick", "saveCat(" + id + ")");
}

function saveCat(id) {
  //Create data to send to server.
    let data = {
      catID: id,
      Name: document.querySelector("#cat" + id).value,
    };
  console.log(data);

  //call 3editUser.php
  fetch('/FamilyDashboard/public/familySetup/5editCat.php', {
    method: 'post',
    body: JSON.stringify(data)
  })
    .then(res => res.text())
      .then(text => new DOMParser().parseFromString(text, 'text/html'))
        .then(doc => {
          let status = doc.body.innerHTML;
          document.getElementById('step5Msgs').innerHTML = status;
        })

    if (status = "Update Succeeded.") {
      document.getElementById('cat' + id).disabled = true;
      toggleCat(id);
      document.getElementById('btncat' + id).setAttribute("onclick", "editCat(" + id + ")");
  }
}

function toggleCat(id) {
  document.getElementById('rowCat' + id).classList.toggle("edit");
  document.getElementById('rowCat' + id).classList.toggle("category");
  document.querySelector('#btncat' + id +' > i').classList.toggle("fas");
  document.querySelector('#btncat' + id +' > i').classList.toggle("fa-pencil-alt");
  document.querySelector('#btncat' + id +' > i').classList.toggle("far");
  document.querySelector('#btncat' + id +' > i').classList.toggle("fa-save");
}

function editTask(taskID) {
  //Show Rows & Hightlight
    toggleTask(taskID);

  //Make Task editable.
    document.querySelector("#task" + taskID + " > th.task > input").disabled = false;

  //Change symbol and Edit action to Save Action
    let html = `<button type=\"submit\"  onclick="saveTask(` + taskID + `)"><i class="far fa-save"></i>`;
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
  }
}

function deleteTask(taskID) {
  //call 3editUser.php
  fetch('/FamilyDashboard/public/familySetup/5deleteTask.php?taskID=' + taskID, {
    method: 'GET',
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
    document.getElementById('catName2').required = true;
  }else {
    document.getElementById('typeRow').classList.add('hidden');
    document.getElementById('newCat').classList.add('hidden');
    document.getElementById('catName2').required = false;
  }

}

function onLoad() {
  if (document.getElementById('start') != null) {
    document.getElementById('start').valueAsDate = new Date();
  }
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
        deleteCompleteTask($taskID);

      }
}

function deleteCompleteTask() {

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
          // let status = doc.body.innerHTML;
          // document.getElementById('status').innerHTML = status;
          let taskLogID = doc.getElementById('taskLogID').innerHTML;
          let newStart = doc.getElementById('newStart').innerHTML;
          // console.log(taskLogID);
          // console.log(newStart);
          if (taskLogID != "insert failed") {
            //change background color to green & add taskLogID
            document.querySelector("#task" + $taskID + " > th.tblInput").classList.remove("tblInput");
            document.getElementById("time" + $taskID).disabled = true;
            document.querySelector("#task" + $taskID + " > th:nth-child(1) > input[type=checkbox]").disabled = true;
            document.getElementById("task" + $taskID).classList.add("saved");

            // document.querySelector("#task353 > th:nth-child(1) > input[type=checkbox]").setAttribute("name", "taskLogID" + taskLogID);
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

function assignTask(taskID) {
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

function saveGrade(taskLogID) {
  //Create data to send to server.
    let data = {
      taskID: taskLogID,
      grade: document.getElementById("grade" + taskLogID).value,
      time: document.getElementById("time" + taskLogID).value,
      note: document.getElementById("note" + taskLogID).value,
    };
    console.log(data);

    fetch('/FamilyDashboard/public/dashboard/3saveGrade.php', {
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
        document.getElementById("taskLog" + taskLogID).remove();
        document.getElementById("taskLogNote" + taskLogID).remove();
      }
}
