let today = new Date();

// 格式化日期為YYYY-MM-DD
let dd = String(today.getDate()).padStart(2, '0');
let mm = String(today.getMonth() + 1).padStart(2, '0'); // 一月是 0
let yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;
document.getElementById('hireDate').value = today;