(function () {
  "use strict";

  const body = document.body;

  /* -----------------------------------------
	 Header Search Toggle
	 ----------------------------------------- */

  const searchTrigger = document.querySelector(".global-search-form-trigger");
  const searchDismiss = document.querySelector(".global-search-form-dismiss");
  const headSearchForm = document.querySelector(".global-search-form");

  function dismissHeadSearch(e) {
    if (e) {
      e.preventDefault();
    }

    headSearchForm.classList.remove("global-search-form-expanded");
    body.focus();
  }

  function displayHeadSearch(e) {
    if (e) {
      e.preventDefault();
    }

    headSearchForm.classList.add("global-search-form-expanded");

    setTimeout(function () {
      headSearchForm.querySelector(".global-search-input").focus();
    }, 50);
  }

  function isHeadSearchVisible() {
    return headSearchForm.classList.contains("global-search-form-expanded");
  }

  searchTrigger.addEventListener(
    "click",
    function (e) {
      e.preventDefault();

      displayHeadSearch();
    },
    false
  );

  searchDismiss.addEventListener(
    "click",
    function (e) {
      e.preventDefault();

      dismissHeadSearch();
    },
    false
  );

  document.addEventListener(
    "keydown",
    function (e) {
      e = e || window.e;

      if (e.key === "Escape" && isHeadSearchVisible()) {
        dismissHeadSearch(e);
      }
    },
    false
  );

  body.addEventListener("click", function (e) {
    if (isHeadSearchVisible()) {
      dismissHeadSearch();
    }
  });

  const elements = body.querySelectorAll(
    ".global-search-form, .global-search-form-trigger"
  );

  Array.from(elements).forEach(function (element) {
    element.addEventListener("click", function (e) {
      e.stopPropagation();
    });
  });
})();
