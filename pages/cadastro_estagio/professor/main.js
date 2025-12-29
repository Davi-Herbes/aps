const inputAluno = document.querySelector("#aluno-input");
const datalist = document.querySelector(".datalist-input-data");

const alunoInputImgs = document.querySelectorAll(".aluno-input-label img");

const inputIdAluno = document.querySelector("#id-aluno-input");

const dados = datalist.children[0].children;

let selectedLi = dados[-1];

for (let i = 0; i < dados.length; i++) {
  const alunoLi = dados[i];
  const nomeAluno = alunoLi.getAttribute("value");
  const userId = alunoLi.getAttribute("user-id");

  alunoLi.addEventListener("mousedown", () => {
    inputAluno.value = nomeAluno;
    selectedLi = alunoLi;
    inputIdAluno.value = userId;
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
