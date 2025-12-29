// export async function deleteDocument(
//   e,
//   displayDataEnvio,
//   displayHoraEnvio,
//   validadeDisplay,
//   validadeInput,
//   fileInput,
//   fileUploadText
// ) {
//   const body = document.querySelector("body");
//   const button = e.target;

//   const docId = button.getAttribute("documento-id");

//   console.log(docId);

//   const formData = new FormData();
//   formData.set("id", docId);

//   const response = await fetch("/2025/projeto/grupo2/src/forms/deletar_documento.php", {
//     method: "POST",
//     body: formData,
//   });

//   try {
//     const data = await response.json();

//     const flashMsg = document.createElement("div");

//     if (data.status === "success") {
//       flashMsg.classList.add("flash-msg-success");
//       flashMsg.classList.add("flash-msg");
//       flashMsg.innerText = "Documento deletado com sucesso.";

//       const displayEnvioContainer = displayDataEnvio.parentElement;
//       displayDataEnvio.remove();
//       displayHoraEnvio.remove();

//       const envio = document.createElement("div");
//       envio.classList.add("file-upload-text-empty");
//       envio.innerText = "Sem envios";

//       displayEnvioContainer.appendChild(envio);

//       validadeDisplay.innerText = "Vazio";
//       validadeDisplay.classList.add("file-upload-text-empty");

//       validadeInput.value = "";
//       const uploadTextContainer = fileUploadText.parentElement;
//       fileUploadText.remove();
//       const uploadTextEmpty = document.createElement("span");
//       uploadTextEmpty.classList.add("file-upload-text");
//       uploadTextEmpty.classList.add("file-upload-text-empty");
//       uploadTextEmpty.innerHTML = "Vazio";

//       uploadTextContainer.insertBefore(uploadTextEmpty, uploadTextContainer.firstChild);

//       fileInput.addEventListener("change", () => {
//         const fileName = fileInput.files[0].name;
//         const fileURL = URL.createObjectURL(fileInput.files[0]);
//         const fileLink = document.createElement("a");
//         fileLink.classList.add("file-upload-text");

//         fileLink.href = fileURL;
//         fileLink.target = "_blank";
//         fileLink.innerText = fileName;

//         uploadTextEmpty.innerHTML = "";
//         uploadTextEmpty.appendChild(fileLink);
//         uploadTextEmpty.classList.remove("file-upload-text-empty");
//       });

//       body.appendChild(flashMsg);
//       setTimeout(() => {
//         flashMsg.remove();
//       }, 3000);
//     } else {
//       flashMsg.classList.add("flash-msg-error");
//       flashMsg.classList.add("flash-msg");
//       flashMsg.innerText = "Ocorreu um erro ao deletar o arquivo.";
//     }
//   } catch (e) {
//     const displayEnvioContainer = displayDataEnvio.parentElement;
//     displayDataEnvio.remove();
//     displayHoraEnvio.remove();

//     const envio = document.createElement("div");
//     envio.classList.add("file-upload-text-empty");
//     envio.innerText = "Sem envios";

//     displayEnvioContainer.appendChild(envio);

//     validadeDisplay.innerText = "Vazio";
//     validadeDisplay.classList.add("file-upload-text-empty");

//     validadeInput.value = "";
//     const uploadTextContainer = fileUploadText.parentElement;
//     fileUploadText.remove();
//     const uploadTextEmpty = document.createElement("span");
//     uploadTextEmpty.classList.add("file-upload-text");
//     uploadTextEmpty.classList.add("file-upload-text-empty");
//     uploadTextEmpty.innerHTML = "Vazio";

//     uploadTextContainer.insertBefore(uploadTextEmpty, uploadTextContainer.firstChild);

//     fileInput.addEventListener("change", () => {
//       const fileName = fileInput.files[0].name;
//       const fileURL = URL.createObjectURL(fileInput.files[0]);
//       const fileLink = document.createElement("a");
//       fileLink.classList.add("file-upload-text");

//       fileLink.href = fileURL;
//       fileLink.target = "_blank";
//       fileLink.innerText = fileName;

//       uploadTextEmpty.innerHTML = "";
//       uploadTextEmpty.appendChild(fileLink);
//       uploadTextEmpty.classList.remove("file-upload-text-empty");
//     });

//     const flashMsg = document.createElement("div");
//     flashMsg.classList.add("flash-msg-error");
//     flashMsg.classList.add("flash-msg");
//     flashMsg.innerText = "Ocorreu um erro ao deletar o arquivo.";

//     body.appendChild(flashMsg);
//     setTimeout(() => {
//       flashMsg.remove();
//     }, 3000);
//   }
// }
