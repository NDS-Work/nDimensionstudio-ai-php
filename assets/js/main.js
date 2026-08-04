const navigationEntry = performance.getEntriesByType?.("navigation")[0];
const isPageReload =
  navigationEntry?.type === "reload" ||
  window.performance?.navigation?.type === 1;

if (isPageReload) {
  if ("scrollRestoration" in window.history) {
    window.history.scrollRestoration = "manual";
  }

  const resetReloadScroll = () => {
    const root = document.documentElement;
    const previousScrollBehavior = root.style.scrollBehavior;
    root.style.scrollBehavior = "auto";
    window.scrollTo(0, 0);
    root.style.scrollBehavior = previousScrollBehavior;
  };

  resetReloadScroll();
  window.addEventListener(
    "load",
    () => {
      resetReloadScroll();
      window.requestAnimationFrame(() =>
        window.requestAnimationFrame(resetReloadScroll),
      );
    },
    { once: true },
  );
}

document.addEventListener("DOMContentLoaded", function () {
  if (window.AOS) {
    AOS.init({ duration: 700, once: true, easing: "ease-out-cubic" });
  }

});
function setOperatingModel(which) {
  const btnOld = document.getElementById("btn-old");
  const btnNd = document.getElementById("btn-nd");
  const panelOld = document.getElementById("panel-old");
  const panelNd = document.getElementById("panel-nd");
  if (!btnOld || !btnNd || !panelOld || !panelNd) return;

  if (which === "old") {
    btnOld.classList.add("active");
    btnNd.classList.remove("active");
    btnOld.setAttribute("aria-pressed", "true");
    btnNd.setAttribute("aria-pressed", "false");
    panelOld.classList.remove("is-dim");
    panelNd.classList.add("is-dim");
  } else {
    btnNd.classList.add("active");
    btnOld.classList.remove("active");
    btnNd.setAttribute("aria-pressed", "true");
    btnOld.setAttribute("aria-pressed", "false");
    panelNd.classList.remove("is-dim");
    panelOld.classList.add("is-dim");
  }
}

const problemData = {
  0: {
    system: "GrowSTACK",
    desc: "GrowSTACK builds demand at the top of the funnel and connects it to sales.",
    step: "Buyer + funnel mapping",
  },
  1: {
    system: "GrowSTACK",
    desc: "Get Found: SEO, AEO and GEO \u2014 visibility across Google and AI answer engines.",
    step: "Visibility audit",
  },
  2: {
    system: "GrowSTACK + BizGRID",
    desc: "Nurture + CRM automation with human handoff signals.",
    step: "Lifecycle map",
  },
  3: {
    system: "GrowSTACK",
    desc: "Two-way WhatsApp automation wired into your CRM with behaviour scoring.",
    step: "Integration blueprint",
  },
  4: {
    system: "BizGRID",
    desc: "Executive dashboards with automated data unification and exception alerts.",
    step: "Reporting audit",
  },
  5: {
    system: "DataLayer",
    desc: "Replace scattered spreadsheets with a single source of truth — structured, automated, and accessible to every team.",
    step: "Spreadsheet consolidation audit",
  },
  6: {
    system: "BizGRID",
    desc: "Employee-support agents that search SOPs, policies and documents.",
    step: "Knowledge audit",
  },
  7: {
    system: "Cre8LAB",
    desc: "AI-assisted production for ad variations, product visuals and short-form video.",
    step: "Creative sprint",
  },
  8: {
    system: "BizGRID + Cre8LAB",
    desc: "Take the prototype to production with engineering, evals and interfaces.",
    step: "MVP scoping",
  },
};

problemData[5] = {
  system: "BizGRID",
  desc: "Move spreadsheets into a governed data grid with lightweight custom UI.",
  step: "Process discovery",
};

document.querySelectorAll(".problem-option").forEach(function (el) {
  el.addEventListener("click", function (e) {
    e.preventDefault();

    // Toggle active card
    document.querySelectorAll(".problem-option").forEach(function (o) {
      o.classList.remove("active");
    });
    this.classList.add("active");

    const d = problemData[parseInt(this.getAttribute("data-index"))];
    const animItems = document.querySelectorAll(
      "#rec-title, #rec-desc, #rec-step",
    );

    // Step 1: slide items out downward
    animItems.forEach(function (item, i) {
      item.style.transition = "opacity 0.18s ease, transform 0.18s ease";
      item.style.transitionDelay = i * 0.04 + "s";
      item.style.opacity = "0";
      item.style.transform = "translateY(12px)";
    });

    // Step 2: after exit, swap content and animate up
    setTimeout(function () {
      document.getElementById("rec-title").textContent = d.system;
      document.getElementById("rec-desc").textContent = d.desc;
      document.getElementById("rec-step").textContent = d.step;

      animItems.forEach(function (item, i) {
        item.style.transform = "translateY(20px)"; // start below for the entrance
        item.style.opacity = "0";
        item.style.transition = "none";

        setTimeout(function () {
          item.style.transition = "opacity 0.3s ease, transform 0.3s ease";
          item.style.transitionDelay = i * 0.07 + "s";
          item.style.opacity = "1";
          item.style.transform = "translateY(0)";
        }, 20);
      });
    }, 220);
  });
});

(function () {
  const trigger = document.querySelector(".mega-trigger");
  const menu = document.querySelector(".mega-menu");
  if (!trigger || !menu) return;

  function open() {
    trigger.classList.add("open");
    menu.classList.add("open");
    trigger.setAttribute("aria-expanded", "true");
  }

  function close() {
    trigger.classList.remove("open");
    menu.classList.remove("open");
    trigger.setAttribute("aria-expanded", "false");
  }

  trigger.addEventListener("click", function (e) {
    e.preventDefault();
    menu.classList.contains("open") ? close() : open();
  });

  // close when clicking outside
  document.addEventListener("click", function (e) {
    if (!trigger.contains(e.target) && !menu.contains(e.target)) close();
  });

  // close on Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") close();
  });
})();

(function () {
  document
    .querySelectorAll(
      '.gs-layer-tabs [data-bs-toggle="pill"], .bg-layer-tabs [data-bs-toggle="pill"]',
    )
    .forEach(function (tabButton) {
      tabButton.addEventListener("shown.bs.tab", function (event) {
        const pane = document.querySelector(
          event.target.getAttribute("data-bs-target"),
        );
        const animatedCard = pane && pane.querySelector("[data-aos]");
        if (!animatedCard) return;

        animatedCard.classList.remove("aos-animate");
        void animatedCard.offsetWidth;
        animatedCard.classList.add("aos-animate");
      });
    });
})();
