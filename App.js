let isChecked = false;
let error = document.getElementById("errorMessage");
let input = document.getElementById("input");
const form = document.getElementById("form");
const checkbox = document.getElementById("check");
const arrowBtn = document.getElementById("arrowBtn");
let isValid;

const emailIsValid = (email) => {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
};

const createMessage = (msgType) => {
  let p = document.createElement("p");
  p.setAttribute("class", "message");

  if (msgType === true) {
    let text = document.createTextNode("Valid");
    p.appendChild(text);
    return p;
  } else if (msgType === false) {
    let text = document.createTextNode("Please provide a valid e-mail address");
    p.appendChild(text);
    return p;
  } else if (msgType === "check") {
    let text = document.createTextNode(
      "You must accept the terms and conditions"
    );
    p.appendChild(text);
    return p;
  } else if (msgType === "empty") {
    let text = document.createTextNode("Email address is required");
    p.appendChild(text);
    return p;
  } else if (msgType === "co") {
    let text = document.createTextNode(
      "We are not accepting subscriptions from Colombia emails"
    );
    p.appendChild(text);
    return p;
  }
};

const removeMessage = () => {
  if (document.getElementsByClassName("message")[0]) {
    let removableMsg = document.getElementsByClassName("message")[0];
    if (removableMsg.parentNode) {
      removableMsg.parentNode.removeChild(removableMsg);
    }
  }
};

const isEnabled = () => {
  isValid = emailIsValid(input.value);
  const buttonValid = messageType(isValid);
  if (buttonValid === true) {
    arrowBtn.onclick = () => {
      formSubmit();
    };
  } else {
    arrowBtn.onclick = () => {
      return false;
    };
  }
};

checkbox.onchange = () => {
  isChecked = !isChecked;
  isEnabled();
};

const formSubmit = () => {
  let message;
  isEnabled();

  isValid = emailIsValid(input.value);
  removeMessage();

  const type = messageType(isValid);

  switch (type) {
    case true:
      document.inputForm.submit();
      break;
    case false:
      message = createMessage(false);
      error.appendChild(message);
      break;
    case "empty":
      message = createMessage("empty");
      error.appendChild(message);
      break;
    case "check":
      message = createMessage("check");
      error.appendChild(message);
      break;
    case "co":
      message = createMessage("co");
      error.appendChild(message);
      break;
    default:
      break;
  }
};

const checkForErrors = () => {
  let message;
  isEnabled();

  isValid = emailIsValid(input.value);
  removeMessage();

  const type = messageType(isValid);

  switch (type) {
    case false:
      message = createMessage(false);
      error.appendChild(message);
      break;
    case "empty":
      message = createMessage("empty");
      error.appendChild(message);
      break;
    case "check":
      message = createMessage("check");
      error.appendChild(message);
      break;
    case "co":
      message = createMessage("co");
      error.appendChild(message);
      break;
    default:
      break;
  }
};

const messageType = (isEmailValid) => {
  let last2 = input.value.substring(input.value.length, input.value.length - 2);
  if (isEmailValid && isChecked && !"" && last2 !== "co") {
    return true;
  } else if (input.value === "") {
    return "empty";
  } else if (last2 == "co") {
    return "co";
  } else if (!isEmailValid && isChecked && !"") {
    return false;
  } else if (!isChecked && !"") {
    return "check";
  }
};
