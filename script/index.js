const existingEmial = async (form) => {
  try {
    const request = await fetch("database/account.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ case: "email", formData: form }),
    });
    if (request.status !== 200) {
      throw new Error("could not connect");
    }
    let data = await request.json();
    return data;
  } catch (error) {
    console.log(error.message);
  }
};

class validateForm {
  regex = {
    name: /^[a-zA-Z\s]{5,}$/,
    email: /^([a-zA-Z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
    password: /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[#$@!%&*?]).{7,}$/,
  };
  error = [];
  constructor(formData) {
    this.name = formData.get("fullname");
    this.email = formData.get("email");
    this.password = formData.get("password");
    this.confirmPassword = formData.get("confirmPassword");
  }
  viewProperty() {
    console.log(`your name: ${this.name}, your email: ${this.email}`);
    console.log(
      `your passoword: ${this.password}, your confirmPassword: ${this.confirmPassword}`
    );
  }
  validateALL() {
    this.validateName();
    this.validateEmail();
    this.validatePassword();
    document.querySelectorAll(".error").forEach((element) => {
      element.innerHTML = "";
    });
    if (this.error.length !== 0) {
      this.error.forEach((element) => {
        document.querySelector(`#${element[0]}`).innerHTML = element[1];
      });
    } else {
      return 1;
    }
  }
  validateName() {
    if (this.name === "") {
      this.addError("fullname", "Your fullname is required");
    } else {
      if (!this.regex.name.test(this.name)) {
        this.addError("fullname", "Your name must be in alphabet");
      }
    }
  }
  validateEmail() {
    if (this.email === "") {
      this.addError("email", "Your Email is required");
    } else {
      if (!this.regex.email.test(this.email)) {
        this.addError("email", "Your Email must be valid");
      }
    }
  }
  validatePassword() {
    if (this.password === "") {
      this.addError("password", "Password must be filled");
    } else {
      if (!this.regex.password.test(this.password)) {
        this.addError(
          "password",
          "least one lowercase, one uppercase, one number, one special character"
        );
      }
    }
    if (this.confirmPassword === "") {
      this.addError("confirmPassword", "This input must be filled ");
    } else {
      if (this.password !== this.confirmPassword) {
        this.addError("confirmPassword", "It is not correct");
      }
    }
  }
  addError(key, message) {
    this.error.push([key, message]);
  }
}
let submitButton = document.querySelector("#submitButton");
submitButton.addEventListener("click", async () => {
  let form = document.querySelector(".form");
  let formData = new FormData(form);
  let validate = new validateForm(formData);
  if (validate.validateALL() === 1) {
    let data2 = await existingEmial(Object.fromEntries(formData.entries()));
    if (data2 === 1) {
      document.querySelector(`#email`).innerHTML = "This acount already exists";
    } else {
      form.submit();
    }
  }
});
