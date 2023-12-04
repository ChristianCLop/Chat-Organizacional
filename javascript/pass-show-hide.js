
const pswrdField = document.querySelector(".form input[type='password']");
const toggleIcon = document.querySelector(".form .field i");

const togglePasswordVisibility = () => {
  if (pswrdField.type === "password") {
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  } else {
    pswrdField.type = "password";
    toggleIcon.classList.remove("active");
  }
};

toggleIcon.onclick = togglePasswordVisibility;

export { togglePasswordVisibility };

