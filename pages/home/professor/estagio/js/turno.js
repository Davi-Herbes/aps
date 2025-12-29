const inputAluno = document.querySelector(".field.turno #turno-input");
const datalist = document.querySelector(".field.turno .datalist-input-data");

const alunoInputImgs = document.querySelectorAll(".field.turno .turno-input-label img");

const inputSlot = document.querySelector(".field.turno #turno-input-slot");

const dados = datalist.children[0].children;

const obj = {
  manha: "Manhã",
  tarde: "Tarde",
  noite: "Noite",
  integral: "Integral",
};

inputAluno.value = obj[inputSlot.value] ?? "";

let selectedLi = dados[-1];

for (let i = 0; i < dados.length; i++) {
  const alunoLi = dados[i];
  const nomeAluno = alunoLi.getAttribute("value");

  alunoLi.addEventListener("mousedown", () => {
    inputAluno.value = alunoLi.innerText;
    inputSlot.value = nomeAluno;
    selectedLi = alunoLi;
  });
}

inputAluno.addEventListener("focus", () => {
  datalist.removeAttribute("hidden");

  for (let i = 0; i < alunoInputImgs.length; i++) {
    const input = alunoInputImgs[i];

    const src = input.src;

    input.src = src.slice(0, src.lastIndexOf(".")) + "-purple.svg";
  }
});

inputAluno.addEventListener("blur", () => {
  datalist.setAttribute("hidden", "");
  for (let i = 0; i < dados.length; i++) {
    const element = dados[i];
    element.classList.remove("selected");
    element.style.display = "flex";
  }

  if (!selectedLi) {
    inputAluno.value = "";
    inputSlot.value = "";
  }

  for (let i = 0; i < alunoInputImgs.length; i++) {
    const input = alunoInputImgs[i];

    const src = input.src;

    input.src = src.slice(0, src.lastIndexOf("-purple")) + ".svg";
  }
});

inputAluno.addEventListener("input", () => {
  const value = inputAluno.value.toLowerCase();

  selectedLi = undefined;

  for (let i = 0; i < dados.length; i++) {
    const alunoLi = dados[i];
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
