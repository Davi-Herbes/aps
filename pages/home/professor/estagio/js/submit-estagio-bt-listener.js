const submitEstagioBtn = document.querySelector("#submit-estagio-btn");
const formEstagio = document.querySelector("#estagio-form");

submitEstagioBtn.addEventListener("click", () => {
  formEstagio.submit();
});
