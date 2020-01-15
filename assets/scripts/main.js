"use strict";

const likeForms = document.querySelectorAll(".like-form");
const likeButtons = document.querySelectorAll(".button-liked");
const editPosts = document.querySelectorAll(".update-post-content");
const deleteButton = document.querySelector(".delete-button-settings");
const deleteButtonReal = document.querySelector(".delete-button-settings-real");
const cancelButton = document.querySelector(".cancel-button-settings");
const label = document.querySelector(".general-label-settings");

// function to toggle hidden on buttons in settings / deletebutton

if (deleteButton) {
  deleteButton.addEventListener("click", () => {
    deleteButtonReal.classList.toggle("hidden");
    deleteButton.classList.toggle("hidden");
    cancelButton.classList.toggle("hidden");
    label.classList.toggle("hidden");
  });
}

if (cancelButton) {
  cancelButton.addEventListener("click", () => {
    deleteButtonReal.classList.toggle("hidden");
    deleteButton.classList.toggle("hidden");
    cancelButton.classList.toggle("hidden");
    label.classList.toggle("hidden");
  });
}

// Function to toggle hidden on buttons and form on profile

editPosts.forEach(editPost => {
  let submitButton = editPost.querySelector(".edit-button");

  submitButton.addEventListener("click", event => {
    const target = event.target.parentElement.parentElement;
    const postLabel = target.querySelector(".general-label");
    postLabel.classList.toggle("hidden");
    const textArea = target.querySelector(".textarea-post");
    textArea.classList.toggle("hidden");
    const updatePost = target.querySelector(".update-post");
    updatePost.classList.toggle("hidden");
    const cancelPost = target.querySelector(".cancel-button");
    cancelPost.classList.toggle("hidden");
    const deletePost = target.querySelector(".button-delete");
    deletePost.classList.toggle("hidden");
    const editButton = target.querySelector(".edit-button");
    editButton.classList.toggle("hidden");
  });

  let cancelButton = editPost.querySelector(".cancel-button");

  cancelButton.addEventListener("click", event => {
    const target = event.target.parentElement.parentElement;

    const postLabel = target.querySelector(".general-label");
    postLabel.classList.toggle("hidden");
    const textArea = target.querySelector(".textarea-post");
    textArea.classList.toggle("hidden");
    const updatePost = target.querySelector(".update-post");
    updatePost.classList.toggle("hidden");
    const cancelPost = target.querySelector(".cancel-button");
    cancelPost.classList.toggle("hidden");
    const deletePost = target.querySelector(".button-delete");
    deletePost.classList.toggle("hidden");
    const editButton = target.querySelector(".edit-button");
    editButton.classList.toggle("hidden");
  });
});

// Like function, using Json so I dont have to update page on buttonclick.
// Also changes color of heart on Like.

likeForms.forEach(likeForm => {
  likeForm.addEventListener("submit", event => {
    event.preventDefault();

    const formData = new FormData(likeForm);

    fetch("app/posts/likes.php", {
      method: "POST",
      body: formData
    })
      .then(response => response.json())
      .then(json => {
        let likeCount = document.querySelector(
          `.likeCount${likeForm[0].value}`
        );
        likeCount.innerText = json;

        const id = event.target.dataset.id;

        const likeButtons = document.querySelectorAll(`.like[data-id="${id}"]`);

        likeButtons.forEach(likeButton => {
          likeButton.classList.toggle("hidden");
        });
      });
  });
});
