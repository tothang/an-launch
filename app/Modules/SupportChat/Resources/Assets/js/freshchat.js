if (window.FreshChat && window.FreshChat.isActive === "1") {
  function initFreshChat() {
    var config = {
      token: window.FreshChat.ApiToken,
      host: "https://wchat.eu.freshchat.com",
      siteId: process.env.MIX_FRESHCHAT_SITE_ID,
      config: {
        headerProperty: {
          //If you have multiple sites you can use the appName and appLogo to overwrite the values.
          appName: window.FreshChat.AppName,
          backgroundColor: window.FreshChat.BackgroundColour,
          foregroundColor: window.FreshChat.Colour
        },
        content: {
          headers: {
            chat: window.FreshChat.AppName
          }
        }
      },
      externalId: window.FreshChat.externalId, // user’s id unique to your system
      firstName: window.FreshChat.FirstName, // user’s first name
    };

    window.fcWidget.init(config);
    window.fcWidget.user.setFirstName(window.FreshChat.FirstName);
    window.fcWidget.user.setEmail(window.FreshChat.Email);
  }

  function initialize(i, t) {
    var e;
    i.getElementById(t)
      ? initFreshChat()
      : (((e = i.createElement("script")).id = t),
        (e.async = !0),
        (e.src = "https://wchat.eu.freshchat.com/js/widget.js"),
        (e.onload = initFreshChat),
        i.head.appendChild(e));
  }

  function initiateCall() {
    initialize(document, "freshchat-js-sdk");
  }

  window.addEventListener
    ? window.addEventListener("load", initiateCall, !1)
    : window.attachEvent("load", initiateCall, !1);
}
