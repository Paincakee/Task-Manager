const searchInput = document.querySelector('input[name="search"]');
searchInput.addEventListener('input', function() {
  const query = this.value;
  const xhr = new XMLHttpRequest();
  xhr.open('GET', `api/project/getProjectContributors.php?query=${query}`);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      const select = document.querySelector('select[name="selected[]"]');
      select.innerHTML = '';
      for (const key in data) {
        if (data.hasOwnProperty(key)) {
          const value = data[key];
          const option = document.createElement('option');
          option.value = key;
          option.textContent = value;
          select.appendChild(option);
        }
      }
    }
  };
  xhr.send();
});
