const inputModalidade = document.querySelector("#modalidade-input");
const inputModalidadeSlot = document.querySelector("#modalidade-input-slot");
const datalistModalidade = document.querySelector(".field.modalidade .datalist-input-data");

const obj = {
  presencial: "Presencial",
  remoto: "Remoto",
  hibrido: "Híbrido",
};

inputModalidade.value = obj[inputModalidadeSlot.value] ?? "";

const modalidadeInputImgs = document.querySelectorAll(
  ".field.modalidade .modalidade-input-label img"
);

const dadosModalidade = datalistModalidade.children[0].children;

let selectedLiModalidade = dadosModalidade[-1];

for (let i = 0; i < dadosModalidade.length; i++) {
  const alunoLi = dadosModalidade[i];
  const nomeAluno = alunoLi.getAttribute("value");

  alunoLi.addEventListener("mousedown", () => {
    inputModalidadeSlot.value = nomeAluno;
    inputModalidade.value = alunoLi.innerText;
    selectedLiModalidade = alunoLi;
  });
}

inputModalidade.addEventListener("focus", () => {
  datalistModalidade.removeAttribute("hidden");

  for (let i = 0; i < modalidadeInputImgs.length; i++) {
    const input = modalidadeInputImgs[i];

    const src = input.src;

    input.src = src.slice(0, src.lastIndexOf(".")) + "-purple.svg";
  }
});

inputModalidade.addEventListener("blur", () => {
  datalistModalidade.setAttribute("hidden", "");
  for (let i = 0; i < dadosModalidade.length; i++) {
    const element = dadosModalidade[i];
    element.classList.remove("selected");
    element.style.display = "flex";
  }

  if (!selectedLiModalidade) {
    inputModalidade.value = "";
    inputModalidadeSlot.value = "";
  }

  for (let i = 0; i < modalidadeInputImgs.length; i++) {
    const input = modalidadeInputImgs[i];

    const src = input.src;

    input.src = src.slice(0, src.lastIndexOf("-purple")) + ".svg";
  }
});

inputModalidade.addEventListener("input", () => {
  const value = inputModalidade.value.toLowerCase();

  selectedLiModalidade = undefined;

  for (let i = 0; i < dadosModalidade.length; i++) {
    const alunoLi = dadosModalidade[i];
    const nomeAluno = alunoLi.getAttribute("value").toLowerCase();

    alunoLi.style.display = nomeAluno.includes(value) ? "flex" : "none";
  }
});

// Ajustar datas

// const dataInicioInput = document.querySelector("#data-inicio-input");
// const dataFimInput = document.querySelector("#data-fim-input");

// const hoje = new Date().toISOString().split("T")[0];

// dataInicioInput.min = hoje;
// dataFimInput.min = hoje;
