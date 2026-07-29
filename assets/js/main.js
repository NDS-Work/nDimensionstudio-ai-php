document.addEventListener("DOMContentLoaded", function () {
  if (window.AOS) {
    AOS.init({ duration: 700, once: true, easing: "ease-out-cubic" });
  }

  document
    .querySelectorAll('[data-bs-toggle="collapse"]')
    .forEach(function (button) {
      button.addEventListener("click", function () {
        const target = document.querySelector(
          button.getAttribute("data-bs-target"),
        );
        if (target) {
          target.classList.toggle("show");
        }
      });
    });
});
function setOperatingModel(which) {
  const btnOld = document.getElementById("btn-old");
  const btnNd = document.getElementById("btn-nd");
  const panelOld = document.getElementById("panel-old");
  const panelNd = document.getElementById("panel-nd");
  if (which === "old") {
    btnOld.classList.add("active");
    btnNd.classList.remove("active");
    panelOld.classList.remove("hidden");
    panelNd.classList.add("hidden");
  } else {
    btnNd.classList.add("active");
    btnOld.classList.remove("active");
    panelNd.classList.remove("hidden");
    panelOld.classList.add("hidden");
  }
}

const problemData = {
  0: {
    system: "GrowSTACK",
    desc: "GrowSTACK builds demand at the top of the funnel and connects it to sales with nurture, automation and CRM alignment.",
    step: "Buyer + funnel mapping",
  },
  1: {
    system: "SEO + AI Engine",
    desc: "We map your brand to the queries buyers are making on Google and AI platforms, then build the content infrastructure to win them.",
    step: "Search visibility audit",
  },
  2: {
    system: "NurtureOS",
    desc: "Automate follow-up sequences across email and WhatsApp so no lead goes cold, with CRM sync keeping your team in the loop.",
    step: "CRM + sequence audit",
  },
  3: {
    system: "ConnectStack",
    desc: "Integrate WhatsApp with your CRM so every conversation is logged, assigned, and followed up automatically.",
    step: "Integration mapping",
  },
  4: {
    system: "ReportPilot",
    desc: "We connect your data sources and build live dashboards so reporting goes from days to minutes.",
    step: "Data source mapping",
  },
  5: {
    system: "DataLayer",
    desc: "Replace scattered spreadsheets with a single source of truth — structured, automated, and accessible to every team.",
    step: "Spreadsheet consolidation audit",
  },
  6: {
    system: "KnowledgeBase AI",
    desc: "Turn your internal docs, SOPs and tribal knowledge into a searchable AI-powered system your team can actually use.",
    step: "Knowledge audit",
  },
  7: {
    system: "CampaignEngine",
    desc: "Systematize campaign production with modular templates, approval flows, and automated asset delivery.",
    step: "Campaign process review",
  },
  8: {
    system: "BizGRID + Cre8LAB",
    desc: "Take the prototype to production with engineering, evals and interfaces.",
    step: "MVP scoping",
  },
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
