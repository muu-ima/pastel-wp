(() => {
  const burger = document.getElementById("plBurger");
  const drawer = document.getElementById("plDrawer");
  const closeBtn = document.getElementById("plDrawerClose");
  const backdrop = document.getElementById("plDrawerBackdrop");

  if (!burger || !drawer) return;

  const open = () => {
    drawer.classList.add("is-open");
    drawer.setAttribute("aria-hidden", "false");
    burger.setAttribute("aria-expanded", "true");
    document.documentElement.style.overflow = "hidden";
  };

  const close = () => {
    drawer.classList.remove("is-open");
    drawer.setAttribute("aria-hidden", "true");
    burger.setAttribute("aria-expanded", "false");
    document.documentElement.style.overflow = "";
  };

  burger.addEventListener("click", () => {
    const isOpen = drawer.classList.contains("is-open");
    isOpen ? close() : open();
  });

  closeBtn?.addEventListener("click", close);
  backdrop?.addEventListener("click", close);

  // Escで閉じる
  window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") close();
  });
})();

// メニュー内リンクを押したら閉じる
drawer.querySelectorAll("a").forEach((a) => {
  a.addEventListener("click", () => close());
});
