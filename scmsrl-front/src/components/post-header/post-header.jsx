import React from "react";
import * as moment from "moment";
import "moment/locale/es";

/**
 *cabecera para los posts
 *
 * @param {*} { title, author, published_at, img }
 * @returns
 */
const PostHeader = ({ title, author, published_at, img }) => {
  return (
    <header class="masthead" style={{ "background-image": `url(${img})` }}>
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-10 col-lg-8 mx-auto">
            <div class="post-heading">
              <h1>{title}</h1>
              {/* <h2 class="subheading">{desc}</h2> */}
              <span class="meta">
                Publicado por {author} {moment(published_at).fromNow()}
              </span>
            </div>
          </div>
        </div>
      </div>
    </header>
  );
};

export default PostHeader;
