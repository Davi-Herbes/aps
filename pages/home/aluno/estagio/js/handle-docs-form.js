// import { deleteDocument } from "./delete-document.js";

// const submitDocsBtn = document.querySelector("#submit-docs-btn");
const deleteDocBtns = document.querySelectorAll(".delete-doc-btn");

// const body = document.querySelector("body");

// function addZero(nb) {
//   const str = `${nb}`;
//   return str.length === 1 ? "0" + str : str;
// }

// for (let i = 0; i < uploadForms.length; i++) {
//   const form = uploadForms[i];
//   const displayDataEnvio = form.querySelector(".display-data-envio");
//   const displayHoraEnvio = form.querySelector(".display-hora-envio");
//   const validadeDisplay = form.querySelector(".validade-display");
//   const validadeInput = form.querySelector(".validade-input");

//   const fileInput = form.querySelector(".doc-input");
//   const fileUploadText = form.querySelector(".file-upload-text");

//   const deleteBtn = form.querySelector(".delete-doc-btn");
//   console.log(deleteBtn);
//   deleteBtn.addEventListener("click", (e) =>
//     deleteDocument(
//       e,
//       displayDataEnvio,
//       displayHoraEnvio,
//       validadeDisplay,
//       validadeInput,
//       fileInput,
//       fileUploadText
//     )
//   );

//   form.addEventListener("submit", async (e) => {
//     e.preventDefault();
//     const formData = new FormData(form);

//     const response = await fetch("/2025/projeto/grupo2/src/forms/enviar_documento.php", {
//       method: "POST",
//       body: formData,
//     });

//     try {
//       const data = await response.json();
//       console.log(data);
//       const flashMsg = document.createElement("div");

//       if (data.valido === "true") {
//         flashMsg.classList.add("flash-msg-success");
//         flashMsg.classList.add("flash-msg");
//         flashMsg.innerText = "Documento atualizado com sucesso.";
//       } else {
//         flashMsg.classList.add("flash-msg-error");
//         flashMsg.classList.add("flash-msg");
//         flashMsg.innerText = "Ocorreu um erro ao atualizar o arquivo.";
//       }

//       if (data.documento.updated_at) {
//         const envioDate = new Date(data.documento.updated_at.replace(" ", "T"));
//         envioDate.setHours(envioDate.getHours() - 3);
//         displayDataEnvio.innerText = `${addZero(envioDate.getDate())}/${addZero(
//           envioDate.getMonth() + 1
//         )}/${envioDate.getFullYear()}`;

//         displayHoraEnvio.innerText = `${addZero(envioDate.getHours())}:${addZero(
//           envioDate.getMinutes()
//         )}`;
//       }

//       if (data.documento.validade) {
//         const validadeDate = new Date(data.documento.validade.replace(" ", "T"));
//         validadeDate.setHours(validadeDate.getHours() - 3);
//         validadeDisplay.innerText = `${addZero(validadeDate.getDate())}/${addZero(
//           validadeDate.getMonth() + 1
//         )}/${validadeDate.getFullYear()}`;

//         validadeInput.value = data.documento.validade;
//       }

//       deleteBtn.disabled = false;
//       deleteBtn.setAttribute("documento-id", data.documento.id);
//       body.appendChild(flashMsg);
//       setTimeout(() => {
//         flashMsg.remove();
//       }, 3000);
//     } catch (e) {
//       console.log(e);
//       const flashMsg = document.createElement("div");
//       flashMsg.classList.add("flash-msg-error");
//       flashMsg.classList.add("flash-msg");
//       flashMsg.innerText = "Ocorreu um erro ao atualizar o arquivo.";

//       body.appendChild(flashMsg);
//       setTimeout(() => {
//         flashMsg.remove();
//       }, 3000);
//     }
//   });
// }

for (let i = 0; i < deleteDocBtns.length; i++) {
  const deleteDocBtn = deleteDocBtns[i];
  const formContainer = deleteDocBtn.parentElement.parentElement.parentElement;
  const deleteForm = formContainer.querySelector(".delete-doc-form");
  // console.log(deleteDocBtn);
  // console.log(formContainer);
  // console.log(deleteForm);

  deleteDocBtn.addEventListener("click", () => {
    deleteForm.submit();
  });
}
