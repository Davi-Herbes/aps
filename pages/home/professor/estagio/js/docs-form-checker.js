const docsInputs = document.querySelectorAll("#docs-form input");
/** @type HTMLButtonElement */
const submitDocsBtn = document.querySelector("button .submit-documento");

const formDocs = document.querySelector("#docs-form");

const initialDocsFormData = new FormData(formDocs);

function formDataChanged(fd1, fd2) {
  const entries1 = Array.from(fd1.entries());
  const entries2 = Array.from(fd2.entries());

  // Quantidade de campos diferente
  if (entries1.length !== entries2.length) return true;

  // Para facilitar, transformar em mapas: chave -> array de valores
  const map1 = group(entries1);
  const map2 = group(entries2);

  // Comparar chaves
  const keys1 = Object.keys(map1);
  const keys2 = Object.keys(map2);
  if (keys1.length !== keys2.length) return true;

  for (const key of keys1) {
    if (!map2[key]) return true;

    const arr1 = map1[key];
    const arr2 = map2[key];

    if (arr1.length !== arr2.length) return true;

    for (let i = 0; i < arr1.length; i++) {
      const v1 = arr1[i];
      const v2 = arr2[i];

      // Se for arquivo
      if (v1 instanceof File || v2 instanceof File) {
        if (!(v1 instanceof File && v2 instanceof File)) return true;
        if (v1.name !== v2.name) return true;
        if (v1.size !== v2.size) return true;
        continue;
      }

      // Se for valor simples
      if (v1 !== v2) return true;
    }
  }

  return false; // nada diferente
}

// Helper: agrupa múltiplos valores da mesma chave
function group(entries) {
  const map = {};
  for (const [k, v] of entries) {
    if (!map[k]) map[k] = [];
    map[k].push(v);
  }
  return map;
}

for (let i = 0; i < docsInputs.length; i++) {
  const input = docsInputs[i];

  input.addEventListener("input", () => {
    const formData = new FormData(formDocs);

    if (formDataChanged(initialDocsFormData, formData)) {
      submitDocsBtn.disabled = false;
    } else {
      submitDocsBtn.disabled = true;
    }
    console.log("OPA");
  });
}
