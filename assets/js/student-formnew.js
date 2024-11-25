let currentTab = 0; // Start at the first tab
showTab(currentTab); // Display the current tab

function nextPrev(n) {
  const tabs = document.getElementsByClassName("tab");

  // Exit function if validation fails when moving forward from the current tab
  if (n === 1 && !validateForm()) return false;

  tabs[currentTab].style.display = "none";
  currentTab += n;
  if (currentTab >= tabs.length) {
    document.getElementById("regForm").submit();
    return false;
  }
  showTab(currentTab);
}

function validateForm() {
  if (currentTab === 1) { // Check consent on the second tab (index 1)
    const consentGiven = document.querySelector('input[name="consent"]:checked');
    if (!consentGiven) {
      alert("Please provide your consent by selecting the radio option.");
      return false;
    }
  }
  
  if (currentTab !== 2) return true; // Only validate other fields if on the third tab (index 2)
  
  let isValid = true;

  // Validate Surname
  const surname = document.getElementById("surname").value.trim();
  const surnameErr = document.getElementById("surnameErr");
  if (surname === "") {
    surnameErr.textContent = "Please enter your Surname.";
    isValid = false;
  } else if (!/^[A-Z\s]+$/.test(surname)) {
    surnameErr.textContent = "Please enter a valid Surname in uppercase.";
    isValid = false;
  } else {
    surnameErr.textContent = "";
  }

  // Validate First Name
  const firstName = document.getElementById("first_name").value.trim();
  const firstNameErr = document.getElementById("firstNameErr");
  if (firstName === "") {
    firstNameErr.textContent = "Please enter your First Name.";
    isValid = false;
  } else if (!/^[A-Z\s]+$/.test(firstName)) {
    firstNameErr.textContent = "Please enter a valid First Name in uppercase.";
    isValid = false;
  } else {
    firstNameErr.textContent = "";
  }

 // Validate Middle Initial
const middleInitial = document.getElementById("middle_initial").value.trim();
const middleInitialErr = document.getElementById("middleInitialErr");
if (middleInitial !== "" && (!/^[A-Z]\.$/.test(middleInitial) || middleInitial.length !== 2)) {
  middleInitialErr.textContent = "Middle Initial should be one uppercase letter followed by a perioddd (e.g., 'A.').";
  isValid = false;
} else {
  middleInitialErr.textContent = "";
}

  // Validate Student Number
  const studentNumber = document.getElementById("student_number").value.trim();
  const studentNumberErr = document.getElementById("studentNumberErr");
  if (studentNumber === "") {
    studentNumberErr.textContent = "Please enter your Student Number.";
    isValid = false;
  } else if (!/^\d{11}$/.test(studentNumber)) {
    studentNumberErr.textContent = "Student Number should be exactly 11 digits.";
    isValid = false;
  } else {
    studentNumberErr.textContent = "";
  }

  // Validate College
  const college = document.getElementById("college").value.trim();
  const collegeErr = document.getElementById("collegeErr");
  if (college === "") {
    collegeErr.textContent = "Please enter your College.";
    isValid = false;
  } else if (!/^[A-Z\s]+$/.test(college)) {
    collegeErr.textContent = "Please enter a valid College name in uppercase.";
    isValid = false;
  } else {
    collegeErr.textContent = "";
  }

  // Validate Program
  const program = document.getElementById("program").value.trim();
  const programErr = document.getElementById("programErr");
  if (program === "") {
    programErr.textContent = "Please enter your Program.";
    isValid = false;
  } else if (!/^BS[A-Z]+$/.test(program)) {
    programErr.textContent = "Please enter a valid Program (e.g., BSCpE, BSCE) in uppercase.";
    isValid = false;
  } else {
    programErr.textContent = "";
  }

  // Validate Year Level
  const yearLevel = document.getElementById("year-level").value;
  const yearLevelErr = document.getElementById("yearLevelErr");
  if (yearLevel === "Choose Year Level") {
    yearLevelErr.textContent = "Please select your Year Level.";
    isValid = false;
  } else {
    yearLevelErr.textContent = "";
  }

  // Validate Age
  const age = document.getElementById("age").value.trim();
  const ageErr = document.getElementById("ageErr");
  if (age === "") {
    ageErr.textContent = "Please enter your Age.";
    isValid = false;
  } else if (!/^\d{2}$/.test(age)) {
    ageErr.textContent = "Age should be exactly 2 digits.";
    isValid = false;
  } else {
    ageErr.textContent = "";
  }

  // Validate Sex
  const sex = document.getElementById("sex").value;
  const sexErr = document.getElementById("sexErr");
  if (sex === "Choose Sex") {
    sexErr.textContent = "Please select your Sex.";
    isValid = false;
  } else {
    sexErr.textContent = "";
  }

  return isValid;
}

function showTab(n) {
  const tabs = document.getElementsByClassName("tab");
  tabs[n].style.display = "block";
  document.getElementById("prevBtn").style.display = n === 0 ? "none" : "inline";
  document.getElementById("nextBtn").innerText = n === (tabs.length - 1) ? "Submit" : "Next";
}
