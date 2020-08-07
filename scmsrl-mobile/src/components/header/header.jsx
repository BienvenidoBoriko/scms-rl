import React from "react";
import config from "./../../utils/config";

/**
 *Crea una cabecera con una imagen de fondo
 *un titulo y la descripcion
 *
 * @param {*} { title, cover_img, desc }
 * @returns
 */
const Header = ({ title, cover_img, desc }) => {
  return (
    <header
      class="masthead"
      style={{ "background-image": "url(" + cover_img + ")" }}
    >
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto">
            <div class="site-heading">
              <h1>{title}</h1>
              <span class="subheading">{desc}</span>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
};

export default Header;
