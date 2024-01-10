<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Система управління надзвичайними подіями</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <style>
    
    #map {
      height: 500px;
      width: 100%;
      border: 2px solid #ddd;
      border-radius: 8px;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1rem 0;
    }

    main {
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    section {
      margin-bottom: 20px;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      width: 80%;
      max-width: 600px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    textarea,
    select {
      width: calc(100% - 20px);
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 20px;
}

h1 {
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

thead {
  background-color: #f2f2f2;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #ddd;
  font-weight: bold;
}

  </style>
</head>
<body>
  <header>
    <h1>Система управління надзвичайними подіями</h1>
  </header>
  
  <main>
    
    <section id="addEvent">
      <h2>Додати нову подію</h2>
      <form id="eventForm" action="save_event.php" method="post">
        <label for="eventName">Назва події:</label>
        <input type="text" id="eventName" name="eventName" required>
        
        <label for="eventCity">Місто:</label>
        <select id="eventCity" name="eventCity">
          <option value="Київ">Київ</option>
          <option value="Харків">Харків</option>
          <option value="Одеса">Одеса</option>
          <option value="Львів">Львів</option>
          <option value="Дніпро">Дніпро</option>
          
          <option value="Івано-Франківськ">Івано-Франківськ</option>
          <option value="Чернівці">Чернівці</option>
          <option value="Тернопіль">Тернопіль</option>
          <option value="Рівне">Рівне</option>
          <option value="Житомир">Житомир</option>
          <option value="Вінниця">Вінниця</option>
          <option value="Хмельницький">Хмельницький</option>
          <option value="Черкаси">Черкаси</option>
          <option value="Кропивницький">Кропивницький</option>
          <option value="Миколаїв">Миколаїв</option>
          <option value="Чернігів">Чернігів</option>
          <option value="Суми">Суми</option>
          <option value="Полтава">Полтава</option>
          <option value="Кривий Ріг">Кривий Ріг</option>
          <option value="Херсон">Херсон</option>
          <option value="Севастополь">Севастополь</option>
          <option value="Маріуполь">Маріуполь</option>
          <option value="Донецьк">Донецьк</option>
          <option value="Луганськ">Луганськ</option>
          
        </select>
        
        <label for="eventDescription">Опис події:</label>
        <textarea id="eventDescription" name="eventDescription" rows="4" cols="50" required></textarea>
        
        <input type="submit" value="Додати подію">
      </form>
    </section>

    
    <section id="eventMap">
      <h2>Мапа</h2>
      <div id="map"></div>
    </section>
  </main>
  
  <table id="eventTable">
  <thead>
    <tr>
      <th>Назва події</th>
      <th>Місто</th>
      <th>Опис</th>
      <th>Час</th>
      <th>Дії</th>
    </tr>
  </thead>
  <tbody id="eventTableBody">
    
    <tr>
      <td>Подія 1</td>
      <td>Місто 1</td>
      <td>Опис 1</td>
      <td>Час 1</td>
      <td>
        <button onclick="deleteEvent(this)">Видалити подію</button>
      </td>
    </tr>
    
  </tbody>
</table>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script>
    var events = []; 
    var cities = {
      "Київ": [50.4501, 30.5234],
      "Харків": [49.9935, 36.2304],
      "Одеса": [46.4825, 30.7233],
      "Львів": [49.8397, 24.0297],
      "Дніпро": [48.4647, 35.0462],
      "Запоріжжя": [47.8388, 35.1396],
      "Івано-Франківськ": [48.9226, 24.7111],
      "Чернівці": [48.2921, 25.9359],
      "Тернопіль": [49.5535, 25.5948],
      "Рівне": [50.6199, 26.2516],
      "Житомир": [50.2547, 28.6587],
      "Вінниця": [49.2331, 28.4682],
      "Хмельницький": [49.4229, 26.9873],
      "Черкаси": [49.4444, 32.0597],
      "Кропивницький": [48.5044, 32.2603],
      "Миколаїв": [46.9750, 31.9946],
      "Чернігів": [51.4934, 31.2895],
      "Суми": [50.9077, 34.7981],
      "Полтава": [49.5937, 34.5407],
      "Кривий Ріг": [47.9022, 33.3587],
      "Херсон": [46.6354, 32.6169],
      "Севастополь": [44.6166, 33.5254],
      "Маріуполь": [47.0971, 37.5431],
      "Донецьк": [48.0159, 37.8029],
      "Луганськ": [48.5740, 39.3078]
      
    };

    
    var map = L.map('map').setView([49.00, 31.00], 6); // Центруємо мапу на центральну Україну
    var tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    
    document.getElementById('eventForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var eventName = document.getElementById('eventName').value;
    var eventCity = document.getElementById('eventCity').value;
    var eventDescription = document.getElementById('eventDescription').value;

    var data = {
        eventName: eventName,
        eventCity: eventCity,
        eventDescription: eventDescription
    };

    var xhr = new XMLHttpRequest();
    var url = 'save_event.php';
    xhr.open('POST', url, true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert('Дані успішно додані до бази даних');
                addEvent(eventName, eventCity, eventDescription);
                displayEventsOnMap();
            } else {
                alert('Помилка під час відправки даних на сервер');
            }
        }
    };
    var params = 'eventName=' + eventName + '&eventCity=' + eventCity + '&eventDescription=' + eventDescription;
    xhr.send(params);
});


    
    function addEvent(name, city, description) {
      events.push({
        name: name,
        city: city,
        description: description
        
      });
    }

    
    function displayEventsOnMap() {
      
      map.eachLayer(function(layer) {
        if (layer instanceof L.Marker) {
          map.removeLayer(layer);
        }
      });

      
      events.forEach(function(event) {
        if (cities[event.city]) {
          var marker = L.marker(cities[event.city]).addTo(map);
          marker.bindPopup(`<b>${event.name}</b><br>${event.description}`).openPopup();
        }
      });
    }
    function addEventToTable(name, city, description) {
    
    var currentTime = new Date().toLocaleString();

    var eventTableBody = document.getElementById('eventTableBody');
    var newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td>${name}</td>
      <td>${city}</td>
      <td>${description}</td>
      <td>${currentTime}</td>
    `;
    eventTableBody.appendChild(newRow);
  }

  
  document.getElementById('eventForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var eventName = document.getElementById('eventName').value;
    var eventCity = document.getElementById('eventCity').value;
    var eventDescription = document.getElementById('eventDescription').value;

    
    addEventToTable(eventName, eventCity, eventDescription);

    
    document.getElementById('eventName').value = '';
    document.getElementById('eventCity').value = '';
    document.getElementById('eventDescription').value = '';

   
    displayEventsOnMap();
  });
  function deleteEvent(button) {
  var row = button.parentNode.parentNode; 

  
  var eventName = row.cells[0].innerText;
  var eventCity = row.cells[1].innerText;
  var eventDescription = row.cells[2].innerText;

  
  events = events.filter(function(event) {
    return !(event.name === eventName && event.city === eventCity && event.description === eventDescription);
  });
  displayEventsOnMap(); // Оновлюємо мапу з урахуванням видалення

  
  var currentTime = new Date().toLocaleString();
  row.cells[3].innerText = currentTime;

  
  row.remove();
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "delete_event.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        
        row.remove(); // Видалення рядка з таблиці
        displayEventsOnMap(); 
      } else {
        
        console.error("Помилка при видаленні події: " + xhr.status);
      }
    }
  };

  
  var data = "eventName=" + encodeURIComponent(eventName) +
             "&eventCity=" + encodeURIComponent(eventCity) +
             "&eventDescription=" + encodeURIComponent(eventDescription);
  xhr.send(data);
}


    
    function addEventToTable(name, city, description) {
  var currentTime = new Date().toLocaleString(); // Отримання поточної дати та часу

  var eventTableBody = document.getElementById('eventTableBody');
  var newRow = document.createElement('tr');
  newRow.innerHTML = `
    <td>${name}</td>
    <td>${city}</td>
    <td>${description}</td>
    <td>${currentTime}</td> <!-- Відображення поточного часу -->
    <td>
      <button onclick="deleteEvent(this)">Видалити подію</button>
    </td>
  `;
  eventTableBody.appendChild(newRow);
}
  </script>
</body>
</html>