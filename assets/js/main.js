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

  initHeroRipple();
  initMovingBorderCtas();
  initProductDottedGlows();
});

function initProductDottedGlows() {
  document.querySelectorAll(".pg-card, .mega-card").forEach((card) => {
    card.addEventListener("pointermove", (event) => {
      if (event.pointerType === "touch") return;
      const bounds = card.getBoundingClientRect();
      const x = ((event.clientX - bounds.left) / bounds.width) * 100;
      const y = ((event.clientY - bounds.top) / bounds.height) * 100;
      card.style.setProperty("--pg-dot-x", `${x.toFixed(2)}%`);
      card.style.setProperty("--pg-dot-y", `${y.toFixed(2)}%`);
    });

    card.addEventListener("pointerleave", () => {
      card.style.setProperty("--pg-dot-x", "50%");
      card.style.setProperty("--pg-dot-y", "45%");
    });
  });
}

function initMovingBorderCtas() {
  document
    .querySelectorAll(
      'a.btn, button.btn[type="submit"], a.gs-btn-primary, a.gs-btn-secondary',
    )
    .forEach((cta) => cta.classList.add("moving-border-cta"));
}

function initHeroRipple() {
  const hero = document.querySelector("[data-hero-ripple]");
  const canvas = hero?.querySelector("[data-hero-ripple-canvas]");
  const context = canvas?.getContext("2d");
  if (!hero || !canvas || !context) return;

  const reducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;
  const highlightColor = [226, 226, 222];

  let width = 0;
  let height = 0;
  let cellSize = 72;
  let columns = 0;
  let rows = 0;
  let deviceScale = 1;
  let staticGrid = null;
  let ripples = [];
  let hoveredCell = null;
  let lastPointerCell = "";
  let animationFrame = 0;
  let resizeTimer = 0;
  let isVisible = true;

  const rgba = (color, alpha) =>
    `rgba(${color[0]}, ${color[1]}, ${color[2]}, ${alpha})`;

  function drawRoundedCell(target, x, y, size, radius) {
    const inset = 2;
    const left = x + inset;
    const top = y + inset;
    const side = Math.max(0, size - inset * 2);
    const corner = Math.min(radius, side / 2);

    target.beginPath();
    target.moveTo(left + corner, top);
    target.arcTo(left + side, top, left + side, top + side, corner);
    target.arcTo(left + side, top + side, left, top + side, corner);
    target.arcTo(left, top + side, left, top, corner);
    target.arcTo(left, top, left + side, top, corner);
    target.closePath();
    target.fill();
  }

  function buildStaticGrid() {
    staticGrid = document.createElement("canvas");
    staticGrid.width = canvas.width;
    staticGrid.height = canvas.height;
    const gridContext = staticGrid.getContext("2d");
    gridContext.scale(deviceScale, deviceScale);
    gridContext.strokeStyle = "rgba(10, 10, 10, 0.075)";
    gridContext.lineWidth = 1;

    for (let column = 0; column <= columns; column += 1) {
      const x = Math.min(width, column * cellSize) + 0.5;
      gridContext.beginPath();
      gridContext.moveTo(x, 0);
      gridContext.lineTo(x, height);
      gridContext.stroke();
    }

    for (let row = 0; row <= rows; row += 1) {
      const y = Math.min(height, row * cellSize) + 0.5;
      gridContext.beginPath();
      gridContext.moveTo(0, y);
      gridContext.lineTo(width, y);
      gridContext.stroke();
    }

    gridContext.fillStyle = "rgba(10, 10, 10, 0.085)";
    for (let row = 0; row < rows; row += 1) {
      for (let column = 0; column < columns; column += 1) {
        gridContext.beginPath();
        gridContext.arc(
          column * cellSize + cellSize / 2,
          row * cellSize + cellSize / 2,
          1.5,
          0,
          Math.PI * 2,
        );
        gridContext.fill();
      }
    }
  }

  function resizeCanvas() {
    const bounds = hero.getBoundingClientRect();
    width = Math.max(1, Math.round(bounds.width));
    height = Math.max(1, Math.round(bounds.height));
    cellSize = window.innerWidth < 768 ? 54 : 72;
    columns = Math.ceil(width / cellSize);
    rows = Math.ceil(height / cellSize);
    deviceScale = Math.min(window.devicePixelRatio || 1, 2);
    canvas.width = Math.round(width * deviceScale);
    canvas.height = Math.round(height * deviceScale);
    context.setTransform(deviceScale, 0, 0, deviceScale, 0, 0);
    buildStaticGrid();
    drawFrame(performance.now());
  }

  function addRipple(row, column, options = {}) {
    ripples = [{
      row,
      column,
      start: performance.now(),
      duration: reducedMotion ? 260 : options.duration || 1100,
      radius: reducedMotion ? 2.25 : options.radius || 7,
      strength: options.strength || 0.56,
      staticPulse: reducedMotion,
    }];
    startAnimation();
  }

  function drawFrame(now) {
    context.clearRect(0, 0, width, height);
    if (staticGrid) {
      context.drawImage(staticGrid, 0, 0, width, height);
    }

    if (hoveredCell) {
      context.save();
      context.shadowColor = "rgba(10, 10, 10, 0.06)";
      context.shadowBlur = 10;
      context.fillStyle = rgba(highlightColor, 0.4);
      drawRoundedCell(
        context,
        hoveredCell.column * cellSize,
        hoveredCell.row * cellSize,
        cellSize,
        8,
      );
      context.restore();
    }

    ripples = ripples.filter((ripple) => {
      const progress = Math.min(1, (now - ripple.start) / ripple.duration);
      const waveRadius = ripple.staticPulse ? 0 : progress * ripple.radius;
      const fade = Math.pow(1 - progress, 0.65);
      const range = Math.ceil(ripple.radius + 1);

      for (
        let row = Math.max(0, ripple.row - range);
        row <= Math.min(rows - 1, ripple.row + range);
        row += 1
      ) {
        for (
          let column = Math.max(0, ripple.column - range);
          column <= Math.min(columns - 1, ripple.column + range);
          column += 1
        ) {
          const distance = Math.hypot(row - ripple.row, column - ripple.column);
          const wave = ripple.staticPulse
            ? Math.max(0, 1 - distance / ripple.radius)
            : Math.max(0, 1 - Math.abs(distance - waveRadius) / 1.5);
          if (wave <= 0) continue;

          context.fillStyle = rgba(
            highlightColor,
            Math.min(0.52, ripple.strength * wave * fade),
          );
          drawRoundedCell(
            context,
            column * cellSize,
            row * cellSize,
            cellSize,
            8,
          );
        }
      }

      return progress < 1;
    });

    if (ripples.length && isVisible) {
      animationFrame = window.requestAnimationFrame(drawFrame);
    } else {
      animationFrame = 0;
    }
  }

  function startAnimation() {
    if (!animationFrame && isVisible) {
      animationFrame = window.requestAnimationFrame(drawFrame);
    }
  }

  function getPointerCell(event) {
    const bounds = hero.getBoundingClientRect();
    return {
      column: Math.max(
        0,
        Math.min(columns - 1, Math.floor((event.clientX - bounds.left) / cellSize)),
      ),
      row: Math.max(
        0,
        Math.min(rows - 1, Math.floor((event.clientY - bounds.top) / cellSize)),
      ),
    };
  }

  hero.addEventListener("pointermove", (event) => {
    if (event.pointerType === "touch") return;
    const cell = getPointerCell(event);
    const cellKey = `${cell.row}:${cell.column}`;
    hoveredCell = cell;

    if (cellKey !== lastPointerCell) {
      lastPointerCell = cellKey;
      drawFrame(performance.now());
    }
  });

  hero.addEventListener("pointerleave", () => {
    hoveredCell = null;
    lastPointerCell = "";
    drawFrame(performance.now());
  });

  hero.addEventListener("click", (event) => {
    const cell = getPointerCell(event);
    addRipple(cell.row, cell.column, {
      radius: 7,
      duration: 1100,
      strength: 0.56,
    });
  });

  window.addEventListener("resize", () => {
    window.clearTimeout(resizeTimer);
    resizeTimer = window.setTimeout(resizeCanvas, 160);
  });

  const visibilityObserver = new IntersectionObserver(
    ([entry]) => {
      isVisible = entry.isIntersecting && !document.hidden;
      if (isVisible) startAnimation();
    },
    { threshold: 0.02 },
  );
  visibilityObserver.observe(hero);

  document.addEventListener("visibilitychange", () => {
    isVisible = !document.hidden && hero.getBoundingClientRect().bottom > 0;
    if (isVisible) startAnimation();
  });

  resizeCanvas();

  window.addEventListener(
    "pagehide",
    () => {
      window.cancelAnimationFrame(animationFrame);
      visibilityObserver.disconnect();
    },
    { once: true },
  );
}

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
