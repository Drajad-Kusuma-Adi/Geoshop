$sql = "SELECT * FROM chats WHERE sender_id=? OR target_id=?";
$stmt = $conn->prepare($sql);
$value1 = $_SESSION["userId"];
$stmt->bind_param("ss", $value1, $value1);
$stmt->execute();
$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC); // Fetch all rows as associative array

if ($userId === $rows[0]['sender_id']) {
    $sql = "SELECT DISTINCT target_id FROM chats WHERE sender_id = ?";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();
$targetIds = $result->fetch_all(MYSQLI_ASSOC); // Fetch all target_ids as associative array

    foreach ($targetIds as $targetId) {
        $rowIndex = array_search($targetId['target_id'], array_column($rows, 'target_id'));
        if ($rowIndex !== false) {
            unset($rows[$rowIndex]); // Remove the chat row from $rows variable
        }
    }

} else if ($userId === $rows[0]['target_id']) {
    $sql = "SELECT DISTINCT sender_id FROM chats WHERE target_id = ?";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();
$senderIds = $result->fetch_all(MYSQLI_ASSOC); // Fetch all sender_ids as associative array

    foreach ($senderIds as $senderId) {
        $rowIndex = array_search($senderId['sender_id'], array_column($rows, 'sender_id'));
        if ($rowIndex !== false) {
            unset($rows[$rowIndex]); // Remove the chat row from $rows variable
        }
    }

}

$rows = array_values($rows); // Re-index the array after removing elements
$sql = "SELECT DISTINCT target_id FROM chats WHERE sender_id = ?";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $targetIds = $result->fetch_all();
    foreach ($targetIds as $targetId) {
        foreach ($rows as $key => $row) {
            if ($row['sender_id'] === $userId && $row['target_id'] === $targetId[0]) {
                unset($rows[$key]);
}
}
}
} else if ($userId === $rows[0]['target_id']) {
    $sql = "SELECT DISTINCT sender_id FROM chats WHERE target_id = ?";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $senderIds = $result->fetch_all();
    foreach ($senderIds as $senderId) {
        foreach ($rows as $key => $row) {
            if ($row['target_id'] === $userId && $row['sender_id'] === $senderId[0]) {
                unset($rows[$key]);
}
}
}
}
$sql = "SELECT DISTINCT target_id FROM chats WHERE sender_id = ?";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $targetIds = $result->fetch_all();
    foreach ($targetIds as $targetId) {
        foreach ($rows as $key => $row) {
            if ($row['sender_id'] === $userId && $row['target_id'] === $targetId[0]) {
                unset($rows[$key]);
}
}
}
} else if ($userId === $rows[0]['target_id']) {
    $sql = "SELECT DISTINCT sender_id FROM chats WHERE target_id = ?";
    $stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $senderIds = $result->fetch_all();
    foreach ($senderIds as $senderId) {
        foreach ($rows as $key => $row) {
            if ($row['target_id'] === $userId && $row['sender_id'] === $senderId[0]) {
                unset($rows[$key]);
}
}
}
}

**Basically my sandbox, this is where I write down algorithm process without actually using flowchart or boring UML diagram. Or maybe some random nonsense that most of you wouldn't want to understand.**

**Admin reports**
reports database (done) -> Get data (done) -> Display, sort by datetime -> Admin take action -> Fill admin_response row in reports table accordingly -> Delete row on schedule -> In the meantime, keep the report visible, but unactionable
Frontend display:

- Admin should click on row
- Modal appear, prompting Admin to take action
- Action processed in backend
  Button clicked -> According to button type, update user violation status -> Update report admin_response -> backend stuff I'm too lazy to plan and going to implement immediately

**Admin voting**
voting database -> Get all data -> Remove expired data -> Display data details in table -> Vote button -> If pressed, increase count by 1 -> If voting count => 4, user get banned -> Check if the user get actioned in loginUser.php

IMPORTANT REMINDER: I'm working on chatting system, then completing User ang Shop features, but Admin is incomplete yet. Continue later when I have time.

UPDATE users is_shop you stupid idiot

**Reminder: work on edit shop and edit shop picture, should be quick, but I want to do something else instead**

**Chatting**
I already completed most frontend work, the backend for showing message is also complete.
Just need to display panel, actual message history, and algorithm to send message.

**Map script, but for some reason doesn't show shops**

<script>
  // Variables declaration
  let watchID;
  let userPosition = {
      latitude: null,
      longitude: null
  };

  // Initialize the map and geolocation
  (() => {
      if (navigator.geolocation) {
          // Geolocation is available
          watchID = navigator.geolocation.watchPosition(geoSuccess, geoError, {
              enableHighAccuracy: true,
              maximumAge: 0,
              timeout: 10000
          });
      } else {
          alert("Geolocation is not supported by this browser");
      }
  })();

  // Geolocation success callback
  function geoSuccess(position) {
      userPosition.latitude = position.coords.latitude;
      userPosition.longitude = position.coords.longitude;

      // Display map with user's current position
      displayMap(userPosition.latitude, userPosition.longitude, 20);
  }

  // Geolocation error callback
  function geoError() {
      alert("Unable to retrieve location");
  }

  // Function to display map
  function displayMap(latitude, longitude, zoomLevel) {
      const map = L.map("map").setView([latitude, longitude], zoomLevel);
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);
      L.marker([latitude, longitude]).addTo(map);

      // Shop location properties
      let customIcon = {
          iconUrl: "../images/shopMarker.png",
          iconSize: [20, 40]
      }
      let markerIcon = L.icon(customIcon);
      let iconOptions = {
          title: "company name",
          draggable: true,
          icon: markerIcon
      }

      // Fetch and display shop location data
      const apiUrl = 'http://localhost/Geoshop/Geoshop%201.0/php/getShopLocation.php';
      fetch(apiUrl)
          .then(response => {
              if (!response.ok) {
                  throw new Error(`HTTP error! Status: ${response.status}`);
              }
              return response.json();
          })
          .then(data => {
              data.forEach(shop => {
                  let marker = new L.Marker([shop.latitude, shop.longitude], iconOptions);
                  marker.addTo(map);
                  marker.bindPopup(shop.name).openPopup();
              });
          })
          .catch(error => {
              console.error('Fetch error:', error);
          });
  }
</script>

LORD
OH LORD
I DON'T UNDERSTAND
HOW TF DO I CALCULATE DISTANCE
WTF IS A HAVERSINE FUCKIN FORMULA

**manageProducts.php**
SELECT \* FROM products WHERE shop_id = $assetId -> fetch_all(MYSQLI_ASSOC) -> foreach products as card

Out of nowhere map is malfunctioning again, also getSgopData.php doesn't set session variable for some reason.
And for some reason it works again, wtf.

<!-- **chatPanel.php**
Redirected from shopView.php -> Carry data of target user

Use AJAX in shopView.php? -->

Nevermind I've finished chatting backend. Just need to style the frontend, look for "TODO: Style message box" in chatLog.php

**Forgot and reset password system**

1. User input their email address onto the form in forgotPasswordPage.php
2. Backend process to check if the email exist in database
3. If email exist, redirect to resetPasswordPage.php
4. Prompt the user to set new password
5. New password set, redirect to loginPage.php
6. If reset password fail due to unknown reason, redirect to error.php
