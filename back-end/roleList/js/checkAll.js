const checkAll = (CheckAll, setGroupName) => {
  let checkboxs = document.getElementsByName(setGroupName);
  for (let i = 0; i < checkboxs.length; i++) {
    checkboxs[i].checked = CheckAll.checked;
  }
}

const allCheck = (checkAll, setGroup) => {
  let checkboxs = document.getElementsByName(setGroup);
  let checkswitch = document.getElementById(checkAll);
  if (checkboxs[1].checked) {
    checkboxs[0].checked = true;
  }
  if (checkboxs[0].checked && checkboxs[1].checked) {
    return checkswitch.checked = true;
  } else {
    return checkswitch.checked = false;
  }
}