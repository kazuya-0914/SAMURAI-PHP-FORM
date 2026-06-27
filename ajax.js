const refreshBtn = document.getElementById('refresh-btn');
const outputDiv = document.getElementById('outputDiv');
let timer;

function fetchFromServer() {
  const dispData = {
    name: outputDiv.textContent
  };

  fetch('ajax.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(dispData)
  })
  .then((res) => res.json())
  .then((data) => {
    outputDiv.textContent = data.message;
  })
}

refreshBtn.addEventListener('click', () => {
  if (timer) {
    clearInterval(timer);
    timer = 0;
    refreshBtn.textContent = '更新';
  } else {
    timer = setInterval(fetchFromServer, 1000);
    refreshBtn.textContent = '停止';
  }
})