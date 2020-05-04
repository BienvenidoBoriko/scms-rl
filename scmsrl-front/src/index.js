import React from "react";
import ReactDOM from "react-dom";
import "./css/index.css";
import $ from "jquery";
import "bootstrap/dist/js/bootstrap.bundle.min";
import App from "./js/App";
import * as serviceWorker from "./js/serviceWorker";

ReactDOM.render(
  <React.StrictMode>
    <App />
  </React.StrictMode>,
  document.getElementById("root")
);
// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Noe this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
