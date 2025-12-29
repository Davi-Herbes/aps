const docInputs = document.querySelectorAll(".doc-input");
const fileUploadTexts = document.querySelectorAll(".file-upload-text");

for (let i = 0; i < docInputs.length; i++) {
  /** @type HTMLInputElement */
  const input = docInputs[i];
  const fileUploadText = fileUploadTexts[i];

  input.addEventListener("change", () => {
    const fileName = input.files[0].name;
    const fileURL = URL.createObjectURL(input.files[0]);
    const fileLink = document.createElement("a");
    fileLink.classList.add("file-upload-text");

    fileLink.href = fileURL;
    fileLink.target = "_blank";
    fileLink.innerText = fileName;

    fileUploadText.innerHTML = "";
    fileUploadText.appendChild(fileLink);
    fileUploadText.classList.remove("file-upload-text-empty");
  });
}
