import React from "react";
import parse from "html-react-parser";

/**
 *Muestra el contenido de un
 *posts
 *
 * @param {*} { content }
 * @returns
 */
const PostContent = ({ content }) => {
  return (
    <article className="post-content">
      <div className="container">
        <div className="row">
          <div className="col-md-10 col-lg-8 mx-auto">{parse(content)}</div>
        </div>
      </div>
    </article>
  );
};

export default PostContent;
