"use strict";

const followForm = document.querySelector(".follow-form");

if (followForm) {
  followForm.addEventListener("submit", event => {
    event.preventDefault();
    const formData = new FormData(followForm);

    fetch("app/users/follows.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(json => {
        const followButton = document.querySelector(".follow-button");

        if (json.isFollowed === false) {
          followButton.innerHTML = "Follow";
        } else {
          followButton.innerHTML = "Unfollow";
        }
      });
  });
}
