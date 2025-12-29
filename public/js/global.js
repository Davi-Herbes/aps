const flashMsg = document.querySelector(".flash-msg");

console.log(flashMsg);

if (flashMsg) {
  setTimeout(() => {
    console.log(flashMsg);
    flashMsg.remove();
  }, 3000);
}
