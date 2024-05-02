const deleteOne = (role_id) => {
  if (confirm(`是否要刪除編號為${role_id}的角色`)) {
    location.href = `roleList-delete.php?role_id=${role_id}`;
  } else {
    return
  }
}