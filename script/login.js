const validateAccount = async (form) => {
  try {
    const request = await fetch("database/account.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ case: "Login", formData: form }),
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
    email: /^([a-zA-Z\d\.-]+)@([a-z\d-]+)\.([a-z]{2,8})(\.[a-z]{2,8})?$/,
  };
  error = [];
  constructor(formData) {
    this.email = formData.get("email");
    this.password = formData.get("password");
  }
  viewProperty() {
    console.log(
      `this is email: ${this.email}, this is your password: ${this.password}`
    );
  }
  async validateAll(form) {
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
      let check = await validateAccount(form);
      console.log(check);
      switch (check.result) {
        case "notExist":
          document.querySelector(`#email`).innerHTML =
            "This account does not exists";
          break;
        case 0:
          document.querySelector(`#password`).innerHTML =
            "Password is not correct";
          break;
        case 1:
          console.log("correct");
          console.log(check.id);
          break;
        default:
          break;
      }
    }
  }
  validateEmail() {
    if (this.email === "") {
      this.addError("email", "Email must be inputed");
    } else {
      if (!this.regex.email.test(this.email)) {
        this.addError("email", "Email is not valid");
      }
    }
  }
  validatePassword() {
    if (this.password === "") {
      this.addError("password", "Password must be inputed");
    } else {
    }
  }
  addError(key, message) {
    this.error.push([key, message]);
  }
}
let submitButtton = document.querySelector("#submitButton");
submitButtton.addEventListener("click", () => {
  let form = document.querySelector(".form");
  let formdata = new FormData(form);
  let validate = new validateForm(formdata);
  validate.validateAll(Object.fromEntries(formdata.entries()));
});
